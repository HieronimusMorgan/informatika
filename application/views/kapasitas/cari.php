<?php $from = "FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen=c.idDosen" ?>
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4 mb-2"><?= $title ?></h1>
            <div id="accordion">
                <div class="card mb-4">
                    <div class="card-header" id="headingOne">
                        <h5 class="mb-0 text-center">
                            <button class="btn btn-link font-weight-bold" data-toggle="collapse"
                                    data-target="#collapseOne" aria-expanded="true" aria-controls="collapseOne">
                                MAHASISWA
                            </button>
                        </h5>

                    </div>
                    <div id="collapseOne" class="collapse" aria-labelledby="headingOne" data-parent="#accordion">
                        <div class="card-body">
                            <div class="row ">
                                <div class="col">
                                    <div class="card mb-1 ">
                                        <div class="card-header d-flex justify-content-center font-weight-bold">
                                            Aktif
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status` LIKE 'AKTIF'")->num_rows(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-header d-flex justify-content-center font-weight-bold">
                                            Tidak Aktif
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'TIDAK AKTIF'")->num_rows(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-header d-flex justify-content-center font-weight-bold ">
                                            Drop Out
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'DO'")->num_rows(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-header d-flex justify-content-center font-weight-bold ">
                                            Cuti
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'CUTI'")->num_rows(); ?>
                                        </div>
                                    </div>
                                </div>
                                <div class="col">
                                    <div class="card ">
                                        <div class="card-header d-flex justify-content-center font-weight-bold ">
                                            Lulus
                                        </div>
                                        <div class="card-body d-flex justify-content-center">
                                            <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'LULUS'")->num_rows(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4  ">
                        <div class="card-header d-flex justify-content-center  font-weight-bold">
                            KAPASITAS KELAS
                        </div>
                        <div class="card-body">
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">MATA KULIAH </label>
                                </div>
                                <div class="col">
                                    <label for="title">: <?php
                                        $sql = "SELECT DISTINCT b.nama  " . $from . " " . $data;
                                        $makul = $this->input->post('makul');
                                        $idSemester = $this->input->post('idSemester');
                                        if ($makul != "") {
                                            echo $makul . ' / ' . $idSemester;
                                        } elseif ($this->db->query($sql)->num_rows() != 0) {
                                            $a = $this->db->query($sql)->result();
                                            foreach ($a as $a) {
                                                $makul = $makul . " " . $a->nama;
                                            }
                                            echo $makul;
                                        }
                                        ?> </label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">TAHUN AJARAN </label>
                                </div>
                                <div class="col">
                                    <label for="title">:
                                        <?php
                                        $tahun = $this->input->post('tahun');
                                        $sql = "SELECT DISTINCT b.tahun " . $from . " " . $data;
                                        if ($tahun != "") {
                                            echo $tahun;
                                        } elseif ($this->db->query($sql)->num_rows() != 0) {
                                            $a = $this->db->query($sql)->result();
                                            foreach ($a as $a) {
                                                $tahun = $tahun . " " . $a->tahun;
                                            }
                                            echo $tahun;
                                        }
                                        ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">TIPE MATA KULIAH </label>
                                </div>
                                <div class="col">
                                    <label for="title">:
                                        <?php
                                        $tipe = $this->input->post('tipe');
                                        $sql = "SELECT DISTINCT b.tipeMakul " . $from . " " . $data;
                                        if ($tipe != "") {
                                            
                                        } elseif ($this->db->query($sql)->num_rows() != 0) {
                                            $a = $this->db->query($sql)->result();
                                            foreach ($a as $a) {
                                                $tipe = $tipe . " " . $a->tipeMakul;
                                            }
                                            echo $tipe;
                                        }
                                        ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">SEMESTER </label>
                                </div>
                                <div class="col">
                                    <label for="title">:
                                        <?php
                                        $semester = $this->input->post('semester');
                                        $sql = "SELECT DISTINCT b.semester " . $from . " " . $data;
                                        if ($semester != "") {
                                            echo $semester;
                                        } elseif ($this->db->query($sql)->num_rows() != 0) {
                                            $a = $this->db->query($sql)->result();
                                            foreach ($a as $a) {
                                                $semester = $semester . " " . $a->semester;
                                            }
                                            echo $semester;
                                        }
                                        ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">DOSEN </label>
                                </div>
                                <div class="col">
                                    <label for="title">:
                                        <?php
                                        $sql = "SELECT DISTINCT  c.nama AS dosen " . $from . " " . $data;
                                        $dosen = $this->input->post('dosen');
                                        if ($dosen != "") {
                                            echo $dosen;
                                        } elseif ($this->db->query($sql)->num_rows() != 0) {
                                            $a = $this->db->query($sql)->result();
                                            foreach ($a as $a) {
                                                $dosen = $dosen . " " . $a->dosen;
                                            }
                                            echo $dosen;
                                        }
                                        ?></label>
                                </div>
                            </div>
                            <?php
                            if ($this->input->post('dosen') != "" && $makul == "") {
                                $sql = "SELECT DISTINCT b.nama FROM presensi a JOIN makul b ON a.idMakul=b.idMakul JOIN dosen c ON a.idDosen = c.idDosen WHERE c.nama LIKE '" . $this->input->post('dosen') . "'";
                                $q = $this->db->query($sql)->result_array();
                                echo '<div class="alert alert-danger" role="danger" style="text-align:center;">
                                        Mengampu Mata Kuliah : ';
                                foreach ($q as $q) {
                                    echo $q['nama'] . ", ";
                                }
                                echo '</div>';
                            }
                            if ($makul == "") {
                                echo '<div class="alert alert-danger" role="danger" style="text-align:center;">
                                     Mata Kuliah kosong!</div>';
                            }
                            ?>
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" id="myTable">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th>ANGKATAN </th>
                                            <th>JUMLAH MAHASISWA</th>
                                            <th>TELAH MENGAMBIL</th>
                                            <th>BELUM MENGAMBIL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <!-- ANGKATAN -->
                                        <?php
                                        $angkatan = $this->input->post('angkatan');
                                        if ($angkatan != "") :
                                            ?>
                                            <tr style="text-align:center;">
                                                <td><?= '20' . $angkatan; ?></td>
                                                <!-- JUMLAH MAHASISWA -->
                                                <td><?= $this->kapasitas_model->mhs($angkatan); ?></td>
                                                <!-- TELAH MENGAMBIL -->
                                                <td><?= $this->kapasitas_model->ambilMakul($data, $angkatan, $makul); ?>
                                                </td>
                                                <!-- BELUM MENGAMBIL MENGAMBIL -->
                                                <td><?= $this->kapasitas_model->belumAmbil($data, $angkatan, $makul); ?>
                                                </td>
                                            </tr>
                                        <?php else : ?>
                                            <?php $menu = $this->kapasitas_model->angkatan(); ?>
                                            <!-- CHECK MAHASISWA -->
                                            <?php if ($this->kapasitas_model->hitung($data, $makul) != 0) : ?>

                                                <?php foreach ($menu as $m): ?>
                                                    <?php if ($this->kapasitas_model->mhs($m['tahun']) != 0) : ?>
                                                        <tr style="text-align:center;">
                                                            <!-- ANGKATAN -->
                                                            <td><?= '20' . $m['tahun']; ?></td>
                                                            <!-- JUMLAH MAHASISWA -->
                                                            <td><?= $this->kapasitas_model->mhs($m['tahun']); ?></td>
                                                            <!-- TELAH MENGAMBIL -->
                                                            <td><?= $this->kapasitas_model->ambilMakul($data, $m['tahun'], $makul); ?>
                                                            </td>
                                                            <!-- BELUM MENGAMBIL MENGAMBIL -->
                                                            <td><?= $this->kapasitas_model->belumAmbil($data, $m['tahun'], $makul); ?>
                                                            </td>
                                                        <?php endif ?>
                                                    <?php endforeach ?>
                                                </tr>
                                            <?php else: ?>
                                            <div class="alert alert-danger" role="danger" style="text-align:center;">
                                                Mahasiswa Belum Mengambil Mata Kuliah <?= $makul ?>!</div>
                                        <?php endif ?>
                                    <?php endif ?>
                                    </tbody>
                                </table>
                                <?php
                                $cetak = ['makul' => $makul, 'tahun' => $tahun, 'tipe' => $tipe, 'semester' => $semester, 'dosen' => $dosen, 'angkatan' => $angkatan, 'data' => $data, 'idSemester' => $idSemester];
                                $this->session->set_tempdata('item', $cetak);
                                ?>
                                <a href="<?= base_url('kapasitas/cetak/') ?>" class="btn btn-success float-right">
                                    <i class="fas fa-file-excel" aria-hidden="true"></i> CETAK EXCEL</a>
                            </div>
                        </div>
                    </div>
                </div>