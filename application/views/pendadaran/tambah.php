<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="container">
                <?php if ($this->session->flashdata('bentrok')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('bentrok'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('rks')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('rks'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('rka')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('rka'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('rksa')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('rksa'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('rsa')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('rsa'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                Form Tambah Jadwal Pendadaran
                            </div>
                            <?php if ($this->session->userdata() == 1): ?>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nim">NIM Mahasiswa</label>
                                        <input type="text" name="nim" class="form-control" id="nim"
                                            value="<?= $mahasiswa['nim']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Mahasiswa</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            value="<?= $mahasiswa['nama']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="dosen1">Dosen Pembimbing 1</label>
                                        <input type="text" name="dosen1" class="form-control" id="dosen1"
                                            value="<?= $mahasiswa['dosen1']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="dosen2">Dosen Pembimbing 2</label>
                                        <input type="text" name="dosen2" class="form-control" id="dosen2"
                                            value="<?= $mahasiswa['dosen2']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Judul Tugas Akhir</label>
                                        <textarea class="form-control" name="judul" id="judul" rows="3"
                                            value="<?= $mahasiswa['judul']; ?>"
                                            readonly><?= $mahasiswa['judul']; ?></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="reviewer">Reviewer Kolokium</label>
                                        <input type="text" name="reviewer" class="form-control" id="reviewer"
                                            value="<?= $mahasiswa['reviewer']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="ketuaPenguji">Ketua Penguji</label>
                                        <select class="form-control" id="ketuaPenguji" name="ketuaPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] != $mahasiswa['dosen2'] && $ds['nama'] != $mahasiswa['dosen1']): ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Ketua Penguji harus diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sekretarisPenguji">Sekretaris Penguji</label>
                                        <select class="form-control" id="sekretarisPenguji" name="sekretarisPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] != $mahasiswa['dosen2'] && $ds['nama'] != $mahasiswa['dosen1']): ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Sekretaris Penguji harus
                                            diisi.</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="anggotaPenguji">Anggota Penguji</label>
                                        <select class="form-control" id="anggotaPenguji" name="anggotaPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                        <small
                                            class="form-text text-danger"><?= form_error('anggotaPenguji'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal">
                                        <small class="form-text text-danger">Kolom Tanggal harus diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi">Jam</label>
                                        <select class="form-control" id="durasi" name="durasi">
                                            <?php foreach ($jam as $j): ?>
                                            <option value="<?= $j; ?>"><?= $j; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ruang">Ruang</label>
                                        <select class="form-control" id="ruang" name="ruang">
                                            <?php foreach ($ruang as $r): ?>
                                            <option value="<?= $r['nama']; ?>"><?= $r['nama']; ?></option>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nilai">Nilai</label>
                                        <input type="text" name="nilai" class="form-control" id="nilai" value="-"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan"
                                            rows="3"></textarea>
                                    </div>
                                    <input type="hidden" name="nilai" id="nilai" value="-">
                                    <a href="<?= base_url() ?>pendadaran" class="btn btn-danger " role="button"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
                                    <button type="submit" name="tambah" class="btn btn-primary float-right"><i
                                            class="fas fa-plus"></i> Tambah Data</button>
                                </form>
                            </div>
                            <?php elseif ($this->session->userdata() != 1): ?>
                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nim">NIM Mahasiswa</label>
                                        <input type="text" name="nim" class="form-control" id="nim"
                                            value="<?= $mahasiswa['nim']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Mahasiswa</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            value="<?= $mahasiswa['nama']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="dosen1">Dosen Pembimbing 1</label>
                                        <input type="text" name="dosen1" class="form-control" id="dosen1"
                                            value="<?= $mahasiswa['dosen1']; ?>" readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="dosen2">Dosen Pembimbing 2</label>
                                        <input type="text" name="dosen2" class="form-control" id="dosen2"
                                            value="<?= $mahasiswa['dosen2']; ?>" readonly>
                                    </div>

                                    <div class="form-group">
                                        <label for="judul">Judul Tugas Akhir</label>
                                        <textarea class="form-control" name="judul" id="judul" rows="3"
                                            value="<?= $mahasiswa['judul']; ?>"
                                            readonly><?= $mahasiswa['judul']; ?></textarea>

                                    </div>
                                    <div class="form-group">
                                        <label for="reviewer">Reviewer Kolokium</label>
                                        <input type="text" name="reviewer" class="form-control" id="reviewer"
                                            value="<?= $mahasiswa['reviewer']; ?>" readonly>

                                    </div>
                                    <div class="form-group">
                                        <label for="ketuaPenguji">Ketua Penguji</label>
                                        <select class="form-control" id="ketuaPenguji" name="ketuaPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] != $mahasiswa['dosen2'] && $ds['nama'] != $mahasiswa['dosen1']): ?>
                                            <?php if ($ds['nama'] == $this->session->userdata('ketuaPenguji')): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Ketua Penguji harus diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="sekretarisPenguji">Sekretaris Penguji</label>
                                        <select class="form-control" id="sekretarisPenguji" name="sekretarisPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] != $mahasiswa['dosen2'] && $ds['nama'] != $mahasiswa['dosen1']): ?>
                                            <?php if ($ds['nama'] == $this->session->userdata('sekretarisPenguji')): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Sekretaris Penguji harus
                                            diisi.</small>
                                    </div>

                                    <div class="form-group">
                                        <label for="anggotaPenguji">Anggota Penguji</label>
                                        <select class="form-control" id="anggotaPenguji" name="anggotaPenguji">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] == $this->session->userdata('anggotaPenguji')): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small
                                            class="form-text text-danger"><?= form_error('anggotaPenguji'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal"
                                            value="<?= $this->session->userdata('tangal'); ?>">
                                        <small class="form-text text-danger">Kolom Tanggal harus diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi">Jam</label>
                                        <select class="form-control" id="durasi" name="durasi">
                                            <?php foreach ($jam as $j): ?>
                                            <?php if ($j == $this->session->userdata('durasi')): ?>
                                            <option value="<?= $j; ?>" selected><?= $j; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $j; ?>"><?= $j; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="ruang">Ruang</label>
                                        <select class="form-control" id="ruang" name="ruang">
                                            <?php foreach ($ruang as $r): ?>
                                            <?php if ($r['nama'] == $this->session->userdata('ruang')): ?>
                                            <option value="<?= $r['nama']; ?>" selected><?= $r['nama']; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $r['nama']; ?>"><?= $r['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="nilai">Nilai</label>
                                        <input type="text" name="nilai" class="form-control" id="nilai" value="-"
                                            readonly>
                                    </div>
                                    <div class="form-group">
                                        <label for="keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan"
                                            rows="3"><?= $this->session->userdata('keterangan'); ?></textarea>
                                    </div>
                                    <input type="hidden" name="nilai" id="nilai" value="-">
                                    <a href="<?= base_url() ?>pendadaran" class="btn btn-danger " role="button"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
                                    <button type="submit" name="tambah" class="btn btn-primary float-right"><i
                                            class="fas fa-plus"></i> Tambah Data</button>
                                </form>
                            </div>
                            <?php endif; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>