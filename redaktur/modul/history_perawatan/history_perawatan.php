<?php $act = $_GET['act']; ?>
<section class="content">
	<div class="box box-success">
		<?php switch ($act) {
			case 'detail': ?>
		<div class="box-header">
			<h1 class="box-title">Detail Perawatan</h1>
		</div>
		<div class="box-body">
			<?php 
					$tgl = $_GET['tgl'];
					$nu = $_GET['nu'];
					$p = mysql_query("SELECT *,history_ap.tanggal_pendaftaran AS tanggal FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE no_urut='$nu' AND history_ap.id_kk='$id_kk' AND history_ap.tanggal_pendaftaran='$tgl'");
 					$pas = mysql_fetch_array($p);
 					// Total
 					
 					$kk = mysql_query("SELECT *FROM pembayaran WHERE no_faktur='$pas[no_faktur]'");
 					$k = mysql_fetch_array($kk);
 					$no_faktur = $k['no_faktur'];
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
								<tr>
								<td>
									<a href="#" onclick="window.history.back()" class="btn btn-primary btn-sm">Kembali</a>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal Perawatan</label></td>
								<td><input class="form-control" type="text" name="tgl" readonly value="<?php echo $pas['tanggal']; ?>"></td>
							</tr>
							<tr>
									<td>
										<div class="checkbox">
											<label>
											<input <?php if ($pas["konsultasi"]=="Yes"): ?>
												checked="TRUE"								
											<?php endif ?> type="checkbox" name="konsultasi" value="Yes">
											Konsultasi</label>
										</div>
									</td>
								</tr>
							
						</tbody>
					</table>
				</div>
			</div><hr>
			<h4>Daftar Treatment atau Produk Yang Dibeli</h4>
					<div class="table-responsive">
				<table class="table table-bordered table-bordered datatable">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Jenis</th>
							<th>Ket</th>
							<th>Jumlah Beli</th>
							<th>Harga</th>
						</tr>
					</thead>
					<tbody>
						<?php $qhk =  mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$no_faktur'"); 
						while($hk=mysql_fetch_array($qhk)){ ?>
						<tr>
							<td><?php echo $hk['nama']; ?></td>
							<td><?php echo $hk['jenis']; ?></td>
							<td>
								<?php if($hk['ket']=="Input Dokter"){ ?>
									<?php echo $hk['jenis']; ?>
							<?php }else{ ?>
								Input Kasir
						<?php } ?>
							</td>
							<td><?php echo $hk['jumlah']; ?></td>
							<td><?php echo rupiah($hk['harga']); ?></td>
						</tr>	
						<?php
						}
						?>
						
					</tbody>
				</table>
			</div>
			
		</div>
			<?php	break;
			default:
				?>
		<div class="box-header">
			<h1 class="box-title">History Perawatan</h1>
		</div>
		<div class="box-body">
			<?php 
			$date = $_GET['tgl'];
			if(empty($date)){
				$date = date("Y-m-d");
			}	
			?>
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-3">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input id="tanggal_hp" class="form-control datepicker" value="<?php echo $date; ?>" style="float: left;text-align: center;"></td>
								<td><button id="cari_hp" class="btn btn-info">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<table class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama Pasien</th>
						<th>No Antrian</th>
						<th>Status Pembayaran</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php $kuery =  mysql_query("SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE tanggal_pendaftaran='$date' AND history_ap.id_kk='$id_kk'");
						while($data=mysql_fetch_array($kuery)){ ?>
					<tr>
						<td><?php echo $data['nama_pasien']; ?></td>
						<td><?php echo $data['no_urut']; ?></td>
						<td><?php echo $data['pembayaran']; ?></td>
						<td>
							<a href="media.php?module=history_p&act=detail&tgl=<?php echo $data['tanggal_pendaftaran']; ?>&nu=<?php echo $data['no_urut']; ?>" class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Detail</a>
						</td>
					</tr>
					<?php	}
					 ?>
					
				</tbody>
			</table>
		</div>
		<?php break;
	} ?>
	</div>
</section>