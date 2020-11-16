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

</style>
<?php

$q = mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$_GET[id]'");
$d = mysqli_fetch_array($q);

?>
<div align="center">
	<h2>Laporan Penjualan Produk</h2>
</div>
<div class="row">
    <div class="col-md-2">
        Tanggal Penjualan
    </div>
    <div class="col-md-5">
         :&emsp; <?php echo tgl_indo($_GET['tgl']); ?>
    </div>
</div>
<div class="row">
    <div class="col-md-2">
        Klinik
    </div>
    <div class="col-md-5">
         :&emsp; <?php echo $d['nama_klinik']; ?>
    </div>
</div>
      <br>
<div align="center">
	<table width="100%" class="table1">
		<thead>
	      <tr>
	        <th>Kasir</th>
	        <th>Kode Produk</th>
	        <th>Nama Produk</th>
	        <th>Jumlah</th>
	        <th>Harga</th>
	        <th>Diskon</th>
	        <th>Sub Total</th>
	      </tr>
	    </thead>
	    <tbody>
	    <?php 
	    			
	    			$q2 = mysqli_query($con, "SELECT *FROM pembayaran p 
	    				JOIN history_kasir pp ON p.no_faktur=pp.no_faktur
	    				JOIN user u ON p.id_kasir=u.id_user  
	    				JOIN pasien pas ON p.id_pasien=pas.id_pasien
	    				WHERE p.id_kk='$d[id_kk]' AND p.tgl='$_GET[tgl]' AND pp.jenis='Produk'");
	    			while ($p=mysqli_fetch_array($q2)) { $total = 0; ?>
	    				
	    	<tr>
	    		<td><?php echo $p['nama_lengkap']; ?></td>
	    		<td><?php echo $p['kode']; ?></td>
	    		<td><?php echo $p['nama']; ?></td>
	    		<td><?php echo $p['jumlah']; ?></td>
	    		<td><?php echo rupiah($p['harga']); ?></td>
	    		<td><?php echo $p['diskon']; ?></td>
	    		<td><?php echo rupiah($p['sub_total']); $total+=$p['sub_total']; ?></td>
	    	</tr> 
	    		<?php $nofak = $p['no_faktur'];
	    			?>
	    	<tr>
	    		<th>Nama Pasien</th>
	    		<td><?php echo $p['nama_pasien'] ?></td>
	    		<th>No.Faktur</th>
	    		<td><?php echo $nofak; ?></td>
	    		<th colspan="2">Total</th>
	    		<td><?php echo rupiah($total);
	    		$totall += $total;
	    		 ?></td>
	    	</tr>
	    	<?php
	    			}
	    	?>
		</tbody>
		<tfoot>
			<th colspan="6">Grand Total</th>
			<td><?php echo rupiah($totall); ?></td>
		</tfoot>
    </table>
    <br>
</div>