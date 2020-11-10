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
	<h2>DETAIL PEMASUKAN UJI LAB</h2>
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
			$lab1	= mysql_fetch_array(mysql_query("Select sum(total) as total From uji_lab, pemeriksaan_lab, perawatan_pasien Where uji_lab.id_ulab=pemeriksaan_lab.id_ulab And pemeriksaan_lab.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_ujilab Like '%$tgl%')"));		
			$lab	= mysql_query("Select tgl_ujilab, id_pasien, uji_lab, sum(total) as totalab From uji_lab, pemeriksaan_lab, perawatan_pasien Where uji_lab.id_ulab=pemeriksaan_lab.id_ulab And pemeriksaan_lab.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_ujilab Like '%$tgl%') Group by id_pasien");		
			while($ulab	= mysql_fetch_array($lab)){
		?>
        <tr>
        	<td><?php echo $ulab['tgl_ujilab']; ?></td>
        	<td><?php echo $ulab['id_pasien']; ?></td>
        	<td><?php echo $ulab['uji_lab']; ?></td>
			<td><div align="right"><?php echo rupiah($ulab['totalab']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="3"><div align="right"><b><?php echo rupiah($lab1['total']); ?></b></div></td>
        </tr>  
    </table>
</div>