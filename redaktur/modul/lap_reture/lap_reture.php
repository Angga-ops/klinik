<?php $tgl =  $_GET["tgl"]; 
if(empty($_GET["tgl"])){
	$tgl = date("Y-m-d");
}
?>
<section class="content"> 
	<div class="box box-success">
		<div class="box-header">
			<h3  class="box-title pull-left">Laporan Reture Produk</h3>
			<a target="_blank" class="btn btn-sm btn-success pull-right"  href="modul/lap_reture/cetak_reture.php?tgl=<?php echo $tgl; ?>"><i class="fa fa-print"></i> Cetak</a>
		</div>
		<div class="box-body" style="margin-top: 0;">
			<div class="row" style="margin-top: 0;">
		 		<div class="col-md-4" style="margin-right: 0;">
		 			<label>Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl" value="<?php echo $tgl; ?>">
		 			<button class="btn btn-sm btn-info" style="margin-top: 6px;" id="cari"><i class="fa fa-search"></i> Cari</button>
		 			
		 		</div>
		 	</div>
		 	<h4>Laporan Reture Produk Tanggal <?php echo tgl_indo($tgl); ?></h4>
		 	<div class="table-responsives">
		 		<table class="table table-bordered table-striped datatable">
		 			<thead>
		 				<tr>
		 					<th>Pengirim</th>
		 					<th>Asal Cabang</th>
		 					<th>Jumlah Jenis Produk Yang Direture</th>
		 					<th>Jumlah Total Produk Yang Direture</th>
		 					<th>Pilihan</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php $q = mysql_query("SELECT *FROM reture r JOIN daftar_klinik dk ON r.asal_cabang=dk.id_kk  WHERE r.tanggal='$tgl'"); 
		 					while($d = mysql_fetch_array($q)){ ?>
		 				<tr>
		 					<td><?php echo $d["pengirim"]; ?></td>
		 					<td><?php echo $d["nama_klinik"]; ?></td>
		 					<?php $pp = mysql_fetch_array(mysql_query("SELECT COUNT(kode_produk) AS jenis,SUM(jumlah) AS total FROM produk_reture WHERE no_reture='$d[no_reture]'")); ?>
		 					<td><?php echo $pp["jenis"]; ?></td>
		 					<td><?php echo $pp["total"]; ?></td>

		 					<td><a href="media.php?module=reture&act=detail&nor=<?php echo $d[no_reture]; ?>" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Detail</a></td>
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
  	window.location.href = "media.php?module=lap_reture&tgl="+tgl;
  });

});
</script>