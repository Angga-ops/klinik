<?php    
  switch($_GET['act']){
  default:
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">History Pembelian Produk</h4>
		</div>
		<div class="box-body">
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-6">
					<form method="POST">
					    <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Dari Tanggal</label>
								<input name="tgl1" class="form-control datepicker" autocomplete="off" style="float: left;text-align: center;"></td>
								<td><label>Sampai Tanggal</label>
								<input name="tgl2" class="form-control datepicker" autocomplete="off" style="float: left;text-align: center;"></td>
								
							</tr>
							<tr><td><button type="submit" name="submit" class="btn btn-info">Tampilkan</button></td></tr>
						</tbody>
					</table>
				</div>
			</div>
			<?php 
			$tgl1 = $_POST['tgl1'];
			$tgl2 = $_POST['tgl2'];
			if ($tgl1 == NULL ) {
				echo '
				<table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Kode Barang</th>
				        <th>Nama Barang</th>
			 	        <th>Jumlah</th>
			            <th>Harga</th>
				        <th>Diskon</th>
				        <th>Sub Total</th>
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
            <table class="table table-bordered table-striped datatable" id="datatable">
				<thead>
					<tr>
						<th>Kode Barang</th>
				        <th>Nama Barang</th>
			 	        <th>Jumlah</th>
			            <th>Harga</th>
				        <th>Diskon</th>
				        <th>Sub Total</th>
					</tr>	
				</thead>
				<tbody>';
						$p = mysql_query("SELECT *FROM history_beli_t WHERE tgl_beli between '$_POST[tgl1]' AND '$_POST[tgl2]'"); 
						while($dat=mysql_fetch_array($p)){
							echo '
									<tr>
										<td>'.$dat['kd_brg'].'</td>
						                <td>'.$dat["nama_brg"].'</td>
						                <td>'.$dat['jumlah'].'</td>
						                <td>'.rupiah($dat["hrg"]).'</td>
						                <td>'.$dat["diskon"].'%</td>
						                <td>'.rupiah($dat["sub_tot"]).'</td>
								</tr>';
						}
					'
				</tbody>
				<tfoot>
					<tr>
						<td><b>TOTAL</b></td>';
			          $jumlahkan = "SELECT SUM(sub_tot) AS total FROM history_beli_t where tgl_beli between '$_POST[tgl1]' AND '$_POST[tgl2]'"; //perintah untuk menjumlahkan
			          $total =@mysql_query($jumlahkan) or die (mysql_error());//melakukan query dengan varibel $jumlahkan
			          $t = mysql_fetch_array($total); //menyimpan hasil query ke variabel $t
			          echo '
						<td><b>'.rupiah($t['total']).'<b></td>
					</tr>
					<a href="modul/lap_pembelian/cetak_pembelian.php?tgl1='.$tgl1.'&tgl2='.$tgl2.'" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Pembelian</a>
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

			
					