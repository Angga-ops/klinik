<script type="text/javascript">
window.print();
</script>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl1	= $_POST['tgl_awal'];
	$tgl2	= $_POST['tgl_akhir'];
?>
<div align="center">	
	<h2>DATA PEMASUKAN OPERASIONAL</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Tanggal</th>
			<th>Poli</th>
			<th>Medis</th>
			<th>Pemeriksaan</th>
			<th>Uji Lab</th>
			<th>Rontgen</th>
			<th>Ruangan</th>
		</tr>
		</thead>
        <tbody>
        <?php
			$tot_pem	= mysql_fetch_array(mysql_query("Select sum(total) total From tagihan, perawatan_pasien Where tagihan.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And tagihan.keterangan='Keluar' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			$sel_pem	= mysql_query("Select tgl_tercatat,
										sum(biaya_poli) as poli, 
										sum(biaya_dokter) as medis,
										sum(biaya_tindakan) as pemeriksaan,
										sum(biaya_lab) as lab,
										sum(biaya_rontgen) as rontgen,
										sum(biaya_kamar) as kamar From tagihan, perawatan_pasien Where tagihan.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And tagihan.keterangan='Keluar' And (tgl_tercatat Between '$tgl1' And '$tgl2') Group by tgl_tercatat");		
			while($pem	= mysql_fetch_array($sel_pem)){
		?>
        <tr>
        	<td><?php echo $pem['tgl_tercatat']; ?></td>
			<td><a target="_blank" href="../report_det/det_pem_poli.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['poli']); ?></a></td>
			<td><a target="_blank" href="../report_det/det_pem_medis.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['medis']); ?></a></td>
			<td><a target="_blank" href="../report_det/det_pem_periksa.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['pemeriksaan']); ?></a></td>
			<td><a target="_blank" href="../report_det/det_pem_lab.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['lab']); ?></a></td>
			<td><a target="_blank" href="../report_det/det_pem_ron.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['rontgen']); ?></a></td>
			<td><a target="_blank" href="../report_det/det_pem_kamar.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($pem['kamar']); ?></a></td>
		</tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="7"><div align="right"><b><?php echo rupiah($tot_pem['total']); ?></b></div></td>
        </tr>
		</tbody>       
    </table>

	<br />
	<h2>DATA PEMBAYARAN RESEP OBAT</h2>
    <table width="100%" class="table1">
    <thead>
    	<tr>
        	<th>Tanggal Pembayaran</th>
        	<th>Pembayaran Resep</th>
        </tr>
    </thead> 
	<tbody>
    <?php
		$tot_obt	= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From pembayaran_resep, perawatan_pasien Where pembayaran_resep.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And sts_pem='Lunas' And (tgl_pemrsp Between '$tgl1' And '$tgl2')"));
   		$obt		= mysql_query("Select tgl_pemrsp, sum(total_harga) as total From pembayaran_resep, perawatan_pasien Where pembayaran_resep.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.keterangan='Keluar' And sts_pem='Lunas' And (tgl_pemrsp Between '$tgl1' And '$tgl2')");
		while($do	= mysql_fetch_array($obt)){
	?>
    	<tr>
        	<td><?php echo $do['tgl_pemrsp']; ?></td>
			<td><a target="_blank" href="../report_det/det_pem_obat.php?id=<?php echo $do['tgl_pemrsp']; ?>"><?php echo rupiah($do['total']); ?></a></td>
        </tr>
        <?php
			}
		?>
	</tbody>
    </table>

	<br />
	<h2>DATA PEMASUKAN PENJUALAN OBAT</h2>
    <table width="100%" class="table1">
    <thead>
    	<tr>
        	<th>Tanggal Transaksi</th>
        	<th>Penjualan Obat</th>
        </tr>
    </thead> 
	<tbody>
    <?php
   		$pem_obt	= mysql_query("Select tgl_pepo, sum(total_harga) as total From pembayaran_po Where ket_pepo='Lunas' And (tgl_pepo Between '$tgl1' And '$tgl2') Group by tgl_pepo");	
		while($data	= mysql_fetch_array($pem_obt)){
	?>
    	<tr>
        	<td><?php echo $data['tgl_pepo']; ?></td>
        	<td><a target="_blank" href="../report_det/det_pem_po.php?id=<?php echo $data['tgl_pepo']; ?>"><?php echo rupiah($data['total']); ?></a></td>
        </tr>
        <?php
			}
		?>
	</tbody>
    </table>
</div>