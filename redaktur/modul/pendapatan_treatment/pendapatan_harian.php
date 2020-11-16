<?php    
  switch($_GET['act']){
  default:
  $id_kk = $_SESSION['klinik'];
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Laporan Pendapatan Treatment Harian</h4>
		</div>
		<div class="box-body">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-6">
					<form method="POST">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input name="tgl" class="form-control datepicker" autocomplete="off" placeholder="jika ingin mencari tanggal lain" style="float: left;text-align: center;">
								</td>
								<td><button type="submit" name="submit" class="btn btn-info">Cari</button>
									<?php $id_kk = $_SESSION['klinik']; ?>
			<?php $t = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'")); ?>
									<a class="btn btn-sm btn-success pull-right" target="_blank"  href="modul/pendapatan_treatment/cetak_harian.php?tgl=<?php echo $_POST['tgl']; ?>&id=<?php echo $t['id_kk'] ?>"><i class="fa fa-print"></i> Cetak</a></td>

							</tr>
						</tbody>
					</table>
				</div>
			</div>
            <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
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
						<?php $q1 = mysqli_query($con,"SELECT *FROM treatment"); $tot=0;
							while ($pr = mysqli_fetch_array($q1)) {
						$q = mysqli_query($con,"SELECT *,SUM(jumlah) AS tot_produk FROM history_kasir WHERE id_kk='$id_kk' AND tanggal='$_POST[tgl]' AND nama='$pr[nama_t]' AND jenis='Treatment'");  
							while ($p = mysqli_fetch_array($q)) {
								if($pr['nama_t']!=$p['nama']){
									continue;
								}
								?>
						<tr>	
							<td><?php echo $pr['nama_t']; ?></td>
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
		</form>
	</div>

<?php
  break;
  }
?>

			
					