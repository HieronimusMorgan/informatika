UNDANGAN UJIAN PENDADARAN SKRIPSI

<?php if ($pendadaran['dosen2'] != NULL): ?>
Yth. <?= $pendadaran['dosen1']; ?><?= '' ?> 
     <?= $pendadaran['dosen2']; ?><?= '' ?> 
     <?= $pendadaran['ketuaPenguji']; ?><?= '' ?> 
     <?= $pendadaran['sekretarisPenguji']; ?><?= '' ?> 
     <?= $pendadaran['anggotaPenguji']; ?><?= '' ?> 

Terkait penetapan jadwal ujian pendadaran skripsi, atas nama mahasiswa :
NIM     : <?= $pendadaran['nim']; ?><?= '' ?> 
Nama    : <?= $pendadaran['nama']; ?><?= '' ?> 
Judul   : <?= $pendadaran['judul']; ?><?= '' ?> 

Jadwal ujian pendadaran skripsi akan dilaksanakan pada:
Tanggal             : <?= format_indo($pendadaran['tanggal']); ?><?= '' ?> 
Jam                 : <?= $pendadaran['durasi']; ?> WIB<?= '' ?> 
Dosen Pembimbing 1  : <?= $pendadaran['dosen1']; ?><?= '' ?> 
Dosen Pembimbing 2  : <?= $pendadaran['dosen2']; ?><?= '' ?> 
Dosen Penguji       : <?= $pendadaran['ketuaPenguji']; ?><?= '' ?> 
                      <?= $pendadaran['sekretarisPenguji']; ?><?= '' ?> 
                      <?= $pendadaran['anggotaPenguji']; ?><?= '' ?> 

Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?
Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.



                                        Yogyakarta, <?= $tanggal; ?><?= '' ?>
                                        
                                        
                                        (Wakaprodi)
                                        <?php if ($dosen != NULL): ?>
                                        <?= $dosen['nama']; ?>
                                        <?php endif; ?>
<?php else: ?>
Yth. <?= $pendadaran['dosen1']; ?><?= '' ?> 
     <?= $pendadaran['ketuaPenguji']; ?><?= '' ?> 
     <?= $pendadaran['sekretarisPenguji']; ?><?= '' ?> 
     <?= $pendadaran['anggotaPenguji']; ?><?= '' ?> 

Terkait penetapan jadwal ujian pendadaran skripsi, atas nama mahasiswa :
NIM     : <?= $pendadaran['nim']; ?><?= '' ?> 
Nama    : <?= $pendadaran['nama']; ?><?= '' ?> 
Judul   : <?= $pendadaran['judul']; ?><?= '' ?> 

Jadwal ujian pendadaran skripsi akan dilaksanakan pada:
Tanggal             : <?= format_indo($pendadaran['tanggal']); ?><?= '' ?> 
Jam                 : <?= $pendadaran['durasi']; ?> WIB<?= '' ?> 
Dosen Pembimbing 1  : <?= $pendadaran['dosen1']; ?><?= '' ?> 
Dosen Penguji       : <?= $pendadaran['ketuaPenguji']; ?><?= '' ?> 
                      <?= $pendadaran['sekretarisPenguji']; ?><?= '' ?> 
                      <?= $pendadaran['anggotaPenguji']; ?><?= '' ?> 

Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?
Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.



                                        Yogyakarta, <?= $tanggal; ?><?= '' ?>
                                        
                                        
                                        (Wakaprodi)
                                        <?php if ($dosen != NULL): ?>
                                        <?= $dosen['nama']; ?>
                                        <?php endif; ?>
<?php endif; ?>

