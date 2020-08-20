<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h5 class="mt-2"><?= $title ?></h5>
            </nav>
            <div class="card-body">
                <a href="#" class="btn btn-primary mb-2" data-toggle="modal" data-target="#ModalInput">Tambah Ujian</a>
                <a href="<?= base_url() ?>rekomendasi/exportExcell2/<?= $id; ?>" class="btn btn-success float-right mb-2"><i class="fas fa-file-excel" aria-hidden="true"></i> Cetak Excell</a>
                
               <!--  <div class="btn-group float-right mb-2" style="margin-right: 5%;">
                    <button type="button" class="btn btn-success  dropdown-toggle " data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">Cetak</button>
                <div class="dropdown-menu">
                  
                    <a class="dropdown-item" href="<?= base_url() ?>rekomendasi/exportPdf/<?= $id; ?>" target="_blank"><i class="fas fa-file-pdf" style="color:red;" aria-hidden="true"></i> PDF</a>
                   
                </div> -->
            </div>
           
            <div class="table-responsive">
                <?= $this->session->flashdata('message'); ?>
                <table class="table table-bordered" id="tabelku" width="100%">
                    <thead>
                        <tr>
                            <th>NO</th>
                            <th>HARI/TGL</th>
                            <th>JAM</th>
                            <th>MATAKULIAH</th>
                            <th>KELAS</th>
                            <th>SEMESTER</th>
                            <th>DOSEN</th>
                            <th>RUANG</th>


                            <th>AKSI</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php $i = 1; ?>
                        <?php foreach ($jadwal as $row) : ?>
                            <tr>
                                <td><?= $i ?></td>
                                <td><?php 
                                $date = date('d-m-Y',strtotime($row['tanggal']));
                                $hari = date('D', strtotime($row['tanggal']));
                                $hari_ini = hari_ini($hari);
                                echo $hari_ini.", ".$date ?></td>
                                <td><?php
                                $jamMulai = date("G:i",strtotime( $row['jamMulai'])); 
                                $jamSelesai = date("G:i", strtotime($row['jamSelesai']));
                                echo $jamMulai." WIB -".$jamSelesai?> WIB</td>
                                <td><?php echo $row['nama']; ?></td>
                                <td> <?php echo $row['kelas']; ?></td>
                                <td><?php echo $row['idSemester'] ?></td>
                                <td><?php echo $row['dosen_nama']; ?></td>
                                <td><?php echo $row['ruangan']; ?></td>


                                <td>
                                   <a href="" id="editModal<?php echo $row['id'];  ?>"  class="badge badge-success " data-toggle="modal" data-target="#ModalEdit<?php echo $row['id'];  ?>">Edit</a>
                                   <a href="<?php echo base_url(); ?>rekomendasi/deletedetailjadwal/<?= $row['id']; ?>/<?= $row['idJadwal'] ?>"
                                    class="badge badge-danger"
                                    onclick="return confirm('Are you sure you want to delete ?');">Delete</a>
                                </td>
                            </tr>
                            <?php $i++; ?>
                        <?php endforeach; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

    <!-- Modal HTML Markup INPUT DATA -->
    <div id="ModalInput" class="modal fade">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">INPUT DATA UJIAN</h5>
                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                <div class="modal-body">
                    <form method="POST" action="<?= base_url() ?>rekomendasi/inputjadwal">
                        <input type="hidden" name="idjadwal" id="idjadwal" value="<?= $id  ?>">
                        <div class="form-group row">
                            <label class="control-label col-sm-4">Tahun Ajaran</label>
                            <label class="control-label col-sm-1">:</label>
                            <div class="col-sm-7">
                                <select name="tahun" id="tahun" class="form-control">
                                     <option><?= $tahunAjaran; ?></option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-4">Semester</label>
                            <label class="control-label col-sm-1">:</label>
                            <div class="col-md-7">
                                <select name="semester" id="semester" class="form-control">
                                    <option><?= $semesterGas_Gen; ?></option>

                                </select>
                            </div>
                        </div>


                        <div class="form-group row">
                            <label class="col-sm-4 col-form-label">Matakuliah / Kelas </label>
                            <label class="control-label col-sm-1">:</label>
                            <div class="col-sm-7">
                                <select name="matkul" id="matkul" class="matkul form-control">
                                    <option value="0">-Matakuliah / Kelas-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-4">Ruang</label>
                            <label class="control-label col-sm-1">:</label>
                            <div class="col-md-7">
                                <select name="ruang" id="ruang" class="kelas form-control">
                                    <option value="0">-Ruang-</option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label class="control-label col-sm-4">Tanggal Ujian</label>
                            <label class="control-label col-sm-1">:</label>
                            <div class="col-sm-7">
                                <input type="text" id="datepicker" name="datepicker" class="form-control" required>
                            </div>
                        </div>

                        <div class="row">
                            <div class="form-group">
                                <label class="control-label col-md-6">Jam Mulai</label>
                                <div class="col-md-12">
                                    <input type="text" name="jam" id="jam" class="form-control" required>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label col-md-8">Jam Selesai</label>
                                <div class="col-md-12">
                                    <input type="text" name="jam2" id="jam2" class="form-control" required>
                                </div>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div><!-- /.modal -->


    <!-- Modal HTML Markup Edit DATA -->
    <?php 
    $i = 1;
    foreach ($jadwal as $row) :?>
        <div id="ModalEdit<?php echo $row['id']; ?>" class="modal fade">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">INPUT DATA UJIAN</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <form method="POST" action="<?= base_url() ?>rekomendasi/editJadwaldetail">
                            <input type="hidden" name="idjadwal" id="idjadwal" value="<?= $id  ?>">
                            <input type="hidden" name="id" id="id" value="<?= $row['id']  ?>">
                            <input type="hidden" name="idMatakul" id="idMatakul" value="<?= $row['idMakul']  ?>">
                            <input type="hidden" name="namaMatakul" id="namaMatakul" value="<?= $row['nama']  ?>">
                            <input type="hidden" name="kelasMatakul" id="kelasMatakul" value="<?= $row['kelas']  ?>">

                            <div class="form-group row">
                                <label class="control-label col-sm-4">Tahun Ajaran</label>
                                <label class="control-label col-sm-1">:</label>
                                <div class="col-sm-7">
                                    <select name="tahunEdit<?php echo $row['id']; ?>" id="tahunEdit<?php echo $row['id']; ?>" class="form-control">
                                        <option><?php echo $row['tahun'] ?></option>
                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4">Semester</label>
                                <label class="control-label col-sm-1">:</label>
                                <div class="col-md-7">
                                    <select name="semesterEdit<?php echo $row['id']; ?>" id="semesterEdit<?php echo $row['id']; ?>" class="form-control">
                                        <option><?= $semesterGas_Gen; ?></option>

                                    </select>
                                </div>
                            </div>


                            <div class="form-group row">
                                <label class="col-sm-4 col-form-label">Matakuliah / Kelas </label>
                                <label class="control-label col-sm-1">:</label>
                                <div class="col-sm-7">
                                    <select name="matkulEdit<?php echo $row['id'];  ?>" id="matkulEdit<?php echo $row['id'];  ?>" class="matkulEdit form-control">
                                        <option value=""></option>
                                    </select>

                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4">Ruang</label>
                                <label class="control-label col-sm-1">:</label>
                                <div class="col-md-7">
                                    <select name="ruangEdit<?php echo $row['id'];  ?>" id="ruangEdit<?php echo $row['id'];  ?>" class="kelas form-control">

                                    </select>
                                </div>
                            </div>

                            <div class="form-group row">
                                <label class="control-label col-sm-4">Tanggal Ujian</label>
                                <label class="control-label col-sm-1">:</label>
                                <div class="col-sm-7">
                                    <input type="text" id="datepickerEdit<?php echo $row['id'];  ?>" name="datepickerEdit<?php echo $row['id'];  ?>" class="form-control" value="<?php   $date = date('d-m-Y',strtotime($row['tanggal']));
                                    echo($date); ?>" required>
                                </div>
                            </div>

                            <div class="row">
                                <div class="form-group">
                                    <label class="control-label col-md-6">Jam Mulai</label>
                                    <div class="col-md-12">
                                        <input type="text" name="jamEdit<?php echo $row['id'];  ?>" id="jamEdit<?php echo $row['id'];  ?>" class="form-control" value="<?php echo $row['jamMulai']; ?>" required>
                                    </div>
                                </div>
                                <div class="form-group">
                                    <label class="control-label col-md-8">Jam Selesai</label>
                                    <div class="col-md-12">
                                        <input type="text" name="jam2Edit<?php echo $row['id'];  ?>" id="jam2Edit<?php echo $row['id'];  ?>" class="form-control" value="<?php echo $row['jamMulai']; ?>" required>
                                    </div>
                                </div>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                                <button type="submit" class="btn btn-primary">Simpan</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        <?php endforeach; ?><!-- /.modal -->
    </div>
</main>

<!-- Angkatan -->
<script type="text/javascript">

    $(document).ready(function() {

        $.ajax({
            url: "<?php echo base_url(); ?>rekomendasi/tahun",
            method: "POST",
            async: false,
            dataType: 'json',
            success: function(data) {

                var html = '<option>'+<?php echo $tahunAjaran ?>+'</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                     if (<?php echo $tahunAjaran; ?> != data[i].tahun) {
                            html += '<option >' + data[i].tahun + '</option>';
                    }
                }
                $('#tahun').html(html);
            }
        });
        var semester = $('#semester').val();
        var idJadwal = $('#idjadwal').val();
        var id = $('#tahun').val();
        matakuliah(id, semester, idJadwal);
    });
</script>

<!-- matakuliah -->
<script>
    $('#tahun').change(function(){
        var semester = $('#semester').val();
        var idJadwal = $('#idjadwal').val();
        var id = $('#tahun').val();
        matakuliah(id, semester, idJadwal);
    });

    function matakuliah(id, semester, idJadwal) {

        $.ajax({
            url: "<?php echo base_url(); ?>rekomendasi/matakuliah",
            method: "POST",
            data: {
                id: id,
                semester: semester,
                idJadwal: idJadwal
            },
            async: false,
            dataType: 'json',
            success: function(data) {
                var html = '<option>-Matakuliah / Kelas-</option>';
                var i;
                for (i = 0; i < data.length; i++) {

                    html += '<option value="' + data[i].idMakul + '">' + data[i].nama + ' / ' + data[i]
                    .kelas + '</option>';
                }
                $('#matkul').html(html);
            }
        });
    }
</script>

<!-- ruang -->
<script type="text/javascript">
    $('#matkul').change(function() {
        var id = $(this).val();


        $.ajax({
            url: "<?php echo base_url(); ?>rekomendasi/ruang",
            method: "POST",
            data: {
                id: id
            },

            dataType: 'json',
            success: function(data) {

                var html = '<option>-Ruang-</option>';
                var i;
                for (i = 0; i < data.length; i++) {
                    html += '<option value=' + data[i].idRuangan + '>' + data[i].ruangan +
                    '</option>';
                }
                $('.kelas').html(html);
            }
        });
    });
</script>

<script>
    $('#datepicker').datetimepicker({

        format: 'DD-MM-YYYY'
    });

    $('#jam').datetimepicker({

        format: 'HH:mm'


    });
    $('#jam2').datetimepicker({

        format: 'HH:mm'

    });
</script>
<script type="text/javascript">
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true,
            "language": {
                "emptyTable": "Data Kosong"
            }
        });
    });
</script>


<!-- edit JavaScriptt -->
<!-- Angkatan -->

<?php foreach ($jadwal as $row): ?>
  <!-- matakuliah -->
  <script type="text/javascript">

   document.getElementById('editModal'+<?php echo $row['id']; ?>).onclick = function() {

    var semester = $('#semesterEdit<?php echo $row['id']; ?>').val();
    var idJadwal = $('#idjadwalEdit'+<?php echo $row['id']; ?>).val();
    var id = $('#tahunEdit'+<?php echo $row['id']; ?>).val();

    $.ajax({
        url: "<?php echo base_url(); ?>rekomendasi/matakuliah",
        method: "POST",
        data: {
            id: id,
            semester: semester,
            idJadwal: idJadwal
        },
        async: false,
        dataType: 'json',
        success: function(data) {

            var html = '<option value="<?php echo $row['idMakul']; ?>"><?php echo $row['nama']; ?> / <?php echo $row['kelas']; ?></option>';

            var i;
            for (i = 0; i < data.length; i++) {

                html += '<option value="' + data[i].idMakul + '">' + data[i].nama + ' / ' + data[i]
                .kelas + '</option>';
            }
            $('#matkulEdit<?php echo $row['id']; ?>').html(html);
        }
    });


    $.ajax({
        url: "<?php echo base_url(); ?>rekomendasi/ruang",
        method: "POST",

        dataType: 'json',
        success: function(data) {

            var html = '<option value="<?php echo $row['idRuangan']; ?>"><?php echo $row['ruangan']; ?></option>';
            var i;
            for (i = 0; i < data.length; i++) {
                html += '<option value=' + data[i].idRuangan + '>' + data[i].ruangan +
                '</option>';
            }
            $('#ruangEdit<?php echo $row['id']; ?>').html(html);
        }
    });
};
</script>

<script>
    $('#datepickerEdit'+<?php echo $row['id'];  ?>).datetimepicker({

        format: 'DD-MM-YYYY'
    });

    $('#jamEdit'+<?php echo $row['id'];  ?>).datetimepicker({

        format: 'HH:mm'


    });
    $('#jam2Edit'+<?php echo $row['id'];  ?>).datetimepicker({

        format: 'HH:mm'

    });
</script>
<?php endforeach ?>


<!-- fungsi hari indo -->
<?php  
function hari_ini($d){
    $hari = $d;

    switch($hari){
      case 'Sun':
      $hari_ini = "Minggu";
      break;

      case 'Mon':     
      $hari_ini = "Senin";
      break;

      case 'Tue':
      $hari_ini = "Selasa";
      break;

      case 'Wed':
      $hari_ini = "Rabu";
      break;

      case 'Thu':
      $hari_ini = "Kamis";
      break;

      case 'Fri':
      $hari_ini = "Jumat";
      break;

      case 'Sat':
      $hari_ini = "Sabtu";
      break;

      default:
      $hari_ini = "Tidak di ketahui";   
      break;
  }

  return $hari_ini;

}
?>