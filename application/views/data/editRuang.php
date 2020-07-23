<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url('home/editRuangan'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">NAMA</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                       value="<?= $data['nama'] ?>" readonly>
                                       <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="makul">MAKUL</label>
                                <input type="text" class="form-control" id="makul" name="makul"
                                       value="<?= $data['makul'] ?>">
                                       <?= form_error('makul', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="jam">JAM</label>
                                <input type="text" class="form-control" id="jam" name="jam" value="<?= $data['jam'] ?>">
                                <?= form_error('jam', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>