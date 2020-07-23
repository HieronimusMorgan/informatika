<?php

/**
 * 
 */
class PresensiModel extends CI_Model {

    public function view() {
        return $this->db->get('presensi')->result_array();
    }

    public function checkMakul($data) {
        return $this->db->get_where('makul', ['nama' => $data['nama'], 'tahun' => $data['tahun'], 'semester' => $data['semester'], 'ruangan' => $data['ruangan'], 'kelas' => $data['kelas']])->num_rows();
    }

    public function idMakul($data) {
        $this->db->insert('makul', $data);
        $query = $this->db->select('idMakul')->from('makul')->where('nama', $data['nama'])->get();
        $row = $query->row();
        return $row->idMakul;
    }

    public function idDosen($data) {
        if ($this->db->get_where('dosen', ['nama' => $data])->num_rows() == 0) {
            $this->db->insert('dosen', ['nama' => $data]);
            $query = $this->db->select('idDosen')->from('dosen')->where('nama', $data)->get();
            $row = $query->row();
            return $row->idDosen;
        } else {
            $query = $this->db->select('idDosen')->from('dosen')->where('nama', $data)->get();
            $row = $query->row();
            return $row->idDosen;
        }
    }

    public function idRuangan($data) {
        if ($this->db->get_where('ruangan', ['nama' => $data['nama'], 'makul' => $data['makul']])->num_rows() == 0) {
            $this->db->insert('ruangan', $data);
            $query = $this->db->select('idRuangan')->from('ruangan')->where(['nama' => $data['nama'], 'makul' => $data['makul']])->get();
            $row = $query->row();
            return $row->idRuangan;
        } else {
            $query = $this->db->select('idRuangan')->from('ruangan')->where(['nama' => $data['nama'], 'makul' => $data['makul']])->get();
            $row = $query->row();
            return $row->idRuangan;
        }
    }

    public function tahun($nim) {
        $th = str_split($nim);
        $data = $th[0] . $th[1];
        if ($this->db->get_where('tahun', ['tahun' => $data])->num_rows() == 0) {
            $this->db->set('tahun', $data);
            $this->db->insert('tahun');
        }
    }

    public function insert($data) {
        $this->db->insert_batch('presensi', $data);
    }

    public function insertMhs($data) {
        $this->db->insert_batch('mahasiswa', $data);
    }

    public function presensi() {
        $sql = "SELECT a.Nim, a.Nama, b.nama, b.kelas, c.nama, d.nama FROM presensi a JOIN makul b ON a.idMakul = b.idMakul JOIN ruangan c ON b.idMakul = c.makul JOIN dosen d ON a.idDosen=d.idDosen";
        $a = $this->db->query($sql);
        var_dump($a);
        die;
    }

}
