<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$pron	= mysql_fetch_array(mysql_query("Select * From pemeriksaan_rontgen Where id_prontgen='$id'"));
	$idr	= $pron['id_rontgen'];
	$uron	= mysql_fetch_array(mysql_query("Select * From uji_rontgen Where id_rontgen='$idr'"));
	$ida	= $pron['id_antrian'];
	$pas	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idp	= $pas['id_pasien'];
	$detp	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idp'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>REVIEW DATA UJI RADIOLOGI</h2>
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
			<td><div align="right"><?php echo $uron['rontgen']; ?></div></td>
		</tr>
        <tr>
			<td>Hasil</td>
			<td><div align="right"><?php echo $pron['hasil']; ?></div></td>
		</tr>
        <tr>
			<td>Diskon Pemeriksaan</td>
			<td><div align="right"><?php echo $pron['diskon_ron']; ?>%</div></td>
		</tr>
        <tr>
			<td>Total</td>
			<td><div align="right"><?php echo rupiah($pron['total']); ?></div></td>
		</tr>
        <tr>
			<td>Keterangan</td>
			<td><div align="right"><?php echo $pron['keterangan']; ?></div></td>
		</tr>
        <tr>
			<td>Waktu Periksan</td>
			<td><div align="right"><?php echo tgl_indo($pron['tgl_rontgen']).' - '.substr($pron['jam_rontgen'], 0,5); ?> WIB</div></td>
		</tr>
    	</tbody>
    </table>
<br />
	<table width="100%">
    	<tr>
        	<td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
		<tr>
        	<td height="200"><div align="right">Bagian Radiologi</div></td>        
        </tr>
    </table>
</div>