<?php

defined('BASEPATH') or exit('No direct script access allowed');

class presensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        
        $this->load->library('form_validation');
        //load libary pagination
        $this->load->library('pagination');
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('PresensiModel');
        $this->load->library('excel');
    }

    public function index() {
        $data['data'] = $this->list_model->get_presensi_list();
        $data['title'] = 'Presensi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('presensi/presensi', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function isi($id) {
        $data['makul'] = $this->PresensiModel->cariMakul($id);
        $data['mahasiswa'] = $this->PresensiModel->mahasiswaPresensi($id);
        $data['title'] = 'Presensi';
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('presensi/isi', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    
    public function editPresensi($idMakul) {
        $this->session->set_tempdata('item', $idMakul);
        redirect('presensi/editPresensi1');
    }

    public function editPresensi1() {
        $idMakul = urldecode($this->session->tempdata('item'));
        $data['mahasiswa'] = $this->PresensiModel->mahasiswaPresensi($idMakul);
        $data['title'] = 'Edit Mata Kuliah';
        $this->db->select('makul.* , ruangan.nama as ruangan');
        $this->db->from('makul');
        $this->db->join('ruangan','ruangan.makul = makul.idMakul');
        $this->db->where('makul.idMakul', $idMakul);
        $data['data'] = $this->db->get()->row_array();

        // $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('presensi/editPresensi', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'kodeMakul' => $this->input->post('kode'),
                'tipeMakul' => $this->input->post('tipe'),
                'nama' => $this->input->post('nama'),
                'tahun' => $this->input->post('tahun'),
                'semester' => $this->input->post('semester'),
                'kapasitas' => $this->input->post('kapasitas')
            ];

            $this->db->where('idMakul', $idMakul);
            $this->db->update('makul', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Presensi berhasil di update!</div>');
            redirect('presensi/isi/'.$idMakul);
        }
    }

    public function deletePresensi($idMakul)
    {
        #delete presensi
        $this->db->where('idMakul',$idMakul);
        $this->db->delete('presensi');
        #delete ruangan
        $this->db->where('makul',$idMakul);
        $this->db->delete('ruangan');

        $hapus = array (
            "idMakul" => $idMakul
        );
        $this->db->delete('makul', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Presensi berhasil di hapus!</div>');
        redirect('presensi');
    }


    public function upload() {
        if (isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);

            for ($iii = 0; $iii < $countfiles; $iii++) {

                $path = $_FILES["file"]["tmp_name"][$iii];


                $object = PHPExcel_IOFactory::load($path);
                $hitung = 0;
                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $makulkelas = $worksheet->getCellByColumnAndRow(3, 4);
                    $makulkelas_temp = explode(" / ", $makulkelas);
                    $tahun_ajar = $worksheet->getCellByColumnAndRow(1, 2);
                    if (count(explode(" T.A ", $tahun_ajar)) == 2) {
                        $tahun_ajar_temp = explode(" T.A ", $tahun_ajar);
                    } else {
                        $tahun_ajar_temp = explode(" TAHUN AKADEMIK ", $tahun_ajar);
                    }

                    $periode = $tahun_ajar_temp[1];

                    $periode_temp = explode(" ", $periode);

                    $waktu = $worksheet->getCellByColumnAndRow(18, 4);
                    $waktu_temp = explode("/", $waktu);
                    #Dosen                    
                    $dosen = $worksheet->getCellByColumnAndRow(6, 4);

                    #MAKUL
                    #nama Makul
                    $makul = $makulkelas_temp[0];
                    #tahun Makul
                    $tahun = $periode_temp[0];
                    #semester Makul
                    $semester = $periode_temp[3];
                    #ruangan Makul
                    $ruangan = $waktu_temp[2];
                    #kelas Makul                                     
                    $kelas = $makulkelas_temp[1];
                    #hari Makul
                    $hari = $waktu_temp[0];
                    #jam Makul
                    $jam = $waktu_temp[1];
                    $check = ['nama' => $makul, 'tahun' => $tahun, 'semester' => $semester, 'kelas' => $kelas];

                    $data1 = $this->PresensiModel->checkMakul($check);
                    if ($data1 == 0) {
                        $idMakul = $this->PresensiModel->idMakul($check);
                        #idDosen
                        $idDosen = $this->PresensiModel->idDosen($dosen);
                        $ruang = ['nama' => $ruangan, 'makul' => $idMakul, 'hari' => $hari, 'jam' => $jam];
                        $idRuangan = $this->PresensiModel->idRuangan($ruang);
                        for ($row = 7; $row <= $highestRow; $row++) {
                            $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                            $nama = ucwords($worksheet->getCellByColumnAndRow(4, $row)->getValue());
                            if (strlen($nim) == 9) {
                                $this->PresensiModel->tahun($nim);
                                $data[] = array('Nim' => $nim, 'Nama' => $nama, 'idMakul' => $idMakul, 'idDosen' => $idDosen, 'idRuangan' => $idRuangan);
                                $hitung++;
                            } elseif ($nama == $dosen) {
                                $id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                if ($id == "") {
                                    $id = mt_rand(0, 999999);
                                }
                                $this->db->set('npp', $id)->where('idDosen', $idDosen)->update('dosen');
                            }
                        }
                        $this->PresensiModel->tambahKapasitas($idMakul, $hitung);
                        $hitung = 0;
                    } else {
                        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                        Data sudah di import!</div>');
                    }
                }
            }

            if ($data) {

                $this->PresensiModel->insert($data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                        Data berhasil di import!</div>');
            }
        }
        redirect('presensi');
    }

}