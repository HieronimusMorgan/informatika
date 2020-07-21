<?php
class Kapasitas_model extends CI_Model{

    public function makul()
    {
        $sql = "SELECT DISTINCT nama FROM makul";
        return $this->db->query($sql)->result_array();
    }

    public function kapasitas($statment)        
    {
        $sql = "SELECT a.Nim ,a.Nama, b.nama,b.tahun,b.semester  FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE a.Nim  ". $statment;
        echo $sql; die;
        return $this->db->query($sql)->result();
    }
}