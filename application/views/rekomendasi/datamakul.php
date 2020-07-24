<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h1 class="mt-2"><?= $title ?></h1>
            </nav>
            <div class="card-body">
                <a href="http://" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Import
                Data Mata Kuliah</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>            
                                <th>NAMA MATAKULIAH</th>
                                <th>KELAS</th>
                                <th>TAHUN</th>
                                <th>SEMESTER</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($makul as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                   
                                    <td><?php echo $row['nama'] ?></td>
                                    <td><?php echo $row['kelas'] ?></td>
                                    <td><?php echo $row['tahun'] ?></td>
                                    <td><?php echo $row['semester'] ?></td>

                                    <td>
                                        <a href="<?php echo base_url(); ?>home/editMakul/<?= $row['nama']; ?>"
                                         class="badge badge-success ">Edit</a>
                                         <a href="<?php echo base_url(); ?>home/deleteMakul/<?= $row['nama']; ?>"
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
                    "scrollY":        "400px",
                    "scrollCollapse": true,
                    "paging":         false
                });
            });
        </script>