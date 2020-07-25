<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
    }

    public function index()
    {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi/index',$data);
        //$this->load->view('templates/footer', $data);
    }
    function c_makul() {
        $data['title'] = 'Manajemen Data Makul'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        

        //get data makul
        $data['makul'] = $this->Jadwal_model->getDataMatkul();

        $this->load->view('rekomendasi/datamakul',$data);
        $this->load->view('templates/footer', $data);

    }
    function c_dosen() {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi/index',$data);
        $this->load->view('templates/footer', $data);

    }
    function c_ruang() {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi/index',$data);
        $this->load->view('templates/footer', $data);

    }
    function c_jadwal() {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi/index',$data);
        $this->load->view('templates/footer', $data);

    }
}