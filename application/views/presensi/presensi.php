<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h2 class=""><?= $title ?></h2>
                    </div>
                    <div class="col-auto ml-3">
                        <a href="http://" class="btn btn-success pull-right" data-toggle="modal"
                            data-target="#exampleModal"> <span class="glyphicon glyphicon-upload"></span> Import
                            Presensi</a>
                    </div>
                </div>
                <hr>
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>MAKUL</th>
                                <th>TAHUN</th>
                                <th>RUANGAN</th>
                                <th>KELAS</th>
                                <th>DOSEN</th>
                                <th>JUMLAH MAHASISWA</th>
                                <th>ACTION</th>

                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result_array() as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?php echo $row['makul']; ?></td>
                                <td><?php echo $row['tahun']; ?></td>
                                <td><?php echo $row['ruang'];?> </td>
                                <td class="text-center"><?php echo $row['kelas'] ; ?></td>
                                <td><?php echo $row['dosen']; ?></td>
                                <td class="text-center">
                                    <?php echo $row['kapasitas'];  ?>
                                </td>
                                <td class="text-center">
                                    <a href="<?php echo base_url(); ?>presensi/isi/<?= $row['idMakul']; ?>"
                                        class=" badge badge-success text-center"> <i
                                            class="glyphicon glyphicon-edit"></i>
                                        Detail</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
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

    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true,
            "bAutoWidth": false
        });
    });
    </script>