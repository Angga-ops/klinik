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
	<h2>DETAIL PEMASUKAN MEDIS</h2>
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
			<th>Waktu</th>
			<th>Medis</th>
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$per1			= mysql_fetch_array(mysql_query("Select sum(biaya_dokter) as total From tagihan, pembayaran Where tagihan.id_tagihan=pembayaran.id_tagihan And pembayaran.keterangan='Lunas' And tgl_tercatat Like '%$tgl%'"));
			$per			= mysql_query("Select * From perawatan_pasien, medis Where medis.no_idk=perawatan_pasien.no_idk And perawatan_pasien.keterangan='Keluar' And (tgl_datang Like '%$tgl%')");		
			while($periksa	= mysql_fetch_array($per)){
			$ida			= $periksa['id_antrian'];
			$tgl_dt			= $periksa['tgl_datang'];
			$ck				= mysql_fetch_array(mysql_query("Select * From checkout Where id_antrian='$ida'"));
			$tgl_ck			= $ck['tgl_checkout'];
			$selisih		= ((abs(strtotime ($tgl_dt) - strtotime ($tgl_ck)))/(60*60*24) + 1);
		?>
        <tr>
        	<td><?php echo $periksa['tgl_datang']; ?></td>
        	<td><?php echo $periksa['id_pasien']; ?></td>
			<td><?php echo $periksa['nama_tm']; ?></td>
        	<td><?php echo $selisih; ?> Hari</td>
			<td><div align="right"><?php echo rupiah($periksa['biaya_praktik']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="4"><div align="right"><b><?php echo rupiah($per1['total']); ?></b></div></td>
        </tr>
		</tbody>        
    </table>