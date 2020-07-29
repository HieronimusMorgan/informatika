<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h1 class="mt-2"><?= $title ?></h1>
            </nav>
            <div class="card-body">
               <!--  <a href="http://" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Import
                Data Mata Kuliah</a> -->
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>            
                                <th>NIP</th>
                                <th>NAMA</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($dosen as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                   
                                    <td><?php echo $row['nip'] ?></td>
                                    <td><?php echo $row['nama'] ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>home/editMakul/<?= $row['idDosen']; ?>"
                                         class="badge badge-success ">Edit</a>
                                        <a href="<?php echo base_url(); ?>home/deleteMakul/<?= $row['idDosen']; ?>"
                                             class="badge badge-danger"
                                             onclick="return confirm('Are you sure you want to delete <?= $row['nama']; ?>?');">Delete</a>
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

                    
                });
            });
        </script>