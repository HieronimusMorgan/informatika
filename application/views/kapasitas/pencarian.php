<div class=" col-lg-4">
    <div class="card mb-4 ">
        <div class="card-header d-flex justify-content-center font-weight-bold">
            PENCARIAN
        </div>
        <div class="card-body">
            <div style="text-align:center;"><?= $this->session->flashdata('message'); ?> </div>
            <form action="<?= base_url('kapasitas/cari'); ?>" method="post" id="form">
                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="title">ANGKATAN</label>
                            <select name="angkatan" id="angkatan" class="form-control">
                                <option value="">-</option>
                                <?php $menu = $this->kapasitas_model->angkatan(); ?>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($this->input->post('angkatan') == $m['tahun']): ?>
                                        <option value="<?= $m['tahun'] ?>" selected><?= '20' . $m['tahun']; ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $m['tahun'] ?>"><?= '20' . $m['tahun']; ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-auto">
                        <div class="form-group">
                            <label for="title">SEMESTER</label>
                            <select name="idSemester" id="idSemester" class="form-control">
                                <option value="">-</option>
                                <?php $menu = $this->kapasitas_model->idSemester(); ?>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($this->input->post('idSemester') == $m['idSemester']): ?>
                                        <option value="<?= $m['idSemester'] ?>" selected><?= $m['idSemester']; ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $m['idSemester'] ?>"><?= $m['idSemester']; ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>

                <div class="form-group">
                    <label for="title">MATA KULIAH</label>
                    <select name="makul" id="makul" class="form-control">
                        <option value="">-</option>
                        <?php $menu = $this->kapasitas_model->makul(); ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('makul') == $m['nama']): ?>
                                <option value="<?= $m['nama'] ?>" selected><?= $m['nama'] ?></option>
                            <?php else : ?>
                                <option value="<?= $m['nama'] ?>"><?= $m['nama'] ?></option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="row">
                    <div class="col">
                        <div class="form-group">
                            <label for="title">TAHUN AJARAN</label>
                            <select name="tahun" id="tahun" class="form-control">
                                <option value="">-</option>
                                <?php $menu = $this->kapasitas_model->tahunAjar() ?>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($this->input->post('tahun') == $m['tahun']): ?>
                                        <option value="<?= $m['tahun'] ?>" selected><?= $m['tahun']; ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $m['tahun'] ?>"><?= $m['tahun']; ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                    <div class="col-5">
                        <div class="form-group">
                            <label for="title">SEMESTER</label>
                            <select name="semester" id="semester" class="form-control">
                                <option value="">-</option>
                                <?php $menu = $this->kapasitas_model->semester(); ?>
                                <?php foreach ($menu as $m) : ?>
                                    <?php if ($this->input->post('semester') == $m['semester']): ?>
                                        <option value="<?= $m['semester'] ?>" selected><?= $m['semester']; ?> </option>
                                    <?php else : ?>
                                        <option value="<?= $m['semester'] ?>"><?= $m['semester']; ?> </option>
                                    <?php endif; ?>
                                <?php endforeach; ?>
                            </select>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <label for="title">TIPE MAKUL</label>
                    <select name="tipe" id="tipe" class="form-control">
                        <option value="">-</option>
                        <?php $menu = $this->kapasitas_model->tipeMakul(); ?>
                        <?php foreach ($menu as $m) : ?>
                            <?php if ($this->input->post('tipe') == $m['tipeMakul']): ?>
                                <option value="<?= $m['tipeMakul'] ?>" selected><?= $m['tipeMakul']; ?> </option>
                            <?php else : ?>
                                <option value="<?= $m['tipeMakul'] ?>"><?= $m['tipeMakul']; ?> </option>
                            <?php endif; ?>
                        <?php endforeach; ?>
                    </select>
                </div>

                <div class="form-group">
                    <label for="title">DOSEN</label>
                    <select name="dosen" id="dosen" class="form-control">
                        <option value="">-</option>
                        <?php $menu = $this->kapasitas_model->dosen(); ?>
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
                    <div class="row">
                        <div class="col-md">
                            <button type="submit" class="btn btn-primary btn-lg btn-block"><i class="fas fa-search"></i>
                                CARI</button>
                        </div>
                        <div class="col-auto">
                            <button href="" type="button" class="btn btn-secondary btn-lg btn-block"
                                    onclick="clear_form_elements(this.form)"><i class="fas fa-undo"></i> RESET
                            </button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
</div>
</main>

<!-- RESET PENCARIAN -->
<script>
    function clear_form_elements(ele) {

        tags = ele.getElementsByTagName('select');
        for (i = 0; i < tags.length; i++) {
            if (tags[i].type == 'select-one') {
                tags[i].selectedIndex = 0;
            } else {
                for (j = 0; j < tags[i].options.length; j++) {
                    tags[i].options[j].selected = false;
                }
            }
        }

    }
</script>

<!-- ISI OTOMATIS -->
<!-- semester -->
<script>
    $('#makul').change(function () {
        var id = $(this).val();
        idSemester(id);
    });

    function idSemester(id) {
        $.ajax({
            url: "<?php echo base_url(); ?>kapasitas/idSemester",
            method: "POST",
            data: {
                id: id
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].idSemester + '">' + data[i].idSemester + '</option>';
                }
                html += '<option value="">-</option>';
                $('#idSemester').html(html);
            }
        });
        $.ajax({
            url: "<?php echo base_url(); ?>kapasitas/tipe",
            method: "POST",
            data: {
                id: id
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].tipeMakul + '">' + data[i].tipeMakul + '</option>';
                }
                html += '<option value="">-</option>';
                $('#tipe').html(html);
            }
        });
        $.ajax({
            url: "<?php echo base_url(); ?>kapasitas/tahun",
            method: "POST",
            data: {
                id: id
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '<option value="">-</option>';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].tahun + '">' + data[i].tahun + '</option>';
                }
                $('#tahun').html(html);
            }
        });
        $.ajax({
            url: "<?php echo base_url(); ?>kapasitas/semester",
            method: "POST",
            data: {
                id: id
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '<option value="">-</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value="' + data[i].semester + '">' + data[i].semester + '</option>';
                }
                $('#semester').html(html);
            }
        });

    }
</script>

<!-- dosen -->
<script>
    $('#makul').change(function () {
        var nama = $(this).val();
        dosen(nama);
    });

    function dosen(nama) {

        $.ajax({
            url: "<?php echo base_url(); ?>kapasitas/dosen",
            method: "POST",
            data: {
                nama: nama
            },
            async: false,
            dataType: 'json',
            success: function (data) {
                var html = '<option value="">-</option>';

                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].nama + '">' + data[i].nama + '</option>';
                }
                $('#dosen').html(html);
            }
        });
    }
</script>