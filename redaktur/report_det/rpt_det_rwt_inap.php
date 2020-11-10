<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl	= $_GET['id'];
	$atr	= $_GET['atr'];
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
	<div align="center">
	<h2>DETAIL DATA RAWAT INAP</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Pasien</th>
			<th>Poli</th>
			<th>Dokter</th>
			<th>Ruangan</th>
		</tr>
        </thead>
        <tbody>
        <?php
			$rj	= mysql_query("Select id_pasien, nama_tm, nama_poli, nama_kamar From perawatan_pasien, medis, tujuan, kamar Where tujuan.id_poli=perawatan_pasien.id_poli And kamar.id_kamar=perawatan_pasien.id_kamar And medis.no_idk=perawatan_pasien.no_idk And tgl_datang Like'%$tgl%' And antrian='$atr'");
			while($data	= mysql_fetch_array($rj)){
		?>
        <tr>
			<td><?php echo $data['id_pasien']; ?></td>
			<td><?php echo $data['nama_poli']; ?></td>
			<td><?php echo $data['nama_tm']; ?></td>
			<td><?php echo $data['nama_kamar']; ?></td>
		</tr>
        <?php
			}
		?>
        </tbody>
    </table>
</div>