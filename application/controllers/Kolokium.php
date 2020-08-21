<?php

use PhpOffice\PhpWord\PhpWord;
use PhpOffice\PhpWord\Writer\Word2007;

class Kolokium extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->model('Kolokium_model');
        $this->load->model('Pendadaran_model');
        $this->load->model('Mahasiswa_model');
        $this->load->model('Dosen_model');
        $this->load->library('form_validation');
    }

    public function index() {
        $data['judul'] = "Jadwal Kolokium";

        $this->load->model('Kolokium_model', 'kolokium');

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('nim', $data['keyword']);
        $this->db->from('kolokium');

        $config['base_url'] = 'http://localhost/informatika/kolokium/index';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['kolokium'] = $this->kolokium->GetKolokium($config['per_page'], $data['start'], $data['keyword']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('kolokium/index', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('templates/footer', $data);
    }

    public function tambah($nim) {
        if ($this->Kolokium_model->cekStatusKolokium($nim) == NULL) {
            $data['judul'] = "Tambah Jadwal Kolokium";
            $data['jam'] = ['07.00-08.00', '08.00-09.00', '09.00-10.00', '10.00-11.00', '11.00-12.00', '12.00-13.00', '13.00-14.00', '14.00-15.00', '15.00-16.00', '16.00-17.00'];
            $data['ruang'] = $this->db->get('ruangsidang')->result_array();
            $data['dosen'] = $this->Dosen_model->getAllDosen();
            $data['mahasiswa'] = $this->Mahasiswa_model->getMahasiswaByNIM($nim);

            $this->form_validation->set_rules('nama', 'Nama Mahasiswa', 'required');
            $this->form_validation->set_rules('nim', 'NIM Mahasiswa', 'required|numeric');
            $this->form_validation->set_rules('dosen1', 'Dosen Pembimbing 1', 'required');
            $this->form_validation->set_rules('dosen2', 'Dosen Pembimbing 2');
            $this->form_validation->set_rules('judul', 'Judul Tugas Akhir', 'required');
            $this->form_validation->set_rules('reviewer', 'Reviewer', 'required');
            $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');

            if ($this->form_validation->run() == FALSE) {
                $this->load->view('templates/header', $data);
                $this->load->view('templates/sidebar', $data);
                $this->load->view('templates/topbar', $data);
                $this->load->view('kolokium/tambah', $data);
                $this->load->view('templates/footer', $data);
            } else {
                $postData = $this->input->post();

                $arraydata = array(
                    'dosen1' => $postData['dosen1'],
                    'dosen2' => $postData['dosen2'],
                    'judul' => $postData['judul'],
                    'reviewer' => $postData['reviewer'],
                    'tanggal' => $postData['tanggal'],
                    'durasi' => $postData['durasi'],
                    'ruang' => $postData['ruang'],
                    'keterangan' => $postData['keterangan']
                );
                $this->session->set_userdata($arraydata);

                $dosen1 = $postData['dosen1'];
                $dosen2 = $postData['dosen2'];
                $reviewer = $postData['reviewer'];
                $ruang = $postData['ruang'];
                $tanggal = $postData['tanggal'];
                $durasi = $postData['durasi'];
                $cekDosen = $this->cekInputKolokium($dosen1, $dosen2, $reviewer);
                switch ($cekDosen) {
                    case 0:
                        $this->session->set_userdata('nim', $nim);
                        $this->session->set_flashdata('samaSemua', 'Dosen Pembimbing 1, 2, maupun reviewer tidak boleh sama');
                        redirect('kolokium/tambah/' . $this->session->userdata('nim'));
                        break;
                    case 1:
                        $this->session->set_userdata('nim', $nim);
                        $this->session->set_flashdata('dosenReviewerSama', 'Dosen pembimbing tidak boleh sama dengan Dosen reviewer');
                        redirect('kolokium/tambah/' . $this->session->userdata('nim'));
                        break;
                    case 2:
                        $this->session->set_userdata('nim', $nim);
                        $this->session->set_flashdata('dosen2Sama', 'Dosen pembimbing 2 tidak boleh sama dengan Dosen reviewer');
                        redirect('kolokium/tambah/' . $this->session->userdata('nim'));
                        break;
                    case 3:
                        $this->session->set_userdata('nim', $nim);
                        $this->session->set_flashdata('dosen1Sama', 'Dosen pembimbing 1 tidak boleh sama dengan Dosen pembimbing 2');
                        redirect('kolokium/tambah/' . $this->session->userdata('nim'));
                        break;
                    default :
                        if ($dosen2 == '') {
                            $hasil = $this->cekBentrok2($dosen1, $reviewer, $ruang, $tanggal, $durasi);
                        } else {
                            $hasil = $this->cekBentrok($dosen1, $dosen2, $reviewer, $ruang, $tanggal, $durasi);
                        }
                        break;
                }
                if ($hasil != NULL) {
//                    var_dump($hasil);
                    $this->session->set_userdata('nim', $nim);
                    $this->session->set_flashdata('bentrok', $hasil);
                    redirect('kolokium/tambah/' . $this->session->userdata('nim'));
                } else {
//                    var_dump($hasil);
                    $this->Kolokium_model->tambahJadwalKolokium();
                    $this->session->set_flashdata('flash', 'Ditambahkan');
                    redirect('kolokium');
                }
            }
        } else {
            $this->session->set_flashdata('terdaftar', 'Mahasiswa Telah terdaftar Kolokium');
            redirect('kolokium');
        }
    }

    public function cekBentrok($dosen1, $dosen2, $reviewer, $ruang, $tanggal, $durasi) {
        $detail = NULL;
        $dataRuang = $this->Kolokium_model->cekStatusRuang($tanggal);
        $dataPendadaran = $this->Pendadaran_model->cekStatusRuang($tanggal);
        $detailBentrok = "Ada bentrok jadwal kolokium Mahasiswa";
        $detailBentrok2 = "Ada bentrok jadwal Pendadaran Mahasiswa";
        $durasiCut = substr($durasi, 0, 2);
        $durasiCut2 = '';
        $durasiInt = (int) $durasiCut;
        $durasiInt2 = 0;
        foreach ($dataRuang as $dr) {
            if ($dr['dosen1'] == $dosen1 || $dr['dosen1'] == $dosen2 || $dr['dosen1'] == $reviewer ||
                    $dr['dosen2'] == $dosen1 || $dr['dosen2'] == $dosen2 || $dr['dosen2'] == $reviewer ||
                    $dr['reviewer'] == $dosen1 || $dr['reviewer'] == $dosen2 || $dr['reviewer'] == $reviewer) {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    } elseif ($dr['ruang'] != $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " dengan NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . " di ruang " . $dr['ruang'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            } else {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            }
        }
        foreach ($dataPendadaran as $dp) {
            $durasiCut2 = substr($dp['durasi'], 0, 2);
            $durasiInt2 = (int) $durasiCut2;
            if ($dp['dosen1'] == $dosen1 || $dp['dosen1'] == $dosen2 || $dp['dosen1'] == $reviewer ||
                    $dp['dosen2'] == $dosen1 || $dp['dosen2'] == $dosen2 || $dp['dosen2'] == $reviewer ||
                    $dp['ketuaPenguji'] == $dosen1 || $dp['ketuaPenguji'] == $dosen2 || $dp['ketuaPenguji'] == $reviewer ||
                    $dp['sekretarisPenguji'] == $dosen1 || $dp['sekretarisPenguji'] == $dosen2 || $dp['sekretarisPenguji'] == $reviewer ||
                    $dp['anggotaPenguji'] == $dosen1 || $dp['anggotaPenguji'] == $dosen2 || $dp['anggotaPenguji'] == $reviewer) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiIn2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    } else {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " dengan NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . " ruang = " . $dp['ruang'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            } else {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            }
        }
        return $detail;
    }

    public function cekBentrok2($dosen1, $reviewer, $ruang, $tanggal, $durasi) {
        $detail = NULL;
        $dataRuang = $this->Kolokium_model->cekStatusRuang($tanggal);
        $dataPendadaran = $this->Pendadaran_model->cekStatusRuang($tanggal);
        $detailBentrok = "Ada bentrok jadwal kolokium Mahasiswa";
        $detailBentrok2 = "Ada bentrok jadwal Pendadaran Mahasiswa";
        $durasiCut = substr($durasi, 0, 2);
        $durasiCut2 = '';
        $durasiInt = (int) $durasiCut;
        $durasiInt2 = 0;
        foreach ($dataRuang as $dr) {
            if ($dr['dosen1'] == $dosen1 || $dr['dosen1'] == $reviewer || $dr['reviewer'] == $dosen1 || $dr['reviewer'] == $reviewer) {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    } else {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " dengan NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . " di ruang " . $dr['ruang'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            } else {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            }
        }
        foreach ($dataPendadaran as $dp) {
            $durasiCut2 = substr($dp['durasi'], 0, 2);
            $durasiInt2 = (int) $durasiCut2;
            if ($dp['dosen1'] == $dosen1 || $dp['dosen1'] == $reviewer ||
                    $dp['dosen2'] == $dosen1 || $dp['dosen2'] == $reviewer ||
                    $dp['ketuaPenguji'] == $dosen1 || $dp['ketuaPenguji'] == $reviewer ||
                    $dp['sekretarisPenguji'] == $dosen1 || $dp['sekretarisPenguji'] == $reviewer ||
                    $dp['anggotaPenguji'] == $dosen1 || $dp['anggotaPenguji'] == $reviewer) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiIn2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    } else {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " dengan NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . " ruang = " . $dp['ruang'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            } else {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            }
        }
        return $detail;
    }

    public function cekInputKolokium($dosen1, $dosen2, $reviewer) {
        if ($dosen1 == $reviewer && $dosen2 == $reviewer && $dosen1 == $dosen2) {
            return 0;
        } elseif ($dosen1 == $reviewer) {
            return 1;
        } elseif ($dosen2 == $reviewer) {
            return 2;
        } elseif ($dosen1 == $dosen2) {
            return 3;
        } else {
            return 4;
        }
    }

    public function inputNim() {
        $data['judul'] = "Tambah Jadwal Kolokium";
        $data['form'] = 'Form Tambah Jadwal Kolokium';
        $this->form_validation->set_rules('nim', 'NIM Mahasiswa', 'required|numeric');
        if ($this->form_validation->run() == FALSE) {

            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kolokium/inputNim', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $postData = $this->input->post();
            $nim = $postData['nim'];
            if ($this->Mahasiswa_model->getMahasiswaByNIM($nim) != null) {
                $this->tambah($nim);
            } else {
                $this->session->set_flashdata('KolokiumtidakAda', 'Mahasiswa tidak ditemukan');
                redirect('kolokium/inputNim');
            }
        }
    }

    public function hapus($id) {
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        if ($data['kolokium']['nilai'] != '-') {
            $this->session->set_flashdata('gagal', 'Mahasiswa telah mendapatkan nilai Kolokium');
        } else {
            $this->Kolokium_model->hapusJadwalKolokium($id);
            $this->session->set_flashdata('flash', 'Dihapus');
        }
        redirect('kolokium');
    }

    public function pindah($id) {
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        if ($data['kolokium']['nilai'] != '-') {
            $this->Kolokium_model->pindahJadwalKolokium($id);
            $this->session->set_flashdata('flash', 'Dipindah');
        } else {
            $this->session->set_flashdata('gagal', 'Mahasiswa belum mendapatkan nilai Pendadaran');
        }
        redirect('kolokium');
    }

    public function detail($id) {
        $data['judul'] = 'Detail  Jadwal Kolokium';
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kolokium/detail', $data);
        $this->load->view('templates/footer', $data);
    }

    public function edit($id) {
        $data['judul'] = "Edit Jadwal Kolokium";
        $data['jam'] = ['07.00-08.00', '08.00-09.00', '09.00-10.00', '10.00-11.00', '11.00-12.00', '12.00-13.00', '13.00-14.00', '14.00-15.00', '15.00-16.00', '16.00-17.00'];

        $data['ruang'] = $this->db->get('ruangsidang')->result_array();
        $data['dosen'] = $this->Dosen_model->getAllDosen();
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $data['kolokium']['tanggal'] = $data['kolokium']['tanggal'];

        $this->form_validation->set_rules('nama', 'Nama Mahasiswa', 'required');
        $this->form_validation->set_rules('nim', 'NIM Mahasiswa', 'required|numeric');
        $this->form_validation->set_rules('dosen1', 'Dosen Pembimbing 1', 'required');
        $this->form_validation->set_rules('dosen2', 'Dosen Pembimbing 2');
        $this->form_validation->set_rules('judul', 'Judul Tugas Akhir', 'required');
        $this->form_validation->set_rules('reviewer', 'Reviewer', 'required');
        $this->form_validation->set_rules('tanggal', 'Tanggal', 'required');
        $this->form_validation->set_rules('keterangan', 'Keterangan');



        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kolokium/edit', $data);

            $this->load->view('templates/footer', $data);
        } else {
            $postData = $this->input->post();
            $nim = $postData['nim'];
            $dosen1 = $postData['dosen1'];
            $dosen2 = $postData['dosen2'];
            $reviewer = $postData['reviewer'];
            $ruang = $postData['ruang'];
            $tanggal = $postData['tanggal'];
            $durasi = $postData['durasi'];

            $cekDosen = $this->cekInputKolokium($dosen1, $dosen2, $reviewer);
            switch ($cekDosen) {
                case 0:
                    $this->session->set_userdata('id', $id);
                    $this->session->set_flashdata('samaSemua', 'Dosen Pembimbing 1, 2, maupun reviewer tidak boleh sama');
                    redirect('kolokium/edit/' . $this->session->userdata('id'));
                    break;
                case 1:
                    $this->session->set_userdata('id', $id);
                    $this->session->set_flashdata('dosenReviewerSama', 'Dosen pembimbing tidak boleh sama dengan Dosen reviewer');
                    redirect('kolokium/edit/' . $this->session->userdata('id'));
                    break;
                case 2:
                    $this->session->set_userdata('id', $id);
                    $this->session->set_flashdata('dosen2Sama', 'Dosen pembimbing 2 tidak boleh sama dengan Dosen reviewer');
                    redirect('kolokium/edit/' . $this->session->userdata('id'));
                    break;
                case 3:
                    $this->session->set_userdata('id', $id);
                    $this->session->set_flashdata('dosen1Sama', 'Dosen pembimbing 1 tidak boleh sama dengan Dosen pembimbing 2');
                    redirect('kolokium/edit/' . $this->session->userdata('id'));
                    break;
                default :
                    if ($dosen2 == '') {
                        $hasil = $this->cekBentrokEdit2($nim, $dosen1, $reviewer, $ruang, $tanggal, $durasi);
                    } else {
                        $hasil = $this->cekBentrokEdit($nim, $dosen1, $dosen2, $reviewer, $ruang, $tanggal, $durasi);
                    }
                    break;
            }
            if ($hasil != NULL) {
//                    var_dump($hasil);
                $this->session->set_userdata('id', $id);
                $this->session->set_flashdata('bentrok', $hasil);
                redirect('kolokium/edit/' . $this->session->userdata('id'));
            } else {
//                    var_dump($hasil);
                $this->Kolokium_model->editJadwalKolokium();
                $this->session->set_flashdata('flash', 'Diubah');
                redirect('kolokium');
            }
        }
    }

    public function cekBentrokEdit($nim, $dosen1, $dosen2, $reviewer, $ruang, $tanggal, $durasi) {
        $detail = NULL;
        $dataRuang = $this->Kolokium_model->cekStatusRuangEdit($tanggal, $durasi);
        $dataRuang2 = $this->Kolokium_model->cekStatusRuangEdit2($tanggal, $durasi, $ruang);
        $dataPenadadaran = $this->Pendadaran_model->cekStatusRuangEdit($tanggal, $durasi);
        $dataPendadaran2 = $this->Pendadaran_model->cekStatusRuangEdit3($tanggal, $ruang);
        $detailBentrok = "Ada bentrok jadwal kolokium Mahasiswa";
        $detailBentrok2 = "Ada bentrok jadwal pendadaran Mahasiswa";
        $durasiCut = substr($durasi, 0, 2);
        $durasiCut2 = '';
        $durasiInt = (int) $durasiCut;
        $durasiInt2 = 0;
        foreach ($dataRuang as $dr) {
            if ($dr['nim'] == $nim) {
                if ($dr['tanggal'] == $tanggal && $dr['durasi'] == $durasi) {
                    if ($dataRuang2 != NULL) {
                        foreach ($dataRuang2 as $dr2) {
                            $durasiPendadaranCut = substr($dr2['durasi'], 0, 2);
                            $durasiPendadaranInt = (int) $durasiPendadaranCut;
                            if ($durasiPendadaranInt == $durasiInt || $durasiPendadaranInt - 1 == $durasiInt || $durasiPendadaranInt + 1 == $durasiInt) {
                                $detailBentrok = $detailBentrok . " dengan NIM " . $dr2['nim'] . " dosbing 1 = " . $dr2['dosen1'] . " dosbing 2 = " . $dr2['dosen2'] . " reviewer = "
                                        . $dr2['reviewer'] . " pada tanggal " . $dr2['tanggal'] . " Jam = " . $dr2['durasi'] . " di ruang " . $dr2['ruang'] . "";
                                $detail = $detailBentrok;
                            }
                        }
                    }
                }
            } elseif ($dr['dosen1'] == $dosen1 || $dr['dosen1'] == $dosen2 || $dr['dosen1'] == $reviewer ||
                    $dr['dosen2'] == $dosen1 || $dr['dosen2'] == $dosen2 || $dr['dosen2'] == $reviewer ||
                    $dr['reviewer'] == $dosen1 || $dr['reviewer'] == $dosen2 || $dr['reviewer'] == $reviewer) {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . "dosbing 2 = " . $dr['dosen2'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    } elseif ($dr['ruang'] != $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " dengan NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . "dosbing 2=" . $dr['dosen2'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . " di ruang " . $dr['ruang'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            } else {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " dosbing 2=" . $dr['dosen2'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            }
        }
        foreach ($dataPenadadaran as $dp) {
            $durasiCut2 = substr($dp['durasi'], 0, 2);
            $durasiInt2 = (int) $durasiCut2;
            if ($dp['nim'] == $nim) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                        if ($dataPendadaran2 != NULL) {
                            foreach ($dataPendadaran2 as $dp2) {
                                $detailBentrok2 = $detailBentrok2 . " bentrok dengan NIM =" . $dp2['nim'] . " dosbing1 = " . $dp2['dosen1'] . " dosbing2 = " . $dp2['dosen2'] . " Ketua Penguji = "
                                        . $dp2['ketuaPenguji'] . " Sekrterais Penguji = " . $dp2['sekretarisPenguji'] . " Anggota Penguji = " . $dp2['anggotaPenguji'] . " pada tanggal " . $dp2['tanggal'] . " Jam = " . $dp2['durasi'] . " ruang = " . $dp2['ruang'] . "";
                                $detail = $detailBentrok2;
                            }

                            return $detail;
                        }
                    }
                }
            } elseif ($dp['dosen1'] == $dosen1 || $dp['dosen1'] == $dosen2 || $dp['dosen1'] == $reviewer ||
                    $dp['dosen2'] == $dosen1 || $dp['dosen2'] == $dosen2 || $dp['dosen2'] == $reviewer ||
                    $dp['ketuaPenguji'] == $dosen1 || $dp['ketuaPenguji'] == $dosen2 || $dp['ketuaPenguji'] == $reviewer ||
                    $dp['sekretarisPenguji'] == $dosen1 || $dp['sekretarisPenguji'] == $dosen2 || $dp['sekretarisPenguji'] == $reviewer ||
                    $dp['anggotaPenguji'] == $dosen1 || $dp['anggotaPenguji'] == $dosen2 || $dp['anggotaPenguji'] == $reviewer) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    } else {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " bentrok dengan NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . " ruang = " . $dp['ruang'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            } else {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            }
        }
        return $detail;
    }

    public function cekBentrokEdit2($nim, $dosen1, $reviewer, $ruang, $tanggal, $durasi) {
        $detail = NULL;
        $dataRuang = $this->Kolokium_model->cekStatusRuangEdit($tanggal, $durasi);
        $dataRuang2 = $this->Kolokium_model->cekStatusRuangEdit2($tanggal, $durasi, $ruang);
        $dataPenadadaran = $this->Pendadaran_model->cekStatusRuangEdit($tanggal, $durasi);
        $dataPendadaran2 = $this->Pendadaran_model->cekStatusRuangEdit3($tanggal, $ruang);
        $detailBentrok = "Ada bentrok jadwal kolokium Mahasiswa";
        $detailBentrok2 = "Ada bentrok jadwal pendadaran Mahasiswa";
        $durasiCut = substr($durasi, 0, 2);
        $durasiCut2 = '';
        $durasiInt = (int) $durasiCut;
        $durasiInt2 = 0;
        foreach ($dataRuang as $dr) {
            if ($dr['nim'] == $nim) {
                if ($dr['tanggal'] == $tanggal && $dr['durasi'] == $durasi) {
                    if ($dataRuang2 != NULL) {
                        foreach ($dataRuang2 as $dr2) {
                            $detailBentrok = $detailBentrok . " dengan NIM " . $dr2['nim'] . " dosbing 1 = " . $dr2['dosen1'] . " dosbing 2 = " . $dr2['dosen2'] . " reviewer = "
                                    . $dr2['reviewer'] . " pada tanggal " . $dr2['tanggal'] . " Jam = " . $dr2['durasi'] . " di ruang " . $dr2['ruang'] . "";
                            $detail = $detailBentrok;
                        }

                        return $detail;
                    }
                }
            } elseif ($dr['dosen1'] == $dosen1 || $dr['dosen1'] == $reviewer || $dr['reviewer'] == $dosen1 || $dr['reviewer'] == $reviewer) {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                        }
                    } elseif ($dr['ruang'] != $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " dengan NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . " di ruang " . $dr['ruang'] . "";
                            $detail = $detailBentrok;
                        }
                    }
                }
            } else {
                if ($dr['tanggal'] == $tanggal) {
                    if ($dr['ruang'] == $ruang) {
                        if ($dr['durasi'] == $durasi) {
                            $detailBentrok = $detailBentrok . " karena " . $dr['ruang'] . " dipakai oleh NIM " . $dr['nim'] . " dosbing 1 = " . $dr['dosen1'] . " reviewer = "
                                    . $dr['reviewer'] . " pada tanggal " . $dr['tanggal'] . " Jam = " . $dr['durasi'] . "";
                            $detail = $detailBentrok;
                            $detail = $detailBentrok;
                        }
                    }
                }
            }
        }
        foreach ($dataPenadadaran as $dp) {
            $durasiCut2 = substr($dp['durasi'], 0, 2);
            $durasiInt2 = (int) $durasiCut2;
            if ($dp['nim'] == $nim) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                        if ($dataPendadaran2 != NULL) {
                            foreach ($dataPendadaran2 as $dp2) {
                                $durasiPendadaranCut = substr($dr2['durasi'], 0, 2);
                                $durasiPendadaranInt = (int) $durasiPendadaranCut;
                                if ($durasiPendadaranInt == $durasiInt || $durasiPendadaranInt - 1 == $durasiInt || $durasiPendadaranInt + 1 == $durasiInt) {
                                    $detailBentrok = $detailBentrok . " dengan NIM " . $dr2['nim'] . " dosbing 1 = " . $dr2['dosen1'] . " dosbing 2 = " . $dr2['dosen2'] . " reviewer = "
                                            . $dr2['reviewer'] . " pada tanggal " . $dr2['tanggal'] . " Jam = " . $dr2['durasi'] . " di ruang " . $dr2['ruang'] . "";
                                    $detail = $detailBentrok;
                                }
                            }
                        }
                    }
                }
            } elseif ($dp['dosen1'] == $dosen1 || $dp['dosen1'] == $reviewer ||
                    $dp['dosen2'] == $dosen1 || $dp['dosen2'] == $reviewer ||
                    $dp['ketuaPenguji'] == $dosen1 || $dp['ketuaPenguji'] == $reviewer ||
                    $dp['sekretarisPenguji'] == $dosen1 || $dp['sekretarisPenguji'] == $reviewer ||
                    $dp['anggotaPenguji'] == $dosen1 || $dp['anggotaPenguji'] == $reviewer) {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    } else {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " bentrok dengan NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . " ruang = " . $dp['ruang'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            } else {
                if ($dp['tanggal'] == $tanggal) {
                    if ($dp['ruang'] == $ruang) {
                        if ($durasiInt2 == $durasiInt || $durasiInt2 - 1 == $durasiInt || $durasiInt2 + 1 == $durasiInt) {
                            $detailBentrok2 = $detailBentrok2 . " karena " . $dp['ruang'] . " dipakai oleh NIM =" . $dp['nim'] . " dosbing1 = " . $dp['dosen1'] . " dosbing2 = " . $dp['dosen2'] . " Ketua Penguji = "
                                    . $dp['ketuaPenguji'] . " Sekrterais Penguji = " . $dp['sekretarisPenguji'] . " Anggota Penguji = " . $dp['anggotaPenguji'] . " pada tanggal " . $dp['tanggal'] . " Jam = " . $dp['durasi'] . "";
                            $detail = $detailBentrok2;
                        }
                    }
                }
            }
        }
        return $detail;
    }

    public function nilai($id) {
        $data['judul'] = 'Edit Nilai';
        $data['nilai'] = ['A', 'B', 'C', 'D', 'E'];
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $this->form_validation->set_rules('nilai', 'Nilai', 'required');
        if ($this->form_validation->run() == FALSE) {
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('kolokium/nilai', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $this->Kolokium_model->editNilaiKolokium();
            $this->session->set_flashdata('flash', 'Diubah');
            redirect('kolokium');
        }
    }

    public function pdf($id) {
        $this->load->library('dompdf_gen');
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $mahasiswa = $data['kolokium']['nim'];
        $filename = 'Detail_Jadwal_Kolokium_' . $mahasiswa . '.pdf';
        $this->load->view('kolokium/detail_pdf', $data);

        $paper_size = 'A4';
        $oreintation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $oreintation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($filename, array('Attachment' => 0));
    }

    public function undangan($id) {
        $this->load->library('dompdf_gen');
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $mahasiswa = $data['kolokium']['nim'];
        $dosen = $this->Dosen_model->getAllDosen();
        foreach ($dosen as $d) {
            if (($d['status']) == 'Wakaprodi') {
                $idD = $d['idDosen'];
                $data['dosen'] = $this->Dosen_model->getDosenById($idD);
                break;
            }
            $data['dosen'] = NULL;
        }
        $data['tanggal'] = format_indo(date("Y-m-d"));

        $filename = 'Undangan_Kolokium_' . $mahasiswa . '.pdf';
        $this->load->view('kolokium/undangan_pdf', $data);

        $paper_size = 'A4';
        $oreintation = 'potrait';
        $html = $this->output->get_output();
        $this->dompdf->set_paper($paper_size, $oreintation);

        $this->dompdf->load_html($html);
        $this->dompdf->render();
        $this->dompdf->stream($filename, array('Attachment' => 0));
    }

    public function undangantxt($id) {
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $dosen = $this->Dosen_model->getAllDosen();
        foreach ($dosen as $d) {
            if (($d['status']) == 'Wakaprodi') {
                $idD = $d['idDosen'];
                $data['dosen'] = $this->Dosen_model->getDosenById($idD);
                break;
            }
            $data['dosen'] = NULL;
        }
        $data['tanggal'] = format_indo(date("Y-m-d"));
        $mahasiswa = $data['kolokium']['nim'];
        $filename = 'Undangan_Kolokium_' . $mahasiswa . '.txt';

        header('Content-type:text/plain');
        header('COntent-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: no-store, no-chace, must-revalidate');
        header('Cache-Control: post-check=0, pre-check=0');
        header('Pragma: no-cache');
        header('Expires:0');

        $handle = fopen('php://output', 'w');

        $data['undangan'] = $this->load->view('kolokium/undangan_txt', $data);
    }

    public function undanganWord($id) {
        $data['kolokium'] = $this->Kolokium_model->getKolokiumByID($id);
        $dosen = $this->Dosen_model->getAllDosen();
        foreach ($dosen as $d) {
            if (($d['status']) == 'Wakaprodi') {
                $idD = $d['idDosen'];
                $data['dosen'] = $this->Dosen_model->getDosenById($idD);
                break;
            }
            $data['dosen'] = NULL;
        }
        $data['tanggal'] = format_indo(date("Y-m-d"));
        $mahasiswa = $data['kolokium']['nim'];

        if ($data['kolokium']['dosen2'] == NULL) {
            $template = new PhpOffice\PhpWord\TemplateProcessor('template/kolokium1.docx');

            $template->setValue('dosen1', $data['kolokium']['dosen1']);
            $template->setValue('reviewer', $data['kolokium']['reviewer']);
            $template->setValue('nim', $data['kolokium']['nim']);
            $template->setValue('nama', $data['kolokium']['nama']);
            $template->setValue('judul', $data['kolokium']['judul']);
            $template->setValue('tanggal', format_indo($data['kolokium']['tanggal']));
            $template->setValue('jam', $data['kolokium']['durasi']);
            $template->setValue('date', $data['tanggal']);
            if ($data['dosen'] != NULL) {
                $template->setValue('wakaprodi', $data['dosen']['nama']);
            } else {
                $template->setValue('wakaprodi', '');
            }

            $temp_filename = 'Undangan_Kolokium_' . $mahasiswa . '.docx';
            $template->saveAs($temp_filename);

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $temp_filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($temp_filename));
            flush();
            readfile($temp_filename);
            unlink($temp_filename);
        } else {
            $template = new PhpOffice\PhpWord\TemplateProcessor('template/kolokium2.docx');

            $template->setValue('dosen1', $data['kolokium']['dosen1']);
            $template->setValue('dosen2', $data['kolokium']['dosen2']);
            $template->setValue('reviewer', $data['kolokium']['reviewer']);
            $template->setValue('nim', $data['kolokium']['nim']);
            $template->setValue('nama', $data['kolokium']['nama']);
            $template->setValue('judul', $data['kolokium']['judul']);
            $template->setValue('tanggal', format_indo($data['kolokium']['tanggal']));
            $template->setValue('jam', $data['kolokium']['durasi']);
            $template->setValue('date', $data['tanggal']);
            if ($data['dosen'] != NULL) {
                $template->setValue('wakaprodi', $data['dosen']['nama']);
            } else {
                $template->setValue('wakaprodi', '');
            }

            $temp_filename = 'Undangan_Kolokium_' . $mahasiswa . '.docx';
            $template->saveAs($temp_filename);

            header('Content-Description: File Transfer');
            header('Content-Type: application/octet-stream');
            header('Content-Disposition: attachment; filename=' . $temp_filename);
            header('Content-Transfer-Encoding: binary');
            header('Expires: 0');
            header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
            header('Pragma: public');
            header('Content-Length: ' . filesize($temp_filename));
            flush();
            readfile($temp_filename);
            unlink($temp_filename);
        }
    }

    public function report() {
        if ($this->input->post() == NULL) {
            $data['judul'] = 'Report Jadwal Kolokium';
            $data['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',];
            $data['jam'] = ['07.00-08.00', '08.00-09.00', '09.00-10.00', '10.00-11.00', '11.00-12.00', '12.00-13.00', '13.00-14.00', '14.00-15.00', '15.00-16.00', '16.00-17.00'];
            $data['ruang'] = $this->db->get('ruangsidang')->result_array();
            $data['dosen'] = $this->Dosen_model->getAllDosen();
            $data['kolokium'] = NULL;
            $data['jumlahData'] = 0;
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);

            $this->load->view('kolokium/report', $data);
            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        } else {
            $data['judul'] = 'Report Jadwal Kolokium';
            $data['bulan'] = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember',];
            $data['jam'] = ['07.00-08.00', '08.00-09.00', '09.00-10.00', '10.00-11.00', '11.00-12.00', '12.00-13.00', '13.00-14.00', '14.00-15.00', '15.00-16.00', '16.00-17.00'];
            $data['ruang'] = $this->db->get('ruangsidang')->result_array();
            $data['dosen'] = $this->Dosen_model->getAllDosen();

            $postData = $this->input->post();

            $statement = '';
            if ($postData['awal'] != '' && $postData['akhir'] == '' && $statement == '') {
                $statement = $statement . " tanggal >= '" . $postData['awal'] . "'";
            } elseif ($postData['awal'] != '' && $postData['akhir'] != '' && $statement == '') {
                $statement = $statement . " tanggal BETWEEN '" . $postData['awal'] . "' AND '" . $postData['akhir'] . "'";
            } elseif ($postData['awal'] != '' && $postData['akhir'] == '' && $statement != '') {
                $statement = $statement . " AND tanggal >= '" . $postData['awal'] . "'";
            } elseif ($postData['awal'] != '' && $postData['awal'] != '' && $statement != '') {
                $statement = $statement . " AND tanggal BETWEEN '" . $postData['awal'] . "' AND '" . $postData['akhir'] . "'";
            } elseif ($postData['awal'] == '' && $postData['akhir'] != '' && $statement == '') {
                $statement = $statement . " tanggal <= '" . $postData['akhir'] . "'";
            } elseif ($postData['awal'] == '' && $postData['akhir'] != '' && $statement != '') {
                $statement = $statement . " AND tanggal <= '" . $postData['akhir'] . "'";
            }
            if ($postData['dosen1'] != '' && $statement == '') {
                $statement = $statement . " dosen1 = '" . $postData['dosen1'] . "'";
            } elseif ($postData['dosen1'] != '' && $statement != '') {
                $statement = $statement . " AND dosen1 = '" . $postData['dosen1'] . "'";
            }
            if ($postData['dosen2'] != '' && $statement == '') {
                $statement = $statement . " dosen2='" . $postData['dosen2'] . "'";
            } elseif ($postData['dosen2'] != '' && $statement != '') {
                $statement = $statement . " AND dosen2='" . $postData['dosen2'] . "'";
            }
            if ($postData['reviewer'] != '' && $statement == '') {
                $statement = $statement . " reviewer = '" . $postData['reviewer'] . "'";
            } elseif ($postData['reviewer'] != '' && $statement != '') {
                $statement = $statement . " AND reviewer = '" . $postData['reviewer'] . "'";
            }
            if ($postData['jam'] != '' && $statement == '') {
                $statement = $statement . " durasi = '" . $postData['jam'] . "'";
            } elseif ($postData['jam'] != '' && $statement != '') {
                $statement = $statement . " AND durasi = '" . $postData['jam'] . "'";
            }
            if ($postData['ruang'] != '' && $statement == '') {
                $statement = $statement . " ruang = '" . $postData['ruang'] . "'";
            } elseif ($postData['ruang'] != '' && $statement != '') {
                $statement = $statement . " AND ruang = '" . $postData['ruang'] . "'";
            }

            $this->session->set_userdata('statement', $statement);

            $arraydata = array(
                'awal' => $postData['awal'],
                'akhir' => $postData['akhir'],
                'dosen1' => $postData['dosen1'],
                'dosen2' => $postData['dosen2'],
                'reviewer' => $postData['reviewer'],
                'jam' => $postData['jam'],
                'ruang' => $postData['ruang']
            );
            $this->session->set_userdata($arraydata);

            $data['statement'] = $statement;
            $data['kolokium'] = $this->Kolokium_model->getKolokiumReport($statement);
            $data['jumlahData'] = $this->Kolokium_model->getJumlahReport($statement);
            if ($data['kolokium'] == NULL) {
                $this->session->set_flashdata('reportKolokium', 'Data Mahasiwa Tidak Ada');
                redirect('kolokium/report');
            }
            $this->load->view('templates/header', $data);
            $this->load->view('templates/sidebar', $data);
            $this->load->view('kolokium/report', $data);

            $this->load->view('templates/topbar', $data);
            $this->load->view('templates/footer', $data);
        }
    }

    public function refreshReport() {
        $data['kolokium'] = NULL;
        $data['jumlahData'] = 0;
        $k = array('awal', 'akhir', 'dosen1', 'dosen2', 'reviewer', 'ketuaPenguji', 'sekretarisPenguji', 'jam', 'ruang');
        $this->session->unset_userdata($k);
        redirect('kolokium/report');
    }

    public function excel() {
        $statement = $this->session->userdata('statement');
        $data['mahasiswa'] = $this->Kolokium_model->getKolokiumReport($statement);
        require (APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require (APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel;
        $object->getProperties()->setCreator("Informatika");
        $object->getProperties()->setLastModifiedBy("Informatika");
        $object->getProperties()->setTitle("Jadwal Kolokium");

        $style_row = array(
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

        $style_row_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $object->setActiveSheetIndex(0);
        if (($this->session->userdata('awal')) != NULL && ($this->session->userdata('akhir')) == NULL) {
            $object->getActiveSheet()->setCellValue('A1', 'Dari ' . format_indo($this->session->userdata('awal')) . ' hingga akhir');
        } elseif (($this->session->userdata('awal')) == NULL && ($this->session->userdata('akhir')) != NULL) {
            $object->getActiveSheet()->setCellValue('A1', 'Dari awal hingga ' . format_indo($this->session->userdata('akhir')));
        } else {
            $object->getActiveSheet()->setCellValue('A1', 'JADWAL KOLOKIUM PERIODE ' . format_indo($this->session->userdata('awal')) . ' - ' . format_indo($this->session->userdata('akhir')));
        }

        $object->getActiveSheet()->setCellValue('A1', 'JADWAL KOLOKIUM PERIODE ' . format_indo($this->session->userdata('awal')) . ' - ' . format_indo($this->session->userdata('akhir')));
        $object->getActiveSheet()->mergeCells('A1:L1');
        $object->getActiveSheet()->getStyle('A1')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('A1')->getFont()->setSize(15);
        $object->getActiveSheet()->getStyle('A1')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
        $object->getActiveSheet()->getStyle('A1')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);

        $object->getActiveSheet()->setCellValue('A3', 'NO');
        $object->getActiveSheet()->setCellValue('B3', 'NIM');
        $object->getActiveSheet()->setCellValue('C3', 'NAMA');
        $object->getActiveSheet()->setCellValue('D3', 'DOSEN PEMBIMBING 1');
        $object->getActiveSheet()->setCellValue('E3', 'DOSEN PEMBIMBING 2');
        $object->getActiveSheet()->setCellValue('F3', 'JUDUL TUGAS AKHIR');
        $object->getActiveSheet()->setCellValue('G3', 'REVIEWER KOLOKIUM');
        $object->getActiveSheet()->setCellValue('H3', 'TANGGAL');
        $object->getActiveSheet()->setCellValue('I3', 'JAM');
        $object->getActiveSheet()->setCellValue('J3', 'ruangsidang');
        $object->getActiveSheet()->setCellValue('K3', 'NILAI');
        $object->getActiveSheet()->setCellValue('L3', 'KETERANGAN');

        $object->getActiveSheet()->getStyle('A3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('A3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('B3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('B3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('C3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('C3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('D3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('D3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('E3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('E3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('F3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('F3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('G3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('G3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('H3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('H3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('I3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('I3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('J3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('J3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('K3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('K3')->getFont()->setBold(TRUE);
        $object->getActiveSheet()->getStyle('L3')->applyFromArray($style_row);
        $object->getActiveSheet()->getStyle('L3')->getFont()->setBold(TRUE);


        $baris = 4;
        $no = 1;

        foreach ($data['mahasiswa'] as $mhs) {
            $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
            $object->getActiveSheet()->setCellValue('B' . $baris, $mhs['nim']);
            $object->getActiveSheet()->setCellValue('C' . $baris, $mhs['nama']);
            $object->getActiveSheet()->setCellValue('D' . $baris, $mhs['dosen1']);
            $object->getActiveSheet()->setCellValue('E' . $baris, $mhs['dosen2']);
            $object->getActiveSheet()->setCellValue('F' . $baris, $mhs['judul']);
            $object->getActiveSheet()->setCellValue('G' . $baris, $mhs['reviewer']);
            $object->getActiveSheet()->setCellValue('H' . $baris, format_indo($mhs['tanggal']));
            $object->getActiveSheet()->setCellValue('I' . $baris, $mhs['durasi']);
            $object->getActiveSheet()->setCellValue('J' . $baris, $mhs['ruang']);
            $object->getActiveSheet()->setCellValue('K' . $baris, $mhs['nilai']);
            $object->getActiveSheet()->setCellValue('L' . $baris, $mhs['keterangan']);

            $object->getActiveSheet()->getStyle('A' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('B' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('C' . $baris)->applyFromArray($style_row_left);
            $object->getActiveSheet()->getStyle('D' . $baris)->applyFromArray($style_row_left);
            $object->getActiveSheet()->getStyle('E' . $baris)->applyFromArray($style_row_left);
            $object->getActiveSheet()->getStyle('F' . $baris)->applyFromArray($style_row_left);
            $object->getActiveSheet()->getStyle('G' . $baris)->applyFromArray($style_row_left);
            $object->getActiveSheet()->getStyle('H' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('I' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('J' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('K' . $baris)->applyFromArray($style_row);
            $object->getActiveSheet()->getStyle('L' . $baris)->applyFromArray($style_row_left);

            $baris++;
        }

        $filename = 'Jadwal_Kolokium_' . date("d-m-Y") . '.xlsx';
        $object->getActiveSheet()->setTitle("Jadwal Kolokium");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');
    }

    public function excelDosen() {
        $statement = $this->session->userdata('statement');
        $data['mahasiswa'] = $this->Kolokium_model->getKolokiumReport($statement);
        $data['dosen'] = $this->Dosen_model->getAllDosen();
        $indeks = 0;
        foreach ($data['dosen'] as $d) {
            $dosenTunggal = 0;
            $dosen1 = 0;
            $dosen2 = 0;
            $reviewer = 0;
            $penguji = 0;
            foreach ($data['mahasiswa'] as $mhs) {
                if ($d['nama'] == $mhs['dosen1'] && $mhs['dosen2'] != NULL) {
                    $dosen1++;
                } elseif ($d['nama'] == $mhs['dosen1'] && $mhs['dosen2'] == NULL) {
                    $dosenTunggal++;
                }
                if ($mhs['dosen2'] != NULL && $d['nama'] == $mhs['dosen2']) {
                    $dosen2++;
                }
                if ($d['nama'] == $mhs['reviewer']) {
                    $reviewer++;
                }
                $penguji = $dosenTunggal + $dosen1 + $dosen2 + $reviewer;
                $dosen = array($d['npp'], $d['nama'], $dosenTunggal, $dosen1, $dosen2, $reviewer, $penguji);
            }
            $array[$indeks] = $dosen;
            $indeks++;
        }

        require (APPPATH . 'PHPExcel-1.8/Classes/PHPExcel.php');
        require (APPPATH . 'PHPExcel-1.8/Classes/PHPExcel/Writer/Excel2007.php');

        $object = new PHPExcel;
        $object->getProperties()->setCreator("Informatika");
        $object->getProperties()->setLastModifiedBy("Informatika");
        $object->getProperties()->setTitle("Rekap Penguji Kolokium");

        $style_row = array(
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

        $style_row_left = array(
            'alignment' => array(
                'horizontal' => PHPExcel_Style_Alignment::HORIZONTAL_LEFT,
                'vertical' => PHPExcel_Style_Alignment::VERTICAL_CENTER
            ),
            'borders' => array(
                'top' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'right' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'bottom' => array('style' => PHPExcel_Style_Border::BORDER_THIN),
                'left' => array('style' => PHPExcel_Style_Border::BORDER_THIN)
            )
        );

        $object->setActiveSheetIndex(0);

        $object->getActiveSheet()->setCellValue('A1', 'Fakultas');
        $object->getActiveSheet()->setCellValue('B1', ':');
        $object->getActiveSheet()->setCellValue('C1', 'Sains dan Teknologi');
        $object->getActiveSheet()->setCellValue('A2', 'Jurusan');
        $object->getActiveSheet()->setCellValue('B2', ':');
        $object->getActiveSheet()->setCellValue('C2', 'Informatika');
        $object->getActiveSheet()->setCellValue('A3', 'Program Studi');
        $object->getActiveSheet()->setCellValue('B3', ':');
        $object->getActiveSheet()->setCellValue('C3', 'Informatika');
        $object->getActiveSheet()->setCellValue('A4', 'Periode');
        $object->getActiveSheet()->setCellValue('B4', ':');
        if ($this->session->userdata('awal') != NULL && $this->session->userdata('akhir') == NULL) {
            $object->getActiveSheet()->setCellValue('C4', 'Dari ' . format_indo($this->session->userdata('awal')) . ' hingga akhir');
        } elseif ($this->session->userdata('awal') == NULL && $this->session->userdata('akhir') != NULL) {
            $object->getActiveSheet()->setCellValue('C4', 'Dari awal hingga ' . format_indo($this->session->userdata('akhir')));
        } else {
            $object->getActiveSheet()->setCellValue('C4', format_indo($this->session->userdata('awal')) . ' - ' . format_indo($this->session->userdata('akhir')));
        }

        $object->getActiveSheet()->setCellValue('A6', 'NO');
        $object->getActiveSheet()->mergeCells('A6:A8');
        $object->getActiveSheet()->getStyle('A6:A8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('B6', 'NPP');
        $object->getActiveSheet()->mergeCells('B6:B8');
        $object->getActiveSheet()->getStyle('B6:B8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('C6', 'NAMA');
        $object->getActiveSheet()->mergeCells('C6:C8');
        $object->getActiveSheet()->getStyle('C6:C8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('D6', 'BIMBINGAN SKRIPSI');
        $object->getActiveSheet()->mergeCells('D6:I6');
        $object->getActiveSheet()->getStyle('D6:I6')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('D7', 'PEMB.');
        $object->getActiveSheet()->getStyle('D7')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('D8', 'TUNGGAL');
        $object->getActiveSheet()->getStyle('D8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('E7', 'PEMB. 1');
        $object->getActiveSheet()->mergeCells('E7:E8');
        $object->getActiveSheet()->getStyle('E7:E8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('F7', 'PEMB. 2');
        $object->getActiveSheet()->mergeCells('F7:F8');
        $object->getActiveSheet()->getStyle('F7:F8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('G7', 'PENANDA');
        $object->getActiveSheet()->getStyle('G7')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('G8', 'TANGAN');
        $object->getActiveSheet()->getStyle('G8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('H7', 'PMRSK');
        $object->getActiveSheet()->getStyle('H7')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('H8', 'ABSTRAK');
        $object->getActiveSheet()->getStyle('H8')->applyFromArray($style_row);
        $object->getActiveSheet()->setCellValue('I7', 'PENGUJI');
        $object->getActiveSheet()->mergeCells('I7:I8');
        $object->getActiveSheet()->getStyle('I7:I8')->applyFromArray($style_row);

        $baris = 9;
        $no = 1;

        for ($i = 0; $i < count($array); $i++) {
            if ($array[$i][6] != 0) {
                $object->getActiveSheet()->setCellValue('A' . $baris, $no++);
                $object->getActiveSheet()->setCellValue('B' . $baris, $array[$i][0]);
                $object->getActiveSheet()->setCellValue('C' . $baris, $array[$i][1]);
                if ($array[$i][2] == 0) {
                    $object->getActiveSheet()->setCellValue('D' . $baris);
                } else {
                    $object->getActiveSheet()->setCellValue('D' . $baris, $array[$i][2]);
                }
                if ($array[$i][3] == 0) {
                    $object->getActiveSheet()->setCellValue('E' . $baris);
                } else {
                    $object->getActiveSheet()->setCellValue('E' . $baris, $array[$i][3]);
                }
                if ($array[$i][4] == 0) {
                    $object->getActiveSheet()->setCellValue('F' . $baris);
                } else {
                    $object->getActiveSheet()->setCellValue('F' . $baris, $array[$i][4]);
                }
                if ($array[$i][5] == 0) {
                    $object->getActiveSheet()->setCellValue('G' . $baris);
                } else {
                    $object->getActiveSheet()->setCellValue('G' . $baris, $array[$i][5]);
                }
                $object->getActiveSheet()->setCellValue('H' . $baris);
                $object->getActiveSheet()->setCellValue('I' . $baris, $array[$i][6]);

                $object->getActiveSheet()->getStyle('A' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('B' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('C' . $baris)->applyFromArray($style_row_left);
                $object->getActiveSheet()->getStyle('D' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('E' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('F' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('G' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('H' . $baris)->applyFromArray($style_row);
                $object->getActiveSheet()->getStyle('I' . $baris)->applyFromArray($style_row);

                $baris++;
            }
        }
        $object->getActiveSheet()->getColumnDimension('A')->setWidth(15);
        $object->getActiveSheet()->getColumnDimension('C')->setWidth(40);

        $filename = 'Rekap_Penguji_Kolokium_' . date("d-m-Y") . '.xlsx';
        $object->getActiveSheet()->setTitle("Rekap Penguji Kolokium");

        header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
        header('Content-Disposition: attachment;filename=' . $filename);
        header('Cache-Control: max-age=0');

        $writer = PHPExcel_IOFactory::createwriter($object, 'Excel2007');
        $writer->save('php://output');
    }

    public function hapusKolokium() {
        $data['judul'] = "History Hapus Jadwal Kolokium";

        $this->load->model('Kolokium_model', 'kolokium');

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('nim', $data['keyword']);
        $this->db->from('hapuskolokium');

        $config['base_url'] = 'http://localhost/proyekKP/kolokium/hapusKolokium';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['kolokium'] = $this->kolokium->getHistoryHapusKolokium($config['per_page'], $data['start'], $data['keyword']);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);

        $this->load->view('kolokium/hapusKolokium', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailHapus($id) {
        $data['judul'] = 'Detail Hapus Jadwal Kolokium';
        $data['kolokium'] = $this->Kolokium_model->getHapusKolokiumByID($id);
        $this->load->view('templates/header', $data);
        $this->load->view('kolokium/detailHapus', $data);
        $this->load->view('templates/footer');
    }

    public function hapusHistoryHapus($id) {
        $data['kolokium'] = $this->Kolokium_model->getHapusKolokiumByID($id);
        $this->Kolokium_model->hapusJadwalKolokiumHapus($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('kolokium/hapusKolokium');
    }

    public function pindahKolokium() {
        $data['judul'] = "History Pindah Jadwal Kolokium";

        $this->load->model('Kolokium_model', 'kolokium');

        $this->load->library('pagination');

        if ($this->input->post('submit')) {
            $data['keyword'] = $this->input->post('keyword');
            $this->session->set_userdata('keyword', $data['keyword']);
        } else {
            $data['keyword'] = $this->session->userdata('keyword');
        }

        $this->db->like('nama', $data['keyword']);
        $this->db->or_like('nim', $data['keyword']);
        $this->db->from('pindahkolokium');

        $config['base_url'] = 'http://localhost/proyekKP/kolokium/pindahKolokium';
        $config['total_rows'] = $this->db->count_all_results();
        $data['total_rows'] = $config['total_rows'];
        $config['per_page'] = 10;

        $this->pagination->initialize($config);

        $data['start'] = $this->uri->segment(3);
        $data['kolokium'] = $this->kolokium->getHistoryPindahKolokium($config['per_page'], $data['start'], $data['keyword']);


        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kolokium/pindahKolokium', $data);
        $this->load->view('templates/footer', $data);
    }

    public function detailPindah($id) {
        $data['judul'] = 'Detail Pindah Jadwal Kolokium';
        $data['kolokium'] = $this->Kolokium_model->getPindahKolokiumByID($id);
        $this->load->view('templates/header', $data);
        $this->load->view('templates/sidebar', $data);
        $this->load->view('templates/topbar', $data);
        $this->load->view('kolokium/detailPindah', $data);

        $this->load->view('templates/footer', $data);
    }

    public function hapusHistoryPindah($id) {
        $data['kolokium'] = $this->Kolokium_model->getPindahKolokiumByID($id);
        $this->Kolokium_model->hapusJadwalKolokiumPindah($id);
        $this->session->set_flashdata('flash', 'Dihapus');
        redirect('kolokium/pindahKolokium');
    }

    public function restorePindah($id) {
        $this->Kolokium_model->restorePindahKolokium($id);
        $this->session->set_flashdata('flash', 'Direstore');
        redirect('kolokium/pindahKolokium');
    }

    public function restoreHapus($id) {
        $this->Kolokium_model->restoreHapusKolokium($id);
        $this->session->set_flashdata('flash', 'Direstore');
        redirect('kolokium/hapusKolokium');
    }

}
