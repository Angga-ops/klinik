<?php    
  switch($_GET['act']){
  default:

?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Laporan Kritik Dan Saran</h4>
		</div>
		<div class="box-body">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-6">
					<form method="POST">
					<table class="table">
						<tbody>
							<tr>
								<td>
								<label>Pilih Klinik</label>
								<select name="klinik" class="form-control" autocomplete="off" style="float: left;text-align: center;">
									<option value="0">Pilih Semua</option>
									<?php
									$q = mysqli_query($con, "SELECT * FROM daftar_klinik");
									while ($data = mysqli_fetch_array($q)) {?>
										<option value="<?php echo $data['id_kk']?>"><?php echo $data['nama_klinik']?></option>
									<?php }?>
								</select>
								</td>

								<td><label>Dari Tanggal</label>
								<input name="tgl1" class="form-control datepicker" autocomplete="off" style="float: left;text-align: center;"></td>

								<td><label>Sampai Tanggal</label>
								<input name="tgl2" class="form-control datepicker" autocomplete="off" style="float: left;text-align: center;"></td>
								<td>
							</tr>
							<tr>
								<td><button type="submit" name="submit" class="btn btn-info">Tmpilkan</button></td></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php 
			$tgl1 = $_POST['tgl1'];
			$tgl2 = $_POST['tgl2'];
			if ($tgl1 == NULL ) {
				echo '
				<div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
				<table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Tanggal</th>
				        <th>Nama</th>
			 	        <th>No Telepon</th>
			            <th>Beauty</th>
				        <th>Kritik Dan Saran</th>
					</tr>	
				</thead>
				<tbody>
				</tbody>
				<tfoot>
					<tr>
						<td></td>
						
					</tr>
				</tfoot>
			</table>';
			}else{
				echo'
				<div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
					<th>Klinik</th>
						<th>Tanggal</th>
				        <th>Nama</th>
			 	        <th>No Telepon</th>
			            <th>Beauty</th>
				        <th>Kritik Dan Saran</th>
					</tr>	
				</thead>
				<tbody>';

						$id_kk = $_POST['klinik'];
						if ($id_kk == 0) {
						    $tgls = "";
							$p = mysqli_query($con, "SELECT *FROM krisar WHERE tanggal between '$_POST[tgl1]' AND '$_POST[tgl2]'"); 
							while($dat=mysqli_fetch_array($p)){
								$q1 = mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$dat[id_kk]'");
											$k = mysqli_fetch_array($q1);
								echo '
										<tr>
											<td>'.
											
											$k['nama_klinik'].'</td>
											<td>'.$dat["tanggal"].'</td>
							                <td>'.$dat["nama"].'</td>
							                <td>'.$dat['no_telp'].'</td>
							                <td>'.$dat['beauty'].'</td>
							                <td>'.$dat['krisar'].'</td>
							                
									</tr>';
									
										if($dat["tanggal"] == $tgls){
											
										}
											else {
												echo "<tr><td colspan = 6 style='background: #00a65a'></td></tr>";
											}
									
											$tgls = $dat["tanggal"];
							}
						}else{
						    $tgls = "";
							$p = mysqli_query($con, "SELECT *FROM krisar WHERE tanggal between '$_POST[tgl1]' AND '$_POST[tgl2]' AND id_kk='$_POST[klinik]'"); 
							while($dat=mysqli_fetch_array($p)){
								$q1 = mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$dat[id_kk]'");
											$k = mysqli_fetch_array($q1);
								echo '
										<tr>
											<td>'.
											
											$k['nama_klinik'].'</td>
											<td>'.$dat["tanggal"].'</td>
							                <td>'.$dat["nama"].'</td>
							                <td>'.$dat['no_telp'].'</td>
							                <td>'.$dat['beauty'].'</td>
							                <td>'.$dat['krisar'].'</td>
							                
									</tr>';
									
										if($dat["tanggal"] == $tgls){
											
										}
											else {
												echo "<tr><td colspan = 6 style='background: #00a65a'></td></tr>";
											}
									
											$tgls = $dat["tanggal"];
							}
						}
						
					'
				</tbody>
				<tfoot>
					<tr>
						<td></td>';
			          $jumlahkan = "SELECT SUM(sub_tot) AS total FROM history_beli_t where tgl_beli='$tgl'"; //perintah untuk menjumlahkan
			          $total =@mysqli_query($con, $jumlahkan) or die (mysqli_error($con));//melakukan query dengan varibel $jumlahkan
			          $t = mysqli_fetch_array($total); //menyimpan hasil query ke variabel $t
			          echo '
						<td></td>
					</tr>
					<a href="modul/laporan_krisar/cetak_krisar.php?tanggal1='.$tgl1.'&tanggal2='.$tgl2.'&id_kk='.$_POST['klinik'].'" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Kritik Dan Saran</a>
				</tfoot>
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

			
					