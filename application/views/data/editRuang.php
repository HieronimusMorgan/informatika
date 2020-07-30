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
                                    value="<?= $data['nama'] ?>">
                                <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="makul">MAKUL</label>
                                <input type="text" class="form-control" id="makul" name="makul" value="<?php $this->db->where('idMakul',$data['makul']);
                                                $this->db->from('makul');
                                                $da = $this->db->get()->row();
                                                echo $da->nama;

                                    ?>" readonly>
                                <?= form_error('makul', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="hari">HARI</label>
                                <input type="text" class="form-control" id="hari" name="hari"
                                    value="<?= $data['hari'] ?>">
                                <?= form_error('hari', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="jam">JAM</label>
                                <input type="text" class="form-control" id="jam" name="jam" value="<?= $data['jam'] ?>">
                                <?= form_error('jam', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <a href="<?= base_url('home/ruangan'); ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>