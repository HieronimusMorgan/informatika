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

	public function insertMhs($data)
	{
		$this->db->insert_batch('mahasiswa',$data);
	}
	
	public function addAll($dosen,$makul,$ruangan)
	{
		if($dosen[0]['nip']==""){
			$dosen=['nip'=>mt_rand(0,999999),'nama'=>$dosen['nama']];
			if($this->db->get_where('dosen', ['nama' => $dosen['nama']])->num_rows() != 1){
				$this->db->insert('dosen',$dosen);
			}	
		}elseif ($this->db->get_where('dosen', ['nama' => $dosen['nama']])->num_rows() != 1){
			$this->db->insert('dosen',$dosen);
		}

		if ($this->db->get_where('makul', ['nama' => $makul['nama'], 'ruangan'=>$makul['ruangan'] ])->num_rows() != 1){
			$this->db->insert('makul',$makul);
		}
		if ($this->db->get_where('ruangan', ['nama' => $ruangan['nama'], 'makul'=>$ruangan['makul']])->num_rows() != 1){
			$this->db->insert('ruangan',$ruangan);
		}
	}
	public function addMakulDosen($makul,$dosen)
	{		
		if ($this->db->get_where('makul', ['nama' => $makul])->num_rows() != 1){
			$this->db->insert('makul',array('nama'=>$makul));

		}
		if($this->db->get_where('dosen', ['nama' => $dosen])->num_rows() != 1){
			$number = mt_rand(10000,999999);
			$this->db->insert('dosen',array('nama'=>$dosen, 'nip'=>$number, 'status'=>'1'));
		}
	}
	
}