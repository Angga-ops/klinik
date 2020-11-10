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
	<h2>DETAIL PEMBAYARAN TAGIHAN</h2>
	<table width="100%">
		<tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>        
	</table>
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Pembayaran</th>
			<th>Id. Tagihan</th>
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
		<?php
			$tot	= mysql_fetch_array(mysql_query("Select sum(tagihan_akhir) as total From pembayaran Where keterangan='Lunas' And (tgl_bayar Like '%$tgl%')"));		
			$pem	= mysql_query("Select * From pembayaran Where keterangan='Lunas' And (tgl_bayar Like '%$tgl%')");		
			while($data	= mysql_fetch_array($pem)){
		?>
        <tr>
        	<td><?php echo $data['id_pembayaran']; ?></td>
        	<td><?php echo $data['id_tagihan']; ?></td>
			<td><div align="right"><?php echo rupiah($data['tagihan_akhir']); ?></div></td>
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