<?php

class Data_model extends CI_Model {

    public function editMhs($nim) {
        $data = ['nim' => $nim];
        $this->session->set_userdata($data);
        redirect('home/editMahasiswa');
    }

    public function editMakul($data) {
        if ($this->db->get_where('makul', ['nama' => $data['nama'], 'tahun' => $data['tahun'], 'semester' => $data['semester']])->num_rows() == 1) {
            #update            
            $this->db->where('nama', $data['nama']);
            $this->db->update('makul', $edit);
        } else {
            $dataBaru = $this->db->query("SELECT idMakul FROM makul WHERE nama LIKE '" . $data['nama'] . "'")->row_array();
            $add = [
                'idMakul' => $dataBaru['idMakul'],
                'tipeMakul' => $data['tipeMakul'],
                'nama' => $data['nama'],
                'tahun' => $data['tahun'],
                'semester' => $data['semester'],
                'ruangan' => $data['ruangan'],
                'kapasitas' => $data['kapasitas']
            ];
            $this->db->insert('makul', $add);
        }
    }

}
