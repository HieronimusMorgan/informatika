<?php
defined('BASEPATH') or exit('No direct script access allowed');

class kolokium extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
    }

    public function index()
    {
        $data['title'] = 'Jadwal Kolokium';
        
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kolokium/index',$data);
        $this->load->view('templates/footer', $data);
    }
}