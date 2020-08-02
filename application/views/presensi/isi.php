<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="row">
                <div class="col-8 mr-auto">
                    <div class="card-body">
                        <h2 class="mt-3 mb-3"><?= $title." ".$makul->nama ?></h2>
                        <div class="row ">
                            <div class="col-5">
                                <label for="title">MATA KULIAH </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->nama.' / '.$makul->kelas ?> </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">TAHUN AJARAN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->tahun ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">SEMESTER </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $makul->semester ?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-5">
                                <label for="title">DOSEN </label>
                            </div>
                            <div class="col">
                                <label for="title">: <?= $this->PresensiModel->cariDosen($makul->idMakul)->dosen?>
                                </label>
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-auto">
                                <a type="button" class="btn btn-secondary" href="<?= base_url('presensi'); ?>">
                                    <i class="fas fa-chevron-left"></i> Kembali</a>
                                <a type="button" class="btn btn-success"
                                    href="<?= base_url('home/editMakul/').$makul->idMakul; ?>">
                                    <i class="fas fa-edit"></i> Edit Presensi</a>
                                <a type="button" class="btn btn-danger"
                                    href="<?= base_url('home/hapusMakul/'.$makul->idMakul); ?>"
                                    onclick="return confirm('Are you sure you want to delete <?= $makul->nama; ?>?');">
                                    <i class="far fa-trash-alt"></i> Hapus Presensi</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <hr>
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