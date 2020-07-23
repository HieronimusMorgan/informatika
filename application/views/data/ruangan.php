<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <nav class="navbar">
                <h1 class="mt-4"><?= $title ?></h1>
                <form method="post" class="form-inline" action="<?php base_url('home/search'); ?>">
                    <input class="form-control mr-sm-2" name="nama" type="text" id="nama" placeholder="Search Name"
                           aria-label="Search">
                    <button class="btn btn-outline-success my-2 my-sm-0" type="submit">Search</button>
                </form>
            </nav>
            <div class="card-body">
                <a href="http://" class="btn btn-primary mb-2" data-toggle="modal" data-target="#exampleModal">Import
                    Data Ruangan</a>
                <div class="table-responsive">
                    <table class="table table-bordered" id="dataTable" width="100%">
                        <thead>
                            <tr>
                                <th>NO</th>
                                <th>NAMA</th>
                                <th>MAKUL</th>
                                <th>JAM</th>
                                <th>ACTION</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; ?>
                            <?php foreach ($data->result() as $row) : ?>
                                <tr>
                                    <td><?= $i ?></td>
                                    <td><?php echo $row->nama; ?></td>
                                    <td><?php echo $row->makul; ?></td>
                                    <td><?php echo $row->jam; ?></td>
                                    <td>
                                        <a href="<?php echo base_url(); ?>home/editRuang/<?= $row->nama; ?>"
                                           class="badge badge-success ">Edit</a>
                                        <a href="<?php echo base_url(); ?>home/deleteRuang/<?= $row->nama; ?>"
                                           class="badge badge-danger"
                                           onclick="return confirm('Are you sure you want to delete <?= $row->nama; ?>?');">Delete</a>
                                    </td>
                                </tr>
                                <?php $i++; ?>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                    <!--Tampilkan pagination-->
                    <div class="row">
                        <div class="col">
                            <?php echo $pagination; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>