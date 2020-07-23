<?php

class List_model extends CI_Model {

    //ambil data mahasiswa dari database
    function get_presensi_list($limit, $start) {
        return $this->db->get('presensi', $limit, $start);
    }

    function get_mahasiswa_list($limit, $start) {
        $this->db->order_by('nim', 'ASC');
        $query = $this->db->get('mahasiswa', $limit, $start);
        return $query;
    }

    function get_dosen_list($limit, $start) {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('dosen', $limit, $start);
        return $query;
    }

    function get_ruangan_list($limit, $start) {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('ruangan', $limit, $start);
        return $query;
    }

    function get_makul_list($limit, $start) {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('makul', $limit, $start);
        return $query;
    }

    function get_kapasitas_list($limit, $start) {
        $this->db->distinct();
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('makul', $limit, $start);
        return $query;
    }

}
