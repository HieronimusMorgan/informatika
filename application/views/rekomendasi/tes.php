<!DOCTYPE html>
<html>
<head>
	<title>BPNT Girikerto</title>

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</head>
<body class="home">
	<div class="container">
		<h2 class="text-center"> BPNT DESA GIRIKERTO </h2>
		<center>
		<a href="<?= base_url()?>status"><button class="btn btn-primary" style="float: center">Cek Status</button></a>
		
		</center>
	</div>
<script>
	$(document).ready(function(){
		alert("hallo");
		// $('#tahun').change(function(){
		// 	var id = $(this).val();
		// 	alert("hallo");
		// 	alert(id);
		// 	$.ajax({
		// 		url : "<?php echo base_url(); ?>jadwal/get_makul_tahun",
		// 		method: "POST",
		// 		data : {id : id},
		// 		async : false,
		// 		dataType : 'json',
		// 		success : function(data){
		// 			var html = '';
		// 			var i;
		// 			for (i = 0; i<data.length; i++){
		// 				html += '<option>' + data[i].matkul+'</option>';
		// 			}
		// 			$('.matkul').html(html);
		// 		}
		// 	});
		// });
	});
</script>

<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery-3.2.1.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/bootstrap.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/jquery.dataTables.js' ?>"></script>
<script type="text/javascript" src="<?php echo base_url() . 'assets/js/dataTables.bootstrap4.js' ?>"></script>
</body>

<style type="text/css">
	.home{
		background:none ;
	}	
	.container{
	margin-top: 9%;
	background: rgba(0,0,0,0.5);
	box-shadow: 0 0px 10px 5px white;
	padding: 40px;
	color: #fff;
	}
}
</style>
</html>
