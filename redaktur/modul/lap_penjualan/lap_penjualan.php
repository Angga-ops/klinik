<?php $tgl =  $_GET["tgl"]; 
if(empty($_GET["tgl"])){
	$tgl = date("Y-m-d");
}

$tgl2 = $_GET['tgl2'];
if(empty($_GET["tgl2"])){
	$tgl2 = date("Y-m-d");
}
$cabang = $_GET['cbg'];
if (empty($_GET['cbg'])) {
	$cabang = "semua";
}
$act = $_GET['act'];

switch ($act) {
	case 'detail':
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Detail Penjualan</h3>
		</div>
		<div class="box-body">
			<table>
				<tr>
					<td>Tanggal &emsp;</td>
					<td>:&emsp;<?php echo tgl_indo($tgl); ?> - <?php echo tgl_indo($tgl2); ?></td>
				</tr>
				<tr>
					<td>Cabang Klinik&emsp;</td>
					<td>:&emsp;<?php $t = mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$_GET[id_kk]'")); echo $t['nama_klinik']; ?></td>
				</tr>
				<tr>
					<td><button style="margin-top: 10px;" class="btn btn-info btn-sm" onclick="window.history.back()">Kembali</button> <a class="btn btn-sm btn-success" target="_blank" style="margin-top: 10px;" href="modul/lap_penjualan/cetak_perklinik.php?tgl=<?php echo $tgl; ?>&tgl2=<?php echo $tgl2; ?>&id=<?php echo $t[id_kk] ?>"><i class="fa fa-print"></i> Cetak</a></td>
				</tr>
			</table>
			<h5>Produk Yang Terjual</h5>
			<div class="table-responsives">
				<table class="table table-bordered table-striped datatable">
					<thead>
						<tr>
							<th>Nama Produk</th>
							<th>Jumlah Terjual</th>
							<th>Harga</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $q1 = mysql_query("SELECT *FROM produk WHERE id_kk='$_GET[id_kk]'"); $tot=0;
							while ($pr = mysql_fetch_array($q1)) {
						$q = mysql_query("SELECT *,SUM(jumlah) AS tot_produk FROM history_kasir WHERE id_kk='$_GET[id_kk]' 
							AND tanggal>='$_GET[tgl]' AND tanggal<='$_GET[tgl2]' AND nama='$pr[nama_p]' AND jenis='Produk'");  
							while ($p = mysql_fetch_array($q)) {
								if($pr['nama_p']!=$p['nama']){
									continue;
								}
								?>
						<tr>	
							<td><?php echo $pr['nama_p']; ?></td>
							<td><?php echo $p['tot_produk']; ?></td>
							<td><?php echo rupiah($p['harga']); ?></td>
							<td><?php echo rupiah($p['tot_produk']*$p['harga']); ?></td>
						</tr>
						<?php
						$tot += $p['tot_produk']*$p['harga'];
							}
						}
						?>
					</tbody>
					<tfoot>
						<tr>
							<th colspan="3">Total</th>
							<td><?php echo rupiah($tot); ?></td>
						</tr>
					</tfoot>
				</table>
			</div>
		</div>
	</div>
</section>

<?php
		break;
	
	default:
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Penjualan Produk</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-2">
					<label>Cabang</label>
					<select class="form-control" id="cabang">
						<option value="semua">Semua</option>
						<?php 
							$q1 = mysql_query("SELECT *FROM daftar_klinik"); 
							while($kl = mysql_fetch_array($q1)){ ?>
						<option <?php if ($kl['id_kk']==$cabang): ?>
							selected
						<?php endif ?> value="<?php echo $kl[id_kk]; ?>"><?php echo $kl['nama_klinik']; ?></option>
						<?php	}
						?>
					</select>
					<button class="btn btn-sm btn-info" style="margin-top: 6px;" id="cari"><i class="fa fa-search"></i> Cari</button>
		 			<a class="btn btn-sm btn-success" target="_blank" style="margin-top: 6px;" <?php if ($cabang=='semua') { ?>
		 				href="modul/lap_penjualan/cetak_penjualan.php?tgl=<?php echo $tgl; ?>&tgl2=<?php echo $tgl2; ?>"
		 			<?php }else{ ?>
		 				href="modul/lap_penjualan/cetak_penjualan.php?cbg=<?php echo $cabang; ?>&tgl=<?php echo $tgl; ?>&tgl2=<?php echo $tgl2; ?>"
		 			<?php } ?> ><i class="fa fa-print"></i> Cetak</a>
				</div>
		 		<div class="col-md-2" style="margin-right: 0;">
		 			<label>Dari Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl" value="<?php echo $tgl; ?>">
		 		</div>
		 		<div class="col-md-2">
		 			<label>Sampai Tanggal</label>
		 			<input class="form-control datepicker" type="text" id="tgl2" value="<?php echo $tgl2; ?>">
		 		</div>
		 	</div>
		 	<h4 class="pull-left">Laporan Penjualan Produk</h4><br>
		 	<h5 class="pull-right"> Tanggal <?php echo tgl_indo($tgl); ?> - <?php echo tgl_indo($tgl2); ?></h5><br>
		 	<div class="table-responsives" style="margin-top: 10px">
		 		<table class="table table-bordered table-striped datatable">
		 			<thead>
		 				<tr>
		 					<th>No</th>
		 					<th>Cabang</th>
		 					<th>Jumlah Transaksi</th>
		 					<th>Jumlah Total Produk Yang Terjual</th>
		 					<th>Total Pendapatan</th>
		 					<th>Pilihan</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php 
		 				if ($cabang=='semua') {
		 					$q =  mysql_query("SELECT *FROM daftar_klinik"); 
		 				}else{
		 					$q =  mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$cabang'"); 
		 				}
		 				
		 				$no = 1;
		 					while ($k = mysql_fetch_array($q)) { 
		 						$q2 = mysql_query("SELECT *,SUM(jumlah) AS total , COUNT(nama) AS jenis_p,SUM(jumlah*harga) AS pen FROM history_kasir WHERE id_kk='$k[id_kk]' AND tanggal>='$tgl' AND tanggal<='$tgl2' AND jenis='Produk'");
		 						$p = mysql_fetch_array($q2);
		 							if ($p['jenis_p']==0) {
		 								continue;
		 							}
		 							?>
		 				<tr>
		 					<td><?php echo $no; ?></td>
		 					<td><?php echo $k["nama_klinik"]; ?></td>
		 					<td><?php echo mysql_num_rows(mysql_query("SELECT *FROM pembayaran WHERE id_kk='$k[id_kk]' AND tgl>='$tgl' AND tgl<='$tgl2'")); ?></td>
		 					<td><?php echo $p["total"]; ?></td>
		 					<td><?php echo rupiah($p["pen"]); ?></td>
		 					<td><a href="media.php?module=lap_penjualan_pro&act=detail&id_kk=<?php echo $k[id_kk]; ?>&tgl=<?php echo $tgl; ?>&tgl2=<?php echo $tgl2; ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Detail</a></td>
		 				</tr>
		 					<?php
		 					$no++;
		 						
		 					}
		 				 ?>
		 				
		 			</tbody>
		 		</table>
		 	</div>
		</div>
		</div>
	</div>
</section>
<?php
		break;
}
?>
<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  // tanggal
  $("#cari").click(function(){
  	var tgl  = $("#tgl").val();
  	var tgl2 = $("#tgl2").val();
  	var cbg  = $("#cabang").val();
  	if (cbg=='semua') {
  		window.location.href = "media.php?module=lap_penjualan_pro&tgl="+tgl+"&tgl2="+tgl2;
  	}else{
  		window.location.href = "media.php?module=lap_penjualan_pro&cbg="+cbg+"&tgl="+tgl+"&tgl2="+tgl2;
  	}
  	
  });

});
</script>