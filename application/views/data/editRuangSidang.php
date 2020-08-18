<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url('home/editRuanganSidang'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">NAMA</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= $data['nama'] ?>">
                                <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <a href="<?= base_url('home/ruanganSidang'); ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>