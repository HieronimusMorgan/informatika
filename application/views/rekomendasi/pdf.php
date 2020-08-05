
<!doctype html>
<html lang="en"><head>
	<!-- Required meta tags -->
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

	<!-- Bootstrap CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">

	<title><?= $title ?></title>

	<style type="text/css">
		table{
			border-collapse: collapse;
			border: 1px solid black;
			font-size: 12px;
			table-layout: auto;
		text-align: center;
			width: 100%:
		}
		th,td {
			border: 1px solid black;

		}
		
	</style>
</head>
<body>
	
	<p> <?= $title; ?></p>

	<table style="">
		<tr>
			<th scope="col">Hari/Tgl</th>
			<th scope="col" style="width: 70px;">Jam</th>
			<th scope="col" style="width: 190px;">Matakuliah</th>
			<th scope="col" style="width: 40px;">Kelas</th>
			<th scope="col" style="width: 40px;">Sem</th>
			<th scope="col" style="width: 190px;">Dosen</th>
			<th scope="col" style="width: 40px;">Ruang</th>
			<th scope="col" style="width: 40px;">Peserta</th>

		</tr>
		<?php $no = 1; ?>
		<?php foreach ($laporan  as $row) :?>

		<tr>

			<td><?php 
				$date = date('d-m-Y',strtotime($row['tanggal']));
				$hari = date('D', strtotime($row['tanggal']));
				$hari_ini = hari_ini($hari);
				echo $hari_ini.", ".$date ?></td>
				
				
					<td><?php
					$jamMulai = date("G:i",strtotime( $row['jamMulai'])); 
					$jamSelesai = date("G:i", strtotime($row['jamSelesai']));
					echo $jamMulai."-".$jamSelesai?></td>
					<td><?php echo $row['nama']; ?></td>
					<td> <?php echo $row['kelas']; ?></td>
					<td><?php echo $row['idSemester'] ?></td>
					<td><?php echo $row['dosen_nama']; ?></td>
					<td><?php echo $row['ruangan']; ?></td>
					<td><?php echo $row['kapasitas']; ?></td>
					

				

				</tr>
				<?php $no++; ?>
				<?php endforeach; ?>

			</table>

		</body></html>

		<?php  
		function hari_ini($d){
		$hari = $d;

		switch($hari){
		case 'Sun':
		$hari_ini = "Minggu";
		break;

		case 'Mon':     
		$hari_ini = "Senin";
		break;

		case 'Tue':
		$hari_ini = "Selasa";
		break;

		case 'Wed':
		$hari_ini = "Rabu";
		break;

		case 'Thu':
		$hari_ini = "Kamis";
		break;

		case 'Fri':
		$hari_ini = "Jumat";
		break;

		case 'Sat':
		$hari_ini = "Sabtu";
		break;

		default:
		$hari_ini = "Tidak di ketahui";   
		break;
	}

	return $hari_ini;

}
?>