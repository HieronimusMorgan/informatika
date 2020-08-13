<?php

class Kapasitas_model extends CI_Model {

    public function makul() {
        $this->db->distinct();
        $this->db->order_by('nama', 'ASC');
        $this->db->select('nama');
        $this->db->from('makul');
        return $this->db->get()->result_array();
    }

    public function kapasitas($statment) {

        $sql = "SELECT DISTINCT a.Nim AS nim, b.nama AS makul, b.tahun AS tahun, b.semester AS semester  FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE a.Nim  " . $statment;
        return $this->db->query($sql)->result();
    }

    public function ambilMakul($data, $angkatan, $cari) {
        if ($cari != NULL) {
            $sql = "SELECT DISTINCT a.Nim AS nim , b.nama AS makul FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen" . $data . " AND a.Nim LIKE '" . $angkatan . "%' ";
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
            $hasil = abs($this->db->query($sql)->num_rows() - $this->kapasitas_model->ambilMakul($data, $angkatan, $cari));
            return $hasil;
        } else {
            return $hasil;
        }
    }

    public function mhs($angkatan) {
        $this->db->distinct();
        $this->db->select('nim');
        $this->db->like('nim', $angkatan, 'after');
        $this->db->where('status', 'AKTIF');
        return $this->db->get('mahasiswa')->num_rows();
    }

    public function angkatan() {
        $this->db->distinct();
        $this->db->order_by('tahun', 'ASC');
        $this->db->select('tahun');
        $this->db->from('tahun');
        return $this->db->get()->result_array();
    }

    public function hitung($data, $makul) {
        $menu = $this->kapasitas_model->angkatan();
        $hitung = 0;
        foreach ($menu as $m) {
            $hitung += $this->kapasitas_model->ambilMakul($data, $m['tahun'], $makul);
        }
        return $hitung;
    }

    # MAKUL

    public function idSemester() {
        $this->db->distinct();
        $this->db->order_by('idSemester', 'ASC');
        $this->db->select('idSemester');
        $this->db->from('makul');
        return $this->db->get()->result_array();
    }

    public function tahunAjar() {
        $this->db->distinct();
        $this->db->order_by('tahun', 'ASC');
        $this->db->select('tahun');
        $this->db->from('makul');
        return $this->db->get()->result_array();
    }

    public function semester() {
        $this->db->distinct();
        $this->db->order_by('semester', 'ASC');
        $this->db->select('semester');
        $this->db->from('makul');
        return $this->db->get()->result_array();
    }

    public function tipeMakul() {
        $this->db->distinct();
        $this->db->order_by('tipeMakul', 'ASC');
        $this->db->select('tipeMakul');
        $this->db->from('makul');
        return $this->db->get()->result_array();
    }

    public function dosen() {
        $this->db->distinct();
        $this->db->order_by('nama', 'ASC');
        $this->db->select('nama');
        $this->db->from('dosen');
        return $this->db->get()->result_array();
    }

    public function ambilMakulAngkatan($data, $makul) {
        $sql = "SELECT DISTINCT a.Nim AS nim , b.nama AS makul FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen " . $data . " AND b.nama LIKE '" . $makul . "' ";
        // var_dump($this->db->query($sql)->num_rows());die;
        return $this->db->query($sql)->num_rows();
    }

    public function belumAmbilAngkatan($data, $makul) {
        $sql = "SELECT DISTINCT a.nim FROM presensi d JOIN makul b ON d.idMakul=b.idMakul JOIN dosen c ON d.idDosen=c.idDosen JOIN mahasiswa a  WHERE a.nim " . $data . " AND a.status = 'AKTIF'";
        $hasil = abs($this->db->query($sql)->num_rows() - $this->kapasitas_model->ambilMakulAngkatan($data, $makul));

        return $hasil;
    }

    public function makulAngkatan($angkatan) {
        $this->db->distinct();
        $this->db->select('nim');
        $this->db->like('nim', $angkatan);
        return $this->db->get('mahasiswa')->num_rows();
    }

}
