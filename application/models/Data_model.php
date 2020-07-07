<?php
class Data_model extends CI_Model{

    public function editMhs($nim)
    {
        $data = ['nim' => $nim];
        $this->session->set_userdata($data);
        redirect('home/editMahasiswa');
    }
}
    