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
                            Data Mahasiswa</a>
                    </div>
                </div>
                <hr>
                <?= $this->session->flashdata('message'); ?>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>No</th>
                                <th>NIM</th>
                                <th>NAMA</th>
                                <th>DPA</th>
                                <th>MINAT</th>
                                <th>STATUS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?php echo $row->nim; ?></td>
                                <td><?php echo $row->nama; ?></td>
                                <td><?php echo $row->dpa; ?></td>
                                <td><?php echo $row->minat; ?></td>
                                <td><?php echo $row->status ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>home/detailMhs/<?= $row->idMahasiswa; ?>"
                                        class="badge badge-primary ">Detail</a>
                                    <a href="<?php echo base_url(); ?>home/editMhs/<?= $row->idMahasiswa; ?>"
                                        class="badge badge-success ">Edit</a>
                                    <a href="<?php echo base_url(); ?>home/deleteMhs/<?= $row->idMahasiswa; ?>"
                                        class="badge badge-danger"
                                        onclick="return confirm('Are you sure you want to delete <?= $row->nim; ?>?');">Delete</a>
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

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Import Data Mahasiswa</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <form method="post" enctype="multipart/form-data"
                    action="<?php echo base_url("home/uploadMahasiswa") ?>">
                    <div class="modal-body">
                        <input type="file" class="form-control-file" id="file" name="file[]" multiple>
                    </div>
                    <div class="modal-footer">
                        <a class="btn btn-success" href="<?php echo base_url(); ?>home/formatmhs">Format</a>
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
            "bAutoWidth": false,
            "language": {
                "emptyTable": "Data Kosong"
            },
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
        });
    });
    </script>