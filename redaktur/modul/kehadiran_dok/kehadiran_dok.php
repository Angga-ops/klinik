<?php $tgl =  $_GET["tgl"]; 
if(empty($_GET["tgl"])){
	$tgl = date("Y-m-d");
}
?>
<section class="content">
	<div class="box box-success">
		 <div class="box-header">
		 	<h3 class="box-title">Laporan Kehadiran Dokter</h3>
		 </div>
		 <div class="box-body">
		 	<div class="row">
		 		<div class="col-md-2" style="margin-right: 0;">
		 			<label>Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl" value="<?php echo $tgl; ?>">
		 			<button class="btn btn-sm btn-info" style="margin-top: 6px;" id="cari"><i class="fa fa-search"></i> Cari</button>
		 			<a class="btn btn-sm btn-success" style="margin-top: 6px;" href="modul/kehadiran_dok/cetak_kd.php?tgl=<?php echo $tgl; ?>"><i class="fa fa-print"></i> Cetak</a>
		 		</div>
		 		<div class="col-md-6" style="margin-left: 0px;"><br>
		 			
		 		</div>
		 	</div>
		 	<h4>Dokter Yang Hadir Tanggal <?php echo tgl_indo($tgl); ?></h4>
		 	<div class="table-responsives">
		 		<table class="table table-bordered table-striped datatable">
		 			<thead>
		 				<tr>
		 					<th>Nama Dokter</th>
		 					<th>Cabang Klinik</th>
		 					<th>Tanggal</th>
		 					<th>Waktu</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php $q = mysql_query("SELECT *FROM kehadiran_dr k JOIN user u ON k.id_dr=u.id_user JOIN daftar_klinik dk ON k.id_kk=dk.id_kk WHERE k.tanggal='$tgl'"); 
		 					while($d = mysql_fetch_array($q)){ ?>
		 				<tr>
		 					<td><?php echo $d["nama_lengkap"]; ?></td>
		 					<td><?php echo $d["nama_klinik"]; ?></td>
		 					<td><?php echo tgl_indo($d["tanggal"]); ?></td>
		 					<td><?php echo $d["jam"]; ?></td>
		 				</tr>
		 				<?php
		 					}
		 				?>
		 				
		 			</tbody>
		 		</table>
		 	</div>
		 </div>
	</div>
</section>

<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  // tanggal
  $("#cari").click(function(){
  	var tgl = $("#tgl").val();
  	window.location.href = "media.php?module=lap_kedo&tgl="+tgl;
  });

});
</script>