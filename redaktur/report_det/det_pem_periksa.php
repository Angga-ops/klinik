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
	<h2>DETAIL PEMASUKAN PEMERIKSAAN</h2>
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
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$tin1	= mysql_fetch_array(mysql_query("Select sum(biaya) as total From pemeriksaan_tindakan, pemeriksaan_pasien, perawatan_pasien Where pemeriksaan_tindakan.id_periksa=pemeriksaan_pasien.id_periksa And pemeriksaan_pasien.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_tindakan Like '%$tgl%')"));		
			$tin	= mysql_query("Select tgl_tindakan, id_pasien, sum(biaya) as total From pemeriksaan_tindakan, pemeriksaan_pasien, perawatan_pasien Where pemeriksaan_tindakan.id_periksa=pemeriksaan_pasien.id_periksa And pemeriksaan_pasien.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And (tgl_tindakan Like '%$tgl%') Group by id_pasien");		
			while($tindakan	= mysql_fetch_array($tin)){
		?>
        <tr>
        	<td><?php echo $tindakan['tgl_tindakan']; ?></td>
        	<td><?php echo $tindakan['id_pasien']; ?></td>
			<td><div align="right"><?php echo rupiah($tindakan['total']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="2"><div align="right"><b><?php echo rupiah($tin1['total']); ?></b></div></td>
        </tr>  
        </tbody>      
    </table>
</div>