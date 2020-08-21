<html><head>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
        <title></title>
    </head><body>
        <table>
            <tr>
                <td width="60">
                    <img src="img/fst.png" width="70">
                </td>
                <td align="left">
                    <span>
                        PROGRAM STUDI INFORMATIKA
                        <br>FAKULTAS SAINS DAN TEKNOLOGI
                        <br>UNIVERSITAS SANATA DHARMA YOGYAKARTA
                    </span>
                </td>
            </tr>
        </table>
        <hr class="line-title">
    <center>
        <h3>
            UNDANGAN UJIAN PENDADARAN SKRIPSI
        </h3>
        <br><br>
    </center>
    <?php if ($pendadaran['dosen2'] != NULL): ?>
        <table>
            <tr>
                <td>Yth.</td>
                <td><?= $pendadaran['dosen1']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['dosen2']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['ketuaPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['sekretarisPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['anggotaPenguji']; ?></td>
            </tr>
        </table>
        <br><br>
        Terkait penetapan jadwal ujian pendadaran skripsi, atas nama mahasiswa :<br>
        <table>
            <tr>
                <td style="color: white">Yth.</td>                
                <td>NIM</td>
                <td>:</td>
                <td><?= $pendadaran['nim']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Nama</td>
                <td>:</td>
                <td><?= $pendadaran['nama']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Judul</td>
                <td>:</td>
                <td><?= $pendadaran['judul']; ?></td>
            </tr>
        </table>
        <br><br>
        Jadwal ujian pendadaran skripsi akan dilaksanakan pada:<br>
        <table>
            <tr>
                <td style="color: white">Yth.</td>  
                <td>Tanggal</td>
                <td>:</td>
                <td><?= format_indo($pendadaran['tanggal']); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Jam</td>
                <td>:</td>
                <td><?= $pendadaran['durasi']; ?> WIB</td>
            </tr>
            <tr>
                <td></td>
                <td>Dosen Pembimbing 1</td>
                <td>:</td>
                <td><?= $pendadaran['dosen1']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Dosen Pembimbing 2</td>
                <td>:</td>
                <td><?= $pendadaran['dosen2']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Dosen Penguji</td>
                <td>:</td>
                <td><?= $pendadaran['ketuaPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>:</td>
                <td><?= $pendadaran['sekretarisPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>:</td>
                <td><?= $pendadaran['anggotaPenguji']; ?></td>
            </tr>
        </table>
        <br><br>

        <p>Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?<br>
            Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.
        </p>
        <br><br><br>
        <p style="margin-right: 30px; text-align: right">
            Yogyakarta, <?= $tanggal; ?>
            <br><br><br>
            (Wakaprodi)<br>
            <?php if ($dosen != NULL): ?>
                <?= $dosen['nama']; ?>
            <?php endif; ?>
        </p>
    <?php else: ?>
        <table>
            <tr>
                <td>Yth.</td>
                <td><?= $pendadaran['dosen1']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['ketuaPenguji']; ?></td>
            </tr> 
            <tr>
                <td></td>
                <td><?= $pendadaran['sekretarisPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td><?= $pendadaran['anggotaPenguji']; ?></td>
            </tr>
        </table>
        <br><br>
        Terkait penetapan jadwal ujian pendadaran skripsi, atas nama mahasiswa :<br>
        <table>
            <tr>
                <td style="color: white">Yth.</td>                
                <td>NIM</td>
                <td>:</td>
                <td><?= $pendadaran['nim']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Nama</td>
                <td>:</td>
                <td><?= $pendadaran['nama']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Judul</td>
                <td>:</td>
                <td><?= $pendadaran['judul']; ?></td>
            </tr>
        </table>
        <br><br>
        Jadwal ujian pendadaran skripsi akan dilaksanakan pada:<br>
        <table>
            <tr>
                <td style="color: white">Yth.</td>  
                <td>Tanggal</td>
                <td>:</td>
                <td><?= format_indo($pendadaran['tanggal']); ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Jam</td>
                <td>:</td>
                <td><?= $pendadaran['durasi']; ?> WIB</td>
            </tr>
            <tr>
                <td></td>
                <td>Dosen Pembimbing 1</td>
                <td>:</td>
                <td><?= $pendadaran['dosen1']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td>Dosen Penguji</td>
                <td>:</td>
                <td><?= $pendadaran['ketuaPenguji']; ?></td>
            </tr>
            <tr>
                <td></td>
                <td></td>
                <td>:</td>
                <td><?= $pendadaran['sekretarisPenguji']; ?></td>
            </tr>

            <tr>
                <td></td>
                <td></td>
                <td>:</td>
                <td><?= $pendadaran['anggotaPenguji']; ?></td>
            </tr>
        </table>
        <br><br>

        <p>Saya ingin meminta konfirmasi Bapak/Ibu, apakah bisa dilaksanakan sesuai jadwal diatas?<br>
            Atas perhatian dan kerjasama Bapak/Ibu saya ucapkan terima kasih.
        </p>
        <br><br><br>
        <p style="margin-right: 30px; text-align: right">
            Yogyakarta, <?= $tanggal; ?>
            <br><br><br>
            (Wakaprodi)<br>
            <?php if ($dosen != NULL): ?>
                <?= $dosen['nama']; ?>
            <?php endif; ?>
        </p>
    <?php endif; ?>

</body>
</html>