<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
	<div align="center">
	<h2>DATA PENGELUARAN RUMAH SAKIT</h2>
        <?php
			$tgl1	= $_POST['tgl_awal'];
			$tgl2	= $_POST['tgl_akhir'];
		?>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2) ?></div></td>
        </tr>
	</table>      
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Tanggal</th>
			<th>Uraian</th>
			<th>Nominal</th>
		</tr>
        </thead>
        <?php
			$tot_png	= mysql_fetch_array(mysql_query("Select sum(jumlah_pop) as total From pengeluaran_op Where (tgl_pop Between '$tgl1' And '$tgl2')"));
			$png		= mysql_query("Select tgl_pop, ket_pop, sum(jumlah_pop) as png From pengeluaran_op Where (tgl_pop Between '$tgl1' And '$tgl2') Group by tgl_pop, ket_pop");
			while($tot	= mysql_fetch_array($png)){
		?>
        <tr>
        	<td><center><?php echo $tot['tgl_pop']; ?></center></td>
			<td><?php echo $tot['ket_pop']; ?></td>
			<td><a target="_blank" href="../report_det/rpt_det_pengeluaran.php?id=<?php echo $tot['tgl_pop']; ?>&ket=<?php echo $tot['ket_pop']; ?>"><?php echo rupiah($tot['png']); ?></a></td>
		</tr>
        <?php
			}
		?>  
        <tr>
        	<td><b>Total</b></td>
        	<td colspan="2"><div align="right"><b><?php echo rupiah($tot_png['total']);?></b></div></td>
        </tr>      
    </table>
</div>