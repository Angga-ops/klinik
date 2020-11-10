<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$plab	= mysql_fetch_array(mysql_query("Select * From pemeriksaan_lab Where id_plab='$id'"));
	$idl	= $plab['id_ulab'];
	$ulab	= mysql_fetch_array(mysql_query("Select * From uji_lab Where id_ulab='$idl'"));
	$ida	= $plab['id_antrian'];
	$pas	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idp	= $pas['id_pasien'];
	$detp	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idp'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>REVIEW UJI LABORATORIUM</h2>
	<table width="100%">
      <tr>
       	<td>Id. Pemeriksaan: <?php echo $id; ?></td>
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
			<td><div align="right"><?php echo $detp['nama_pasien']; ?></div></td>
		</tr>
        <tr>
			<td>Pengujian</td>
			<td><div align="right"><?php echo $ulab['uji_lab']; ?></div></td>
		</tr>
        <tr>
			<td>Frekuensi Uji</td>
			<td><div align="right"><?php echo $plab['jumlah_ujilab']; ?>x</div></td>
		</tr>
        <tr>
			<td>Diskon Pemeriksaan</td>
			<td><div align="right"><?php echo $plab['diskon_lab']; ?>%</div></td>
		</tr>
        <tr>
			<td>Hasil</td>
			<td><div align="right"><?php echo $plab['hasil']; ?></div></td>
		</tr>
        <tr>
			<td>Total Biaya</td>
			<td><div align="right"><?php echo rupiah($plab['total']); ?></div></td>
		</tr>
        <tr>
			<td>Waktu Periksan</td>
			<td><div align="right"><?php echo tgl_indo($plab['tgl_ujilab']).' - '.substr($plab['jam_ujilab'], 0,5); ?> WIB</div></td>
		</tr>
   	</tbody>
    </table>
    <br />
	<table width="100%">
    	<tr>
        	<td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
		<tr>
        	<td height="200"><div align="right">Bagian Laboratorium</div></td>        
        </tr>
    </table>
</div>    