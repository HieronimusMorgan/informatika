<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->library('pdf');
    }

    public function index()
    {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('rekomendasi/index',$data);
        //$this->load->view('templates/footer', $data);
    }
    function exportPdf() {
       $pdf = new FPDF('P', 'mm','Letter');
        // membuat halaman baru
        $pdf->AddPage();
        // setting jenis font yang akan digunakan
        $pdf->SetFont('Arial','B',12);
        // mencetak string 
        $pdf->Cell(190,7,'JADWAL  UJIAN AKHIR SEMESTER PRODI INFORMATIKA ',0,1);
        
        $pdf->Cell(190,7,'SEMESTER GASAL TAHUN AJARAN 2019/2020',0,1);
        // Memberikan space kebawah agar tidak terlalu rapat
        $pdf->Cell(10,7,'',0,1);
        $pdf->SetFont('Arial','B',10);
        $pdf->Cell(20,6,'NIM',1,0);
        $pdf->Cell(85,6,'NAMA MAHASISWA',1,0);
        $pdf->Cell(27,6,'NO HP',1,0);
        $pdf->Cell(25,6,'TANGGAL LHR',1,1);
        $pdf->SetFont('Arial','',10);
        // $mahasiswa = $this->db->get('mahasiswa')->result();
        // foreach ($mahasiswa as $row){
        //     $pdf->Cell(20,6,$row->nim,1,0);
        //     $pdf->Cell(85,6,$row->nama_lengkap,1,0);
        //     $pdf->Cell(27,6,$row->no_hp,1,0);
        //     $pdf->Cell(25,6,$row->tanggal_lahir,1,1); 
        // }
        $pdf->Output();

    }
    function c_makul() {
        $data['title'] = 'Manajemen Data Makul'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);


        //get data makul
        $data['makul'] = $this->Jadwal_model->getDataMatkul();

        $this->load->view('rekomendasi/datamakul',$data);
        $this->load->view('templates/footer', $data);

    }
    // function pindah() {
    //     $data = $this->db->query("SELECT DISTINCT ruangan FROM makul order by ruangan asc  ")->result();

    //     $newdata = array();
    //     $index = 0;
    //     foreach ($data as $key) {
    //         if (!empty($key->ruangan)) {
    //             # code...
    //             $newdata[$index++] = $key;
    //         }
    //     }
    
    //     $this->db->insert_batch('ruang',$newdata);
    //     print("masuk");


    // }
    function c_dosen() {
        $data['title'] = 'Dosen'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        
        //get data dosen 
        $data['dosen'] = $this->Jadwal_model->getDataDosen();

        $this->load->view('rekomendasi/dosen', $data);

        $this->load->view('templates/footer', $data);

    }
    function c_ruang() {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        //get data ruangan
        $data['ruangan'] = $this->Jadwal_model->getDataRuangan();
        $this->load->view('rekomendasi/ruang',$data);
        $this->load->view('templates/footer', $data);

    }
    function c_jadwal() {
        $data['title'] = 'Rekomendasi Jadwal'; 
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        //get data jadwal

        $data['jadwal'] = $this->Jadwal_model->getDataJadwal();

        $this->load->view('rekomendasi/jadwal',$data);
        $this->load->view('templates/footer', $data);
    }
    function jadwal() {
        $jenis = $this->input->post('jenis');
        $semester = $this->input->post('semester');
        $tahun = $this->input->post('tahun');

        $data = array(
            "jenisUjian" => $jenis,
            "semester" => $semester,
            "tahun" => $tahun
        );

        //insert ke database jadwal
        $this->Jadwal_model->tambahJadwal($data);
        redirect('rekomendasi/c_jadwal');
    }

    function detailjadwal($id) {
        //get data jadwal
        $jadwal = $this->Jadwal_model->getDataJadwalWhere($id);
        
        foreach ($jadwal as $key) {
            # code...
         $jenisUjian = $key['jenisUjian'];
         $semester = $key['semester'];
         $tahun = $key['tahun'];
     }
     $data['id'] = $id;

     //load view
     $data['semesterGas_Gen'] = $semester;
     $data['title'] = 'Data '.$jenisUjian.' semester '.$semester.' tahun '.$tahun;
     $this->load->view('templates/header');
     $this->load->view('templates/sidebar', $data);
     $this->load->view('templates/topbar', $data);

     //get detail jadwal
     $dataa = $this->Jadwal_model->getDetailJadwal($id);
     $data['jadwal'] = $dataa;

     $this->load->view('rekomendasi/detailjadwal',$data);
     $this->load->view('templates/footer');



 }

 function inputjadwal() {
    $tanggal = $this->input->post('datepicker');
    $tahun = $this->input->post('tahun');
    $semester = $this->input -> post('semester');
    $makul = $this->input->post('matkul');
    $ruang = $this->input->post('ruang');
    $jam1 = $this->input->post('jam');
    $jam2 = $this->input->post('jam2');

    $idJadwal = $this->input->post('idjadwal');

    $newtanggal = date("Y-m-d",strtotime($tanggal));

    $data = array(
     "idJadwal" => $idJadwal,
     "idMakul" => $makul,
     "idRuangan" => $ruang,
     "jamMulai" => $jam1,
     "jamSelesai" => $jam2,
     "tanggal" => $newtanggal
 );
    $key = "";
    $cek = $this->Jadwal_model->getDetailJadwal($key);

        // cek-er
    $cekdata = $this->Jadwal_model->getDetailJadwal($idJadwal);
    if (empty($cek)) {
            # code...

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Jadwal berhasil disimpan.</div>');
        $this->Jadwal_model->inputdetailjadwal($data);
        redirect("rekomendasi/detailjadwal/$idJadwal");

    }
    else{
        foreach ($cekdata as $key) {
            $time = date("G:i:s", strtotime($jam1));
            $timeP = date("G:i:s", strtotime($key['jamMulai']));

            if ($key['tanggal'] == $newtanggal && $timeP == $time){


                if($key['idRuangan'] != $ruang ) {

                    $mhs1 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$key[idMakul]'")->result();

                    $mhs2 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$makul'")->result();

                    foreach ($mhs2 as $mhsInput) {
                        # code...

                        foreach ($mhs1 as $mhsCek) {
                            # code...
                            if($mhsInput->nim == $mhsCek->nim ) {
                                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                                    Jadwal tidak disimpan karena ada mahasiswa yang berbenturan jadwal!</div>');
                                redirect("rekomendasi/detailjadwal/$idJadwal");
                            }else{
                                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                                    Jadwal berhasil disimpan.</div>');
                                $this->Jadwal_model->inputdetailjadwal($data);
                                redirect("rekomendasi/detailjadwal/$idJadwal");
                            }
                        }
                    }

                }
                else {
                    $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                        Jadwal tidak disimpan! Ruangan sudah terpakai pada hari dan jam yang sama! </div>');
                    redirect("rekomendasi/detailjadwal/$idJadwal");
                }
            }
            else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                    Jadwal berhasil disimpan.</div>');
                $this->Jadwal_model->inputdetailjadwal($data);
                redirect("rekomendasi/detailjadwal/$idJadwal");

            }

        }      
    }
}

//edit jadwal
function editjadwal(){
    $id = $this->input->post('idJadwal');
    $data = array(

        'jenisUjian' => $this->input->post('jenis'),
        'semester' => $this->input->post('semester'),
        'tahun' => $this->input->post('tahun')
    );
    $this->Jadwal_model->editjadwal($data,$id);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
        Data berhasil diperbaharui. </div>');
    redirect('rekomendasi/c_jadwal');

}

//delet jadwal detail
function deletedetailjadwal() {
    $id = $this->uri->segment(3);
    $idJadwal = $this->uri->segment(4);    
    $data = array(
        "id" => $id
    );
    $this->Jadwal_model->del_jadwaldetail($data);
    $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
     Data berhasil dihapus. </div>');
    redirect("rekomendasi/detailjadwal/$idJadwal");
}

        // get data untuk input jadwal
function tahun() {
    $data = $this->db->query("SELECT DISTINCT tahun FROM makul order by tahun asc")->result();
    echo json_encode($data);
}

function matakuliah() {
    $tahun = $this->input->post('id');
    $semester = $this->input->post('semester');
    $idJadwal = $this->input->post('idJadwal');

        //getjadwalmasuk
    $jadwal = $this->db->query("SELECT * FROM detailjadwal WHERE idJadwal = '$idJadwal'")->result();
        //data terbaru setelah di filter data yang sudah masukk
    $newdata = array();
    $index = 0;

    if (empty($jadwal)) {
              //getmatakuliah
        $data = $this->db->query("SELECT * FROM makul WHERE tahun = '$tahun' AND semester = '$semester'")->result();
        echo json_encode($data);
    }
    else{
        foreach ($jadwal as $key) {
            $newdata[$index++] = $key->idMakul;
        }
        $this->db->where_not_in('idMakul',$newdata);
        $this->db->where('tahun',$tahun);
        $this->db->where('semester', $semester);
        $dataa = $this->db->get('makul')->result();
        
        echo json_encode($dataa);
    }
    

}
function kelas() {
    $id = $this->input->post('id');
    $a = $this->db->query("SELECT kelas FROM makul WHERE nama = '$id'") ->result();
    echo json_encode($a);
}
function ruang() {
    $data = $this->db->query("SELECT * FROM ruang")->result();

    $newdata = array();
    $index = 0;
    foreach ($data as $key) {
        if (!empty($key->ruangan)) {
                # code...
            $newdata[$index++] = $key;
        }
    }


    echo json_encode($newdata);
}

}