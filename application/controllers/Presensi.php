<?php
defined('BASEPATH') or exit('No direct script access allowed');

class presensi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();        
        //load libary pagination
        $this->load->library('pagination'); 
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('PresensiModel');
        $this->load->library('excel');
    }

    public function index()
    {
        $config['base_url'] = site_url('presensi/index'); //site url
        $config['total_rows'] = $this->db->count_all('presensi'); //total row
        $config['per_page'] = 25;  //show record per halaman
        $config["uri_segment"] = 3;  // uri parameter
        $choice = $config["total_rows"] / $config["per_page"];
        $config["num_links"] = floor($choice);
        
        $config['first_link']       = 'First';
        $config['last_link']        = 'Last';
        $config['next_link']        = 'Next';
        $config['prev_link']        = 'Prev';
        $config['full_tag_open']    = '<div class="pagging text-center"><nav><ul class="pagination justify-content-center">';
        $config['full_tag_close']   = '</ul></nav></div>';
        $config['num_tag_open']     = '<li class="page-item"><span class="page-link">';
        $config['num_tag_close']    = '</span></li>';
        $config['cur_tag_open']     = '<li class="page-item active"><span class="page-link">';
        $config['cur_tag_close']    = '<span class="sr-only">(current)</span></span></li>';
        $config['next_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['next_tagl_close']  = '<span aria-hidden="true">&raquo;</span></span></li>';
        $config['prev_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['prev_tagl_close']  = '</span>Next</li>';
        $config['first_tag_open']   = '<li class="page-item"><span class="page-link">';
        $config['first_tagl_close'] = '</span></li>';
        $config['last_tag_open']    = '<li class="page-item"><span class="page-link">';
        $config['last_tagl_close']  = '</span></li>';

        $this->pagination->initialize($config);
        $data['page'] = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;

        $data['data'] = $this->list_model->get_presensi_list($config["per_page"], $data['page']);           

        $data['pagination'] = $this->pagination->create_links();


        $data['title'] = 'Presensi';

        $data['isi'] = $this->db->get_where('presensi')->result_array();
       
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('presensi/presensi',$data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function makul()
    {
        
    }
    public function upload()
    {        

        if(isset($_FILES["file"]["name"])) {
            $countfiles = count($_FILES["file"]["name"]);         

            for ($iii=0; $iii <  $countfiles; $iii++) { 
                
                $path = $_FILES["file"]["tmp_name"][$iii];
                $object = PHPExcel_IOFactory::load($path);
                
                foreach ($object ->getWorksheetIterator() as $worksheet) {
                    $highestRow = $worksheet ->getHighestRow();
                    $highestColumn = $worksheet ->getHighestColumn();
        
                    $tahun_ajar = $worksheet ->getCellByColumnAndRow(1,2);
                    $tahun_ajar_temp = explode(" T.A ",$tahun_ajar);

                    if($tahun_ajar_temp[1] == "") {
                        $tahun_ajar_temp = explode(" TAHUN AKADEMIK ",$tahun_ajar);
                    }

                    $periode = $tahun_ajar_temp[1];
                    $makulkelas = $worksheet->getCellByColumnAndRow(3, 4);
                    $makulkelas_temp = explode(" / ",$makulkelas);
                    $makul1 = $makulkelas_temp[0];
                    $makul = strtoupper($makul1);                    
                    $kelas = $makulkelas_temp[1];
                    $dosen = $worksheet->getCellByColumnAndRow(6,4);
                    $this->PresensiModel->addMakulDosen($makul1,$dosen);
                    $dosen = strtoupper($dosen);
                    $dosen = addslashes($dosen);

                    $data1 = $this->db->query("SELECT * FROM presensi WHERE Makul LIKE '".$makul1."' AND Kelas LIKE '".$kelas."' AND Dosen LIKE '".$dosen."' AND TahunAjaran LIKE '".$periode."'")->num_rows();

                    if($data1 == 0) {
                        for ($row=7; $row <= $highestRow ; $row++) { 
                            $nim = $worksheet ->getCellByColumnAndRow(2,$row) ->getValue();
                            $nama = $worksheet ->getCellByColumnAndRow(4,$row) ->getValue();
                            if($nim == 9) {
                                $data[] = array('Nim' => $nim,'Nama' => $nama,'Makul' =>$makul,'Kelas' => $kelas,'Dosen' => $dosen,'TahunAjaran' => $periode);                                
                            }
                        }

                    }else{

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