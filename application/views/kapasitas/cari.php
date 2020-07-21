<div id="layoutSidenav_content">
    <main>
        <div class="container-fluid">
            <h1 class="mt-4"><?= $title?></h1>
            <div class="card mb-4">
                <div class="card-body">
                    <div class="row">
                        <div class="col">
                            <div class="card mb-1">
                                <div class="card-header d-flex justify-content-center ">
                                    Jumlah Mahasiswa Aktif
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT * FROM mahasiswa WHERE `status` LIKE 'AKTIF'")->num_rows(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-1">
                                <div class="card-header d-flex justify-content-center ">
                                    Jumlah Mahasiswa Tidak Aktif
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT * FROM mahasiswa WHERE `status`  LIKE 'TIDAK AKTIF'")->num_rows(); ?>
                                </div>
                            </div>
                        </div>
                        <div class="col">
                            <div class="card mb-1">
                                <div class="card-header d-flex justify-content-center ">
                                    Jumlah Mahasiswa DO
                                </div>
                                <div class="card-body d-flex justify-content-center">
                                    <?php echo $this->db->query("SELECT * FROM mahasiswa WHERE `status`  LIKE 'DO'")->num_rows(); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg-8">
                    <div class="card mb-4  ">
                        <div class="card-header d-flex justify-content-center bold ">
                            <h5> <?= $data ?></h5>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">

                                <table class="table table-bordered" id="dataTable" width="100%" id="myTable">
                                    <thead>
                                        <tr style="text-align:center;">
                                            <th>TAHUN</th>
                                            <th>TELAH MENGAMBIL</th>
                                            <th>BELUM MENGAMBIL</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php $i = 1; ?>
                                        <?php $total = 0 ; 
                                        $makul =$this->db->get('tahun')->result_array();
                                        ?>
                                        <?php if ($kapasitas):?>
                                        <?php foreach ($makul as $m):?>
                                        <?php  
                                                $sql = "SELECT COUNT(Nim) AS jumlah FROM presensi a JOIN makul b ON a.idMakul = b.idMakul WHERE b.nama LIKE '".$data."' AND a.Nim LIKE '".$m['tahun']."%'  ";
                                                $jumlah = $this->db->query($sql)->result_array();?>
                                        <?php if ($jumlah[0]['jumlah']!=0) : ?>
                                        <tr>
                                            <td style="text-align:center;"><?='20'.$m['tahun'] ?></td>
                                            <td style="text-align:center;"><?php  
                                                    echo $jumlah[0]['jumlah'];
                                                    $total += $jumlah[0]['jumlah'];
                                            ?>
                                            </td>
                                            <td style="text-align:center;"><?php  
                                                $sql = "SELECT COUNT(DISTINCT a.nim) AS jumlah FROM mahasiswa a JOIN presensi b ON a.nim = b.Nim JOIN makul c ON b.idMakul=c.idMakul WHERE a.nim LIKE '".$m['tahun']."%' AND c.nama NOT LIKE '".$data."' AND a.status = 'AKTIF' ";
                                                $kurang = $this->db->query($sql)->result_array();
                                                echo  abs($jumlah[0]['jumlah']-$kurang[0]['jumlah']);
                                            ?>
                                            </td>
                                        </tr>
                                        <?php endif ?>
                                        <?php $i++; ?>
                                        <?php endforeach ?>
                                        <?php endif ?>
                                    </tbody>
                                </table>

                            </div>
                        </div>
                    </div>
                </div>
                <div class="col-lg-4">
                    <div class="card mb-4 ">
                        <div class="card-header d-flex justify-content-center">
                            FILTER
                        </div>
                        <div class="card-body">
                            <form action="<?= base_url('kapasitas/filter');?>" method="post">
                                <div class="form-group">
                                    <label for="title">ANGKATAN</label>
                                    <input type="text" class="form-control" name="angkatan" id="angkatan">
                                </div>
                                <div class="form-group">
                                    <label for="title">MATA KULIAH</label>
                                    <select name="makul" id="makul" class="form-control">
                                        <option value=""></option>
                                        <?php $sql="SELECT DISTINCT nama FROM makul"; ?>
                                        <?php $menu = $this->db->query($sql)->result_array();?>
                                        <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['nama']?>"><?= $m['nama']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">TAHUN AJARAN</label>
                                    <select name="tahun" id="tahun" class="form-control">
                                        <option value=""></option>
                                        <?php $sql="SELECT DISTINCT tahun FROM makul"; ?>
                                        <?php $menu = $this->db->query($sql)->result_array();?>
                                        <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['tahun']?>"><?= $m['tahun']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">TIPE MAKUL</label>
                                    <select name="tipe" id="tipe" class="form-control">
                                        <option value=""></option>
                                        <?php $menu =['Wajib','RD','SC','JK','Perminatan'] ?>
                                        <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m?>"> <?= $m?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="title">DOSEN</label>
                                    <select name="dosen" id="dosen" class="form-control">
                                        <option value=""></option>
                                        <?php $sql="SELECT DISTINCT nama FROM dosen"; ?>
                                        <?php $menu = $this->db->query($sql)->result_array();?>
                                        <?php foreach ($menu as $m) : ?>
                                        <option value="<?= $m['nama']?>"><?= $m['nama']?> </option>
                                        <?php endforeach; ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <button type="submit" class="btn btn-primary btn-lg btn-block">CARI</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>