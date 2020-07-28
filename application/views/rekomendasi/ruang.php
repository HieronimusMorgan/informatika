<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h1 class="mt-2"><?= $title ?></h1>
            </nav>
            <div class="card-body">
               <!--  <a href="<?= base_url('rekomendasi/pindah');?>" class="btn btn-primary mb-2">Import
                Data Mata Kuliah</a> -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>            
                                <th>RUANGAN</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($ruangan as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                   
                                    <td><?php echo $row['ruangan'] ?></td>
                                   
                                    <td>
                                        <a href="<?php echo base_url(); ?>home/editMakul/<?= $row['idRuangan']; ?>"
                                         class="badge badge-success ">Edit</a>
                                        <a href="<?php echo base_url(); ?>home/deleteMakul/<?= $row['idRuangan']; ?>"
                                             class="badge badge-danger"
                                             onclick="return confirm('Are you sure you want to delete <?= $row['ruangan']; ?>?');">Delete</a>
                                         </td>
                                     </tr>
                                     <?php $i++; ?>
                                 <?php endforeach; ?>
                             </tbody>
                         </table>
                    </div>
                </div>
            </div>
        </main>

        <script type="text/javascript">
            $(document).ready(function(){
                $('#tabelku').dataTable({
                    "scrollY":        "400px",
                    "scrollCollapse": true,
                    "paging":         false
                });
            });
        </script>