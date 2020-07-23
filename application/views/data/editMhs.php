<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url('home/editMahasiswa'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                       value="<?= $data['nama'] ?>">
                                       <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="nim">NIM</label>
                                <input type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>">
                                <?= form_error('nim', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="dpa">DPA</label>
                                <input type="text" class="form-control" id="dpa" name="dpa" value="<?= $data['dpa'] ?>">
                                <?= form_error('dpa', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="title">MINAT</label>
                                <select name="minat" id="minat" class="form-control">
                                    <option value=""></option>
                                    <?php $menu = ['SC', 'RD', 'JAR'] ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <?php if ($m == $data['minat']) : ?>
                                            <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                        <?php else : ?>
                                            <option value="<?= $m ?>"> <?= $m ?> </option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="dosbing">DOSBING</label>
                                <input type="text" class="form-control" id="dosbing" name="dosbing"
                                       value="<?= $data['dosbing'] ?>">
                            </div>
                            <div class="form-group">
                                <label for="ipk">IPK</label>
                                <input type="text" class="form-control" id="ipk" name="ipk" value="<?= $data['ipk'] ?>">
                                <?= form_error('ipk', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="sks">SKS</label>
                                <input type="text" class="form-control" id="sks" name="sks" value="<?= $data['sks'] ?>">
                                <?= form_error('sks', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="title">STATUS</label>
                                <select name="status" id="status" class="form-control">
                                    <option value=""></option>
                                    <?php $menu = ['AKTIF', 'TIDAK AKTIF', 'DO'] ?>
                                    <?php foreach ($menu as $m) : ?>
                                        <?php if ($m == $data['status']) : ?>
                                            <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                        <?php else : ?>
                                            <option value="<?= $m ?>"> <?= $m ?> </option>
                                        <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
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