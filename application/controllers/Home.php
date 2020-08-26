<?php

defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('list_model');
        $this->load->model('Ruangan_model');
        $this->load->model('data_model');
        $this->load->library('excel');
    }

    public function index() {
        $data['title'] = 'Presensi';
        $data['isi'] = $this->db->get_where('presensi')->result_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('home', $data);
        $this->load->view('templates/footer', $data);
    }

    public function mahasiswa() {
        
        $data['data'] = $this->list_model->get_mahasiswa_list();

        $data['title'] = 'Data Mahasiswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/mahasiswa', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailMhs($idMahasiswa) {
        $data['title'] = 'Detail Mahasiswa';
        $data['data'] = $this->db->get_where('mahasiswa', ['idMahasiswa' => $idMahasiswa])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/detailMhs', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editMhs($idMahasiswa) {
        $this->session->set_tempdata('item', $idMahasiswa, 1000);
        redirect('home/editMahasiswa');
    }

    public function editMahasiswa() {
        $idMahasiswa = $this->session->tempdata('item');
        $data['title'] = 'Edit Mahasiswa';
        $data['data'] = $this->db->get_where('mahasiswa', ['idMahasiswa' => $idMahasiswa])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nim', 'NIM', 'required');
        //  $this->form_validation->set_rules('dpa', 'DPA', 'required');
        //  $this->form_validation->set_rules('ipk', 'IPK', 'required');
        //  $this->form_validation->set_rules('sks', 'SKS', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('data/editMhs', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'nama' => $this->input->post('nama'),
                'nim' => $this->input->post('nim'),
                'dpa' => $this->input->post('dpa'),
                'minat' => $this->input->post('minat'),
                'status' => $this->input->post('status')
            ];
            $this->db->where('idMahasiswa', $idMahasiswa);
            $this->db->update('mahasiswa', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
             Mahasiswa berhasil di update!</div>');
            redirect('home/mahasiswa');
        }
    }

    public function deleteMhs($idMahasiswa) {
        $hapus = $this->db->get_where('mahasiswa', ['idMahasiswa' => $idMahasiswa])->row_array();
        $this->db->delete('mahasiswa', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Mahasiswa berhasil di hapus!</div>');
        redirect('home/mahasiswa');
    }

    public function dosen() {
       
        $data['data'] = $this->list_model->get_dosen_list();

        $data['title'] = 'Data Dosen';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/dosen', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editDsn($idDosen) {
        $this->session->set_tempdata('item', $idDosen, 1000);
        redirect('home/editDosen');
    }

    public function editDosen() {
        $idDosen = $this->session->tempdata('item');
        $data['title'] = 'Edit Dosen';
        $data['data'] = $this->db->get_where('dosen', ['idDosen' => $idDosen])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'nip', 'required');
        // $this->form_validation->set_rules('prodi', 'prodi', 'required');
        // $this->form_validation->set_rules('status', 'status', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('data/editDsn', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'npp' => $this->input->post('nip'),
                'nama' => $this->input->post('nama'),
                'prodi' => $this->input->post('prodi'),
                'status' => $this->input->post('status'),
            ];
            $this->db->where('idDosen', $idDosen);
            $this->db->update('dosen', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Dosen berhasil di update!</div>');
            redirect('home/dosen');
        }
    }

    public function deleteDsn($idDosen) {
        $hapus = $this->db->get_where('dosen', ['idDosen' => $idDosen])->row_array();
        $this->db->delete('dosen', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Dosen berhasil di hapus!</div>');
        redirect('home/dosen');
    }

    public function makul() {
       
        $data['data'] = $this->list_model->get_makul_list();

        $data['title'] = 'Data Mata Kuliah';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/makul', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editMakul($idMakul) {
        $this->session->set_tempdata('item', $idMakul);
        redirect('home/editMat');
    }

    public function editMat() {
        $idMakul = urldecode($this->session->tempdata('item'));
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
            $this->load->view('data/editMakul', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'tipeMakul' => $this->input->post('tipe'),
                'nama' => $this->input->post('nama'),
                'tahun' => $this->input->post('tahun'),
                'semester' => $this->input->post('semester'),
                'kapasitas' => $this->input->post('kapasitas')
            ];

            $this->db->where('idMakul', $idMakul);
            $this->db->update('makul', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Mata Kuliah berhasil di update!</div>');
            redirect('home/makul');
        }
    }

    public function deleteMakul($idMakul)
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
        Mata Kuliah berhasil di hapus!</div>');
        redirect('home/makul');
    }

    public function ruangan() {
        
        $data['data'] = $this->list_model->get_ruangan_list();

        $data['title'] = 'Data Ruangan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/ruangan', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editRuang($idRuangan) {
        $this->session->set_tempdata('item', $idRuangan);
        redirect('home/editRuangan');
    }

    public function editRuangan() {
        $idRuangan = $this->session->tempdata('item');
        $data['title'] = 'Edit Ruangan';
        $data['data'] = $this->db->get_where('ruangan', ['idRuangan' => $idRuangan])->row_array();

        $this->form_validation->set_rules('nama', 'nama', 'required');
        $this->form_validation->set_rules('makul', 'Makul', 'required');
        $this->form_validation->set_rules('jam', 'Jam', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('data/editRuang', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'nama' => $this->input->post('nama'),
                'jam' => $this->input->post('jam')
            ];
            $this->db->where('idRuangan', $idRuangan);
            $this->db->update('ruangan', $edit);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Ruangan berhasil di update!</div>');
            redirect('home/ruangan');
        }
    }

    public function deleteRuang($idRuangan)
    {
        $this->db->select("idMakul");
        $this->db->where('idRuangan',$idRuangan);
        $this->db->from('presensi');
        $idMakul = $this->db->get()->row();

        #delete presensi
        $this->db->where('idRuangan',$idRuangan);
        $this->db->delete('presensi');


        #delete makul
        $this->db->where('idMakul',$idMakul->idMakul);
        $this->db->delete('makul');

        $hapus = array (
            "idRuangan" => $idRuangan
        );
        $this->db->delete('ruangan', $hapus);

        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Ruangan berhasil di hapus!</div>');
        redirect('home/ruangan');
    }


    public function ruanganSidang() {
        
        $data['data'] = $this->list_model->get_ruanganSidang_list();

        $data['title'] = 'Data Ruangan Sidang';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/ruanganSidang', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambahRuangSidang()
    {
        $this->Ruangan_model->tambahDataRuangan();
         $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Ruangan Sidang berhasil di tambah!</div>');
        redirect('home/ruanganSidang');
    }

    public function editRuangSidang($idRuangan) {
        $this->session->set_tempdata('item', $idRuangan);
        redirect('home/editRuanganSidang');
    }

    public function editRuanganSidang() {
        $idRuangan = $this->session->tempdata('item');
        $data['title'] = 'Edit Ruangan Sidang';
        $data['data'] = $this->db->get_where('ruangsidang', ['idRuangan' => $idRuangan])->row_array();

        $this->form_validation->set_rules('nama', 'nama', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('data/editRuangSidang', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'nama' => $this->input->post('nama')
            ];
            $this->db->where('idRuangan', $idRuangan);
            $this->db->update('ruangsidang', $edit);
            
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Ruangan Sidang berhasil di update!</div>');
            redirect('home/ruanganSidang');
        }
    }
    public function deleteRuangSidang($idRuangan)
    {
        $this->db->where('idRuangan',$idRuangan);
        $this->db->delete('ruangsidang');

        
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
         Ruang Sidang berhasil di hapus!</div>');
        redirect('home/ruanganSidang');
    }

    public function uploadMahasiswa() {

        if (isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);

            for ($iii = 0; $iii < $countfiles; $iii++) {

                $path = $_FILES["file"]["tmp_name"][$iii];
                $object = PHPExcel_IOFactory::load($path);

                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    $num = 1;
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $nim = $worksheet->getCellByColumnAndRow(0, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        $dpa = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $minat = $worksheet->getCellByColumnAndRow(3, $row)->getValue();
                        $status = $worksheet->getCellByColumnAndRow(4, $row)->getValue();
                        $ipk = $worksheet->getCellByColumnAndRow(5, $row)->getValue();
                        $sks = $worksheet->getCellByColumnAndRow(6, $row)->getValue();
                        $dosbing = $worksheet->getCellByColumnAndRow(7, $row)->getValue();
                        $dosbing1 = $worksheet->getCellByColumnAndRow(8, $row)->getValue();

                        if (strlen($nim) == 9) {
                            if ($this->db->get_where('mahasiswa', ['nim' => $nim])->num_rows() == 0) {
                                $data[] = array('Nim' => $nim, 'Nama' => $nama, 'dpa' => $dpa, 'minat' => $minat, 'status' => $status
                                    , 'ipk' => $ipk, 'sks' => $sks, 'dosbing' => $dosbing, 'dosbing1' => $dosbing1);
                                $num++;
                            }
                        }
                    }
                }
            }
            if ($data) {
                $this->db->insert_batch('mahasiswa', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                            ' . $num . ' Data mahasiswa berhasil di import!</div>');
            } else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                            Data mahasiswa sudah di import!</div>');
            }
        }
        redirect('home/mahasiswa');
    }

    public function uploadDosen() {
        if (isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);

            for ($iii = 0; $iii < $countfiles; $iii++) {

                $path = $_FILES["file"]["tmp_name"][$iii];
                $object = PHPExcel_IOFactory::load($path);

                foreach ($object->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet->getHighestRow();
                    $highestColumn = $worksheet->getHighestColumn();
                    for ($row = 2; $row <= $highestRow; $row++) {
                        $nim = $worksheet->getCellByColumnAndRow(2, $row)->getValue();
                        $nama = $worksheet->getCellByColumnAndRow(1, $row)->getValue();
                        if ($this->db->get_where('dosen', ['nama' => $nama])->num_rows() == 0) {
                            $data[] = array('npp' => $nim, 'nama' => $nama);
                        }
                    }
                }
            }
            if ($data) {
                $this->db->insert_batch('dosen', $data);
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                            Data berhasil di import!</div>');
            }
        }
        redirect('home/dosen');
    }

    public function formatmhs() {
        $excel = new PHPExcel();
        $excel->getProperties()->setTitle("Format Mahasiswa");
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "NIM"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "NAMA");
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "DPA"); 
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "MINAT"); 
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "STATUS");
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "IPK"); 
        $excel->setActiveSheetIndex(0)->setCellValue('G1', "SKS"); 
        $excel->setActiveSheetIndex(0)->setCellValue('H1', "DOSBING"); 
        $excel->setActiveSheetIndex(0)->setCellValue('I1', "DOSBING 1");
        $excel->getActiveSheet(0)->setTitle("Format Mahasiswa");
        $excel->setActiveSheetIndex(0);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Format Mahasiswa.xlsx"'); 
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }
    
    public function formatdosen() {
        $excel = new PHPExcel();
        $excel->getProperties()->setTitle("Format Dosen");
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "NPP"); 
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "NAMA");
        $excel->getActiveSheet(0)->setTitle("Format Dosen");
        $excel->setActiveSheetIndex(0);
        
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Format Dosen.xlsx"'); 
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

}