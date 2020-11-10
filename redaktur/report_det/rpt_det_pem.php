<script type="text/javascript">
window.print();
</script>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl	= $_GET['id'];
?>
	<div align="center">
	<h2>DETAIL PEMERIKSAN PASIEN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Pasien</th>
			<th>Diagnosa</th>
			<th>Kedatangan</th>
		</tr>
        </thead>
        <?php
			$pem	= mysql_query("Select id_pasien, diagnosa, jam_periksa From perawatan_pasien, pemeriksaan_pasien Where perawatan_pasien.id_antrian=pemeriksaan_pasien.id_antrian And tgl_periksa Like '%$tgl%'");
			while($data	= mysql_fetch_array($pem)){
		?>
        <tbody>
        <tr>
			<td><?php echo $data['id_pasien']; ?></td>
			<td><?php echo $data['diagnosa']; ?></td>
			<td><?php echo substr($data['jam_periksa'], 0,5); ?> WIB</td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>