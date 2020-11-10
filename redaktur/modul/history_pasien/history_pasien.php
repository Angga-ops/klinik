<?php switch ($_GET['d']) {
	case '1': ?>
	<section>
		<div class="box box-success">
			<div class="box-header">
				<h1 class="box-title">Detail Perawatan</h1>
			</div>
			<div class="box-body">
				<?php 
					$tgl = $_GET['tgl'];
					$nu = $_GET['nu'];
					$p = mysql_query("SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE no_urut='$nu' AND history_ap.tanggal_pendaftaran='$tgl'");
 					$pas = mysql_fetch_array($p);
 					// Total
 					$query = mysql_query("SELECT SUM(harga_p) AS jumlah FROM perawatan_pasien WHERE no_urut='$nu' AND tanggal='$tgl'");
 					$total = mysql_fetch_array($query);
 					$total = $total['jumlah'];
 					// End
 					$kk = mysql_query("SELECT *FROM pembayaran WHERE no_urut='$nu' AND tgl='$tgl'");
 					$k = mysql_fetch_array($kk);
				 ?>
				<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tbody>
								<tr>
									<td><label>Nama</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
								</tr>
								<tr>
									<td><label>No Antrian</label></td>
									<td><input class="form-control" type="text" name="no_urut" readonly value="<?php echo $pas['no_urut']; ?>"></td>
								</tr>
								<?php if ($pas['pembayaran']=="Lunas") { ?>
								<tr>
									<td><label>Total Yang Harus Di Bayar</label></td>
									<td><input class="form-control" type="text" name="total" readonly value="<?php echo $total; ?>"></td>
								</tr>
								<tr>
									<td><label>Kembalian</label></td>
									<td><input class="form-control" type="text" name="kembalian" value="<?php echo $k['kembalian']; ?>" readonly></td>
								</tr>
								<?php } ?>
								<tr>
									<td>
										<button type="submit" onclick="window.history.back()" class="btn btn-success btn-sm">Kembali</button>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal Pendaftaran</label></td>
								<td><input class="form-control" type="text" name="tgl" readonly value="<?php echo $pas['tanggal_pendaftaran']; ?>"></td>
							</tr>
							<tr>
								<td><label>Kunjungan Ke</label></td>
								<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['kunjungan_ke']; ?>"></td>
							</tr>
							<tr>
								<td><label>Status Pembayaran</label></td>
								<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['pembayaran']; ?>"></td>
							</tr>
							<?php if($pas['pembayaran']=="Lunas"){ ?>
							<tr>
								<td><label>Uang</label></td>
								<td><input class="form-control" type="text" name="uang" value="<?php echo $k['uang']; ?>" readonly></td>
							</tr>
							<?php } ?>
						</tbody>
					</table>
				</div>
			</div>
			<hr style="margin-top: 0; opacity: 0.5;">
			<h4>Perawatan</h4>
			<table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Perawatan</th>
						<th>Harga</th>
					</tr>	
				</thead>
				<tbody>
					<?php $p = mysql_query("SELECT *FROM perawatan_pasien WHERE no_urut='$nu' AND tanggal='$tgl'"); 
						while($dat=mysql_fetch_array($p)){ ?>
							<tr>
								<td><?php echo $dat['nama_p']; ?></td>
								<td><?php echo $dat['harga_p']; ?></td>
							</tr>
					<?php 	}
					?>
				</tbody>
				<tfoot>
					<tr>
						<td><b>TOTAL</b></td>
						<td><b>Rp <?php echo number_format($total); ?><b></td>
					</tr>
				</tfoot>
			</table>
			</div>
		</div>
	</section>	
	<?php	break;
	
	default: ?>
		<?php $id=$_GET['pp']; 

$pas = mysql_fetch_array(mysql_query("SELECT *FROM pasien WHERE id_pasien='$id'"));

?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="box-title">History Pasien</h1>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tbody>
								<tr>
									<td><label>Nama</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
								</tr>
								<tr>
									<td><label>Alamat</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['alamat']; ?>"></td>
								</tr>
								<tr>
									<td><label>Jenis Kelamin</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['jk']; ?>"></td>
								</tr>
								<tr>
									<td><label>Nomor Hp/Telp</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['no_telp']; ?>"></td>
								</tr>
								<tr>
									<td>
										<button type="submit" onclick="window.history.back()" class="btn btn-success btn-sm">Kembali</button>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal Lahir</label></td>
								<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['tgl_lahir']; ?>"></td>
							</tr>
							<tr>
								<td><label>Umur</label></td>
								<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['umur']; ?>"></td>
								</tr>
							<tr>
								<td><label>Tanggal Pertama Berkunjung</label></td>
								<td><input class="form-control" type="text" name="tgl" readonly value="<?php $tgl = new datetime($pas['tgl_pendaftaran']); 
								echo $tgl->format("Y-m-d"); ?>"></td>
							</tr>
							<tr>
								<td><label>Total Kunjungan</label></td>
								<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['total_kunjungan']; ?>"></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<hr style="margin-top: 0; opacity: 0.5;">
			<h4>History Transaksi</h4>
			<table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Kunjungan Ke</th>
						<th>Tanggal Transaksi</th>
						<th>Nomor Antrian</th>
						<th>Status Pembayaran</th>
						<th>Pilihan</th>
					</tr>	
				</thead>
				<tbody>
					<?php $p = mysql_query("SELECT *FROM history_ap WHERE id_pasien='$id' ORDER BY tanggal_pendaftaran DESC"); 
						while($dat=mysql_fetch_array($p)){ ?>
							<tr>
								<td><?php echo $dat['kunjungan_ke']; ?></td>
								<td><?php echo $dat['tanggal_pendaftaran']; ?></td>
								<td><?php echo $dat['no_urut']; ?></td>
								<td><?php echo $dat['pembayaran']; ?></td>
								<td>
									<a href="media.php?module=history_pasien&tgl=<?php echo $dat['tanggal_pendaftaran']; ?>&nu=<?php echo $dat['no_urut']; ?>&d=1" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Detail</a>
								</td>
							</tr>
					<?php 	}
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?php	break;
} ?>