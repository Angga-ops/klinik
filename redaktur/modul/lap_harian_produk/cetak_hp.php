<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");
?>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
<style>
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
    width: 15%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}
<?php 
	$klinik = $_GET['klinik'];
	$tgl    = date("Y-m-d");
	$date1   = new DateTime($tgl);
	$date2   = new DateTime($tgl);
	$date3   = new DateTime($tgl);
	$date4   = new DateTime($tgl);
	$date5   = new DateTime($tgl);

	$date1	= $date1->modify('+0 day');
	$date2	= $date2->modify('-1 day');
	$date3	= $date3->modify('-2 day');
	$date4	= $date4->modify('-3 day');
	$date5	= $date5->modify('-4 day');
	$hari = array();
	$a1 = $date1->format('Y-m-d');
	$hari[] = $a1;
	$a2 = $date2->format('Y-m-d');
	$hari[] = $a2;
	$a3 = $date3->format('Y-m-d');
	$hari[] = $a3;
	$a4 = $date4->format('Y-m-d');
	$hari[] = $a4;
	$a5 = $date5->format('Y-m-d');
	$hari[] = $a5;

?>

</style>
<div align="left">
	<h2>Laporan Harian Produk</h2>
</div>
<br>
<div align="center">
	<table width="100%" class="table1">
		<thead>
	      <tr>
	        <th rowspan="3">No</th>
	        <th rowspan="3">Nama Barang</th>
	        <th colspan="16">Tanggal</th>
	      </tr>
	      <tr>
	      	<th colspan="4"><?php echo $date5->format('d-m-Y'); ?></th>
	      	<th colspan="3"><?php echo $date4->format('d-m-Y'); ?></th>
	      	<th colspan="3"><?php echo $date3->format('d-m-Y'); ?></th>
	      	<th colspan="3"><?php echo $date2->format('d-m-Y'); ?></th>
	      	<th colspan="3"><?php echo $date1->format('d-m-Y'); ?></th>
	      </tr>
	      <tr>
	      	<th>SA</th>
	      	<th>(+)</th>
	      	<th>(-)</th>
	      	<th>SS</th>
	      	<th>(+)</th>
	      	<th>(-)</th>
	      	<th>SS</th>
	      	<th>(+)</th>
	      	<th>(-)</th>
	      	<th>SS</th>
	      	<th>(+)</th>
	      	<th>(-)</th>
	      	<th>SS</th>
	      	<th>(+)</th>
	      	<th>(-)</th>
	      	<th>SS</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php 

	    	$qk = mysql_query("SELECT *FROM kategori"); 
	    	while($k  = mysql_fetch_array($qk)){ 
	    	$qp = mysql_query("SELECT *FROM produk WHERE id_kategori='$k[id_kategori]' AND id_kk='$klinik'");
	    	$cek = mysql_num_rows($qp);
	    	if ($cek==0) {
	    		continue;
	    	}
	    		?>
	    	<tr>
	    		<th align="center" colspan="2"><?php echo $k['kategori']; ?></th>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    		<td></td>
	    	</tr>
	    	<?php while($p =mysql_fetch_array($qp)){ 
	    		$no=1;
	    		$c     = 0;
	    		$limit = 5;
	    		$min   = array();
	    		$plus  = array();
	    		$ss    = $p['jumlah'];
	    		while ($c<5) {

	    			$tgl = $hari[$c];

	    			$pp = mysql_fetch_array(mysql_query("SELECT *FROM pengiriman p 
		 						JOIN produk_pengiriman pp ON  p.no_pengiriman=pp.no_pengiriman
		 						WHERE p.tanggal='$tgl' AND pp.kode_produk='$p[kode_produk]' AND p.cabang='$klinik'"));

	    			$plus[] = $pp['jumlah_diterima'];

	    			$hk = mysql_fetch_array(mysql_query("SELECT SUM(jumlah) AS total_p FROM history_kasir WHERE nama='$p[nama_p]' AND tanggal='$tgl' AND jenis='Produk' AND id_kk='$klinik'"));

	    			$min[] = $hk['total_p'];

	    			$c++;
	    		}
	    	?>
	    	<tr>
	    		<?php 
	    		$jum  = $ss-$plus[0]+$min[0]; 
	    		$jum2 = $jum-$plus[1]+$min[1];
	    		$jum3 = $jum2-$plus[2]+$min[2];
	    		$jum4 = $jum3-$plus[3]+$min[3];
	    		$jum5 = $jum4-$plus[4]+$min[4];
	    		?>
	    		<td><?php echo $no; ?></td>
	    		<td><?php echo $p['nama_p']; ?></td>
	    		<td><?php echo $jum5; ?></td>

	    		<td><?php echo $plus[4]; ?></td>
	    		<td><?php echo $min[4]; ?></td>
	    		<td><?php echo $jum4; ?></td>

	    		<td><?php echo $plus[3]; ?></td>
	    		<td><?php echo $min[3]; ?></td>
	    		<td><?php echo $jum3; ?></td>

	    		<td><?php echo $plus[2]; ?></td>
	    		<td><?php echo $min[2]; ?></td>
	    		<td><?php echo $jum2; ?></td>

	    		<td><?php echo $plus[1]; ?></td>
	    		<td><?php echo $min[1]; ?></td>
	    		<td><?php echo $jum; ?></td>

	    		<td><?php echo $plus[0]; ?></td>
	    		<td><?php echo $min[0]; ?></td>
	    		<td><?php echo $ss; ?></td>
	    	</tr>
	    <?php $no++; } 
	    	}

	    	?>
	    </tbody>
	    <tbody>
		</tbody>
    </table>
    <br>
</div>