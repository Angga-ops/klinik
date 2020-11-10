<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$resep	= mysql_fetch_array(mysql_query("Select * From pembayaran_resep Where id_pemrsp='$id'"));
	$ida	= $resep['id_antrian'];
	$atr	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idpas	= $atr['id_pasien'];
	$pas	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idpas'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>RIVIEW PEMBAYARAN RESEP</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">No. Faktur : <?php echo $id; ?></div></td>
        </tr>    
    </table>
    
	<table width="100%" class="table1">
	<thead>
        <tr>
			<th><div align="left">Uraian</div></th>
			<th><div align="right">Detail</div></th>
		</tr>
	</thead>
    <tbody> 
        <tr>
			<td><div align="left">Id. Pembayaran</div></td>
			<td><div align="right"><?php echo $id; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">No. RM</div></td>
			<td><div align="right"><?php echo $idpas; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Pasien</div></td>
			<td><div align="right"><?php echo $pas['nama_pasien']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Total Biaya</div></td>
			<td><div align="right"><?php echo rupiah($resep['total_harga']); ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Keterangan</div></td>
			<td><div align="right"><?php echo $resep['keterangan']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Pembayaran</div></td>
			<td><div align="right"><?php echo tgl_indo($resep['tgl_pemrsp']); ?></div></td>
		</tr>
	</tbody>
    </table>
</div>