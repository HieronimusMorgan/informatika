<?php

/**
 * 
 */
class PresensiModel extends CI_Model
{
	public function view() {
		return $this->db->get('presensi')->result_array();
	}
	public function insert($data) {
		$this->db->insert_batch('presensi',$data);
	}

	public function addMakulDosen($makul,$dosen)
	{
		
		if ($this->db->get_where('makul', ['nama' => $makul])->num_rows() != 1){
			$this->db->insert('makul',array('nama'=>$makul));

		}
		if($this->db->get_where('dosen', ['nama' => $dosen])->num_rows() != 1){
			$number = mt_rand(10000,999999);
			$this->db->insert('dosen',array('nama'=>$dosen, 'nip'=>$number));
		}
	}
	
}