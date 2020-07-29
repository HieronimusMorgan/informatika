<?php

class List_model extends CI_Model {

    //ambil data mahasiswa dari database
    function get_presensi_list() {
        $this->db->order_by('idMakul', 'ASC');
        return $this->db->get('presensi');
    }

    function get_mahasiswa_list() {
        $this->db->order_by('nim', 'ASC');
        $query = $this->db->get('mahasiswa');
        return $query;
    }

    function get_dosen_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('dosen');
        return $query;
    }

    function get_ruangan_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('ruangan');
        return $query;
    }

    function get_makul_list() {
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('makul');
        return $query;
    }

    function get_kapasitas_list() {
        $this->db->distinct();
        $this->db->order_by('nama', 'ASC');
        $query = $this->db->get('makul');
        return $query;
    }

}