<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title?></h1>
            <div class="card-body">
                <a href="http://" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Tambah
                    Mahasiswa</a>
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>MAKUL</th>
                                <th>KELAS</th>
                                <th>RUANGAN</th>
                                <th>DOSEN</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result_array() as $row) : ?>
                            <?php $c = $this->db->query("SELECT a.Nim, a.Nama, b.nama AS makul, b.kelas AS kelas, d.nama AS dosen, c.nama AS ruangan FROM presensi a JOIN makul b ON a.idMakul = b.idMakul JOIN dosen d ON a.idDosen=d.idDosen JOIN ruangan c ON a.idRuangan = c.idRuangan WHERE a.idPresensi LIKE " .$row['idPresensi'])->row_array(); ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?php echo $c['Nim']; ?></td>
                                <td><?php echo $c['Nama']; ?></td>
                                <td><?php echo $c['makul'];?> </td>
                                <td><?php echo $c['kelas'] ; ?></td>
                                <td><?php echo $c['ruangan']; ?></td>
                                <td><?php echo $c['dosen']; ?></td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!--Tampilkan pagination-->
                    <div class="row">
                        <div class="col">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>


    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Tambah Presensi</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data" action="<?php echo base_url("presensi/upload") ?>">
                    <div class="modal-body">
                        <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                        <button type="submit" class="btn btn-primary">Import</button>
                    </div>
                </form>
            </div>
        </div>
    </div>