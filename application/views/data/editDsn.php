<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col-lg-6">
                    <form action="<?= base_url('home/editDosen'); ?>" method="post">
                        <div class="modal-body">
                            <div class="form-group">
                                <label for="nip">NPP</label>
                                <input type="text" class="form-control" id="nip" name="nip" value="<?= $data['npp'] ?>">
                                <?= form_error('nip', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="nama">Nama</label>
                                <input type="text" class="form-control" id="nama" name="nama"
                                    value="<?= $data['nama'] ?>">
                                <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <label for="title">Prodi</label>
                                <select name="prodi" id="prodi" class="form-control">
                                    <option value=""></option>
                                    <?php $menu = ['Akuntansi', 'Ekonomi', 'Manajemen','Farmasi','Bimbingan dan Konseling', 'Pendidikan Bahasa dan Sastra Indonesia
Pendidikan Bahasa Inggris', 'Pendidikan Biologi','Pendidikan Ekonomi Bidang Keahlian Khusus Pendidikan Akuntansi', 'Pendidikan Fisika', 'Pendidikan Guru Sekolah Dasar', 'Pendidikan Keagamaan Katolik', 'Pendidikan Kimia', 'Pendidikan Matematika','Pendidikan Sejarah', 'Psikologi', 'Informatika', 'Matematika', 'Teknik Elektro', 'Teknik Mesin', 'Sastra Indonesia', 'Sastra Inggris', 'Sejarah','Filsafat Keilahian Program Sarjana'] ?>
                                    <?php foreach ($menu as $m) : ?>
                                    <?php if ($m == $data['prodi']) : ?>
                                    <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                    <?php else : ?>
                                    <option value="<?= $m ?>"> <?= $m ?> </option>
                                    <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                            </div>
                            <div class="form-group">
                                <label for="nama">Status</label>
                                <select name="status" id="status" class="form-control">
                                    <option value=""></option>
                                    <?php $menu = ['Kaprodi', 'Wakaprodi', 'Dosen'] ?>

                                    <?php foreach ($menu as $m) : ?>
                                    <?php if ($m == $data['prodi']) : ?>
                                    <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                    <?php else : ?>
                                    <option value="<?= $m ?>"> <?= $m ?> </option>
                                    <?php endif ?>
                                    <?php endforeach; ?>
                                </select>
                                <?= form_error('status', '<small class="text-danger pl-2">', '</small>') ?>
                            </div>
                            <div class="form-group">
                                <a href="<?= base_url('home/dosen'); ?>" class="btn btn-secondary">Kembali</a>
                                <button type="submit" class="btn btn-primary">Edit</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </main>