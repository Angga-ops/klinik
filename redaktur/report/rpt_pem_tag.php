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
	<h2>DATA PEMBAYARAN TAGIHAN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Tanggal</th>
			<th>Jumlah</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$pem	= mysql_query("Select tgl_bayar, count(id_pembayaran) as jumlah From pembayaran Where keterangan='Lunas' ANd tgl_bayar Between '$tgl1' And '$tgl2' Group by tgl_bayar");
			while($data	= mysql_fetch_array($pem)){
		?>
        <tr>
			<td><?php echo tgl_indo($data['tgl_bayar']); ?></td>
			<td><div align="right"><a target="_blank" href="../report_det/det_pem_tag.php?id=<?php echo $data['tgl_bayar']; ?>"><?php echo $data['jumlah']; ?> Transaksi</a></div></td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>