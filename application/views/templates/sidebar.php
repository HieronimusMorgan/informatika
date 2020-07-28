<div id="layoutSidenav">
    <div id="layoutSidenav_nav">
        <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
            <div class="sb-sidenav-menu">
                <div class="nav">
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Data"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Data
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Data" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('home/mahasiswa'); ?>">Data Mahasiswa</a>
                            <a class="nav-link" href="<?= base_url('home/dosen'); ?>">Data Dosen</a>
                            <a class="nav-link" href="<?= base_url('home/makul'); ?>">Data Makul</a>
                            <a class="nav-link" href="<?= base_url('home/ruangan'); ?>">Data Ruangan</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#kapasitas"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Kapasitas Kelas
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="kapasitas" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('presensi'); ?>">Data Presensi Mahasiswa</a>
                            <a class="nav-link" href="<?= base_url('kapasitas'); ?>">Laporan Kapasitas Kelas</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Rekomendasi"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Rekomendasi Jadwal Ujian
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Rekomendasi" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('rekomendasi/c_makul'); ?>">Manajemen Data Makul</a>
                            <a class="nav-link" href="<?= base_url('rekomendasi/c_ruang'); ?>">Manajemen Ruang</a>
                            <a class="nav-link" href="<?= base_url('rekomendasi/c_dosen');  ?>">Manajemen Data Dosen</a>
                            <a class="nav-link" href="<?= base_url('rekomendasi/c_jadwal');  ?>">Manajemen Jadwal</a>
                            <a class="nav-link" href="#">Laporan Jadwal</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Pendadaran"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Jadwal Pendadaran
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Pendadaran" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('pendadaran'); ?>">Manajemen Data Dosen</a>
                            <a class="nav-link" href="#">Manajemen Ruangan</a>
                            <a class="nav-link" href="#">Manajemen Jadwal Pendadaran</a>
                            <a class="nav-link" href="#">Laporan Pendadaran</a>
                        </nav>
                    </div>
                    <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#Kolokium"
                       aria-expanded="false" aria-controls="collapseLayouts">
                        <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                        Jadwal Kolokium
                        <div class="sb-sidenav-collapse-arrow"><i class="fas fa-angle-down"></i></div>
                    </a>
                    <div class="collapse" id="Kolokium" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                        <nav class="sb-sidenav-menu-nested nav">
                            <a class="nav-link" href="<?= base_url('kolokium'); ?>">Manajemen Data Dosen</a>
                            <a class="nav-link" href="#">Manajemen Ruangan</a>
                            <a class="nav-link" href="#">Manajemen Jadwal Kolokium</a>
                            <a class="nav-link" href="#">Laporan Kolokium</a>
                        </nav>
                    </div>
                    </nav>
                </div>