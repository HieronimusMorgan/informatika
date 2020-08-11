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
            $this->db->SELECT('detailjadwal.*,makul.*,ruang.*,dosen.nama as dosen_nama');
            $this->db->FROM('detailjadwal');
            $this->db->join('presensi','presensi.idMakul = detailjadwal.idMakul');
            $this->db->join('makul','makul.idMakul = presensi.idMakul');
            $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
            $this->db->join('ruang','ruang.idRuangan = detailjadwal.idRuangan');
            $this->db->group_by('presensi.idMakul,presensi.idDosen');
            $this->db->order_by('detailjadwal.tanggal ASC,detailjadwal.jamMulai ASC');

            $this->db->where('detailjadwal.idJadwal',$id);

            $data = $this->db->get();
            return $data->result_array();
            

        } 	

    }
    function getDetailJadwall($id,$newtanggal,$jam,$ruang) {

        if (empty($id)) {
            
            $data = $this->db->get("detailjadwal")->result_array();
            return $data;
        }else{

            $this->db->WHERE('jamMulai',$jam);
            $this->db->WHERE('idRuangan',$ruang);
            $hasil = $this->db->get("detailjadwal")->result();
            if($hasil){
               
            
                $this->db->SELECT('detailjadwal.*,makul.*,ruang.*,dosen.nama as dosen_nama');
                $this->db->FROM('detailjadwal');
                $this->db->join('presensi','presensi.idMakul = detailjadwal.idMakul');
                $this->db->join('makul','makul.idMakul = presensi.idMakul');
                $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
                $this->db->join('ruang','ruang.idRuangan = detailjadwal.idRuangan');
                $this->db->group_by('presensi.idMakul,presensi.idDosen');
                $this->db->order_by('detailjadwal.tanggal ASC,detailjadwal.jamMulai ASC');

                $this->db->where('detailjadwal.idJadwal',$id);
                $this->db->where('detailjadwal.tanggal',$newtanggal);
                $this->db->where('detailjadwal.jamMulai',$jam);
                 $this->db->WHERE('detailjadwal.idRuangan',$ruang);
                $data = $this->db->get();
                return $data->result_array();
                
            }else{
               
             $this->db->SELECT('detailjadwal.*,makul.*,ruang.*,dosen.nama as dosen_nama');
             $this->db->FROM('detailjadwal');
             $this->db->join('presensi','presensi.idMakul = detailjadwal.idMakul');
             $this->db->join('makul','makul.idMakul = presensi.idMakul');
             $this->db->join('dosen','dosen.idDosen = presensi.idDosen' );
             $this->db->join('ruang','ruang.idRuangan = detailjadwal.idRuangan');
             $this->db->group_by('presensi.idMakul,presensi.idDosen');
             $this->db->order_by('detailjadwal.tanggal ASC,detailjadwal.jamMulai ASC');

             $this->db->where('detailjadwal.idJadwal',$id);
             $this->db->where('detailjadwal.tanggal',$newtanggal);
             $data = $this->db->get();
             
             return $data->result_array();
         }


     }   

 }
 function cetakLaporanUjian($id) {
   $this->db->where("idJadwal",$id);
   $data = $this->db->get("detailjadwal")->result_array();
   return $data;
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
function del_jadwal($data){
    $this->db->delete("jadwal",$data);
}

    //edit jadwal
function editjadwal($data,$id){
        //edit jadwal
    $this->db->where("idJadwal",$id);
    $this->db->update("jadwal",$data);

}

}
