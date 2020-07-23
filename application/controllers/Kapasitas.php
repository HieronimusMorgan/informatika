<?php

defined('BASEPATH') or exit('No direct script access allowed');

class kapasitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        //load libary pagination
        $this->load->library('pagination');
        //load the department_model
        $this->load->model('list_model');
        $this->load->model('kapasitas_model');
        $this->load->library('excel');
    }

    public function index() {
        $data['title'] = 'Kapasitas Kelas';
        $data['makul'] = $this->kapasitas_model->makul();

        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kapasitas/index', $data);
        $this->load->view('kapasitas/pencarian', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cari() {
        $statment = "";
        if ($this->input->post('angkatan') != "") {
            $angkatan = str_split($this->input->post('angkatan'));
            $statment = $statment . " AND a.Nim LIKE '" . $angkatan[0] . $angkatan[1] . "%'  ";
        }
        if ($this->input->post('makul') != "") {
            $makul = $this->input->post('makul');
            $statment = $statment . " AND b.nama LIKE '" . $makul . "'  ";
        }
        if ($this->input->post('tahun') != "") {
            $tahun = $this->input->post('tahun');
            $statment = $statment . " AND b.tahun LIKE '" . $tahun . "'  ";
        }
        if ($this->input->post('tipe') != "") {
            $tipe = $this->input->post('tipe');
            $statment = $statment . " AND b.tipeMakul LIKE '" . $tipe . "'  ";
        }
        if ($this->input->post('dosen') != "") {
            $dosen = $this->input->post('dosen');
            $statment = $statment . " AND c.nama LIKE '" . $dosen . "' ";
        }
        if ($this->input->post('semester') != "") {
            $semester = $this->input->post('semester');
            $statment = $statment . " AND b.semester LIKE '" . $semester . "' ";
        }
        //$simpan=['angkatan'=>$angkatan[2].$angkatan[3],'makul'=>$makul,'tahun'=>$tahun,'tipe'=>$tipe,'dosen'=>$dosen,'semester'=>$semester];
        $data['title'] = 'Kapasitas Kelas';
        if ($statment != "") {
            $data['kapasitas'] = $this->kapasitas_model->kapasitas($statment);
            $data['data'] = $statment;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                        Filter kosong!</div>');
            redirect('kapasitas');
        }
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kapasitas/cari', $data);
        $this->load->view('kapasitas/pencarian', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function cetak() {
        $data = $this->session->tempdata('item');
        $data = (array) $data;
        // Panggil class PHPExcel nya
        $excel = new PHPExcel();
        // Settingan awal fil excel
        $excel->getProperties()->setTitle("Kapasitas Kelas ");
        // Buat sebuah variabel untuk menampung pengaturan style dari header tabel
        $style_col = array(
            'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        // Buat sebuah variabel untuk menampung pengaturan style dari isi tabel
        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $styleArray = array(
            'font' => array(
                'size' => 12,
                'name' => 'Times New Roman'
        ));
        $style_col1 = array(
            'font' => array('name' => 'Times New Roman'), // Set font nya jadi bold
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER, // Set text jadi ditengah secara horizontal (center)
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER // Set text jadi di tengah secara vertical (middle)
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border top dengan garis tipis
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border right dengan garis tipis
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN), // Set border bottom dengan garis tipis
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN) // Set border left dengan garis tipis
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "KAPASITAS KELAS"); // Set kolom A1 dengan tulisan "DATA SISWA"
        $excel->getActiveSheet()->mergeCells('A1:D1'); // Set Merge Cell pada kolom A1 sampai E1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE); // Set bold kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18); // Set font size 15 untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER); // Set text center untuk kolom A1
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER); // Set text center untuk kolom A1
        // Buat header tabel nya pada baris ke 3
        $excel->setActiveSheetIndex(0)->setCellValue('A3', "MATA KULIAH");
        $excel->setActiveSheetIndex(0)->setCellValue('A4', "TAHUN AJARAN");
        $excel->setActiveSheetIndex(0)->setCellValue('A5', "TIPE MATA KULIAH");
        $excel->setActiveSheetIndex(0)->setCellValue('A6', "SEMESTER");
        $excel->setActiveSheetIndex(0)->setCellValue('A7', "DOSEN");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($styleArray)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A4')->applyFromArray($styleArray)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A5')->applyFromArray($styleArray)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A6')->applyFromArray($styleArray)->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A7')->applyFromArray($styleArray)->getFont()->setBold(TRUE);




        if ($data['makul'] != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('B3', ": " . $data['makul']);
            $excel->getActiveSheet()->getStyle('B3')->applyFromArray($styleArray);
        }
        if ($data['tahun'] != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('B4', ": " . $data['tahun']);
            $excel->getActiveSheet()->getStyle('B4')->applyFromArray($styleArray);
        }
        if ($data['tipe'] != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('B5', ": " . $data['tipe']);
            $excel->getActiveSheet()->getStyle('B5')->applyFromArray($styleArray);
        }
        if ($data['semester'] != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('B6', ": " . $data['semester']);
            $excel->getActiveSheet()->getStyle('B6')->applyFromArray($styleArray);
        }
        if ($data['dosen'] != "") {
            $excel->setActiveSheetIndex(0)->setCellValue('B7', ": " . $data['dosen']);
            $excel->getActiveSheet()->getStyle('B7')->applyFromArray($styleArray);
        }




        $excel->setActiveSheetIndex(0)->setCellValue('A9', "ANGKATAN");
        $excel->setActiveSheetIndex(0)->setCellValue('B9', "JUMLAH MAHASISWA");
        $excel->setActiveSheetIndex(0)->setCellValue('C9', "TELAH MENGAMBIL");
        $excel->setActiveSheetIndex(0)->setCellValue('D9', "BELUM MENGAMBIL");

        $excel->getActiveSheet()->getStyle('A9')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B9')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C9')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D9')->applyFromArray($style_col);


        if ($data['angkatan'] != "") {
            $angkatan = $data['angkatan'];
            $excel->setActiveSheetIndex(0)->setCellValue('A10', "20" . $angkatan);
            $excel->setActiveSheetIndex(0)->setCellValue('B10', $this->kapasitas_model->mhs($angkatan));
            $excel->setActiveSheetIndex(0)->setCellValue('C10', $this->kapasitas_model->ambilMakul($data['data'], $angkatan, $data['makul']));
            $excel->setActiveSheetIndex(0)->setCellValue('D10', $this->kapasitas_model->belumAmbil($data['data'], $angkatan, $data['makul']));

            $excel->getActiveSheet()->getStyle('A10')->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('B10')->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('C10')->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('D10')->applyFromArray($style_col1);
        } else {
            $menu = $this->kapasitas_model->tahun();
            $numrow = 10;
            foreach ($menu as $m) {
                $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, "20" . $m['tahun']);
                $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $this->kapasitas_model->mhs($m['tahun']));
                $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $this->kapasitas_model->ambilMakul($data['data'], $m['tahun'], $data['makul']));
                $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $this->kapasitas_model->belumAmbil($data['data'], $m['tahun'], $data['makul']));

                $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_col1);
                $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col1);
                $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_col1);
                $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_col1);
                $numrow++;
            }
        }
        // Set width kolom
        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25); // Set width kolom A
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(28); // Set width kolom B
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(28); // Set width kolom C
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(28); // Set width kolom D

        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);

        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);

        $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);
        // Set judul file excel nya
        $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas");
        $excel->setActiveSheetIndex(0);
        // Proses file excel
        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Kapasitas Kelas.xlsx"'); // Set nama file excel nya
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

}
