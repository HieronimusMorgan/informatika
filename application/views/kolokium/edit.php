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
                <?php elseif ($this->session->flashdata('dosen1Sama')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('dosen1Sama'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('dosenReviewerSama')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('dosenReviewerSama'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('dosen2Sama')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('dosen2Sama'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php elseif ($this->session->flashdata('semuaSama')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('semuaSama'); ?>.
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
                                Edit Jadwal Kolokium
                            </div>
                            <div class="card-body">
                                <form action="" method="post">
                                    <input type="hidden" name="id" value="<?= $kolokium['id']; ?>">
                                    <div class="form-group">
                                        <label for="nim">NIM Mahasiswa</label>
                                        <input type="text" name="nim" class="form-control" id="nim"
                                            value="<?= $kolokium['nim']; ?>" readonly>
                                        <small class="form-text text-danger"><?= form_error('nim'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="nama">Nama Mahasiswa</label>
                                        <input type="text" name="nama" class="form-control" id="nama"
                                            value="<?= $kolokium['nama']; ?>" readonly>
                                        <small class="form-text text-danger"><?= form_error('nama'); ?></small>
                                    </div>
                                    <div class="form-group">
                                        <label for="dosen1">Dosen Pembimbing 1</label>
                                        <select class="form-control" id="dosen1" name="dosen1">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] == $kolokium['dosen1']): ?>
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
                                            <?php if ($ds['nama'] == $kolokium['dosen2']): ?>
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
                                            rows="3"><?= $kolokium['judul']; ?></textarea>
                                        <small class="form-text text-danger">Kolom Judul Tugas Akhir harus
                                            diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="reviewer">Reviewer Kolokium</label>
                                        <select class="form-control" id="reviewer" name="reviewer">
                                            <option value="">-</option>
                                            <?php foreach ($dosen as $ds): ?>
                                            <?php if ($ds['nama'] == $kolokium['reviewer']): ?>
                                            <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama']; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                        <small class="form-text text-danger">Kolom Reviewer Kolokium harus
                                            diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="tanggal">Tanggal</label>
                                        <input type="date" name="tanggal" class="form-control" id="tanggal"
                                            value="<?= $kolokium['tanggal']; ?>">
                                        <small class="form-text text-danger">Kolom Tanggal harus diisi.</small>
                                    </div>
                                    <div class="form-group">
                                        <label for="durasi">Jam</label>
                                        <select class="form-control" id="durasi" name="durasi">
                                            <?php foreach ($jam as $j): ?>
                                            <?php if ($j == $kolokium['durasi']): ?>
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
                                            <?php if ($r['nama'] == $kolokium['ruang']): ?>
                                            <option value="<?= $r['nama']; ?>" selected><?= $r['nama']; ?></option>
                                            <?php else: ?>
                                            <option value="<?= $r['nama']; ?>"><?= $r['nama']; ?></option>
                                            <?php endif; ?>
                                            <?php endforeach; ?>
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="Keterangan">Keterangan</label>
                                        <textarea class="form-control" name="keterangan" id="keterangan"
                                            rows="3"><?= $kolokium['keterangan']; ?></textarea>
                                    </div>

                                    <a href="<?= base_url() ?>kolokium" class="btn btn-danger " role="button"><i
                                            class="fas fa-arrow-left"></i> Kembali</a>
                                    <button type="submit" name="tambah" class="btn btn-success float-right"><i
                                            class="fas fa-edit"></i> Edit Data</button>

                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

        </div>
    </main>