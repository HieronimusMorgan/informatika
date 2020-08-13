<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h1 class="mt-2"><?= $title ?></h1>
            </nav>
            <div>
                <a href="" class="btn btn-primary mb-2" data-toggle="modal" data-target="#ModalInput">Tambah Ujian</a>
                 <?= $this->session->flashdata('message'); ?>
                <div >
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>            
                                <th>JENIS UJIAN</th>
                                <th>SEMESTER</th>
                                <th>TAHUN</th>
                                <th>AKSI</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($jadwal as $row) : ?>                         


                                <tr>
                                    <td><?= $i ?></td>

                                    <td><?php echo $row['jenisUjian']; ?></td>
                                    <td><?php echo $row['semester']; ?></td>
                                    <td><?php echo $row['tahun']; ?></td>

                                    <td>
                                        <a href="<?php echo base_url(); ?>rekomendasi/detailJadwal/<?= $row['idJadwal'];  ?>"
                                            class="badge badge-success" style="color: white">Detail</a>
                                        <a href="#" class="badge badge-warning" data-toggle="modal" data-target="#ModalEdit<?php echo $row['idJadwal'];  ?>">Edit</a>
                                         <a href="<?php echo base_url(); ?>rekomendasi/deleteJadwal/<?= $row['idJadwal']; ?>"
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

             <!-- Modal HTML Markup -->
             <div id="ModalInput" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">INPUT DATA UJIAN</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form role="form" method="POST" action="<?= base_url('rekomendasi/jadwal'); ?>">
                            <input type="hidden" name="jenisujian" value="">
                            <div class="form-group">
                                <label class="control-label">JENIS UJIAN</label>
                                <div>
                                    <select class="form-control input-lg" name="jenis" value="" placeholder="UAS / UTS">
                                        <option>UTS</option>
                                        <option>UAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">SEMESTER</label>
                                <div>
                                    <select  class="form-control input-lg" name="semester">
                                        <option>GASAL</option>
                                        <option>GENAP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">TAHUN</label>
                                <input type="text" name="tahun" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->


    <!-- Modal Edit HTML Markup -->
    <?php 
        foreach ($jadwal as $key) :
            $idJadwal = $key['idJadwal'];
            $jenisUjian = $key['jenisUjian'];
            $semester = $key['semester'];
            $tahun = $key['tahun'];
        
     ?>

             <div id="ModalEdit<?php echo $idJadwal;  ?>" class="modal fade">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <div class="modal-header">
                            <h5 class="modal-title">INPUT DATA UJIAN</h1>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                              <span aria-hidden="true">&times;</span>
                          </button>
                      </div>
                      <div class="modal-body">
                        <form role="form" method="POST" action="<?= base_url('rekomendasi/editjadwal'); ?>">
                            <input type="hidden" name="idJadwal" value="<?php echo $idJadwal; ?>">
                            <div class="form-group">
                                <label class="control-label">JENIS UJIAN</label>
                                <div>
                                    <select class="form-control input-lg" name="jenis" value="<?php echo $jenisUjian; ?>" placeholder="UAS / UTS">
                                        <option>UTS</option>
                                        <option>UAS</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">SEMESTER</label>
                                <div>
                                    <select  class="form-control input-lg" name="semester" value="<?php echo $semester; ?>">
                                        <option>GASAL</option>
                                        <option>GENAP</option>
                                    </select>
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="control-label">TAHUN</label>
                                <input type="text" name="tahun" value="<?php echo $tahun ?>" class="form-control input-lg">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Batal</button>
                            <button type="submit" class="btn btn-primary">Simpan</button>
                        </div>
                    </form>

                </div>
            </div><!-- /.modal-content -->
        </div><!-- /.modal-dialog -->
    </div><!-- /.modal -->

    <?php 
    endforeach; ?>

</main>

<script type="text/javascript">
    $(document).ready(function(){
        $('#tabelku').dataTable({
            
            "paging":         true,
            "language": {
                "emptyTable": "Data Kosong"
            }
        });
    });
</script>