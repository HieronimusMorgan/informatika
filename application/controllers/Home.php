<?php

defined('BASEPATH') or exit('No direct script access allowed');

class home extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->library('pagination');
        $this->load->model('list_model');
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
        $config['base_url'] = site_url('home/mahasiswa'); //site url
        $config['total_rows'] = $this->db->count_all('mahasiswa'); //total row

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

        $data['data'] = $this->list_model->get_mahasiswa_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = 'Data Mahasiswa';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/mahasiswa', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailMhs($nim) {
        $data['title'] = 'Detail Mahasiswa';
        $data['data'] = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/detailMhs', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editMhs($nim) {
        $this->session->set_tempdata('item', $nim, 1000);
        redirect('home/editMahasiswa');
    }

    public function editMahasiswa() {
        $nim = $this->session->tempdata('item');
        $data['title'] = 'Edit Mahasiswa';
        $data['data'] = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();

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
            $this->db->where('nim', $nim);
            $this->db->update('mahasiswa', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
             Mahasiswa berhasil di update!</div>');
            redirect('home/mahasiswa');
        }
    }

    public function deleteMhs($nim) {
        $hapus = $this->db->get_where('mahasiswa', ['nim' => $nim])->row_array();
        $this->db->delete('mahasiswa', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Mahasiswa berhasil di hapus!</div>');
        redirect('home/mahasiswa');
    }

    public function searchMhs() {
        // Ambil data NIS yang dikirim via ajax post
        $keyword = $this->input->post('keyword');
        $siswa = $this->SiswaModel->search($keyword);

        // Kita load file view.php sambil mengirim data siswa hasil query function search di SiswaModel
        $hasil = $this->load->view('view', array('siswa' => $siswa), true);

        // Buat sebuah array
        $callback = array(
            'hasil' => $hasil, // Set array hasil dengan isi dari view.php yang diload tadi
        );
        echo json_encode($callback); // konversi varibael $callback menjadi JSON
    }

    public function dosen() {
        $config['base_url'] = site_url('home/dosen'); //site url
        $config['total_rows'] = $this->db->count_all('dosen'); //total row

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

        $data['data'] = $this->list_model->get_dosen_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = 'Data Dosen';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/dosen', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editDsn($nip) {
        $this->session->set_tempdata('item', $nip, 1000);
        redirect('home/editDosen');
    }

    public function editDosen() {
        $nip = $this->session->tempdata('item');
        $data['title'] = 'Edit Dosen';
        $data['data'] = $this->db->get_where('dosen', ['nip' => $nip])->row_array();

        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('nip', 'nip', 'required');

        if ($this->form_validation->run() == false) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('data/editDsn', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $edit = [
                'nama' => $this->input->post('nama'),
                'nip' => $this->input->post('nip')
            ];
            $this->db->where('nip', $nip);
            $this->db->update('dosen', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Dosen berhasil di update!</div>');
            redirect('home/dosen');
        }
    }

    public function deleteDsn($nip) {
        $hapus = $this->db->get_where('dosen', ['nip' => $nip])->row_array();
        $this->db->delete('mahasiswa', $hapus);
        $this->session->set_flashdata('message', '<div class="alert alert-danger" role="success">
        Dosen berhasil di hapus!</div>');
        redirect('home/dosen');
    }

    public function makul() {
        $config['base_url'] = site_url('home/makul'); //site url
        $config['total_rows'] = $this->db->count_all('makul'); //total row

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

        $data['data'] = $this->list_model->get_makul_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = 'Data Mata Kuliah';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/makul', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editMakul($nama) {
        $this->session->set_tempdata('item', $nama, 1000);
        redirect('home/editMat');
    }

    public function editMat() {
        $nama = urldecode($this->session->tempdata('item'));
        $data['title'] = 'Edit Mata Kuliah';
        $data['data'] = $this->db->get_where('makul', ['nama' => $nama])->row_array();


        $this->form_validation->set_rules('tipe', 'Tipe', 'required');
        $this->form_validation->set_rules('nama', 'Nama', 'required');
        $this->form_validation->set_rules('tahun', 'Tahun', 'required');
        $this->form_validation->set_rules('semester', 'Semester', 'required');
        $this->form_validation->set_rules('ruangan', 'Ruangan', 'required');
        $this->form_validation->set_rules('kapasitas', 'Kapasitas', 'required');

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
                'ruangan' => $this->input->post('ruangan'),
                'kapasitas' => $this->input->post('kapasitas')
            ];

            $this->data_model->editMakul($edit);
            $this->db->where('kodeMakul', $kode);
            $this->db->update('makul', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Mata Kuliah berhasil di update!</div>');
            redirect('home/makul');
        }
    }

    public function ruangan() {
        $config['base_url'] = site_url('home/ruangan'); //site url
        $config['total_rows'] = $this->db->count_all('ruangan'); //total row

        $config['per_page'] = 25;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $config["num_links"] = 5;

        // $config['first_link'] = 'First';
        // $config['last_link'] = 'Last';
        // $config['next_link'] = 'Next';
        // $config['prev_link'] = 'Prev';
        // $config['full_tag_open'] = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        // $config['full_tag_close'] = '</ul></nav></div>';
        // $config['num_tag_open'] = '<li class="page-item"><span class="page-link">';
        // $config['num_tag_close'] = '</span></li>';
        // $config['cur_tag_open'] = '<li class="page-item active"><span class="page-link">';
        // $config['cur_tag_close'] = '<span class="sr-only">(current)</span></span></li>';
        // $config['next_tag_open'] = '<li class="page-item"><span class="page-link">';
        // $config['next_tagl_close'] = '<span aria-hidden="true">&raquo;</span></span></li>';
        // $config['prev_tag_open'] = '<li class="page-item"><span class="page-link">';
        // $config['prev_tagl_close'] = '</span>Next</li>';
        // $config['first_tag_open'] = '<li class="page-item"><span class="page-link">';
        // $config['first_tagl_close'] = '</span></li>';
        // $config['last_tag_open'] = '<li class="page-item"><span class="page-link">';
        // $config['last_tagl_close'] = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data'] = $this->list_model->get_ruangan_list($config["per_page"], $data['page']);

        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = 'Data Ruangan';

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('data/ruangan', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function editRuang($nama) {
        $this->session->set_tempdata('item', $nama, 1000);
        redirect('home/editRuangan');
    }

    public function editRuangan() {
        $nama = $this->session->tempdata('item');
        $data['title'] = 'Edit Ruangan';
        $data['data'] = $this->db->get_where('ruangan', ['nama' => $nama])->row_array();

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
                'makul' => $this->input->post('makul'),
                'jam' => $this->input->post('jam')
            ];
            $this->db->where('nama', $nama);
            $this->db->update('ruangan', $edit);
            $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Ruangan berhasil di update!</div>');
            redirect('home/ruangan');
        }
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
                                # code...
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
                            $data[] = array('nip' => $nim, 'nama' => $nama);
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
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "NIM"); // Set kolom B3 dengan tulisan "NIS"
        $excel->setActiveSheetIndex(0)->setCellValue('B1', "NAMA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('C1', "DPA"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('D1', "MINAT"); // Set kolom C3 dengan tulisan "NAMA"
        $excel->setActiveSheetIndex(0)->setCellValue('E1', "STATUS"); // Set kolom D3 dengan tulisan "JENIS KELAMIN"
        $excel->setActiveSheetIndex(0)->setCellValue('F1', "IPK"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('G1', "SKS"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('H1', "DOSBING"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->setActiveSheetIndex(0)->setCellValue('I1', "DOSBING 1"); // Set kolom E3 dengan tulisan "ALAMAT"
        $excel->getActiveSheet(0)->setTitle("Format Mahasiswa");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Format Mahasiswa.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

}
