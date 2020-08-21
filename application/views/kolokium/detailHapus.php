<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="container">
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="card">
                            <div class="card-header">
                                Detail Data Kolokium
                            </div>
                            <div class="card-body">
                                <table>
                                    <tr>
                                        <td width="130">
                                            <img src="http://exelsa.usd.ac.id/lihatGambar.php?act=nim&nim=<?= $kolokium['nim']; ?>"
                                                width="100">
                                        </td>
                                        <td>
                                            <h5 class="card-title"><?= $kolokium['nama']; ?></h5>
                                            <p class="card-text"><?= $kolokium['nim']; ?></p>
                                        </td>
                                    </tr>
                                </table>
                                <br>
                                <table class="table table-bordered">
                                    <tbody>
                                        <tr>
                                            <td width="200">
                                                <p class="card-text">Dosen Pembimbing 1:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['dosen1']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Dosen Pembimbing 2:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['dosen2']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Judul:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['judul']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Reviewer Kolokium:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['reviewer']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Tanggal:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= format_indo($kolokium['tanggal']); ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Jam:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['durasi']; ?> WIB</p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Ruangan:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['ruang']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Keterangan:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?= $kolokium['keterangan']; ?></p>
                                            </td>
                                        </tr>
                                        <tr>
                                            <td>
                                                <p class="card-text">Nilai:</p>
                                            </td>
                                            <td>
                                                <p class="card-text"><?=$kolokium['nilai'];?></p>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                                <br>
                                <a href="<?= base_url() ?>kolokium/hapusKolokium" class="btn btn-danger"><i
                                        class="fas fa-arrow-left "></i> Kembali</a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>