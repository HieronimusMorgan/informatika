<?php

class Ruangan_model extends CI_model {

    public function getAllRuangan() {
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('ruangan')->result_array();
    }

    public function tambahDataRuangan() {
        $data = array(
            'nama' => $this->input->post('nama', true)
        );
        $this->db->insert('ruangsidang', $data);
    }

    public function hapusDataRuangan($id) {
        $this->db->where('idRuangan', $id);
        $this->db->delete('ruangsidang');
    }

    public function getRuanganByID($id) {
        return $this->db->get_where('ruangsidang', ['idRuangan' => $id])->row_array();
    }

    public function editDataRuangan() {
        $data = array(
            'nama' => $this->input->post('nama', true)
        );

        $this->db->where('idRuangan', $this->input->post('id'));
        $this->db->update('ruangan', $data);
    }

    public function getRuangan($limit, $start, $keyword = null) {
        if ($keyword) {
            $this->db->like('nama', $keyword);
        }
        $this->db->order_by('nama', 'ASC');
        return $this->db->get('ruangan', $limit, $start)->result_array();
    }

    public function countAllRuangan() {
        return $this->db->get('ruangan')->num_rows();
    }

}