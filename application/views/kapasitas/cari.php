<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4 mb-2"><?= $title ?></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row ">
                        <div class="col">
                            <div class="card mb-1 ">
                                <div class="card-header d-flex justify-content-center font-weight-bold">
                                    Jumlah Mahasiswa Aktif
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status` LIKE 'AKTIF'")->num_rows(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-1 ">
                                <div class="card-header d-flex justify-content-center font-weight-bold">
                                    Jumlah Mahasiswa Tidak Aktif
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'TIDAK AKTIF'")->num_rows(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-1 ">
                                <div class="card-header d-flex justify-content-center font-weight-bold ">
                                    Jumlah Mahasiswa DO
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT DISTINCT * FROM mahasiswa WHERE `status`  LIKE 'DO'")->num_rows(); ?>
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
                                    <label for="title">: <?php echo $makul = $this->input->post('makul');
                                    ?> </label>

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">TAHUN AJARAN </label>
                                </div>
                                <div class="col">
                                    <label for="title">: <?= $tahun = $this->input->post('tahun') ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">TIPE MATA KULIAH </label>
                                </div>
                                <div class="col">
                                    <label for="title">: <?= $tipe = $this->input->post('tipe') ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">SEMESTER </label>
                                </div>
                                <div class="col">
                                    <label for="title">: <?= $semester = $this->input->post('semester') ?></label>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3 font-weight-bold">
                                    <label for="title">DOSEN </label>
                                </div>
                                <div class="col">
                                    <label for="title">: <?= $dosen = $this->input->post('dosen') ?></label>
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
                                        <?php $angkatan = $this->input->post('angkatan');
                                        if ($angkatan != "") :
                                            ?>
                                            <tr style="text-align:center;">
                                                <td>
    <?= '20' . $angkatan; ?>
                                                </td>
                                                <!-- JUMLAH MAHASISWA -->
                                                <td>
    <?= $this->kapasitas_model->mhs($angkatan); ?>
                                                </td>
                                                <!-- TELAH MENGAMBIL -->
                                                <td>
    <?= $this->kapasitas_model->ambilMakul($data, $angkatan, $makul); ?>
                                                </td>
                                                <!-- BELUM MENGAMBIL MENGAMBIL -->
                                                <td>
    <?= $this->kapasitas_model->belumAmbil($data, $angkatan, $makul); ?>
                                                </td>
                                            </tr>
                                        <?php else : ?>

                                            <?php $sql = "SELECT DISTINCT tahun FROM tahun ORDER BY tahun ASC"; ?>
                                            <?php $menu = $this->db->query($sql)->result_array(); ?>
    <?php foreach ($menu as $m): ?>
                                                <tr style="text-align:center;">
                                                    <!-- ANGKATAN -->
                                                    <td><?= '20' . $m['tahun']; ?></td>
                                                    <!-- JUMLAH MAHASISWA -->
                                                    <td><?= $this->kapasitas_model->mhs($m['tahun']); ?></td>
                                                    <!-- TELAH MENGAMBIL -->
                                                    <td>
        <?= $this->kapasitas_model->ambilMakul($data, $m['tahun'], $makul); ?>
                                                    </td>
                                                    <!-- BELUM MENGAMBIL MENGAMBIL -->
                                                    <td>
                                                    <?= $this->kapasitas_model->belumAmbil($data, $m['tahun'], $makul); ?>
                                                    </td>
    <?php endforeach ?>
                                            </tr>

<?php endif ?>

                                    </tbody>
                                </table>
<?php $cetak = ['makul' => $makul, 'tahun' => $tahun, 'tipe' => $tipe, 'semester' => $semester, 'dosen' => $dosen, 'angkatan' => $angkatan, 'data' => $data];
$sd = urlencode(json_encode($cetak));
$this->session->set_tempdata('item', $cetak); ?>
                                <a href="<?= base_url('kapasitas/cetak/') ?>"
                                   class="btn btn-secondary float-right">CETAK</a>
                            </div>
                        </div>
                    </div>
                </div>