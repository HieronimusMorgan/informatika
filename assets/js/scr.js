 document.getElementById('ganti').onclick = function(){
	$('#matkulEdit').html("");
 	var semester = $('#semesterEdit').val();
 	var idJadwal = $('#idjadwalEdit').val();
 	var id = $('#tahunEdit').val();
 	var ido = $('#idMatakul').val();
 	var nama = $('#namaMatakul').val();
 	var kelas = $('#kelasMatakul').val();


 	var html = '<option value="' + ido + '">' + kelas + ' / ' + kelas + '</option>';
 	$('#matkulEdit').html(html);

 };