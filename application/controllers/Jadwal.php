<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
    }

    public function index()
    {

    }
    function get_makul_tahun() {
    	$id = $this->input->post('tahun');
    	$data = $this->Jadwal_model->getDataMatkul('$id');
    	echo json_encode($data);

    }

    
}