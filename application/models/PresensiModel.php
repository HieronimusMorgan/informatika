<?php

class PresensiModel extends CI_Model {

    public function view() {
        return $this->db->get('presensi')->result_array();
    }

    public function checkMakul($data) {
        return $this->db->get_where('makul', ['nama' => $data['nama'], 'tahun' => $data['tahun'], 'semester' => $data['semester'], 'kelas' => $data['kelas']])->num_rows();
    }

    public function idMakul($data) {
        $this->db->insert('makul', $data);
        $query = $this->db->select('idMakul')->from('makul')->where($data)->get();
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

    public function tambahKapasitas($id,$hitung)
    {
        $this->db->where('idMakul', $id);
        $this->db->update('makul', ['kapasitas'=>$hitung]);
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

    public function mahasiswaPresensi($id)
    {
        $this->db->distinct();
        $this->db->select('*');
        $this->db->from('presensi');
        $this->db->where('idMakul',$id);
        $data = $this->db->get();
        return $data;
    }

    public function cariMakul($id)
    {
        $this->db->from('makul');
        $this->db->where('idMakul',$id);
        $data = $this->db->get();
        return $data->row();
    }

    public function cariDosen($id)
    {
        $this->db->order_by('makul.idMakul', 'ASC');
        $this->db->distinct();
        $this->db->select('dosen.nama as dosen');
        $this->db->from('makul');
        $this->db->join('presensi','presensi.idMakul = makul.idMakul');
        $this->db->join('ruangan','ruangan.idRuangan = presensi.idRuangan');
        $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
        $this->db->where(' makul.idMakul',$id);
        $data = $this->db->get()->row();
        return $data;
    }
}