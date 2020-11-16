<?php $act = $_GET['act']; ?>
<section class="content">
	<div class="box box-success">
		<?php switch ($act) {
			case 'detail': ?>
		<div class="box-header">
			<h1 class="box-title">Detail Data Pasca Treatment</h1>
		</div>
		<div class="box-body">
			<?php 
					$no_faktur = $_GET['nofak'];
				 ?>
				<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<?php 
				$pem = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM pembayaran JOIN pasien ON pembayaran.id_pasien=pasien.id_pasien WHERE pembayaran.no_faktur='$no_faktur'"));

				?>
				<div class="row">
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama 
							</div>
							<div class="col-md-6" id="data_n">
								:&emsp;<?php echo $pem['nama_pasien']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No Telp
							</div>
							<div class="col-md-6" id="data_nt">
								:&emsp;<?php echo $pem['no_telp']; ?>	 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Alamat
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['alamat']; ?>	 
								</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Tanggal Lahir
								</div>
								<div class="col-md-6" id="data_tl">
								:&emsp;<?php echo $pem['tgl_lahir']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Pekerjaan
								</div>
								<div class="col-md-6" id="data_jk">
								:&emsp;<?php echo $pem['pekerjaan']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Total Kunjungan
								</div>
								<div class="col-md-6" id="data_tk">
								:&emsp;<?php echo $pem['total_kunjungan']; ?>				 
								</div>
							</div>
					</div>
				</div>
			</div>
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasca Treatment</h4>
				<?php 
				$pc = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM pasca_treatment JOIN pasien ON pasca_treatment.id_pasien=pasien.id_pasien WHERE pasca_treatment.no_faktur='$no_faktur'"));

				?>
				<div class="row">
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama Dokter
							</div>
							<div class="col-md-6" id="data_n">
								<?php $d = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM user WHERE id_user='$pc[id_dr]'")); ?>
								:&emsp;<?php echo $d['nama_lengkap']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Objek
							</div>
							<div class="col-md-6" id="data_n">
								:&emsp;<?php echo $pc['objek']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Subjek
							</div>
							<div class="col-md-6" id="data_nt">
								:&emsp;<?php echo $pc['subjek']; ?>	 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
								Assestment
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pc['assestment']; ?>	 
								</div>
						</div>
					</div>
				</div>
			</div>
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasca Treatment</h4>
				<div class="row">
					<div class="col-md-3" align="center">
						<?php 
						if ($pc['foto1']=="") { ?>
							<img style="width: 100%;" src="../file_user/foto_pasien/kosong.png">
						<?php }else{ ?>
							<a href="../file_user/foto_pasien/<?php echo $pc['foto1']; ?>"><img style="width: 100%;" src="../file_user/foto_pasien/<?php echo $pc['foto1']; ?>"></a>
						<?php }
						?>
						<label>Foto 1</label>
					</div>
					<div class="col-md-3" align="center">
						<?php 
						if ($pc['foto2']=="") { ?>
							<img style="width: 100%;" src="../file_user/foto_pasien/kosong.png">
						<?php }else{ ?>
							<a href="../file_user/foto_pasien/<?php echo $pc['foto2']; ?>"><img style="width: 100%;" src="../file_user/foto_pasien/<?php echo $pc['foto2']; ?>"></a>
						<?php }
						?>
						<label>Foto 2</label>
					</div>
					<div class="col-md-3" align="center">
						<?php 
						if ($pc['foto3']=="") { ?>
							<img style="width: 100%;" src="../file_user/foto_pasien/kosong.png">
						<?php }else{ ?>
							<a href="../file_user/foto_pasien/<?php echo $pc['foto3']; ?>"><img style="width: 100%;" src="../file_user/foto_pasien/<?php echo $pc['foto3']; ?>"></a>
						<?php }
						?>
						<label>Foto 3</label>
					</div>
					<div class="col-md-3" align="center">
						<?php 
						if ($pc['foto4']=="") { ?>
							<img style="width: 100%;" src="../file_user/foto_pasien/kosong.png">
						<?php }else{ ?>
							<a href="../file_user/foto_pasien/<?php echo $pc['foto4']; ?>"><img style="width: 100%;"src="../file_user/foto_pasien/<?php echo $pc['foto4']; ?>"></a>
						<?php }
						?>
						<label>Foto 4</label>
					</div>
				</div>
			</div>
			<hr>
			<h4>Daftar Treatment atau Produk Yang Dibeli</h4>
				<div class="table-responsive">
				<table class="table table-bordered table-bordered datatable">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Jenis</th>
							<th>Ket</th>
							<th>Jumlah Beli</th>
						</tr>
					</thead>
					<tbody>
						<?php $qhk =  mysqli_query($con, "SELECT *FROM history_kasir WHERE no_faktur='$no_faktur'"); 
						while($hk=mysqli_fetch_array($qhk)){ ?>
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
			<h1 class="box-title">History Pasca Treatment</h1>
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
			<div class="table-responsive">
			<table class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama Pasien</th>
						<th>Nama Dokter</th>
						<th>Subjek</th>
						<th>Objek</th>
						<th>Assestment</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php $kuery =  mysqli_query($con, "SELECT *FROM pasca_treatment JOIN pasien ON pasca_treatment.id_pasien=pasien.id_pasien WHERE tanggal='$date' AND pasca_treatment.id_kk='$_SESSION[klinik]'");
						while($data=mysqli_fetch_array($kuery)){ ?>
					<tr>
						<td><?php echo $data['nama_pasien']; ?></td>
						<td>
							<?php 
							$d = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM user WHERE id_user='$data[id_dr]'"));
							echo $d['nama_lengkap'];
							?>
						</td>
						<td><?php echo $data['subjek']; ?></td>
						<td><?php echo $data['objek']; ?></td>
						<td><?php echo $data['assestment']; ?></td>
						<td>
							<a href="media.php?module=history_pc&act=detail&nofak=<?php echo $data['no_faktur']; ?>" class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Detail</a>
						</td>
					</tr>
					<?php	}
					 ?>
					
				</tbody>
			</table>
			</div>
		</div>
		<?php break;
	} ?>
	</div>
</section>