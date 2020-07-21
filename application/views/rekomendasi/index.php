


<div id="layoutSidenav_content">
<main>
	<div class="col-md-6 col-md-offset-3">
		<div class="thumbail">
			<form class="form-hosizontal">
				<div class="form-group">
					<label class="control-label col-md-3">Tahun Ajaran</label>
					<div class="col-md-8">
						<select name="tahun" id="tahun" class="form-control">
							<option value="0">-PILIH-</option>
							<option value ="2017">2017</option>
							<option value="2018">2018</option>
						</select>
					</div>
				</div>
				<div class="form-group">
					<label class="control-label col-md-3">Matakuliah</label>
					<div class="col-md-8">
						<select name="matkul" class="matkul form-control">
							<option value="0">-Matakuliah-</option>
						</select>
					</div>
				</div>
			</form>
		</div>
	</div>

</main>
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



<!-- <div id="layoutSidenav_content">
	<main>
		<div class="container-fluid">
			<h1 class="mt-4"><?= $title?></h1>

			<form>
				<div class="form-group">
					<label for="exampleFormControlInput1">Tanggal Ujian</label>
					<input class="datepicker">
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect1">Example select</label>
					<select class="form-control" id="exampleFormControlSelect1">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlSelect2">Example multiple select</label>
					<select multiple class="form-control" id="exampleFormControlSelect2">
						<option>1</option>
						<option>2</option>
						<option>3</option>
						<option>4</option>
						<option>5</option>
					</select>
				</div>
				<div class="form-group">
					<label for="exampleFormControlTextarea1">Example textarea</label>
					<textarea class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
				</div>

				<div class="container">
					<div class="row">
						<div class='col-sm-6'>
							<div class="form-group">
								<div class='input-group date' id='datetimepicker2'>
									<input type='text' class="form-control" />
									<span class="input-group-addon">
										<span class="glyphicon glyphicon-calendar"></span>
									</span>
								</div>
							</div>
						</div>
						<script type="text/javascript">
							$(function () {
								$('#datetimepicker2').datetimepicker({
									locale: 'ru'
								});
							});
						</script>
					</div>
				</div>
			</form>
		</div>
	</main>


-->
