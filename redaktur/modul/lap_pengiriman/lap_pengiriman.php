<?php 
$tgl =  $_GET["tgl"]; 
if(empty($_GET["tgl"])){
	$tgl = date("Y-m-d");
}
$tgl2 = $_GET["tgl2"];
if(empty($_GET["tgl2"])){
	$tgl2 = date("Y-m-d");
}
?>
<section class="content"> 
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Pengiriman Produk</h3>
		</div>
		<div class="box-body">
			<div class="row">
		 		<div class="col-md-2" style="margin-right: 0;">
		 			<label>Dari Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl" value="<?php echo $tgl; ?>">
		 			<button class="btn btn-sm btn-info" style="margin-top: 10px;" id="cari"><i class="fa fa-search"></i> Cari</button>
		 			<a target="_blank" class="btn btn-sm btn-success"  style="margin-top: 10px;" href="modul/lap_pengiriman/cetak_pengiriman.php?tgl=<?php echo $tgl; ?>&tgl2=<?php echo $tgl2; ?>"><i class="fa fa-print"></i> Cetak</a>
		 		</div>
		 		<div class="col-md-2" style="margin-right: 0;">
		 			<label>Ke Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl_2" value="<?php echo $tgl; ?>">
		 		</div>
		 	</div>
		 	<h4 class="pull-left">Laporan Pengiriman Produk </h4><br>
		 	<h5 class="pull-right">Tanggal <?php echo tgl_indo($tgl); ?> - <?php echo tgl_indo($tgl2); ?></h5><br>
		 	<div class="table-responsives" style="margin-top: 10px;">
		 		<table class="table table-bordered table-striped datatable">
		 			<thead>
		 				<tr>
		 					<th>Pengirim</th>
		 					<th>Penerima</th>
		 					<th>Tujuan Cabang</th>
		 					<th>Jumlah Jenis Produk Yang Dikirim</th>
		 					<th>Jumlah Total Produk Yang Dikirim</th>
		 					<th>Pilihan</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php $q = mysqli_query($con, "SELECT *FROM pengiriman p JOIN daftar_klinik dk ON p.cabang=dk.id_kk WHERE p.tanggal>='$tgl' AND p.tanggal<='$tgl2'"); 
		 					while($d = mysqli_fetch_array($q)){ ?>
		 				<tr>
		 					<td><?php echo $d["pengirim"]; ?></td>
		 					<td><?php echo $d["penerima"]; ?></td>
		 					<td><?php echo $d["nama_klinik"]; ?></td>
		 					<?php $pp = mysqli_fetch_array(mysqli_query($con, "SELECT COUNT(kode_produk) AS jenis,SUM(jumlah) AS total FROM produk_pengiriman WHERE no_pengiriman='$d[no_pengiriman]'")); ?>
		 					<td><?php echo $pp["jenis"]; ?></td>
		 					<td><?php echo $pp["total"]; ?></td>

		 					<td><a href="media.php?module=pengiriman&act=detail&nop=<?php echo $d['no_pengiriman']; ?>" class="btn btn-info btn-xs"><i class="fa fa-list"></i> Detail</a></td>
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
  	var tgl2 = $("#tgl_2").val();
  	window.location.href = "media.php?module=lap_pengiriman_pro&tgl="+tgl+"&tgl2="+tgl2;
  });

});
</script>