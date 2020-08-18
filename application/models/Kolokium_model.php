<?php

class Kolokium_model extends CI_model {

    public function getAllKolokium() {
        return $this->db->get('kolokium')->result_array();
    }

    public function tambahJadwalKolokium() {
//        $tanggal = $this->input->post('tanggal', true);
//        $tgl = format_indo($tanggal);

        $data = array(
            'nim' => $this->input->post('nim', true),
            'nama' => $this->input->post('nama', true),
            'dosen1' => $this->input->post('dosen1', true),
            'dosen2' => $this->input->post('dosen2', true),
            'judul' => $this->input->post('judul', true),
            'reviewer' => $this->input->post('reviewer', true),
            'tanggal' => $this->input->post('tanggal', true),
            'durasi' => $this->input->post('durasi', true),
            'ruang' => $this->input->post('ruang', true),
            'keterangan' => $this->input->post('keterangan', true),
            'nilai' => $this->input->post('nilai', true)
        );

        $this->db->insert('kolokium', $data);
    }

    public function hapusJadwalKolokium($id) {
        $this->historyHapusKolokium($id);
        $this->db->where('id', $id);
        $this->db->delete('kolokium');
    }
    
    public function hapusJadwalKolokiumHapus($id) {
        $this->db->where('id', $id);
        $this->db->delete('hapuskolokium');
    }
    
    public function hapusJadwalKolokiumPindah($id) {
        $this->db->where('id', $id);
        $this->db->delete('pindahkolokium');
    }

    public function historyHapusKolokium($id) {
        $data = $this->getKolokiumByID($id);
        $this->db->insert('hapusKolokium', $data);
    }

    public function pindahJadwalKolokium($id) {
        $data = $this->getKolokiumByID($id);
        $this->db->insert('pindahKolokium', $data);
        $this->db->where('id', $id);
        $this->db->delete('kolokium');
    }
    
    public function restorePindahKolokium($id){
        $data=$this->getPindahKolokiumByID($id);
        $this->db->insert('kolokium',$data);
        $this->db->where('id',$id);
        $this->db->delete('pindahkolokium');
    }
    
    public function restoreHapusKolokium($id){
        $data=$this->getHapusKolokiumByID($id);
        $this->db->insert('kolokium',$data);
        $this->db->where('id',$id);
        $this->db->delete('hapuskolokium');
    }

    public function getKolokiumByID($id) {
        return $this->db->get_where('kolokium', ['id' => $id])->row_array();
    }
    
    public function getHapusKolokiumByID($id) {
        return $this->db->get_where('hapuskolokium', ['id' => $id])->row_array();
    }
    
    public function getPindahKolokiumByID($id) {
        return $this->db->get_where('pindahkolokium', ['id' => $id])->row_array();
    }

    public function getKolokiumByNIM($nim) {
        return $this->db->get_where('kolokium', ['nim' => $nim])->row_array();
    }

    public function editJadwalKolokium() {
//        $tanggal = $this->input->post('tanggal', true);
//        $tgl = format_indo($tanggal);

        $data = array(
            'nim' => $this->input->post('nim', true),
            'nama' => $this->input->post('nama', true),
            'dosen1' => $this->input->post('dosen1', true),
            'dosen2' => $this->input->post('dosen2', true),
            'judul' => $this->input->post('judul', true),
            'reviewer' => $this->input->post('reviewer', true),
            'tanggal' => $this->input->post('tanggal', true),
            'durasi' => $this->input->post('durasi', true),
            'ruang' => $this->input->post('ruang', true),
            'keterangan' => $this->input->post('keterangan', true),
        );

        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kolokium', $data);
    }

    public function editNilaiKolokium() {
        $data = array('nilai' => $this->input->post('nilai', true));
        $this->db->where('id', $this->input->post('id'));
        $this->db->update('kolokium', $data);
    }

    public function getKolokium($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('nim', $keyword);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('kolokium', $limit, $start)->result_array();
    }
    
    public function getHistoryHapusKolokium($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('nim', $keyword);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('hapuskolokium', $limit, $start)->result_array();
    }
    
    public function getHistoryPindahKolokium($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->like('nama', $keyword);
            $this->db->or_like('nim', $keyword);
        }
        $this->db->order_by('id', 'DESC');
        return $this->db->get('pindahkolokium', $limit, $start)->result_array();
    }

    public function countAllKolokium() {
        return $this->db->get('kolokium')->num_rows();
    }

    public function cekStatusKolokium($nim) {
        return $this->db->get_where('kolokium', ['nim' => $nim])->row_array();
    }

//
//    public function cekBentrokKolokiumAll($dosen1, $dosen2, $reviewer) {
//        $this->db->or_where('dosen1', $dosen1);
//        $this->db->or_where('dosen1', $dosen2);
//        $this->db->or_where('dosen1', $reviewer);
//        $this->db->or_where('dosen2', $dosen1);
//        $this->db->or_where('dosen2', $dosen2);
//        $this->db->or_where('dosen2', $reviewer);
//        $this->db->or_where('reviewer', $dosen1);
//        $this->db->or_where('reviewer', $dosen2);
//        $this->db->or_where('reviewer', $reviewer);
//
//        return $this->db->get('kolokium')->result_array();
//    }
//
//    public function cekBentrokKolokiumAll2($dosen1, $reviewer) {
//        $this->db->or_where('dosen1', $dosen1);
//        $this->db->or_where('dosen1', $reviewer);
//        $this->db->or_where('reviewer', $dosen1);
//        $this->db->or_where('reviewer', $reviewer);
//
//        return $this->db->get('kolokium')->result_array();
//    }

    public function cekStatusRuang($tanggal) {
        $this->db->where('tanggal', $tanggal);
//        $this->db->where('durasi', $durasi);
        return $this->db->get('kolokium')->result_array();
    }

    public function cekStatusRuangEdit($tanggal, $durasi) {
        $this->db->or_where('tanggal', $tanggal);
        $this->db->or_where('durasi', $durasi);
        return $this->db->get('kolokium')->result_array();
    }

    public function cekStatusRuangEdit2($tanggal, $durasi, $ruang) {
        $this->db->where('tanggal', $tanggal);
        $this->db->where('durasi', $durasi);
        $this->db->where('ruang', $ruang);
        return $this->db->get('kolokium')->result_array();
    }

    public function cekStatusRuangEdit3($tanggal, $ruang) {
        $this->db->where('tanggal', $tanggal);
        $this->db->where('ruang', $ruang);
        return $this->db->get('kolokium')->result_array();
    }

    public function getKolokiumReport($statement) {
        $query = " SELECT * FROM kolokium WHERE " . $statement . " ORDER BY tanggal ASC ";

        return $this->db->query($query)->result_array();
    }

    public function getJumlahReport($statement) {
        return count($this->getKolokiumReport($statement));
    }

}
