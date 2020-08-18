<!-- <style>
#tabelku tbody tr:hover td {
    background: none repeat scroll 0 0 #C0C0C0;
    color: #000000;
}

#tabelku tbody tr.selected td {
    background: none repeat scroll 0 0 #C0C0C0;
    color: #000000;
}
</style>
-->
<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
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
                        <div class="card-header d-flex justify-content-center font-weight-bold ">
                            KAPASITAS SEMUA KELAS
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="tabelku" width="100%">
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
                                                    $sql = "SELECT  COUNT(DISTINCT a.Nim, a.idMakul, a.idRuangan) AS jumlah FROM presensi a JOIN makul b ON a.idMakul = b.idMakul WHERE b.nama LIKE '" . $m['nama'] . "' ";
                                                    $jumlah = $this->db->query($sql)->result_array();
                                                    echo $jumlah[0]['jumlah'];
                                                    $total += $jumlah[0]['jumlah'];
                                                    ?>
                                            </td>
                                        </tr>
                                        <?php $i++; ?>
                                        <?php endforeach ?>
                                    </tbody>
                                    <tr>
                                        <th colspan="2" class="text-right">TOTAL</th>
                                        <td style="text-align:center;"><?php echo $total ?></td>
                                    </tr>
                                </table>
                                <hr>
                                <a href="<?= base_url('kapasitas/cetakAll/') ?>" class="btn btn-success float-right">
                                    <i class="fas fa-file-excel" aria-hidden="true"></i> CETAK EXCEL</a>
                            </div>
                        </div>
                    </div>
                </div>
                <script type="text/javascript">
                $(document).ready(function() {
                    $('#tabelku').dataTable({
                        "scrollY": "440px",
                        "scrollCollapse": true,
                        "paging": true,
                        "bAutoWidth": false,
                        "bInfo": true,
                        "lengthMenu": [
                            [10, 25, 50, 100, -1],
                            [10, 25, 50, 100, "All"]
                        ],
                    });
                });
                // $(document).ready(function() {
                //     var table = $('#tabelku').DataTable();
                //     $('#tabelku tbody').on('click', 'tr', function() {
                //         var id = table.row(this).data();
                //         alert('You clicked on ' + id[1] + '\'s row');
                //     });
                // });
                // 
                </script>