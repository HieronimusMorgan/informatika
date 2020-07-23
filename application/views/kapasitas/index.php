<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
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
                        <div class="card-header d-flex justify-content-center font-weight-bold ">
                            KAPASITAS SEMUA KELAS
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="dataTable" width="100%" id="myTable">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th>NO</th>
                                            <th>MAKUL</th>
                                            <th>JUMLAH</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php $total = 0; ?>
                                        <?php foreach ($makul as $m): ?>
                                            <tr>
                                                <td style="text-align:center;"><?php echo $i ?></td>
                                                <td><?php echo $m['nama'] ?></td>
                                                <td style="text-align:center;"><?php
                                                    $sql = "SELECT COUNT(Nim) AS jumlah FROM presensi a JOIN makul b ON a.idMakul = b.idMakul WHERE b.nama LIKE '" . $m['nama'] . "'";
                                                    $jumlah = $this->db->query($sql)->result_array();
                                                    echo $jumlah[0]['jumlah'];
                                                    $total += $jumlah[0]['jumlah'];
                                                    ?>
                                                </td>
                                            </tr>
                                            <?php $i++; ?>
                                        <?php endforeach ?>
                                        <tr>
                                            <th colspan="2" class="text-right">TOTAL</th>
                                            <td style="text-align:center;"><?php echo $total ?></td>
                                        </tr>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>