<section class="content-header">
    <h1>
    	Reseptionis
    </h1>
    <ol class="breadcrumb">
       <li><a href="media.php?module=home"><i class="fa fa-home"></i> Home</a></li>
       <li><a href="#">Pembayaran</a></li>
    </ol>
</section>
<?php 
$act = $_GET['act']; 
$id_kk = $_SESSION['klinik'];
$daten = date("Y-m-d");
$tgl = $_GET['tgl'];
?>
<section class="content">
			<?php 
				switch ($act) {
					case 'bayar': ?>
						<?php
						$tgl = $_GET['tgl'];
								$nu = $_GET['nu'];
								$p = mysqli_query($con,"SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE no_urut='$nu' AND history_ap.tanggal_pendaftaran='$tgl'");
			 					$pas = mysqli_fetch_array($p);
			 					// Total
			 					$query = mysqli_query($con,"SELECT SUM(harga_p) AS jumlah FROM perawatan_pasien WHERE no_urut='$nu' AND tanggal='$tgl'");
			 					$query2 = mysqli_query($con,"SELECT *FROM produk_pasien WHERE no_urut='$nu' AND tanggal='$tgl'");
			 					while ($tot1 = mysqli_fetch_array($query2)) {
			 						$totalpr += $tot1['harga_pr']*$tot1['jumlah'];
			 					}
			 					
			 					$tot = mysqli_fetch_array($query);
			 					$totalp  = $tot['jumlah'];
			 					
			 					$total = $totalp + $totalpr; 
			 					// End 
							 ?>
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Pembayaran</h4>
		</div>
		<div class="box-body">
							<div class="row">
								<form id="form_bayar">
									<input type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
									<div class="col-md-6">
										<table class="table">
											<tbody>
													<?php $nofak = date("YmdHis"); ?>
													<tr>
														<td><label>No.Faktur</label></td>
														<td><input class="form-control" type="number" name="nofak" value="<?php echo $nofak; ?>"></td>
													</tr>
													<tr>
														<td><label>Nama</label></td>
														<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
													</tr>
													<tr>
														<td><label>No Antrian</label></td>
														<td><input id="nourut_ht" class="form-control" type="text" name="no_urut" readonly value="<?php echo $pas['no_urut']; ?>"></td>
													</tr>
													<tr>
														<td><label>Total Yang Harus Di Bayar</label></td>
														<td><input class="form-control" type="text" name="total" readonly value="<?php echo $total; ?>"></td>
													</tr>
													<tr>
														<td><label>Kembalian</label></td>
														<td><input class="form-control" type="text" name="kembalian" id="kembalian" readonly></td>
													</tr>
													<tr>
														<td>
															<a href="#" onclick="window.history.back()" class="btn btn-primary btn-sm">Kembali</a>
															<button id="btn_bayar" type="submit" class="btn btn-success btn-sm">Bayar</button>
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
													<td><input class="form-control" type="text" id="tgl_ht" name="tgl" readonly value="<?php echo $pas['tanggal_pendaftaran']; ?>"></td>
												</tr>
												<tr>
													<td><label>Status Pembayaran</label></td>
													<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['pembayaran']; ?>"></td>
												</tr>
												<tr>
													<td><label>Uang</label></td>
													<td><input class="form-control" type="text" id="uang_ht" name="uang"></td>
												</tr>
												<tr>
													<td><label>Metode Pembayaran</label></td>
													<td>
														<select name="metode" class="form-control">
															<option value="Tunai">Tunai</option>
															<option value="Transfer">Transfer</option>
														</select>
													</td>
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
							</form>
						</div>
						<hr style="margin-top: 0; opacity: 0.5;">
						<div class="row">
							<div class="col-md-6">
								<h4>Perawatan</h4>
								<div class="table-responsive">
								<table class="table table-bordered table-striped datatable" id="datatable">
									<thead>
										<tr>
											<th>Perawatan</th>
											<th>Harga</th>
										</tr>	
									</thead>
									<tbody>
										<?php $p = mysqli_query($con,"SELECT *FROM perawatan_pasien WHERE no_urut='$nu' AND tanggal='$tgl' AND id_kk='$id_kk'"); 
											while($dat=mysqli_fetch_array($p)){ ?>
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
											<td><b>Rp <?php echo number_format($totalp); ?><b></td>
										</tr>
									</tfoot>
								</table>
								</div>
							</div>
							<div class="col-md-6">
								<h4>Produk</h4>
								<div class="table-responsive">
								<table class="table table-bordered table-striped datatable" id="datatable">
									<thead>
										<tr>
											<th>Produk</th>
											<th>Harga</th>
											<th>Jumlah</th>
											<th>Sub Total</th>
										</tr>	
									</thead>
									<tbody>
										<?php $p = mysqli_query($con,"SELECT *FROM produk_pasien WHERE no_urut='$nu' AND tanggal='$tgl' AND id_kk='$id_kk'"); 
											while($dat=mysqli_fetch_array($p)){ ?>
												<tr>
													<td><?php echo $dat['nama_pr']; ?></td>
													<td><?php echo $dat['harga_pr']; ?></td>
													<td><?php echo $dat['jumlah']; ?></td>
													<td><?php echo $dat['harga_pr']*$dat['jumlah']; ?></td>
												</tr>
										<?php 	}
										?>
									</tbody>
									<tfoot>
										<tr>
											<td colspan="3"><b>TOTAL</b></td>
											<td><b>Rp <?php echo number_format($totalpr); ?><b></td>
										</tr>
									</tfoot>
								</table>
								</div>
							</div>
						</div>
					</div>
				</div>
					<?php break;
					
					default: ?>
					<div class="callout callout-success">
				     <h4>DAFTAR ANTRIAN PEMBAYARAN PASIEN</h4>
				    </div>
					<div class="row">
					<!--<div class="col-md-4">
							<div class="box box-success">
				            <div class="box-header">
				              <h3 class="box-title">Antrian Pembayaran Layanan Laboratorium/Apotek</h3>
				            </div>
				            <!-- /.box-header -->
				            <!--<div class="box-body">
				                <div class="table-responsive">
							    <table class="table table-bordered table-striped datatable">            
							      <thead>
							        <tr>
							            <th>Nama Pasien</th>
							            <th>Nomor Antrian</th>
							            <th>Pilihan</th>
							        </tr>
							      </thead>
							      <tbody>
								  <?php 
			              $appp = mysqli_query($con,"SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE pembayaran = 'Belum Lunas' AND jenis_layanan IN ('lab','apotek') AND tanggal_pendaftaran='$daten' ORDER BY history_ap.no_urut ASC");
			              while($iii = mysqli_fetch_array($appp)){ ?>
			               
			              <tr>
			                <td><?php echo $iii['nama_pasien']; ?></td>
			                <td><?php echo $iii['no_urut']; ?></td>
			                  <td>
			                    <a href="media.php?module=history_transaksi&layan=lab&act=bayar&nofak=<?php echo $iii['no_faktur']; ?>" class="btn btn-xs btn-primary">Bayar</a>
			                  </td>
			              </tr>
			              <?php }
			              ?>							        
							      </tbody>
							    </table>
							    </div>
							     </div>
							    </div>
						</div>-->
						<div class="col-md-6">
							<div class="box box-success">
				            <div class="box-header">
				              <h3 class="box-title">Antrian Pembayaran Pasien Rawat Inap</h3>
				            </div>
				            <!-- /.box-header -->
				            <div class="box-body">
				                <div class="table-responsive">
							    <table class="table table-bordered table-striped datatable">            
							      <thead>
							        <tr>
							            <th>Nama Pasien</th>
							            <th>Ruang Perawatan</th>
							            <th>Pilihan</th>
							        </tr>
							      </thead>
							      <tbody>
								  <?php 
			              //$appp = mysql_query("SELECT * FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien JOIN pembayaran ON pembayaran.no_faktur=perawatan_pasien.no_faktur WHERE perawatan_pasien.tgl_out='$daten' AND pembayaran.status is NULL ORDER BY perawatan_pasien.id ASC");
			               $appp = mysqli_query($con,"SELECT * FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE tgl_out='$daten' ORDER BY perawatan_pasien.id ASC");
			              while($iii = mysqli_fetch_array($appp)){ 
							 $bang = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_ruangan AS sal FROM ruangan WHERE id = $iii[id_ruang]")); 
							 $check = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$iii[no_faktur]' AND status='Belum Lunas'");
							 $total1 =0;
								while ($ks1=mysqli_fetch_array($check)) {
									$total1 += $ks1['sub_total'];
								}
								if($total1 != 0){
							  ?>
			               
			              <tr>
			                <td><?php echo $iii['nama_pasien']; ?></td>
			                <td><?php echo $bang['sal']; ?></td>
			                  <td>
			                    <a href="media.php?module=history_transaksi&layan=inap&act=bayar&nofak=<?php echo $iii['no_faktur']; ?>" class="btn btn-xs btn-primary">Bayar</a>
			                  </td>
			              </tr>
			              <?php 
			              		}
			          		}
			              ?>									        
							      </tbody>
							    </table>
							    </div>
							     </div>
							    </div>
						</div>
						<div class="col-md-6">
							<div class="box box-success">
			                  <div class="box-header">
			                    <h3 class="box-title">Antrian Pembayaran Pasien Poliklinik/IGD</h3>
			                  </div>
			                  <!-- /.box-header -->
			                  <div class="box-body">
			           <div class="table-responsive">      
			          <table class="table table-bordered table-striped datatable">            
			            <thead>
			              <tr>
			                  <th>Nama Pasien</th>
			                  <th>Nomor Antrian</th>
			                  <th>Pilihan</th>
			              </tr>
			            </thead>
			            <tbody>
			              <?php 
			              $appp = mysqli_query($con,"SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE pembayaran = 'Belum Lunas' AND jenis_layanan IN ('poliklinik','igd') AND tanggal_pendaftaran='$daten' ORDER BY history_ap.no_urut ASC");
			              while($iii = mysqli_fetch_array($appp)){ ?>
			               
			              <tr>
			                <td><?php echo $iii['nama_pasien']; ?></td>
			                <td><?php echo $iii['no_urut']; ?></td>
			                  <td>
			                    <a href="media.php?module=history_transaksi&layan=jalan&act=bayar&nofak=<?php echo $iii['no_faktur']; ?>" class="btn btn-xs btn-primary">Bayar</a>
			                  </td>
			              </tr>
			              <?php }
			              ?>
			              
			            </tbody>
			          </table>
			          </div>
			           </div>
			          </div>
						</div>
					</div>
						
					<?php break;
				}
			?>
</section>