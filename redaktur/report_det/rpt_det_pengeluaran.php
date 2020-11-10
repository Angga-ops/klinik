<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl			= $_GET['id'];
	$ket			= $_GET['ket'];
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
	<div align="center">
    <h2 style="text-transform:uppercase;">DETAIL PENGELUARAN <?php echo $ket; ?></h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl)?></div></td>
        </tr>
	</table>      
    <table width="100%" class="table1">
       	<thead>
		<tr>
			<th>Tanggal</th>
			<th>Id. Transaksi</th>
			<th>Detail</th>
			<th>Biaya</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$tgl			= $_GET['id'];
			$ket			= $_GET['ket'];
			$png1			= mysql_fetch_array(mysql_query("Select sum(jumlah_pop) as total From pengeluaran_op Where ket_pop='$ket' And (tgl_pop Like '%$tgl%')"));					
			$png			= mysql_query("Select id_transaksi, tgl_pop, det_pop, sum(jumlah_pop) as total From pengeluaran_op Where ket_pop='$ket' And (tgl_pop Like '%$tgl%') Group by id_transaksi");		
			while($png_tot	= mysql_fetch_array($png)){
		?>
		<tr>
        	<td><?php echo $png_tot['tgl_pop']; ?></td>
        	<td><?php echo $png_tot['id_transaksi']; ?></td>
			<td><?php echo $png_tot['det_pop'] ?></td>
			<td><div align="right"><?php echo rupiah($png_tot['total']); ?></div></td>
        </tr>
		<?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="3"><div align="right"><b><?php echo rupiah($png1['total']); ?></b></div></td>
        </tr>        
    	</tbody>
    </table>
</div>