<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <div class="modal-body">
                        <div class="form-group text-center">
                            <img src="http://exelsa.usd.ac.id/lihatGambar.php?act=nim&nim=<?= $data['nim'] ?>"
                                 class="img-thumbnail" alt="Responsive image">
                        </div>
                        <div class="form-group">
                            <label for="nama">Nama</label>
                            <input type="text" class="form-control" id="nama" name="nama" value="<?= $data['nama'] ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="nim">NIM</label>
                            <input type="text" class="form-control" id="nim" name="nim" value="<?= $data['nim'] ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="dpa">DPA</label>
                            <input type="text" class="form-control" id="dpa" name="dpa" value="<?= $data['dpa'] ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">MINAT</label>
                            <input type="text" class="form-control" id="minat" name="minat"
                                   value="<?= $data['minat'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dosbing">DOSBING</label>
                            <input type="text" class="form-control" id="dosbing" name="dosbing"
                                   value="<?= $data['dosbing'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="dosbing">DOSBING 1</label>
                            <input type="text" class="form-control" id="dosbing1" name="dosbing1"
                                   value="<?= $data['dosbing1'] ?>" readonly>
                        </div>
                        <div class="form-group">
                            <label for="ipk">IPK</label>
                            <input type="text" class="form-control" id="ipk" name="ipk" value="<?= $data['ipk'] ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="sks">SKS</label>
                            <input type="text" class="form-control" id="sks" name="sks" value="<?= $data['sks'] ?>"
                                   readonly>
                        </div>
                        <div class="form-group">
                            <label for="title">STATUS</label>
                            <input type="text" class="form-control" id="status" name="status"
                                   value="<?= $data['status'] ?>" readonly>
                        </div>
                        <div class="form-group text-right">
                            <a class="btn btn-primary btn-lg-5"
                               href="<?php echo base_url(); ?>home/editMhs/<?= $data['nim']; ?>">Edit Data</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>