<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl	= $_GET['id'];
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />

<div align="center">
	<h2>DETAIL PEMASUKAN RONTGEN</h2>
	<table width="100%">
		<tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>        
	</table>
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Tanggal</th>
			<th>No. RM</th>
			<th>Uji Lab</th>
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$tgl	= $_GET['id'];
			$lab1	= mysql_fetch_array(mysql_query("Select sum(total) as total From uji_rontgen, pemeriksaan_rontgen, perawatan_pasien Where uji_rontgen.id_rontgen=pemeriksaan_rontgen.id_rontgen And pemeriksaan_rontgen.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_rontgen Like '%$tgl%')"));		
			$lab	= mysql_query("Select tgl_rontgen, id_pasien, rontgen, sum(total) as totalron From uji_rontgen, pemeriksaan_rontgen, perawatan_pasien Where uji_rontgen.id_rontgen=pemeriksaan_rontgen.id_rontgen And pemeriksaan_rontgen.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_rontgen Like '%$tgl%') Group by id_pasien");		
			while($ulab	= mysql_fetch_array($lab)){
		?>
        <tr>
        	<td><?php echo $ulab['tgl_rontgen']; ?></td>
        	<td><?php echo $ulab['id_pasien']; ?></td>
        	<td><?php echo $ulab['rontgen']; ?></td>
			<td><div align="right"><?php echo rupiah($ulab['totalron']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="3"><div align="right"><b><?php echo rupiah($lab1['total']); ?></b></div></td>
        </tr>
        <tbody>                
    </table>
</div>