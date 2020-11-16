<?php 

$tgl = $_GET['tgl'];
if (empty($_GET['tgl'])) {
	$tgl = date("Y-m-d");
}

?>
<section class="content">
	<div class="box box-success">
		<?php $id_kk = $_SESSION['klinik']; ?>
			<?php $t = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'")); ?>
		<div class="box-header">
			<h3 class="box-title pull-left">Penjualan Produk Klinik <?php echo $t['nama_klinik']; ?></h3><a class="btn btn-sm btn-success pull-right" target="_blank"  href="modul/lap_penjualan_cab/cetak.php?tgl=<?php echo $tgl; ?>&id=<?php echo $t['id_kk'] ?>"><i class="fa fa-print"></i> Cetak</a>
		</div>
		<div class="box-body">
			<label>Tanggal</label>
			<div class="row">
				<div class="col-md-6">
					<input class="form-control datepicker" type="text" name="tgl" id="tgl" value="<?php echo $tgl; ?>">
				</div>
			</div>
			<button style="margin-top: 10px;" class="btn btn-info btn-sm" onclick="window.history.back()">Kembali</button>
			<button style="margin-top: 10px;" class="btn btn-success btn-sm" id="cari"><i class="fa fa-search"></i> Cari</button>
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
						<?php $q1 = mysqli_query($con, "SELECT * FROM produk WHERE id_kk='$id_kk'"); $tot=0;
							while ($pr = mysqli_fetch_array($q1)) {
						$q = mysqli_query($con, "SELECT *,SUM(jumlah) AS tot_produk FROM history_kasir WHERE id_kk='$id_kk' AND tanggal='$tgl' AND nama='$pr[nama_p]' AND jenis='Produk'");  
							while ($p = mysqli_fetch_array($q)) {
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
  	window.location.href = "media.php?module=penpro_cab&tgl="+tgl;
  });

});
</script>