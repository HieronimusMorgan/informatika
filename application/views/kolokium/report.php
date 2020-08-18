<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="container">
                <?php if ($this->session->flashdata('reportKolokium')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('reportKolokium'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <?php if ($kolokium == null && $this->session->userdata() == NULL): ?>
                <div class="row mt-3">
                    <div class="col">
                        <h3 class="mt-3">Report Jadwal Kolokium</h3>

                        <form action="" method="post">
                            <table cellpadding="20">
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="awal">Periode Awal</label>
                                                        <input type="date" name="awal" class="form-control" id="awal">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="akhir">Periode Akhir</label>
                                                        <input type="date" name="akhir" class="form-control" id="akhir">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <label for="dosen1">Dosen Pembimbing 1</label>
                                            <select class="form-control" id="dosen1" name="dosen1">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dosen2">Dosen Pembimbing 2</label>
                                            <select class="form-control" id="dosen2" name="dosen2">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="reviewer">Reviewer Kolokium</label>
                                            <select class="form-control" id="reviewer" name="reviewer">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam">Jam</label>
                                            <select class="form-control" id="jam" name="jam">
                                                <option value="">-</option>
                                                <?php foreach ($jam as $ds): ?>
                                                <option value="<?= $ds; ?>"><?= $ds; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ruang">Ruangan</label>
                                            <select class="form-control" id="ruang" name="ruang">
                                                <option value="">-</option>
                                                <?php foreach ($ruang as $ds): ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a href="<?= base_url() ?>kolokium" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" name="cari" class="btn btn-warning"><i class="fas fa-search"></i>
                                Cari</button>
                        </form>
                    </div>
                </div>
                <?php elseif ($kolokium == null && $this->session->userdata() != NULL): ?>
                <div class="row mt-3">
                    <div class="col">
                        <h3 class="mt-3">Report Jadwal Kolokium</h3>

                        <form action="" method="post">
                            <table cellpadding="20">
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="awal">Periode Awal</label>
                                                        <input type="date" name="awal" class="form-control" id="awal"
                                                            value="<?= $this->session->userdata('awal'); ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="akhir">Periode Akhir</label>
                                                        <input type="date" name="akhir" class="form-control" id="akhir"
                                                            value="<?= $this->session->userdata('akhir'); ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <label for="dosen1">Dosen Pembimbing 1</label>
                                            <select class="form-control" id="dosen1" name="dosen1">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $this->session->userdata('dosen1')): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dosen2">Dosen Pembimbing 2</label>
                                            <select class="form-control" id="dosen2" name="dosen2">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $this->session->userdata('dosen2')): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="reviewer">Reviewer</label>
                                            <select class="form-control" id="reviewer" name="reviewer">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $this->session->userdata('reviewer')): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam">Jam</label>
                                            <select class="form-control" id="jam" name="jam">
                                                <option value="">-</option>
                                                <?php foreach ($jam as $ds): ?>
                                                <?php if ($ds == $this->session->userdata('jam')): ?>
                                                <option value="<?= $ds; ?>" selected><?= $ds ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds; ?>"><?= $ds; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ruang">Ruangan</label>
                                            <select class="form-control" id="ruang" name="ruang">
                                                <option value="">-</option>
                                                <?php foreach ($ruang as $ds): ?>
                                                <?php if ($ds['nama'] == $this->session->userdata('ruang')): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a href="<?= base_url() ?>kolokium" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" name="cari" class="btn btn-warning"><i class="fas fa-search"></i>
                                Cari</button>
                            <a href="<?= base_url() ?>kolokium/refreshReport" class="btn btn-danger"><i
                                    class="fa fa-refresh"></i> Refresh</a>
                        </form>
                    </div>
                </div>
                <?php else: ?>

                <?php $postData = $this->input->post(); ?>

                <div class="row mt-3">
                    <div class="col">
                        <h3 class="mt-3">Report Jadwal Kolokium</h3>

                        <form action="" method="post">
                            <table cellpadding="20">
                                <tr>
                                    <td>
                                        <table>
                                            <tr>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="awal">Periode Awal</label>
                                                        <input type="date" name="awal" class="form-control" id="awal"
                                                            value="<?= $this->session->userdata('awal'); ?>">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <label for="akhir">Periode Akhir</label>
                                                        <input type="date" name="akhir" class="form-control" id="akhir"
                                                            value="<?= $this->session->userdata('akhir'); ?>">
                                                    </div>
                                                </td>
                                            </tr>
                                        </table>
                                        <div class="form-group">
                                            <label for="dosen1">Dosen Pembimbing 1</label>
                                            <select class="form-control" id="dosen1" name="dosen1">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $postData['dosen1']): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="dosen2">Dosen Pembimbing 2</label>
                                            <select class="form-control" id="dosen2" name="dosen2">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $postData['dosen2']): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                    <td>
                                        <div class="form-group">
                                            <label for="reviewer">Reviewer</label>
                                            <select class="form-control" id="reviewer" name="reviewer">
                                                <option value="">-</option>
                                                <?php foreach ($dosen as $ds): ?>
                                                <?php if ($ds['nama'] == $postData['reviewer']): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama']; ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="jam">Jam</label>
                                            <select class="form-control" id="jam" name="jam">
                                                <option value="">-</option>
                                                <?php foreach ($jam as $ds): ?>
                                                <?php if ($ds == $postData['jam']): ?>
                                                <option value="<?= $ds; ?>" selected><?= $ds ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds; ?>"><?= $ds; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                        <div class="form-group">
                                            <label for="ruang">Ruangan</label>
                                            <select class="form-control" id="ruang" name="ruang">
                                                <option value="">-</option>
                                                <?php foreach ($ruang as $ds): ?>
                                                <?php if ($ds['nama'] == $postData['ruang']): ?>
                                                <option value="<?= $ds['nama']; ?>" selected><?= $ds['nama'] ?></option>
                                                <?php else: ?>
                                                <option value="<?= $ds['nama'] ?>"><?= $ds['nama']; ?></option>
                                                <?php endif; ?>
                                                <?php endforeach; ?>
                                            </select>
                                        </div>
                                    </td>
                                </tr>
                            </table>
                            <a href="<?= base_url() ?>kolokium" class="btn btn-primary"><i
                                    class="fas fa-arrow-left"></i> Kembali</a>
                            <button type="submit" name="cari" class="btn btn-warning"><i class="fas fa-search"></i>
                                Cari</button>
                            <a href="<?= base_url() ?>kolokium/refreshReport" class="btn btn-danger"><i
                                    class="fas fa-refresh"></i> Refresh</a>
                            <div class="btn-group">
                                <button type="button" class="btn btn-success dropdown-toggle" data-toggle="dropdown"
                                    aria-haspopup="true" aria-expanded="false">
                                    <i class="fas fa-file-excel"></i> Export Excel
                                </button>
                                <div class="dropdown-menu">
                                    <a href="<?= base_url(); ?>kolokium/excel" class="dropdown-item"><i
                                            class="fas fa-file-excel"></i> Jadwal Kolokium</a>
                                    <a href="<?= base_url(); ?>kolokium/excelDosen" class="dropdown-item"><i
                                            class="fas fa-file-excel"></i> Rekap Penguji</a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row mt-3">
                    <div class="col-md-16">

                        <h7>Jumlah Data : <?= $jumlahData; ?></h7>

                        <table class="table" border="1">
                            <thead class="thead-dark">
                                <tr style="text-align:center">
                                    <th scope="col">No.</th>
                                    <th scope="col">NIM</th>
                                    <th scope="col">Nama</th>
                                    <th scope="col">Tanggal</th>
                                    <th scope="col">Jam</th>
                                    <th scope="col">Ruangan</th>
                                    <th scope="col">Nilai</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $start = 0; ?>
                                <?php foreach ($kolokium as $kol) : ?>
                                <tr style="text-align:center">
                                    <th style="vertical-align: middle"><?= ++$start; ?></th>
                                    <td style="vertical-align: middle"><?= $kol['nim']; ?></td>
                                    <td style="text-align:left; width: 280px"><?= $kol['nama']; ?></td>
                                    <td style="vertical-align: middle"><?= format_indo($kol['tanggal']); ?></td>
                                    <td style="vertical-align: middle"><?= $kol['durasi']; ?></td>
                                    <td style="vertical-align: middle"><?= $kol['ruang']; ?></td>
                                    <td style="vertical-align: middle"><?= $kol['nilai']; ?></td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <?php endif; ?>
            </div>

        </div>
    </main>