<?php

class Mahasiswa_model extends CI_model{

    public function getAllMahasiswa()
    {
        return $this->db->get('mahasiswa')->result_array();
        
    }

    public function tambahDataMahasiswa()
    {
        $data = array(
            'nama' => $this->input->post('nama', true),
            'nim' => $this->input->post('nim', true),
            'email' => $this->input->post('email', true),
            'jurusan' => $this->input->post('jurusan', true)
        );

        $this->db->insert('mahasiswa', $data);
    }

    public function hapusDataMahasiswa($id)
    {
        $this->db->where('id', $id);
        $this->db->delete('mahasiswa');
    }

    public function getMahasiswaByID($id)
    {
        return $this->db->get_where('mahasiswa', ['id' => $id])->row_array();
    }
    
    public function getMahasiswaByNIM($nim){
        return $this->db->get_where('mahasiswa',['nim'=>$nim])->row_array();
    }

    public function editDataMahasiswa()
    {
        $data = array(
            'nama' => $this->input->post('nama', true),
            'nim' => $this->input->post('nim', true),
            'email' => $this->input->post('email', true),
            'jurusan' => $this->input->post('jurusan', true)
        );
        
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('mahasiswa', $data);
    }

    public function getMahasiswa($limit, $start, $keyword = null)
    {
        if($keyword){
            $this->db->like('nama', $keyword);
            $this->db->or_like('nim', $keyword);
        }
        $this->db->order_by('nim','ASC');
        return $this->db->get('mahasiswa', $limit, $start)->result_array();
    }
    public function getMahasiswaNama($nim){
        $this->db->select('nama');
        $this->db->where('nim',$nim);
        return $this->db->get('mahasiswa')->row();
      
        
    }

    public function countAllMahasiswa()
    {
        return $this->db->get('mahasiswa')->num_rows();
    }
}