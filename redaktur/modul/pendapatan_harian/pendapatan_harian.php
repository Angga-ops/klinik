<?php    
  switch($_GET['act']){
  default:
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Laporan Pendapatan Produk Harian</h4>
		</div>
		<div class="box-body">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-6">
					<form method="POST">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input name="tgl" autocomplete="off" class="form-control datepicker" placeholder="jika ingin mencari tanggal lain" style="float: left;text-align: center;">
								</td>
								<td><button type="submit" name="submit" class="btn btn-info">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php 
			$tgl = $_POST['tgl'];
			$harian = date('Y-m-d');
			if ($tgl == NULL AND $harian = date('Y-m-d')) {
				echo '
				
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Nama Produk</th>
				        <th>Jumlah</th>
			 	        <th>Harga produk</th>
			            <th>Tanggal</th>
					</tr>	
				</thead>
				<tbody>';
						$p = mysqli_query($con,"SELECT *FROM history_kasir WHERE tanggal='$harian' AND jenis='Produk'"); 
						while($dat=mysqli_fetch_array($p)){
							echo '
									<tr>
										<td>'.$dat['nama'].'</td>
						                <td>'.$dat["jumlah"].'</td>
						                <td>'.$dat['harga'].'</td>
						                <td>'.$dat['tanggal'].'</td>
						                
								</tr>';
						}
					'
				</tbody>
				<tfoot>
					<tr>
						<td><b>TOTAL</b></td>';
			           $jumlahkan = "SELECT SUM(harga) AS total FROM history_kasir where tanggal='$harian' AND jenis='Produk'"; //perintah untuk menjumlahkan
			          $total =@mysqli_query($con,$jumlahkan) or die (mysqli_error($con));//melakukan query dengan varibel $jumlahkan
			          $t = mysqli_fetch_array($total); //menyimpan hasil query ke variabel $t
			          echo '
						<td><b>'.rupiah($t['total']).'<b></td>
					</tr>
					<a href="modul/pendapatan_harian/cetak_harian.php?tanggal='.$tgl.'" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Pembelian</a>
				</tfoot>
			</table>
                </form>
                
      </div>';
			}else{
				echo'
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Nama Produk</th>
				        <th>Jumlah</th>
			 	        <th>Harga Produk</th>
			            <th>Tanggal</th>
					</tr>	
				</thead>
				<tbody>';
						$p = mysqli_query($con,"SELECT *FROM history_kasir WHERE tanggal='$tgl' AND jenis='Produk'"); 
						while($dat=mysqli_fetch_array($p)){
							echo '
									<tr>
										<td>'.$dat['nama'].'</td>
						                <td>'.$dat["jumlah"].'</td>
						                <td>'.$dat['harga'].'</td>
						                <td>'.$dat['tanggal'].'</td>
								</tr>';
						}
					'
				</tbody>
				<tfoot>
					<tr>
						<td><b>TOTAL</b></td>';
			          $jumlahkan = "SELECT SUM(harga) AS total FROM history_kasir where tanggal='$tgl' AND jenis='Produk'"; //perintah untuk menjumlahkan
			          $total =@mysqli_query($con,$jumlahkan) or die (mysqli_error($con));//melakukan query dengan varibel $jumlahkan
			          $t = mysqli_fetch_array($total); //menyimpan hasil query ke variabel $t
			          echo '
						<td><b>'.rupiah($t['total']).'<b></td>
					</tr>
					<a href="modul/pendapatan_harian/cetak_tanggallain.php?tanggal='.$tgl.'" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Pendapatan</a>
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

			
					