<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title ?></h1>
            <div class="row">
                <div class="col">
                    <div class="col">
                        <form action="<?= base_url('presensi/editPresensi1'); ?>" method="post">
                            <div class="modal-body">
                                <div class="form-group">
                                    <label for="kode">Kode Makul</label>
                                    <input type="text" class="form-control" id="kode" name="kode"
                                        value="<?= $data['kodeMakul'] ?>">
                                    <?= form_error('kode', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="title">TIPE MAKUL</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value=""></option>
                                        <?php $menu = ['Wajib', 'RD', 'SC', 'JK', 'Perminatan'] ?>
                                        <?php foreach ($menu as $m) : ?>
                                        <?php if ($m == $data['tipeMakul']) : ?>
                                        <option value="<?= $m ?>" selected> <?= $m ?> </option>
                                        <?php else : ?>
                                        <option value="<?= $m ?>"> <?= $m ?> </option>
                                        <?php endif ?>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="nama">Nama Makul</label>
                                    <input type="text" class="form-control" id="nama" name="nama"
                                        value="<?= $data['nama'] ?>">
                                    <?= form_error('nama', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="tahun">Tahun</label>
                                    <input type="text" class="form-control" id="tahun" name="tahun"
                                        value="<?= $data['tahun'] ?>">
                                    <?= form_error('tahun', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="semester">Semester</label>
                                    <input type="text" class="form-control" id="semester" name="semester"
                                        value="<?= $data['semester'] ?>">
                                    <?= form_error('semester', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="ruangan">Ruangan</label>
                                    <input type="text" class="form-control" id="ruangan" name="ruangan"
                                        value="<?= $data['ruangan'] ?>" readonly>
                                    <?= form_error('ruangan', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <label for="kapasitas">Kapasitas</label>
                                    <input type="text" class="form-control" id="kapasitas" name="kapasitas"
                                        value="<?= $data['kapasitas'] ?>">
                                    <?= form_error('kapasitas', '<small class="text-danger pl-2">', '</small>') ?>
                                </div>
                                <div class="form-group">
                                    <a href="<?= base_url('presensi/isi/'.$data['idMakul']); ?>"
                                        class="btn btn-secondary">Kembali</a>
                                    <button type="submit" class="btn btn-primary">Edit</button>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>

                <div class="col">
                    <div class="table-responsive mt-1">
                        <div class="h5">Data Mahasiswa</div>
                        <table class="table table-bordered" id="tabelku" width="100%">
                            <thead>
                                <tr class="text-center">
                                    <th>NO</th>
                                    <th>NIM</th>
                                    <th>NAMA</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php $i = 1; ?>
                                <?php foreach ($mahasiswa->result_array() as $row) : ?>
                                <tr>
                                    <td class="text-center"><?= $i ?></td>
                                    <td><?php echo $row['nim']; ?></td>
                                    <td><?php echo $row['nama']; ?></td>
                                </tr>
                                <?php $i++; ?>
                                <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>

                </div>
            </div>
        </div>
    </main>


    <script type="text/javascript">
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "450px",
            "scrollCollapse": true,
            "paging": false,
            "bAutoWidth": false
        });
    });
    </script>