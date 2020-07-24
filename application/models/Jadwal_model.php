<?php
class Jadwal_model extends CI_Model{

    //data matkul berdasarkan tahun
    function getDataMatkul(){
    	$hasil = $this->db->query("SELECT * FROM makul");
    	return $hasil->result_array();
    }
}
    