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

    <h2>DETAIL PEMASUKAN OBAT</h2>
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
			$per1	= mysql_fetch_array(mysql_query("Select sum(biaya) as total From obat_keluar, perawatan_pasien Where obat_keluar.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And sts_ok='Dibayar' And (tgl_keluar Like '%$tgl%')"));		
			$per	= mysql_query("Select tgl_keluar, id_pasien, sum(biaya) as total From obat_keluar, perawatan_pasien Where obat_keluar.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And sts_ok='Dibayar' And (tgl_keluar Like '%$tgl%') Group by id_periksa");		
			while($periksa	= mysql_fetch_array($per)){
			$idp	= $periksa['id_pasien'];
		?>
        <tr>
        	<td><?php echo $periksa['tgl_keluar']; ?></td>
        	<td><?php echo $idp; ?></td>
			<td><div align="right"><?php echo rupiah($periksa['total']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="2"><div align="right"><b><?php echo rupiah($per1['total']); ?></b></div></td>
        </tr>  
        </tbody>      
    </table>
</div>