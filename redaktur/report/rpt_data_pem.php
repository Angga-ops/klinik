<script type="text/javascript">
window.print();
</script>
<style>
.table1{
	margin:0 auto;
	border-collapse:collapse;
	background:#FFFFFF;
}
.table1 th{
	border:solid;
	border-width:1px;
	border-color:#000000;
	color:#FFFFFF;
	padding:4px 8px;
	background:#23333E;
}
.table1 td{
	border:solid;
	border-width:1px;
	border-color:#000000;
	padding:4px 8px;
}
#hitam{
	text-align:center;
	background:#333333;
	color:#FFFFFF;
}
#rpt{
	border:solid;
	border-color:#000000;
	border-width:1px;
}
</style>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tg	= $_POST['tgl'];
    $tgl = explode(" - ",$tg);
    $tgl_1 = explode("/",$tgl[0]);
    $tgl_2 = explode("/",$tgl[1]);

    $tgl1 = $tgl_1[2]."-".$tgl_1[0]."-".$tgl_1[1];
    $tgl2 = $tgl_2[2]."-".$tgl_2[0]."-".$tgl_2[1];
?>
	<div align="center">
	<h2>DATA PEMERIKSAN PASIEN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th><div align="center" id="donker">Tanggal</div></th>
			<th><div align="center" id="donker">Jumlah</div></th>
		</tr>
        </thead>
        <?php
			$pem	= mysql_query("Select tgl_periksa, count(id_antrian) as jumlah From pemeriksaan_pasien Where tgl_periksa Between '$tgl1' And '$tgl2' Group by tgl_periksa");
			while($data	= mysql_fetch_array($pem)){
		?>
        <tbody>
        <tr>
			<td><?php echo tgl_indo($data['tgl_periksa']); ?></td>
			<td><div align="right"><a target="_blank" href="../report_det/rpt_det_pem.php?id=<?php echo $data['tgl_periksa']; ?>"><?php echo $data['jumlah']; ?></a></div></td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>