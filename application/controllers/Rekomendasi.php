<?php
defined('BASEPATH') or exit('No direct script access allowed');

class rekomendasi extends CI_Controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('Jadwal_model');
        $this->load->library('excel');
        
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
    function ecportExcell() {

        $id = $this->uri->segment(3);
        $jadwal = $this->Jadwal_model->getDataJadwalWhere($id);

        foreach ($jadwal as $key) {
            # code...
         $jenisUjian = $key['jenisUjian'];
         $semester = $key['semester'];
         $tahun = $key['tahun'];
     }
       //jumlah mahasiswa per matkul

     $data['title'] = 'Data '.$jenisUjian.' semester '.$semester.' tahun '.$tahun;
     $title= 'Data '.$jenisUjian.' semester '.$semester.' tahun '.$tahun;
     $data['laporan']= $this->Jadwal_model->getDetailJadwal($id);
       //jumlah mahasiswa per matkul


     $tampil = $this->view->rekomendasi('pdf',$data);

     header("Content-type: application/vnd-ms-excel");
     header("Content-Disposition: attachment; filename=$title.xls");

     echo $tampil;


 }
 function exportExcell2() {

    $id = $this->uri->segment(3);
    $excel = new PHPExcel();
    // Settingan awal fil excel
    $excel->getProperties()->setCreator('My Notes Code')
    ->setLastModifiedBy('My Notes Code')
    ->setTitle("Rekomendasi Jadwal")
    ->setSubject("Ujian")
    ->setDescription("Rekomendasi Jadwal Ujian")
    ->setKeywords("Jadwal Ujian");
    // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
    $style_col = array(
      'font' => array('bold' => true), // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );
    $style_isi = array(

     // Set font nya jadi bold
      'alignment' => array(
        'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );
    // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
    $style_row = array(
      'alignment' => array(
        'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
    ),
      'borders' => array(
        'top' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
        'right' => array('style'  => PHPExcel_Style_Border::BORDER_THIN),  // Set border right dengan garis tipis
        'bottom' => array('style'  => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
        'left' => array('style'  => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
    )
  );
    $excel->setActiveSheetIndex(0)->setCellValue('A1', "Rekomendasi Jadwal Ujian"); // Set kolom A1 dengan tulisan "DATA SISWA"
    $excel->getActiveSheet()->mergeCells('A1:E1'); // Set Merge Cell pada kolom A1 sampai E1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(15); // Set font size 15 untuk kolom A1
    $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
    // Buat header tabel nya pada baris ke 3
    $excel->setActiveSheetIndex(0)->setCellValue('A3', "HARI / TANGGAL");
    $excel->setActiveSheetIndex(0)->setCellValue('B3', "JAM");
    $excel->setActiveSheetIndex(0)->setCellValue('C3', "MATAKULIAH");
    $excel->setActiveSheetIndex(0)->setCellValue('D3', "KELAS");
    $excel->setActiveSheetIndex(0)->setCellValue('E3', "SEMESTER");
    $excel->setActiveSheetIndex(0)->setCellValue('F3', "DOSEN");
    $excel->setActiveSheetIndex(0)->setCellValue('G3', "RUANG");
    $excel->setActiveSheetIndex(0)->setCellValue('H3', "PESERTA");
    // Apply style header yang telah kita buat tadi ke masing-masing kolom header
    $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('E3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('F3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('G3')->applyFromArray($style_col);
    $excel->getActiveSheet()->getStyle('H3')->applyFromArray($style_col);
    // Panggil function view yang ada di SiswaModel untuk menampilkan semua data siswanya
    $hasil= $this->Jadwal_model->getDetailJadwal($id);
    $col = 1; // Untuk penomoran tabel, di awal set dengan 1
    $numrow = 4;
    foreach ($hasil as $row) {

        $date = date('d-m-Y',strtotime($row['tanggal']));
        $hari = date('D', strtotime($row['tanggal']));
        $hari_ini = $this->hari_ini($hari);





        $jamMulai = date("G:i",strtotime( $row['jamMulai'])); 
        $jamSelesai = date("G:i", strtotime($row['jamSelesai']));
        $tanggal = $hari_ini.", ".$date;
        $time = $jamMulai."-".$jamSelesai;


        # code...
        $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $tanggal);
        $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $time);
        $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row["nama"]);
        $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row["kelas"]);
        $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row["idSemester"]);
        $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row["dosen_nama"]);
        $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row["ruangan"]);
        $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row["kapasitas"]);

        $excel->setActiveSheetIndex(0)->getStyle('A'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('B'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('C'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('D'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('E'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('F'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('G'.$numrow)->applyFromArray($style_isi);
        $excel->setActiveSheetIndex(0)->getStyle('H'.$numrow)->applyFromArray($style_isi);

        $numrow++;
        $col++;
    }   
    // Set width kolom
    $excel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
    $excel->getActiveSheet()->getColumnDimension('B')->setWidth(18);
    $excel->getActiveSheet()->getColumnDimension('C')->setWidth(33);
    $excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
    $excel->getActiveSheet()->getColumnDimension('F')->setWidth(50);
    
    // Set height semua kolom menjadi auto (mengikuti height isi dari kolommnya, jadi otomatis)
    $excel->getActiveSheet()->getDefaultRowDimension()->setRowHeight(-1);
    // Set orientasi kertas jadi LANDSCAPE
    $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // Set judul file excel nya
    $excel->getActiveSheet(0)->setTitle("Rekomendasi Jadwal Ujian");
    $excel->setActiveSheetIndex(0);
    // Proses file excel
    header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    header('Content-Disposition: attachment; filename="Rekomendasi Jadwal Ujian.xlsx"'); // Set nama file excel nya
    header('Cache-Control: max-age=0');
    $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    $write->save('php://output');
    // $excel = new PHPExcel();
    //     // print $data['data'];die;
    // $excel->getProperties()->setTitle("Kapasitas Kelas ");

    // $style_col = array(
    //     'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12),
    //     'alignment' => array(
    //         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    //         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    //     ),
    //     'borders' => array(
    //         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    //     )
    // );

    // $style_row = array(
    //     'alignment' => array(
    //         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    //     ),
    //     'borders' => array(
    //         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    //     )
    // );
    // $styleArray = array(
    //     'font' => array(
    //         'size' => 12,
    //         'name' => 'Times New Roman'
    //     ));
    // $style_col1 = array(
    //     'font' => array('name' => 'Times New Roman'),
    //     'alignment' => array(
    //         'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
    //         'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
    //     ),
    //     'borders' => array(
    //         'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
    //         'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
    //     )
    // );


    // $excel->setActiveSheetIndex(0)->setCellValue('A1', "HARI / TANGGAL");
    // $excel->setActiveSheetIndex(0)->setCellValue('B1', "JAM");
    // $excel->setActiveSheetIndex(0)->setCellValue('C1', "MATAKULIAH");
    // $excel->setActiveSheetIndex(0)->setCellValue('D1', "KELAS");
    // $excel->setActiveSheetIndex(0)->setCellValue('E1', "SEMESTER");
    // $excel->setActiveSheetIndex(0)->setCellValue('F1', "DOSEN");
    // $excel->setActiveSheetIndex(0)->setCellValue('G1', "RUANG");
    // $excel->setActiveSheetIndex(0)->setCellValue('H1', "PESERTA");

    // $data= $this->Jadwal_model->getDetailJadwal($id);


    // $excel->getActiveSheet()->getColumnDimension('A')->setWidth(18);
    // $excel->getActiveSheet()->getColumnDimension('C')->setWidth(33);
    // $excel->getActiveSheet()->getColumnDimension('E')->setWidth(14);
    // $excel->getActiveSheet()->getColumnDimension('F')->setWidth(33);

    // $numrow = 2;
    // foreach ($data as $row) {
    //     $date = date('d-m-Y',strtotime($row['tanggal']));
    //     $hari = date('D', strtotime($row['tanggal']));
    //     $hari_ini = $this->hari_ini($hari);



    

    //     $jamMulai = date("G:i",strtotime( $row['jamMulai'])); 
    //     $jamSelesai = date("G:i", strtotime($row['jamSelesai']));
    //      $tanggal = $hari_ini.", ".$date;
    //     $time = $jamMulai."-".$jamSelesai;


    //     # code...
    //     $excel->setActiveSheetIndex(0)->setCellValue('A'.$numrow, $tanggal);
    //     $excel->setActiveSheetIndex(0)->setCellValue('B'.$numrow, $time);
    //     $excel->setActiveSheetIndex(0)->setCellValue('C'.$numrow, $row["nama"]);
    //     $excel->setActiveSheetIndex(0)->setCellValue('D'.$numrow, $row["kelas"]);
    //     $excel->setActiveSheetIndex(0)->setCellValue('E'.$numrow, $row["kelas"]);
    //     $excel->setActiveSheetIndex(0)->setCellValue('F'.$numrow, $row["-dosen_nama"]);
    //     $excel->setActiveSheetIndex(0)->setCellValue('G'.$numrow, $row["ruangan"]);
    //     $excel->setActiveSheetIndex(0)->setCellValue('H'.$numrow, $row["kapasitas"]);
    //     $numrow++;
    // }   



    //     // $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
    //     // $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
    //     // $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
    //     // $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
    //     // $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
    //     // $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
    //     // $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

    // $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
    // $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

    // $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas");
    // $excel->setActiveSheetIndex(0);

    // header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
    // header('Content-Disposition: attachment; filename="Kapasitas Kelas.xlsx"');
    // header('Cache-Control: max-age=0');
    // $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
    // $write->save('php://output');

}
function hari_ini($d){
    $hari = $d;

    switch($hari){
        case 'Sun':
        $hari_ini = "Minggu";
        break;

        case 'Mon':     
        $hari_ini = "Senin";
        break;

        case 'Tue':
        $hari_ini = "Selasa";
        break;

        case 'Wed':
        $hari_ini = "Rabu";
        break;

        case 'Thu':
        $hari_ini = "Kamis";
        break;

        case 'Fri':
        $hari_ini = "Jumat";
        break;

        case 'Sat':
        $hari_ini = "Sabtu";
        break;

        default:
        $hari_ini = "Tidak di ketahui";   
        break;
    }

    return $hari_ini;

}
function exportPdf() {
    $this->load->library('pdf');
    $id = $this->uri->segment(3);
    $jadwal = $this->Jadwal_model->getDataJadwalWhere($id);

    foreach ($jadwal as $key) {
            # code...
     $jenisUjian = $key['jenisUjian'];
     $semester = $key['semester'];
     $tahun = $key['tahun'];
 }
       //jumlah mahasiswa per matkul

 $data['title'] = 'Data '.$jenisUjian.' semester '.$semester.' tahun '.$tahun;
 $data['laporan']= $this->Jadwal_model->getDetailJadwal($id);
       //jumlah mahasiswa per matkul

 $this->pdf->setPaper('Letter','portrait');
 $this->pdf->filename = "Jadwal Ujian.pdf";
 $this->pdf->load_view('rekomendasi/pdf',$data);
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
 $data['tahunAjaran'] = $tahun;
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
function cekJam($current,$start,$finish) {
    print($current);
    print($start);
    print($finish);

    if ($start < $current ) {
       # code...

        return $time1;
    }else{
        $hasil = "Tidak";
        return $hasil;
    }
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
    
    $jam = substr($jam1,0,2);

    $data = array(
     "idJadwal" => $idJadwal,
     "idMakul" => $makul,
     "idRuangan" => $ruang,
     "jamMulai" => $jam1,
     "jamSelesai" => $jam2,
     "tanggal" => $newtanggal
 ); 

        // cek-er
    $cekdata = $this->Jadwal_model->getDetailJadwall($idJadwal,$newtanggal,$jam1,$ruang);


    if (empty($cekdata)) {
            # code...

        $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Jadwal berhasil disimpan.</div>');
        $this->Jadwal_model->inputdetailjadwal($data);
        redirect("rekomendasi/detailjadwal/$idJadwal");

    }
    else{

        foreach ($cekdata as $key) {    

            $time = date("G:i:s", strtotime($jam1));
            $timeEnd = date("G:i:s", strtotime($jam2));
            $timeP = date("G:i:s", strtotime($key['jamMulai']));

            $timeOut =  date("G:i:s", strtotime($key['jamSelesai']));

            $flagJam = "";

            if (($timeP <= $time && $time <= $timeOut) || ($timeP <= $timeEnd && $timeEnd <= $timeOut) ) {
                $flagJam ="Ada";

            }
            
            if ($key['tanggal'] == $newtanggal){

                if($key['idRuangan'] != $ruang  || $flagJam != "Ada" ) {


                    $mhs1 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$key[idMakul]'")->result();

                    $mhs2 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$makul'")->result();
                    $cek = "";
                    foreach ($mhs2 as $mhsInput) {
                        # code...


                        foreach ($mhs1 as $mhsCek) {

                            # code...
                            if($mhsInput->nim == $mhsCek->nim ) {
                               $cek = "ada";
                               break; 
                           }
                       }

                       if ($cek == "ada") {
                        break;
                    }
                }
                if ($cek) {
                        # code...
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
            else {
                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                    Jadwal tidak disimpan! Ruangan sudah terpakai pada hari dan jam yang sama atau ruangan masih digunakan untuk ujian pada jam itu! </div>');
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


//edit detail jadwal
function editjadwaldetail() {


   $idJadwal = $this->input->post('idjadwal');

   $id = $this->input->post('id');

   //delet dulu

   $tanggal = $this->input->post('datepickerEdit'.$id);
   $tahun = $this->input->post('tahunEdit'.$id);
   $semester = $this->input -> post('semesterEdit'.$id);
   $makul = $this->input->post('matkulEdit'.$id);
   $ruang = $this->input->post('ruangEdit'.$id);
   $jam1 = $this->input->post('jamEdit'.$id);
   $jam2 = $this->input->post('jam2Edit'.$id);



   $newtanggal = date("Y-m-d",strtotime($tanggal));

   $jam = substr($jam1,0,2);

   $data = array(
     "idJadwal" => $idJadwal,
     "idMakul" => $makul,
     "idRuangan" => $ruang,
     "jamMulai" => $jam1,
     "jamSelesai" => $jam2,
     "tanggal" => $newtanggal
 ); 


        // cek-er
   $cekdata = $this->Jadwal_model->getDetailJadwall($idJadwal,$newtanggal,$jam1,$ruang);


   if (empty($cekdata)) {
            # code...

    $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
        Jadwal berhasil disimpan.</div>');
    $this->Jadwal_model->inputdetailjadwal($data);
    redirect("rekomendasi/detailjadwal/$idJadwal");

}
else{

    foreach ($cekdata as $key) {    

        $time = date("G:i:s", strtotime($jam1));
        $timeEnd = date("G:i:s", strtotime($jam2));
        $timeP = date("G:i:s", strtotime($key['jamMulai']));

        $timeOut =  date("G:i:s", strtotime($key['jamSelesai']));

        $flagJam = "";

        if (($timeP <= $time && $time <= $timeOut) || ($timeP <= $timeEnd && $timeEnd <= $timeOut) ) {
            $flagJam ="Ada";

        }

        if ($key['tanggal'] == $newtanggal){

            if($key['idRuangan'] != $ruang  || $flagJam != "Ada" ) {


                $mhs1 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$key[idMakul]'")->result();

                $mhs2 = $this->db->query("SELECT * FROM presensi WHERE idMakul = '$makul'")->result();
                $cek = "";
                foreach ($mhs2 as $mhsInput) {
                        # code...


                    foreach ($mhs1 as $mhsCek) {

                            # code...
                        if($mhsInput->nim == $mhsCek->nim ) {
                           $cek = "ada";
                           break; 
                       }
                   }

                   if ($cek == "ada") {
                    break;
                }
            }
            if ($cek) {

                $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                    Jadwal tidak berhasil diperbaharui karena ada mahasiswa yang berbenturan jadwal!</div>');
                redirect("rekomendasi/detailjadwal/$idJadwal");
            }else{
                $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
                    Jadwal berhasil diperbaharui.</div>');
                $this->db->where("id", $id);
                $this->db->update("detailjadwal",$data);
                redirect("rekomendasi/detailjadwal/$idJadwal");
            }
        }
        else {

            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                Jadwal tidak berhasil diperbaharui! Ruangan sudah terpakai pada hari dan jam yang sama atau ruangan masih digunakan untuk ujian pada jam yang sama! </div>');
            redirect("rekomendasi/detailjadwal/$idJadwal");
        }
    }
    else{
        $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
            Jadwal berhasil disimpan.</div>');
        $this->db->where("id", $id);
        $this->db->update("detailjadwal",$data);
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
//delete jadwal
function deleteJadwal() {
 $idJadwal = $this->uri->segment(3);    
 $data = array(
    "idJadwal" => $idJadwal
);
 $this->Jadwal_model->del_jadwal($data);
 $this->session->set_flashdata('message', '<div class="alert alert-success" role="success">
     Data berhasil dihapus. </div>');
 redirect("rekomendasi/c_jadwal");
}

        // get data untuk input jadwal
function tahun() {

    $data = $this->db->query("SELECT DISTINCT tahun FROM makul order by tahun desc")->result();
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