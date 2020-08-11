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
                            KAPASITAS KELAS ANGKATAN 20<?= $this->input->post('angkatan'); ?>
                        </div>
                        <div class="card-body">

                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabelku" width="100%">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th>MAKUL </th>
                                            <th>JUMLAH MAHASISWA</th>
                                            <th>TELAH MENGAMBIL</th>
                                            <th>BELUM MENGAMBIL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $menu = $this->db->query("SELECT DISTINCT b.nama " . $from . " " . $data)->result_array(); ?>
                                        <?php foreach ($menu as $m): ?>
                                            <tr>
                                                <!-- ANGKATAN -->
                                                <td><?= $m['nama']; ?></td>
                                                <!-- JUMLAH MAHASISWA -->
                                                <td style="text-align:center;">
                                                    <?= $this->kapasitas_model->mhs($this->input->post('angkatan')); ?></td>
                                                <!-- TELAH MENGAMBIL -->
                                                <td style="text-align:center;">
                                                    <?= $this->kapasitas_model->ambilMakulAngkatan($data, $m['nama']); ?>
                                                </td>
                                                <!-- BELUM MENGAMBIL MENGAMBIL -->
                                                <td style="text-align:center;">
                                                    <?= $this->kapasitas_model->belumAmbilAngkatan($data, $m['nama']); ?>
                                                </td>
                                            <?php endforeach ?>
                                        </tr>
                                    </tbody>
                                </table>
                                <hr>
                                <?php
                                $cetak = ['angkatan' => $this->input->post('angkatan'), 'data' => $data];
                                $this->session->set_tempdata('item1', $cetak);
                                ?>
                                <a href="<?= base_url('kapasitas/cetakAngkatan/') ?>"
                                   class="btn btn-success float-right">
                                    <i class="fas fa-file-excel" aria-hidden="true"></i> CETAK EXCEL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                    $(document).ready(function () {
                        $('#tabelku').dataTable({
                            "scrollY": "400px",
                            "paging": true,
                            "language": {
                                "emptyTable": "Data Kosong"
                            }
                        });
                    });
                </script>