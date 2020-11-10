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
	<h2>DETAIL UJI LAB</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Pasien</th>
			<th>Uji Lab</th>
			<th>Frekuensi</th>
			<th>Diskon</th>
			<th>Kedatangan</th>
		</tr>
        </thead>
        <?php
			$pem	= mysql_query("Select id_pasien, uji_lab, jumlah_ujilab, diskon_lab, jam_ujilab From uji_lab, perawatan_pasien, pemeriksaan_lab Where perawatan_pasien.id_antrian=pemeriksaan_lab.id_antrian And uji_lab.id_ulab=pemeriksaan_lab.id_ulab And tgl_ujilab Like '%$tgl%'");
			while($data	= mysql_fetch_array($pem)){
		?>
        <tbody>
        <tr>
			<td><?php echo $data['id_pasien']; ?></td>
			<td><?php echo $data['uji_lab']; ?></td>
			<td><?php echo $data['jumlah_ujilab']; ?>x</td>
			<td><?php echo $data['diskon_lab']; ?>%</td>
			<td><?php echo substr($data['jam_ujilab'], 0,5); ?> WIB</td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>