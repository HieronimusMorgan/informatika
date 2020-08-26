<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <div class="card-body">
                <div class="row">
                    <div class="col-auto mr-auto">
                        <h2 class=""><?= $title ?></h2>
                    </div>
                </div>
                <hr>
                <div class="table-responsive">
                    <table class="table table-bordered" id="tabelku" width="100%">
                        <thead>
                            <tr class="text-center">
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>MAKUL</th>
                                <th>HARI</th>
                                <th>JAM</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                            <tr>
                                <td class="text-center"><?= $i ?></td>
                                <td><?php echo $row->nama; ?></td>
                                <td><?php echo ($makul = $this->db->query('SELECT nama FROM makul WHERE idMakul LIKE '.$row->makul)->row()->nama); ?>
                                </td>
                                <td><?php echo $row->hari; ?></td>
                                <td><?php echo $row->jam; ?></td>
                                <td>
                                    <a href="<?php echo base_url(); ?>home/editRuang/<?= $row->idRuangan; ?>"
                                        class="badge badge-success ">Edit</a>
                                    <a href="<?php echo base_url(); ?>home/deleteRuang/<?= $row->idRuangan; ?>"
                                        class="badge badge-danger"
                                        onclick="return confirm('Are you sure you want to delete <?= $row->nama; ?>, present <?= $makul; ?> and <?= $makul; ?>?');">Delete</a>
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
    $(document).ready(function() {
        $('#tabelku').dataTable({
            "scrollY": "400px",
            "scrollCollapse": true,
            "paging": true,
            "bAutoWidth": false,
            "language": {
                "emptyTable": "Data Kosong"
            },
            "lengthMenu": [
                [10, 25, 50, 100, -1],
                [10, 25, 50, 100, "All"]
            ],
        });
    });
    </script>