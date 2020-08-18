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
        <h3>JADWAL PENDADARAN MAHASISWA</h3>
    </center>
    <br><br>
    <table cellpadding="5">
        <tr>
            <td>Nama</td>
            <td>:</td>
            <td><?= $pendadaran['nama']; ?></td>
        </tr>
        <tr>
            <td>NIM</td>
            <td>:</td>
            <td><?= $pendadaran['nim']; ?></td>
        </tr>
        <tr>
            <td>Dosen Pembimbing 1</td>
            <td>:</td>
            <td><?= $pendadaran['dosen1']; ?></td>
        </tr>
        <tr>
            <td>Dosen Pembimbing 2</td>
            <td>:</td>
            <td><?= $pendadaran['dosen2']; ?></td>
        </tr>
        <tr>
            <td>Judul Tugas Akhir</td>
            <td>:</td>
            <td><?= $pendadaran['judul']; ?></td>
        </tr>
        <tr>
            <td>Reviewer Kolokium</td>
            <td>:</td>
            <td><?= $pendadaran['reviewer']; ?></td>
        </tr>
        <tr>
            <td>Ketua Penguji</td>
            <td>:</td>
            <td><?= $pendadaran['ketuaPenguji']; ?></td>
        </tr>
        <tr>
            <td>Sekretaris Penguji</td>
            <td>:</td>
            <td><?= $pendadaran['sekretarisPenguji']; ?></td>
        </tr>
        <tr>
            <td>Anggota Penguji</td>
            <td>:</td>
            <td><?= $pendadaran['anggotaPenguji']; ?></td>
        </tr>
        <tr>
            <td>Tanggal<</td>
            <td>:</td>
            <td><?= format_indo($pendadaran['tanggal']); ?></td>
        </tr>
        <tr>
            <td>Jam</td>
            <td>:</td>
            <td><?= $pendadaran['durasi']; ?> WIB</td>
        </tr>
        <tr>
            <td>Ruangan</td>
            <td>:</td>
            <td><?= $pendadaran['ruang']; ?></td>
        </tr>
        <tr>
            <td>Keterangan</td>
            <td>:</td>
            <td><?= $pendadaran['keterangan']; ?></td>
        </tr>
    </table>
</body></html>

