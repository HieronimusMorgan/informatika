<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kapasitas extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        //load libary pagination
        $this->load->library('pagination'); 
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('kapasitas_model');
    }

    public function index()
    {
        $data['title'] = 'Kapasitas Kelas';
        $data['makul'] = $this->kapasitas_model->makul();
        
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kapasitas/index',$data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        }
        
        public function filter()
        {
            $statment="";
            if ($this->input->post('angkatan')!="") {
                $angkatan=str_split($this->input->post('angkatan'));
                $statment =$statment." AND a.Nim LIKE '".$angkatan[2].$angkatan[3]."%'  ";
            }
            if ($this->input->post('makul')!="") {
                $makul = $this->input->post('makul');
                $statment=$statment." AND b.nama LIKE '".$makul."'  ";
            }
            if ($this->input->post('tahun')!="") {
                $tahun = $this->input->post('tahun');
                $statment=$statment." AND b.tahun LIKE '".$tahun."'  ";
            }
            if ($this->input->post('tipe')!="") {
                $tipe = $this->input->post('tipe');
                $statment=$statment." AND b.tipeMakul LIKE '".$tipe."'  ";
            }
            if ($this->input->post('dosen')!="") {
                $dosen =$this->input->post('dosen');
                $statment=$statment." AND c.nama LIKE '".$dosen."' ";
            }
            if ($this->input->post('semester')!="") {
                $semester =$this->input->post('semester');
                $statment=$statment." AND b.semester LIKE '".$semester."' ";
            }
            
            $data['title'] = 'Kapasitas Kelas';
            $data['kapasitas']=$this->kapasitas_model->kapasitas($statment);
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kapasitas/cari',$data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
            
        
    }

    
}