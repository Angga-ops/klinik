<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$po		= mysql_fetch_array(mysql_query("Select * From pembayaran_po Where id_pepo='$id'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>RIVIEW PEMBAYARAN PENJUALAN OBAT</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Id. Pembayaran : <?php echo $id; ?></div></td>
        </tr>    
    </table>
    
	<table width="100%" class="table1">
	<thead>
        <tr>
			<th><div align="left">Uraian</div></th>
			<th><div align="right">Detail</div></th>
		</tr>
	</thead>
    <tbody> 
        <tr>
			<td><div align="left">Pembeli</div></td>
			<td><div align="right"><?php echo $po['pembeli']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Kontak</div></td>
			<td><div align="right"><?php echo $po['kontak']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Total Harga</div></td>
			<td><div align="right"><?php echo rupiah($po['total_harga']); ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Pembayaran</div></td>
			<td><div align="right"><?php echo rupiah($po['nominal_byr']); ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Kembalian</div></td>
			<td><div align="right"><?php echo rupiah($po['kembalian']); ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Pembayaran</div></td>
			<td><div align="right"><?php echo tgl_indo($po['tgl_pepo'])." - ".substr($po['jam_pepo'], 0,5)." WIB"; ?></div></td>
		</tr>
	</tbody>
    </table>
</div>