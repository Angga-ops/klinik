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
    <h2>DETAIL PEMASUKAN POLI</h2>
	<table width="100%">
		<tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>            
    </table>
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Tanggal</th>
			<th>Id. Pasien</th>
			<th>Medis</th>
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$per1			= mysql_fetch_array(mysql_query("Select sum(biaya_poli) as total From tagihan, pembayaran Where tagihan.id_tagihan=pembayaran.id_tagihan And pembayaran.keterangan='Lunas' And tgl_tercatat Like '%$tgl%'"));		
			$per			= mysql_query("Select * From perawatan_pasien, tujuan Where tujuan.id_poli=perawatan_pasien.id_poli And perawatan_pasien.keterangan='Keluar' And (tgl_datang Like '%$tgl%')");		
			while($periksa	= mysql_fetch_array($per)){
		?>
        <tr>
        	<td><?php echo $periksa['tgl_datang']; ?></td>
        	<td><?php echo $periksa['id_pasien']; ?></td>
			<td><?php echo $periksa['nama_poli'] ?></td>
			<td><div align="right"><?php echo rupiah($periksa['biaya_poli']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="3"><div align="right"><b><?php echo rupiah($per1['total']); ?></b></div></td>
        </tr>        
   		</tbody>
    </table>
</div>