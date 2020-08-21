UNDANGAN UJIAN KOLOKIUM

<?php if ($kolokium['dosen2'] != NULL): ?>
Yth. <?= $kolokium['dosen1']; ?><?= '' ?> 
     <?= $kolokium['dosen2']; ?><?= '' ?> 
     <?= $kolokium['reviewer']; ?><?= '' ?> 

Terkait penetapan jadwal ujian kolokium, atas nama mahasiswa :
NIM     : <?= $kolokium['nim']; ?><?= '' ?> 
Nama    : <?= $kolokium['nama']; ?><?= '' ?> 
Judul   : <?= $kolokium['judul']; ?>

Jadwal ujian kolokium akan dilaksanakan pada:
Tanggal             : <?= format_indo($kolokium['tanggal']); ?><?= '' ?> 
Jam                 : <?= $kolokium['durasi']; ?> WIB<?= '' ?> 
Dosen Pembimbing 1  : <?= $kolokium['dosen1']; ?><?= '' ?> 
Dosen Pembimbing 2  : <?= $kolokium['dosen2']; ?><?= '' ?> 
Dosen Penguji       : <?= $kolokium['reviewer']; ?><?= '' ?> 

Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?
Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.



                                        Yogyakarta, <?= $tanggal; ?><?= '' ?>
                                        
                                        
                                        (Wakaprodi)
                                        <?php if ($dosen != NULL): ?>
                                        <?= $dosen['nama']; ?>
                                        <?php endif; ?>
                                        
                                        
                                        
<?php else: ?>
Yth. <?= $kolokium['dosen1']; ?><?= '' ?> 
     <?= $kolokium['reviewer']; ?><?= '' ?> 

Terkait penetapan jadwal ujian kolokium, atas nama mahasiswa :
NIM     : <?= $kolokium['nim']; ?><?= '' ?> 
Nama    : <?= $kolokium['nama']; ?><?= '' ?> 
Judul   : <?= $kolokium['judul']; ?>

Jadwal ujian kolokium akan dilaksanakan pada:
Tanggal             : <?= format_indo($kolokium['tanggal']); ?><?= '' ?> 
Jam                 : <?= $kolokium['durasi']; ?> WIB<?= '' ?> 
Dosen Pembimbing 1  : <?= $kolokium['dosen1']; ?><?= '' ?> 
Dosen Penguji       : <?= $kolokium['reviewer']; ?><?= '' ?> 

Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?
Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.ih.



                                        Yogyakarta, <?= $tanggal; ?><?= '' ?>
                                        
                                        
                                        (Wakaprodi)
                                        <?php if ($dosen != NULL): ?>
                                        <?= $dosen['nama']; ?>
                                        <?php endif; ?>
                                        
<?php endif; ?>

