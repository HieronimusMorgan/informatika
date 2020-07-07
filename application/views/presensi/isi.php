<!-- Begin Page Content -->
<div class="container-fluid">

    <!-- Page Heading -->
    <h1 class="h3 mb-4 text-gray-800"><?= $title ?></h1>

    <div class="row">
        <div class="col">
            <?= form_error('role', '<div div class="alert alert-danger" role="alert">', '</div>'); ?>
            <?= $this->session->flashdata('message'); ?>
            <a href="http://" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Import
                Data</a>
            <table class="table table-hover">
                <thead>
                    <tr>
                        <th scope="col">No</th>
                        <th scope="col">NIM</th>
                        <th scope="col">Nama</th>
                        <th scope="col">Makul</th>
                        <th scope="col">Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1; ?>
                    <?php foreach ($isi as $m) : ?>
                    <tr>
                        <th scope="row"><?= $i ?></th>
                        <th><?= $m['Nim'] ?></th>
                        <th><?= $m['Nama'] ?></th>
                        <th><?= $m['Makul'] ?></th>
                        <th><?= $m['Kelas'] ?></th>
                    </tr>
                    <?php $i++; ?>
                    <?php endforeach; ?>
                </tbody>
            </table>
        </div>
    </div>
</div>
<!-- /.container-fluid -->

</div>
<!-- End of Main Content -->

<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
    aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="exampleModalLabel">Add New Menu</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form method="POST" action="<?php echo base_url('presensi/upload') ?>" enctype="multipart/form-data">
                <div class="form-group">
                    <label for="exampleInputEmail1">UNGGAH FILE EXCEL</label>
                    <input type="file" name="userfile" class="form-control">
                </div>

                <button type="submit" class="btn btn-success">UPLOAD</button>
            </form>
        </div>
    </div>
</div>