<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">

            <div class="container">
                <?php if ($this->session->flashdata('KolokiumtidakAda')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('KolokiumtidakAda'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                        </div>
                    </div>
                </div>

                <?php elseif ($this->session->flashdata('PendadarantidakAda')): ?>
                <div class="row mt-3">
                    <div class="col-md-10">
                        <div class="alert alert-danger alert-dismissible fade show" role="alert">
                            <?= $this->session->flashdata('PendadarantidakAda'); ?>.
                            <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                    </div>
                </div>
                <?php endif; ?>

                <div class="row mt-3">
                    <div class="col">
                        <div class="card">
                            <div class="card-header">
                                <?= $form; ?>
                            </div>

                            <div class="card-body">
                                <form action="" method="post">
                                    <div class="form-group">
                                        <label for="nim">NIM Mahasiswa</label>
                                        <input type="text" name="nim" class="form-control" id="nim" autofocus="">
                                        <small class="form-text text-danger"><?= form_error('nim'); ?></small>
                                    </div>
                                    <button type="submit" name="inputNim" value="inputNim"
                                        class="btn btn-primary float-right"><i class="fas fa-search"></i>
                                        Search</button>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>