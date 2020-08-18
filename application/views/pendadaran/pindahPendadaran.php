<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="container">
                <?php if ($this->session->flashdata('flash')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-success alert-dismissible fade show" role="alert">
                            Data <strong>berhasil</strong> <?= $this->session->flashdata('flash'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>
                <h3 class="mt-3">History Pindah Jadwal Pendadaran</h3>

                <div class="row mt-3">
                    <div class="col-md-6">
                        <form action="<?= base_url('pendadaran/pindahPendadaran'); ?>" method="post">
                            <div class="input-group mb-3">
                                <input type="text" class="form-control" placeholder="Cari mahasiswa.." name="keyword"
                                    autocomplete="off" autofocus="">
                                <div class="input-group-append">
                                    <input class="btn btn-primary" type="submit" name="submit">
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="row">
                    <div class="col-md-12">
                        <h7>Jumlah Data : <?= $total_rows; ?></h7>

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
                                    <th scope="col">Opsi</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php if (empty($pendadaran)) : ?>
                                <tr>
                                    <td colspan="8">
                                        <div class="alert alert-danger" role="alert">
                                            Data tidak ditemukan!
                                        </div>
                                    </td>
                                </tr>
                                <?php endif; ?>

                                <?php foreach ($pendadaran as $pen) : ?>
                                <tr style="text-align:center">
                                    <th style="vertical-align: middle"><?= ++$start; ?></th>
                                    <td style="vertical-align: middle"><?= $pen['nim']; ?></td>
                                    <td style="text-align:left; width: 250px; vertical-align: middle">
                                        <?= $pen['nama']; ?></td>
                                    <td style="vertical-align: middle"><?= format_indo($pen['tanggal']); ?></td>
                                    <td style="vertical-align: middle"><?= $pen['durasi']; ?></td>
                                    <td style="vertical-align: middle"><?= $pen['ruang']; ?></td>
                                    <td style="vertical-align: middle"><?= $pen['nilai']; ?></td>
                                    <td style="vertical-align: middle">
                                        <a href="<?= base_url(); ?>pendadaran/detailPindah/<?= $pen['id']; ?>"
                                            class="badge badge-primary" style="width: 50px">Detail</a>
                                        <a href="<?= base_url(); ?>pendadaran/restorePindah/<?= $pen['id']; ?>"
                                            class="badge badge-success" style="width: 50px"
                                            onclick="return confirm('Apakah anda yakin mengembalikan data ini?');">Restore</a>
                                        <a href="<?= base_url(); ?>pendadaran/hapusHistoryPindah/<?= $pen['id']; ?>"
                                            class="badge badge-danger" style="width: 50px"
                                            onclick="return confirm('Apakah anda yakin menghapus data ini?');">Hapus</a>
                                    </td>
                                </tr>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                        <a href="<?= base_url() ?>pendadaran" class="btn btn-danger"><i class="fas fa-arrow-left "></i>
                            Kembali</a>
                        <br>
                        <?= $this->pagination->create_links(); ?>

                    </div>
                </div>

            </div>
        </div>
    </main>