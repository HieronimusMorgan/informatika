<?php
class Jadwal_model extends CI_Model{

    //data matkul berdasarkan tahun
    function getDataMatkul($tahun){
    	$hasil = $this->db->query("SELECT * FROM makul where tahun = '$tahun'");
    	return $hasil->result();
    }
}
    