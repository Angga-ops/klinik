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
	<h2>DETAIL UJI RONTGEN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Pasien</th>
			<th>Uji Rontgen</th>
			<th>Diskon</th>
			<th>Kedatangan</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$pem	= mysql_query("Select id_pasien, rontgen, diskon_ron, jam_rontgen From uji_rontgen, perawatan_pasien, pemeriksaan_rontgen Where perawatan_pasien.id_antrian=pemeriksaan_rontgen.id_antrian And uji_rontgen.id_rontgen=pemeriksaan_rontgen.id_rontgen And tgl_rontgen Like '%$tgl%'");
			while($data	= mysql_fetch_array($pem)){
		?>
        <tr>
			<td><?php echo $data['id_pasien']; ?></td>
			<td><?php echo $data['rontgen']; ?></td>
			<td><?php echo $data['diskon_ron']; ?>%</td>
			<td><?php echo substr($data['jam_rontgen'], 0,5); ?> WIB</td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>