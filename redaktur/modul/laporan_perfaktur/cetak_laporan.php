<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");

	setlocale(LC_TIME,"IND");
	setlocale(LC_TIME,"id_ID");
?>
<style>
body,td,th {font-size: 10px}
.table1{
	margin:0 auto;
	border-collapse:collapse;
	background:#FFFFFF;
}
.table1 th{
	border:solid;
	border-width:1px;
	border-color:#000000;
	color:black;
	padding:4px 8px;
}
.table1 td{
	border:solid;
	border-width:1px;
	border-color:#000000;
	padding:4px 8px;
}
#hitam{
	text-align:center;
	background:#333333;
	color:#FFFFFF;
}
#rpt{
	border:solid;
	border-color:#000000;
	border-width:1px;
}
.row:after, .row:before {
	display: table;
	content: " ";
}
.row:after {
	clear: both;
}
.col-md-2 {
    width: 20%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}

</style>
<?php
$harian = date('Y-m-d');
$tgl = $_GET['tanggal'];
$id_kk = isset($_GET['id_kk'])? "AND id_kk='$_GET[id_kk]'" : "";

$idd = mysql_fetch_array(mysql_query("SELECT * FROM daftar_klinik WHERE id_kk='$_GET[id_kk]'"));
	$p = mysql_query("SELECT no_faktur FROM history_kasir WHERE tanggal='$_GET[tanggal]' $id_kk  GROUP BY no_faktur");

	if(is_null($idd["nama_klinik"])){ echo "<center><h3>Semua Cabang</h3></center>"; } else {
?>
<center>
<h3><?php echo $idd[nama_klinik]; ?></h3>
</hr>
<h3><?php echo $idd[alamat]; ?></h3>
	</center> <?php } ?>
<div align="center">
	<h3>Penjualan pada tanggal : <?php echo strftime("%d %B %Y",strtotime($tgl)); ?></h3>
</div>
<div align="center">
	<div align="left"><h4>Produk Yang Terjual</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	    		<th>No Faktur</th>
		        <th>Tanggal</th>
				<th>Pasien</th>
	 	        <th>Nama Produk/Jasa</th>
	            <th>Harga</th>
				<th>Diskon</th>
	            <th>Jumlah</th>
	            <th>Jenis</th>
	            <th>Sub Total</th>
	            <th>Status</th>
			            
	        </tr>
	    </thead>
	    <tbody>
		<?php 
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
	    </tfoot>
	   <!--  -->
    </table>
    <br/>
</div>