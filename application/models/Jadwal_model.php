<?php
class Jadwal_model extends CI_Model{

    //data matkul berdasarkan tahun
    function getDataMatkul(){
    	$hasil = $this->db->query("SELECT * FROM makul");
    	return $hasil->result_array();
    }
    function getDataDosen(){
    	$data = $this->db->get("dosen");
    	return $data->result_array();
    }
    function getDataRuangan() {
    	$data = $this->db->get("ruang");
    	return $data->result_array();
    }
    function getDataJadwal() {
    	$data = $this->db->get("jadwal");
    	return $data->result_array();
    }
    function getDataJadwalWhere($id) {
    	$data = $this->db->get_where("jadwal",["idJadwal" => $id]);
    	return $data->result_array();
    }
    function getDetailJadwal($id) {

        if (empty($id)) {
            $data = $this->db->get("detailjadwal")->result_array();
             return $data;
        }else{
           
            $this->db->FROM('detailjadwal');
            $this->db->JOIN('presensi','presensi.idMakul = detailjadwal.idMakul');
            $data = $this->db->get();
            return $data->result_array();
            

        } 	
       
    }
    function tambahJadwal($data) {
    	$this->db->insert("jadwal",$data);
    }

    function inputdetailjadwal($data) {
        $this->db->insert("detailjadwal",$data);
    }
    function getinfodetail() {

    }
    function ceker($id){
        $this->db->where("idJadwal",$id);


    }
    //detele jadwal detail 
    function del_jadwaldetail($data){
        $this->db->delete("detailjadwal",$data);
    }

}
