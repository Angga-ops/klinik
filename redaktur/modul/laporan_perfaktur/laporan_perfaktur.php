<?php    
  switch($_GET['act']){
  default:
  $id_kk = $_SESSION['klinik'];
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Laporan Pendapatan Perfaktur</h4>
		</div>
		<div class="box-body">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-6">
					<form method="POST">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input name="tgl" class="form-control datepicker" placeholder="jika ingin mencari tanggal lain" style="float: left;text-align: center;" autocomplete="off"></td>
								<td><label>Klinik</label></td>
								<td><select name="klinik" class="form-control" autocomplete="off" style="float: left;text-align: center;">
                        <option value="0">Pilih Semua</option>
                        <?php
                        $q = mysql_query("SELECT * FROM daftar_klinik");
                        while ($data = mysql_fetch_array($q)) {?>
                          <option value="<?php echo $data['id_kk']?>"><?php echo $data['nama_klinik']?></option>
                        <?php }?>
                      </select>
								</td>
								<td><button type="submit" name="submit" class="btn btn-info">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php 
			$tgl = isset($_POST['tgl'])? $_POST['tgl'] : date('Y-m-d') ;
			$klinik = isset($_POST['klinik'])? $_POST['klinik'] : 0;
			
			if ($klinik == 0) {
				echo '
				<div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>No Faktur</th>
						<th>Tanggal</th>
						<th>Nama Pasien</th>
			 	        <th>Nama Produk/Jasa</th>
						 <th>Harga</th>
						 <th>Diskon</th>
			            <th>Jumlah</th>
			            <th>Jenis</th>
			            <th>Sub Total</th>
			            <th>Status</th>
			            
					</tr>	
				</thead>
				<tbody>';
						$p = mysql_query("SELECT *FROM history_kasir WHERE tanggal='$tgl' GROUP BY no_faktur"); 

						$no =1;
						$cap = array();
						$total = 0;
						while ($brs = mysql_fetch_array($p)) { 
				
							array_push($cap,$brs[no_faktur]);
								
							} 
				
				
							foreach($cap as $k => $v){
								$s = mysql_query("SELECT * FROM history_kasir WHERE no_faktur = '$v'");
								$subt = 0;
								while($br = mysql_fetch_assoc($s)){
									$subtotal = $br['sub_total'];
								//	$subtotal= $br['harga']*$br['jumlah']; 
									$subt = $subt + $subtotal;
				
									
				$cust = mysql_fetch_assoc(mysql_query("SELECT * FROM pasien WHERE id_pasien = '$br[id_pasien]'"));
				$disc = ($br['diskon'] == 0)? 0 : ($br['diskon']/100*$br['harga']);
				
									?>
				
				<tr>
							 
							  <td><?php echo $br['no_faktur']; ?></td>
							  <td><?php echo strftime("%d %B %Y",strtotime($br['tanggal'])); ?></td>
							  <td><?php echo $cust['nama_pasien']; ?></td>
							  <td><?php echo $br['nama']; ?></td>
							  <td>Rp <?php echo number_format($br['harga'],0,",","."); ?></td>
							  <td>Rp <?php echo number_format($disc,0,",","."); ?></td>
							  <td><?php echo $br['jumlah']; ?></td>
							  <td><?php echo $br['jenis']; ?></td>
							  <td>Rp <?php echo number_format($subtotal,0,",","."); ?></td>
							  <td><?php echo $br['status']; ?></td>
							  
							</tr>
				
									<?php
								} 
								
					$ong = mysql_fetch_assoc(mysql_query("SELECT uang_ongkir AS kir FROM pembayaran WHERE no_faktur = '$v'"));	
					$ongkirs = is_null($ong['kir']) || $ong['kir'] == ""? 0 : $ong['kir'];
								?>
				
				</tr>
							<tr><td><strong>Ongkir</strong></td><td colspan=9>Rp <?php echo number_format($ongkirs,0,",","."); ?></td></tr>
							<tr><td><strong>Subtotal</strong></td><td colspan=9>Rp <?php echo number_format($subt + $ongkirs,0,",","."); ?></td></tr>
				
								<?php $total = $total + ($subt + $ongkirs);	}     ?>
						</tbody>
						<tfoot>
							<tr>
								<td>TOTAL</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<?php
									  echo '<td>-</td>
				
										<td><b>'.rupiah($total).'<b></td>';?>
							</tr>
								
								<?php
								echo '
								</tfoot>
								<a href="modul/laporan_perfaktur/cetak_laporan.php?tanggal='.$tgl.'"  target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Laporan</a>
			</table>
                </form>
                
      </div>';
			}else{
				echo'
				<div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>No Faktur</th>
						<th>Tanggal</th>
						<th>Nama Pasien</th>
			 	        <th>Nama Produk/Jasa</th>
						 <th>Harga</th>
						 <th>Diskon</th>
			            <th>Jumlah</th>
			            <th>Jenis</th>
			            <th>Sub Total</th>
			            <th>Status</th>
			            
					</tr>	
				</thead>
				<tbody>';
						$p = mysql_query("SELECT *FROM history_kasir WHERE tanggal='$tgl' AND id_kk = '$klinik' GROUP BY no_faktur");
						$no =1;
						$cap = array();
						$total = 0;
						while ($brs = mysql_fetch_array($p)) { 
				
							array_push($cap,$brs[no_faktur]);
								
							} 
				
				
							foreach($cap as $k => $v){
								$s = mysql_query("SELECT * FROM history_kasir WHERE no_faktur = '$v'");
								$subt = 0;
								while($br = mysql_fetch_assoc($s)){
									$subtotal = $br['sub_total'];
								//	$subtotal= $br['harga']*$br['jumlah']; 
									$subt = $subt + $subtotal;
				
									
				$cust = mysql_fetch_assoc(mysql_query("SELECT * FROM pasien WHERE id_pasien = '$br[id_pasien]'"));
				$disc = ($br['diskon'] == 0)? 0 : ($br['diskon']/100*$br['harga']);
				
									?>
				
				<tr>
							 
							  <td><?php echo $br['no_faktur']; ?></td>
							  <td><?php echo strftime("%d %B %Y",strtotime($br['tanggal'])); ?></td>
							  <td><?php echo $cust['nama_pasien']; ?></td>
							  <td><?php echo $br['nama']; ?></td>
							  <td>Rp <?php echo number_format($br['harga'],0,",","."); ?></td>
							  <td>Rp <?php echo number_format($disc,0,",","."); ?></td>
							  <td><?php echo $br['jumlah']; ?></td>
							  <td><?php echo $br['jenis']; ?></td>
							  <td>Rp <?php echo number_format($subtotal,0,",","."); ?></td>
							  <td><?php echo $br['status']; ?></td>
							  
							</tr>
				
									<?php
								} 
								
					$ong = mysql_fetch_assoc(mysql_query("SELECT uang_ongkir AS kir FROM pembayaran WHERE no_faktur = '$v'"));	
					$ongkirs = is_null($ong['kir']) || $ong['kir'] == ""? 0 : $ong['kir'];
								?>
				
				</tr>
							<tr><td><strong>Ongkir</strong></td><td colspan=9>Rp <?php echo number_format($ongkirs,0,",","."); ?></td></tr>
							<tr><td><strong>Subtotal</strong></td><td colspan=9>Rp <?php echo number_format($subt + $ongkirs,0,",","."); ?></td></tr>
				
								<?php $total = $total + ($subt + $ongkirs);	}     ?>
						</tbody>
						<tfoot>
							<tr>
								<td>TOTAL</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<td>-</td>
								<?php
									  echo '<td>-</td>
				
										<td><b>'.rupiah($total).'<b></td>';?>
							</tr>
								
								<?php
								echo '
								</tfoot>
								<a href="modul/laporan_perfaktur/cetak_laporan.php?tanggal='.$tgl.'&id_kk='.$klinik.'"  target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Laporan</a>
			</table>
                </form>
                
      </div>';}?>
      </div>
  </div>
</section>

<?php
  break;
  }
?>

			
					