<?php

class Kapasitas_model extends CI_Model {

    public function makul() {
        $sql = "SELECT DISTINCT nama FROM makul";
        return $this->db->query($sql)->result_array();
    }

    public function kapasitas($statment) {
        $sql = "SELECT DISTINCT a.Nim AS nim, b.nama AS makul, b.tahun AS tahun, b.semester AS semester  FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE a.Nim  " . $statment;
        return $this->db->query($sql)->result();
    }

    public function ambilMakul($data, $angkatan, $cari) {
        if ($cari != NULL) {
            $sql = "SELECT DISTINCT a.Nim AS nim , b.nama AS makul FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE a.Nim " . $data . " AND a.Nim LIKE '" . $angkatan . "%' ";
            return $this->db->query($sql)->num_rows();
        } else {
            $this->session->set_flashdata('makul', '<div class="alert alert-danger" role="danger">
                       Mata Kuliah kosong!</div>');
            return 0;
        }
    }

    public function belumAmbil($data, $angkatan, $cari) {
        $hasil = 0;
        if ($cari != NULL) {
            $sql = "SELECT DISTINCT nim FROM mahasiswa WHERE nim LIKE '" . $angkatan . "%' AND status = 'AKTIF'";
            $sql1 = "SELECT a.Nim FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE a.Nim " . $data . " AND a.Nim LIKE '" . $angkatan . "%'";
            $hasil = abs($this->db->query($sql)->num_rows() - $this->db->query($sql1)->num_rows());
            return $hasil;
        } else {
            return $hasil;
        }
    }

    public function mhs($angkatan) {
        $sql = "SELECT DISTINCT nim FROM mahasiswa WHERE nim LIKE '" . $angkatan . "%' AND status = 'AKTIF'";
        // var_dump($sql);die;
        return $this->db->query($sql)->num_rows();
    }

    public function tahun() {
        $sql = "SELECT DISTINCT tahun FROM tahun ORDER BY tahun ASC";
        return $menu = $this->db->query($sql)->result_array();
    }

}
