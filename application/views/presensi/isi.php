<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="row font-weight-normal">
                <div class="col-auto mr-auto">
                    <div class="card-body">
                        <h2 class="mt-3 mb-3"><?= $title." ".$makul->nama ?></h2>
                        <div class="row ">
                            <div class="col-3">
                                <label for="title">MATA KULIAH </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->nama.' / '.$makul->kelas ?> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 ">
                                <label for="title">TAHUN AJARAN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->tahun ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3">
                                <label for="title">SEMESTER </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->semester ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-3 ">
                                <label for="title">DOSEN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $this->PresensiModel->cariDosen($makul->idMakul)->dosen?>
                                </label>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="table-responsive mt-1">
                <table class="table table-bordered" id="tabelku" width="100%">
                    <thead>
                        <tr class="text-center">
                            <th>NO</th>
                            <th>NIM</th>
                            <th>NAMA</th>

                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($mahasiswa->result_array() as $row) : ?>
                        <tr>
                            <td class="text-center"><?= $i ?></td>
                            <td><?php echo $row['nim']; ?></td>
                            <td><?php echo $row['nama']; ?></td>
                        </tr>
                        <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
                <a href="<?= base_url('presensi'); ?>" class="btn btn-secondary"> Kembali </a>
            </div>
        </div>
    </main>

    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "200px",
            "scrollCollapse": true,
            "paging": false,
            "bAutoWidth": false
        });
    });
    </script>