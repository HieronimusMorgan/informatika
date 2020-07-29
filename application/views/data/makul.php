<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h2 class=""><?= $title ?></h2>
                    </div>

                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>KODE</th>
                                <th>TIPE</th>
                                <th>NAMA</th>
                                <th>KELAS</th>
                                <th>TAHUN</th>
                                <th>SEMESTER</th>
                                <th>RUANGAN</th>
                                <th>KAPASITAS</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?php echo $row->kodeMakul; ?></td>
                                <td><?php echo $row->tipeMakul; ?></td>
                                <td><?php echo $row->nama; ?></td>
                                <td><?php echo $row->kelas; ?></td>
                                <td><?php echo $row->tahun; ?></td>
                                <td><?php echo $row->semester; ?></td>
                                <td><?php echo $row->ruangan; ?></td>
                                <td><?php echo $row->kapasitas; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>home/editMakul/<?= $row->nama; ?>"
                                        class="badge badge-success ">Edit</a>
                                    <a href="<?php echo base_url(); ?>home/deleteMakul/<?= $row->idMakul; ?>"
                                        class="badge badge-danger"
                                        onclick="return confirm('Are you sure you want to delete <?= $row->nama; ?>?');">Delete</a>
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
<<<<<<< HEAD
    $(document).ready(function(){
        $('#tabelku').dataTable({   
            "paging":         false,
            "language": {
                "emptyTable": "Data Kosong"
            }
        });
    });
</script>
=======
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true,
            "bAutoWidth": false
        });
    });
    </script>
>>>>>>> 812f2457f669c8faa0461d3edf9d3e49b887ae6e
