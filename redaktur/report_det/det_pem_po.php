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
	<h2>DETAIL PEMBAYARAN PENJUALAN OBAT</h2>
	<table width="100%">
		<tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>        
	</table>
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>No. Faktur</th>
			<th>Pembeli</th>
			<th>Nominal</th>
		</tr>
        </thead>
        <tbody>
		<?php
			$tot	= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From pembayaran_po Where ket_pepo='Lunas' And (tgl_pepo Like '%$tgl%')"));		
			$pem	= mysql_query("Select * From pembayaran_po Where ket_pepo='Lunas' And (tgl_pepo Like '%$tgl%')");		
			while($data	= mysql_fetch_array($pem)){
		?>
        <tr>
        	<td><?php echo $data['id_pepo']; ?></td>
        	<td><?php echo $data['pembeli']; ?></td>
			<td><div align="right"><?php echo rupiah($data['total_harga']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="2"><div align="right"><b><?php echo rupiah($tot['total']); ?></b></div></td>
        </tr>  
        </tbody>      
    </table>
</div>