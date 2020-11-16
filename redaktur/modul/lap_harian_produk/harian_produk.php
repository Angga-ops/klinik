<?php 

if ($_SESSION['jenis_u']=="JU-01") {

	$klinik =  $_GET["klinik"];

	if (empty($_GET['klinik'])) {
	$klinik = 1;
	}

}else{
	$klinik = $_SESSION['klinik'];
}



if(empty($_GET["tgl"])){
	$tgl = date("Y-m-d");
}



?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title pull-left">Laporan Harian Produk</h3>
			<a class="btn btn-sm btn-success pull-right" href="modul/lap_harian_produk/cetak_hp.php?klinik=<?php echo $klinik; ?>"><i class="fa fa-print"></i> Cetak</a>
		</div>
		<div class="box-body">
			<?php if ($_SESSION['jenis_u']!="JU-01") { ?>
				<input type="hidden" id="klinik" value="<?php echo $klinik; ?>">
			<?php
			}
			?>
			 <?php if ($_SESSION['jenis_u']=="JU-01") { ?> 
			<div class="row">
		 		<div class="col-md-4" style="margin-right: 0;">
		 			<label>Klinik</label>
		 			<select class="form-control" id="klinik">
		 				<?php $qk = mysqli_query($con, "SELECT *FROM daftar_klinik"); 
		 					while($k=mysqli_fetch_array($qk)){ ?>
		 						<option <?php if ($k['id_kk']==$klinik): ?>
		 							selected
		 						<?php endif ?> value="<?php echo $k['id_kk'];?>"><?php echo $k['nama_klinik'];?></option>
		 				<?php
							}
		 				?>
		 			</select>
		 			<button class="btn btn-sm btn-info" style="margin-top: 6px;" id="cari"><i class="fa fa-search"></i> Cari</button>
		 		</div>
		 	</div>
		 	<h4 style="margin-top: 0;">Laporan Harian Produk Klinik 
		 		<?php $kk=mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$klinik'")); 
		 		echo $kk['nama_klinik'] ?>
		 	</h4>
			<?php } ?> 
		 	<div class="table-responsives">
		 		<table class="table table-bordered table-striped datatable2">
		 			<thead>
		 				<tr>
		 					<th>Tanggal</th>
		 					<th>nama Produk</th>
		 					<th>Stok Awal</th>
		 					<th>(+)</th>
		 					<th>(-)</th>
		 					<th>Stok Sisa</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php 
		 				$qp = mysqli_query($con, "SELECT *FROM produk WHERE id_kk='$klinik'"); 
		 				while($p = mysqli_fetch_array($qp)){
		 					$qhk = mysqli_query($con, "SELECT SUM(jumlah) AS total_p FROM history_kasir WHERE nama='$p[nama_p]' AND tanggal='$tgl' AND jenis='Produk'");
		 					$qpp = mysqli_query($con, "SELECT *FROM pengiriman p 
		 						JOIN produk_pengiriman pp ON  p.no_pengiriman=pp.no_pengiriman
		 						WHERE p.tanggal='$tgl' AND pp.kode_produk='$p[kode_produk]'");

		 					$hk = mysqli_fetch_array($qhk);
		 					$pp  = mysqli_fetch_array($qpp);
		 					?>
		 				<tr>
		 					<td><?php echo $tgl;?></td>
		 					<td><?php echo $p['nama_p']; ?></td>
		 					<td><?php echo $p['jumlah']-$pp['jumlah_diterima']+$hk['total_p']; ?></td>
		 					<td>
		 						<?php if ($pp['jumlah_diterima']=="") {
		 							echo "0";
		 						}else {
		 							echo $pp['jumlah_diterima'];
		 						}   ?>
		 					</td>
		 					<td>
		 						<?php 
		 						if ($hk['total_p']=="") {
		 							echo "0";
		 						}else{
		 							echo $hk['total_p'];
		 						}
		 						?>
		 					</td>
		 					<td><?php echo $p['jumlah']; ?></td>
		 				</tr>
		 				<?php
		 				}
		 				?>
		 			</tbody>
		 		</table>
		 	</div>
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
  	var klinik = $("#klinik").val();
  	window.location.href = "media.php?module=harian_produk&klinik="+klinik;
  });

});
</script>