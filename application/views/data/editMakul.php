<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url('home/editMat'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="kode">Kode Makul</label>
                                <input type="text" class="form-control" id="kode" name="kode"
                                       value="<?= $data['kodeMakul'] ?>">
                                       <?= form_error('kode', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="title">TIPE MAKUL</label>
                                <select name="tipe" id="tipe" class="form-control">
                                    <option value=""></option>
                                    <?php $menu = ['Wajib', 'RD', 'SC', 'JK', 'Perminatan'] ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <?php if ($m == $data['tipeMakul']) : ?>
                                            <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                        <?php else : ?>
                                            <option value="<?= $m ?>"> <?= $m ?> </option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama Makul</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                       value="<?= $data['nama'] ?>">
                                       <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="tahun">Tahun</label>
                                <input type="text" class="form-control" id="tahun" name="tahun"
                                       value="<?= $data['tahun'] ?>">
                                       <?= form_error('tahun', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="semester">Semester</label>
                                <input type="text" class="form-control" id="semester" name="semester"
                                       value="<?= $data['semester'] ?>">
                                       <?= form_error('semester', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="ruangan">Ruangan</label>
                                <input type="text" class="form-control" id="ruangan" name="ruangan"
                                       value="<?= $data['ruangan'] ?>">
                                       <?= form_error('ruangan', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="kapasitas">Kapasitas</label>
                                <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                       value="<?= $data['kapasitas'] ?>">
                                       <?= form_error('kapasitas', '<small class="text-danger pl-2">', '</small>') ?>
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