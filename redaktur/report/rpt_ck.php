<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$ck		= mysql_fetch_array(mysql_query("Select * From checkout Where id_checkout='$id'"));
	$ida	= $ck['id_antrian'];
	$atr	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idp	= $atr['id_pasien'];
	$pas	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idp'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>REVIEW DATA CHECKOUT</h2>
	<table width="100%">
      <tr>
       	<td>Id. Checkout: <?php echo $id; ?></td>
        </tr>    
    </table>
	<table width="100%" class="table1">
        <thead>
        	<tr>
            	<th>Uraian</th>
            	<th>Detail</th>
            </tr>
        </thead>
        <tbody>
        <tr>
			<td>No. RM</td>
			<td><div align="right"><?php echo $idp; ?></div></td>
		</tr>
        <tr>
			<td>Nama Pasien</td>
			<td><div align="right"><?php echo $pas['nama_pasien']; ?></div></td>
		</tr>
        <tr>
			<td>Kondisi</td>
			<td><div align="right"><?php echo $ck['kondisi_pas']; ?></div></td>
		</tr>
        <tr>
			<td>Keterangan</td>
			<td><div align="right"><?php echo $ck['keterangan']; ?></div></td>
		</tr>
        <tr>
			<td>Kedatangan</td>
			<td><div align="right"><?php echo tgl_indo($atr['tgl_datang'])." - ".substr($atr['jam_datang'], 0,5)." WIB" ?></div></td>
		</tr>
        <tr>
			<td>Checkout</td>
			<td><div align="right"><?php echo tgl_indo($ck['tgl_checkout'])." - ".substr($ck['jam_checkout'], 0,5)." WIB" ?></div></td>
		</tr>
   	</tbody>
    </table>
    <br />
	<table width="100%">
    	<tr>
        	<td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
		<tr>
        	<td height="200"><div align="right">Bagian Administrasi</div></td>        
        </tr>
    </table>
</div>    