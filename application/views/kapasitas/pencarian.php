<div class=" col-lg-4">
    <div class="card mb-4 ">
        <div class="card-header d-flex justify-content-center font-weight-bold">
            FILTER
        </div>
        <div class="card-body">
            <div style="text-align:center;"><?= $this->session->flashdata('message'); ?> </div>
            <form action="<?= base_url('kapasitas/cari'); ?>" method="post">
                <div class="form-group">
                    <label for="title">ANGKATAN</label>
                    <select name="angkatan" id="angkatan" class="form-control">
                        <option value=""></option>
                        <?php $menu = $this->kapasitas_model->tahun() ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('angkatan') == $m['tahun']): ?>
                                <option value="<?= $m['tahun'] ?>" selected><?= '20' . $m['tahun']; ?> </option>
                            <?php else : ?>
                                <option value="<?= $m['tahun'] ?>"><?= '20' . $m['tahun']; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">MATA KULIAH</label>
                    <select name="makul" id="makul" class="form-control">
                        <option value=""></option>
                        <?php $sql = "SELECT DISTINCT nama FROM makul ORDER BY nama ASC"; ?>
                        <?php $menu = $this->db->query($sql)->result_array(); ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('makul') == $m['nama']): ?>
                                <option value="<?= $m['nama'] ?>" selected><?= $m['nama'] ?></option>
                            <?php else : ?>
                                <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">TAHUN AJARAN</label>
                    <select name="tahun" id="tahun" class="form-control">
                        <option value=""></option>
                        <?php $sql = "SELECT DISTINCT tahun FROM makul ORDER BY tahun ASC"; ?>
                        <?php $menu = $this->db->query($sql)->result_array(); ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('tahun') == $m['tahun']): ?>
                                <option value="<?= $m['tahun'] ?>" selected><?= $m['tahun']; ?> </option>
                            <?php else : ?>
                                <option value="<?= $m['tahun'] ?>"><?= $m['tahun']; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">TIPE MAKUL</label>
                    <select name="tipe" id="tipe" class="form-control">
                        <option value=""></option>
                        <?php $menu = ['Wajib', 'RD', 'SC', 'JK', 'Perminatan'] ?>
                        <?php foreach ($menu as $m) : ?>
                            <option value="<?= $m ?>"> <?= $m ?> </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">SEMESTER</label>
                    <select name="semester" id="semester" class="form-control">
                        <option value=""></option>
                        <?php $menu = ['GASAL', "GENAP"] ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('semester') == $m): ?>
                                <option value="<?= $m ?>" selected><?= $m; ?> </option>
                            <?php else : ?>
                                <option value="<?= $m ?>"><?= $m; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <label for="title">DOSEN</label>
                    <select name="dosen" id="dosen" class="form-control">
                        <option value=""></option>
                        <?php $sql = "SELECT DISTINCT nama FROM dosen ORDER BY nama ASC"; ?>
                        <?php $menu = $this->db->query($sql)->result_array(); ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('dosen') == $m['nama']): ?>
                                <option value="<?= $m['nama'] ?>" selected><?= $m['nama']; ?> </option>
                            <?php else : ?>
                                <option value="<?= $m['nama'] ?>"><?= $m['nama']; ?> </option>
                            <?php endif; ?>
                            </option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary btn-lg btn-block">CARI</button>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</main>