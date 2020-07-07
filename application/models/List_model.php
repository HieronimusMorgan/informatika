<?php
class List_model extends CI_Model{
    
    //ambil data mahasiswa dari database
    function get_presensi_list($limit, $start){
        $query = $this->db->get('presensi', $limit, $start);
        return $query;
    }
    function get_mahasiswa_list($limit, $start){
        $query = $this->db->get('mahasiswa', $limit, $start);
        return $query;
    }
    function get_dosen_list($limit, $start){
        $query = $this->db->get('dosen', $limit, $start);
        return $query;
    }
    function get_ruangan_list($limit, $start){
        $query = $this->db->get('ruangan', $limit, $start);
        return $query;
    }function get_makul_list($limit, $start){
        $query = $this->db->get('makul', $limit, $start);
        return $query;
    }
}