<?php

defined('BASEPATH') or exit('No direct script access allowed');

class kapasitas extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('pagination');
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
        $makul = '';
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
        if ($this->input->post('idSemester') != "") {
            $idSemester = $this->input->post('idSemester');
            $statment = $statment . " AND b.idSemester LIKE '" . $idSemester . "' ";
        }
        $data['title'] = 'Kapasitas Kelas';
        if ($statment != "") {
            $data['kapasitas'] = $this->kapasitas_model->kapasitas($statment);
            $data['data'] = $statment;
        } else {
            $this->session->set_flashdata('message', '<div class="alert alert-danger" role="danger">
                        Filter kosong!</div>');
            redirect('kapasitas');
        }
        if ($makul) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kapasitas/cari', $data);
            $this->load->view('kapasitas/pencarian', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kapasitas/cariAngkatan', $data);
            $this->load->view('kapasitas/pencarian', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    function idSemester() {
        $idSemester = $this->input->post('id');
        $data = $this->db->query("SELECT DISTINCT idSemester FROM makul WHERE nama = '$idSemester'")->result();

        $newdata = array();
        $index = 0;


        if ($data) {
            foreach ($data as $key2) {
                $newdata[$index++] = $key2;
            }
            echo json_encode($newdata);
        } else {
            echo json_encode($this->kapasitas_model->idSemester());
        }
    }

    function tahun() {
        $tahun = $this->input->post('id');
        $data = $this->db->query("SELECT DISTINCT tahun FROM makul WHERE nama = '$tahun'")->result();

        $newdata = array();
        $index = 0;

        if ($data) {
            foreach ($data as $key2) {
                $newdata[$index++] = $key2;
            }
            echo json_encode($newdata);
        } else {
            echo json_encode($this->kapasitas_model->tahun());
        }
    }

    function semester() {
        $semester = $this->input->post('id');
        $data = $this->db->query("SELECT DISTINCT semester FROM makul WHERE nama = '$semester'")->result();

        $newdata = array();
        $index = 0;

        if ($data) {
            foreach ($data as $key2) {
                $newdata[$index++] = $key2;
            }
            echo json_encode($newdata);
        } else {
            echo json_encode($this->kapasitas_model->semester());
        }
    }

    function dosen() {
        $makul = $this->input->post('nama');
        $data = $this->db->query("SELECT DISTINCT c.nama  FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen WHERE b.nama LIKE '$makul'")->result();
        $newdata = array();
        $index = 0;

        if ($data) {
            foreach ($data as $key2) {
                $newdata[$index++] = $key2;
            }
            echo json_encode($newdata);
        } else {
            echo json_encode($this->kapasitas_model->dosen());
        }
    }

    function tipe() {
        $makul = $this->input->post('nama');
        $data = $this->db->query("SELECT DISTINCT b.tipeMakul FROM makul b WHERE b.nama LIKE  '$makul'")->result();
        $newdata = array();
        $index = 0;

        if ($data) {
            foreach ($data as $key2) {
                $newdata[$index++] = $key2;
            }
            echo json_encode($newdata);
        } else {
            echo json_encode($this->kapasitas_model->tipeMakul());
        }
    }

    public function cetak() {
        $data = $this->session->tempdata('item');
        $data = (array) $data;
        $excel = new PHPExcel();

        $excel->getProperties()->setTitle("Kapasitas Kelas ");

        $style_col = array(
            'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $styleArray = array(
            'font' => array(
                'size' => 12,
                'name' => 'Times New Roman'
        ));
        $style_col1 = array(
            'font' => array('name' => 'Times New Roman'),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $excel->setActiveSheetIndex(0)->setCellValue('A1', "KAPASITAS KELAS");
        $excel->getActiveSheet()->mergeCells('A1:D1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
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
        $MAKUL = $data['makul'];
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
            $menu = $this->kapasitas_model->angkatan();
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

                $excel->getActiveSheet()->getRowDimension($numrow)->setRowHeight(20);
                $numrow++;
            }
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);

        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas");
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Kapasitas Kelas ' . $MAKUL . '.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    public function cetakAngkatan() {
        $data = $this->session->tempdata('item1');
        $data = (array) $data;
        $excel = new PHPExcel();
        // print $data['data'];die;
        $excel->getProperties()->setTitle("Kapasitas Kelas ");

        $style_col = array(
            'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $styleArray = array(
            'font' => array(
                'size' => 12,
                'name' => 'Times New Roman'
        ));
        $style_col1 = array(
            'font' => array('name' => 'Times New Roman'),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $angkatan = $data['angkatan'];
        $excel->getActiveSheet()->setCellValueByColumnAndRow(0, 1, "KAPASITAS KELAS ANGKATAN 20" . $angkatan);
        $excel->getActiveSheet()->mergeCells('A1:D1');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "MATA KULIAH");
        $excel->setActiveSheetIndex(0)->setCellValue('B3', "JUMLAH MAHASISWA");
        $excel->setActiveSheetIndex(0)->setCellValue('C3', "TELAH MENGAMBIL");
        $excel->setActiveSheetIndex(0)->setCellValue('D3', "BELUM MENGAMBIL");

        $excel->getActiveSheet()->getStyle('A3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('B3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('C3')->applyFromArray($style_col);
        $excel->getActiveSheet()->getStyle('D3')->applyFromArray($style_col);

        $menu = $this->db->query("SELECT DISTINCT b.nama FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen " . $data['data'])->result_array();
        $numrow = 4;
        foreach ($menu as $m) {
            # code...
            $excel->setActiveSheetIndex(0)->setCellValue('A' . $numrow, $m['nama']);
            $excel->setActiveSheetIndex(0)->setCellValue('B' . $numrow, $this->kapasitas_model->mhs($angkatan));
            $excel->setActiveSheetIndex(0)->setCellValue('C' . $numrow, $this->kapasitas_model->ambilMakulAngkatan($data['data'], $m['nama']));
            $excel->setActiveSheetIndex(0)->setCellValue('D' . $numrow, $this->kapasitas_model->belumAmbilAngkatan($data['data'], $m['nama']));

            $excel->getActiveSheet()->getStyle('A' . $numrow)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('B' . $numrow)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('C' . $numrow)->applyFromArray($style_col1);
            $excel->getActiveSheet()->getStyle('D' . $numrow)->applyFromArray($style_col1);
            $numrow++;
        }

        $excel->getActiveSheet()->getColumnDimension('A')->setWidth(25);
        $excel->getActiveSheet()->getColumnDimension('B')->setWidth(28);
        $excel->getActiveSheet()->getColumnDimension('C')->setWidth(28);
        $excel->getActiveSheet()->getColumnDimension('D')->setWidth(28);

        $excel->getActiveSheet()->getRowDimension('1')->setRowHeight(30);
        $excel->getActiveSheet()->getRowDimension('3')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('4')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('5')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('6')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('7')->setRowHeight(20);
        $excel->getActiveSheet()->getRowDimension('9')->setRowHeight(20);

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas");
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Kapasitas Kelas Angkatan 20' . $angkatan . ' .xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

    //AND a.Nim LIKE '18%'

    public function cetakAll() {

        $excel = new PHPExcel();
        // print $data['data'];die;
        $excel->getProperties()->setTitle("Kapasitas Kelas ");

        $style_col = array(
            'font' => array('bold' => true, 'name' => 'Times New Roman', 'size' => 12),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $style_row = array(
            'alignment' => array(
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );
        $styleArray = array(
            'font' => array(
                'size' => 12,
                'name' => 'Times New Roman'
        ));
        $style_col1 = array(
            'font' => array('name' => 'Times New Roman'),
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_CENTER,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $excel->setActiveSheetIndex(0)->setCellValue('A1', "KAPASITAS KELAS");
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setName('Times New Roman');
        $excel->getActiveSheet()->getStyle('A1')->getFont()->setSize(18);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $excel->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $excel->setActiveSheetIndex(0)->setCellValue('A3', "MAHASISWA AKTIF PER ANGKATAN");
        $angkatan = $this->kapasitas_model->angkatan();
        $makul = $this->kapasitas_model->makul();
        $col = 0;
        $row = 4;
        foreach ($angkatan as $a) {
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, 4, '20' . $a['tahun']);
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, 5, $this->kapasitas_model->mhs($a['tahun']));

            $col++;
        }
        $excel->getActiveSheet()->mergeCellsByColumnAndRow(0, 1, ($col - 1), 1);
        $excel->getActiveSheet()->mergeCellsByColumnAndRow(0, 3, ($col - 1), 3);

        $excel->setActiveSheetIndex(0)->setCellValue('A7', "MAHASISWA TELAH MENGAMBIL (PER ANGKATAN)");
        $col = 1;
        $row = 7;
        foreach ($angkatan as $a) {
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '20' . $a['tahun']);
            $col++;
        }
        $col = 0;
        $row = 8;
        foreach ($makul as $mat) {
            $colTahun = 1;
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $mat['nama']);
            foreach ($angkatan as $ang) {
                $data = "AND a.Nim LIKE '" . $ang['tahun'] . "%'";
                $excel->getActiveSheet()->setCellValueByColumnAndRow($colTahun, $row, $this->kapasitas_model->ambilMakulAngkatan($data, $mat['nama']));
                $colTahun++;
            }
            $row++;
        }
        $row++;
        $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, "MAHASISWA BELUM MENGAMBIL");
        $col = 1;
        foreach ($angkatan as $a) {
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, '20' . $a['tahun']);
            $col++;
        }
        $row++;
        $col = 0;
        foreach ($makul as $mat) {
            $colTahun = 1;
            $excel->getActiveSheet()->setCellValueByColumnAndRow($col, $row, $mat['nama']);
            foreach ($angkatan as $ang) {
                $data = "AND a.Nim LIKE '" . $ang['tahun'] . "%'";
                $excel->getActiveSheet()->setCellValueByColumnAndRow($colTahun, $row, $this->kapasitas_model->belumAmbilAngkatan($data, $mat['nama']));
                $colTahun++;
            }
            $row++;
        }

        $excel->getActiveSheet()->getPageSetup()->setOrientation(PHPExcel_Worksheet_PageSetup::ORIENTATION_LANDSCAPE);
        $excel->getActiveSheet()->getPageSetup()->setPaperSize(PHPExcel_Worksheet_PageSetup::PAPERSIZE_A4);

        $excel->getActiveSheet(0)->setTitle("Kapasitas Kelas");
        $excel->setActiveSheetIndex(0);

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment; filename="Kapasitas Kelas.xlsx"');
        header('Cache-Control: max-age=0');
        $write = PHPExcel_IOFactory::createWriter($excel, 'Excel2007');
        $write->save('php://output');
    }

}
