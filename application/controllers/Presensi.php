<?php

defined('BASEPATH') or exit('No direct script access allowed');

class presensi extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load libary pagination
        $this->load->library('pagination');
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('PresensiModel');
        $this->load->library('excel');
    }

    public function index() {
        $config['base_url'] = site_url('presensi/index'); //site url
        $config['total_rows'] = $this->db->count_all('presensi'); //total row
        $config['per_page'] = 25;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $config["num_links"] = 5;

        $config['first_link'] = 'First';
        $config['last_link'] = 'Last';
        $config['next_link'] = 'Next';
        $config['prev_link'] = 'Prev';
        $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close'] = '</ul></nav></div>';
        $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close'] = '</span></li>';
        $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close'] = '</span>Next</li>';
        $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data'] = $this->list_model->get_presensi_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();
        $data['title'] = 'Presensi';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('presensi/presensi', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function makul() {
        
    }

    public function upload() {
        if (isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);

            for ($iii = 0; $iii < $countfiles; $iii++) {

                $path = $_FILES["file"]["tmp_name"][$iii];
                $object = PHPExcel_IOFactory::load($path);

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
                    $check = ['nama' => $makul, 'tahun' => $tahun, 'semester' => $semester, 'ruangan' => $ruangan, 'kelas' => $kelas];
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
                            } elseif ($nama == $dosen) {
                                $id = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                                if ($id == "") {
                                    $id = mt_rand(0, 999999);
                                }
                                $this->db->set('nip', $id)->where('idDosen', $idDosen)->update('dosen');
                            }
                        }
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
