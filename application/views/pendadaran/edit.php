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
                    <div class="col-md-6">
                        <div class="card">
                            <div class="card-header">
                                Edit Jadwal Pendadaran
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $pendadaran['id']; ?>">
                                    <div class="form-group">
                                        <label for="nim">NIM Mahasiswa</label>
                                        <input type="text" name="nim" class="form-control" id="nim"
                                            value="<?= $pendadaran['nim']; ?>" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Mahasiswa</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            value="<?= $pendadaran['nama']; ?>" readonly="">
                                    </div>
                                    <div class="form-group">
                                        <label for="dosen1">Dosen Pembimbing 1</label>
                                        <select class="form-control" id="dosen1" name="dosen1">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] == $pendadaran['dosen1']): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Dosen Pembimbing 1 harus
                                            diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="dosen2">Dosen Pembimbing 2</label>
                                        <select class="form-control" id="dosen2" name="dosen2">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] == $pendadaran['dosen2']): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="judul">Judul Tugas Akhir</label>
                                        <textarea class="form-control" name="judul" id="judul"
                                            rows="3"><?= $pendadaran['judul']; ?></textarea>
                                        <small class="form-text text-danger">Kolom Judul Tugas Akhir harus diisi.</small
                                            </div>
                                        <div class="form-group">
                                            <label for="reviewer">Reviewer Kolokium</label>
                                            <select class="form-control" id="reviewer" name="reviewer">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $pendadaran['reviewer']): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?>
                                                </option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                            <small class="form-text text-danger">Kolom Reviewer Kolokium harus
                                                diisi.</small </div>
                                            <div class="form-group">
                                                <label for="ketuaPenguji">Ketua Penguji</label>
                                                <select class="form-control" id="ketuaPenguji" name="ketuaPenguji">
                                                    <option value="">-</option>
                                                    <?php foreach ($dosen as $ds): ?>
                                                    <?php if ($ds['nama'] == $pendadaran['ketuaPenguji']): ?>
                                                    <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?>
                                                    </option>
                                                    <?php else: ?>
                                                    <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                    <?php endif; ?>
                                                    <?php endforeach; ?>
                                                </select>
                                                <small class="form-text text-danger">Kolom Ketua Penguji harus
                                                    diisi.</small </div>
                                                <div class="form-group">
                                                    <label for="sekretarisPenguji">Sekretaris Penguji</label>
                                                    <select class="form-control" id="sekretarisPenguji"
                                                        name="sekretarisPenguji">
                                                        <option value="">-</option>
                                                        <?php foreach ($dosen as $ds): ?>
                                                        <?php if ($ds['nama'] == $pendadaran['sekretarisPenguji']): ?>
                                                        <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?>
                                                        </option>
                                                        <?php else: ?>
                                                        <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                        <?php endif; ?>
                                                        <?php endforeach; ?>
                                                    </select>
                                                    <small class="form-text text-danger">Kolom Sekretaris Penguji harus
                                                        diisi.</small </div>
                                                    <div class="form-group">
                                                        <label for="sekretarisPenguji">Anggota Penguji</label>
                                                        <select class="form-control" id="anggotaPenguji"
                                                            name="anggotaPenguji">
                                                            <option value="-">-</option>
                                                            <?php foreach ($dosen as $ds): ?>
                                                            <?php if ($ds['nama'] == $pendadaran['anggotaPenguji']): ?>
                                                            <option value="<?= $ds['nama']; ?>" selected>
                                                                <?= $ds['nama']; ?></option>
                                                            <?php else: ?>
                                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?>
                                                            </option>
                                                            <?php endif; ?>
                                                            <?php endforeach; ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group">
                                                        <label for="tanggal">Tanggal</label>
                                                        <input type="date" name="tanggal" class="form-control"
                                                            id="tanggal" value="<?= $pendadaran['tanggal']; ?>">
                                                        <small class="form-text text-danger">Kolom Tanggal harus
                                                            diisi.</small </div>
                                                        <div class="form-group">
                                                            <label for="durasi">Jam</label>
                                                            <select class="form-control" id="durasi" name="durasi">
                                                                <?php foreach ($jam as $j): ?>
                                                                <?php if ($j == $pendadaran['durasi']): ?>
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
                                                                <?php if ($r['nama'] == $pendadaran['ruang']): ?>
                                                                <option value="<?= $r['nama']; ?>" selected>
                                                                    <?= $r['nama']; ?></option>
                                                                <?php else: ?>
                                                                <option value="<?= $r['nama']; ?>"><?= $r['nama']; ?>
                                                                </option>
                                                                <?php endif; ?>
                                                                <?php endforeach; ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="keterangan">Keterangan</label>
                                                            <textarea class="form-control" name="keterangan"
                                                                id="keterangan"
                                                                rows="3"><?= $pendadaran['keterangan']; ?></textarea>
                                                        </div>

                                                        <a href="<?= base_url() ?>pendadaran" class="btn btn-danger "
                                                            role="button"><i class="fas fa-arrow-left"></i> Kembali</a>
                                                        <button type="submit" name="tambah"
                                                            class="btn btn-success float-right"><i
                                                                class="fas fa-edit"></i> Edit Data</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>