<?php
	switch($_GET['act']){
	default:
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Riwayat Rawat Jalan</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Antrian</th>
	<th>Pasien</th>
	<th>Antrian</th>
	<th>Poli</th>
	<th>Ket.</th>
	<th>Kedatangan</th>
	<th>Tindakan Medis</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	$data = mysqli_query($con,"Select id_antrian, nama_pasien, nama_poli, antrian, keterangan, tgl_datang, jam_datang From perawatan_pasien, pasien, tujuan Where perawatan_pasien.id_pasien=pasien.id_pasien And perawatan_pasien.id_poli=tujuan.id_poli And antrian='Rawat Jalan' And keterangan='Keluar'");
	while($hasil= mysqli_fetch_array($data)){
	$tgl_datang	= tgl_indo($hasil['tgl_datang']);
?>
  <tr class="gradeX">
	<td><?php echo $hasil['id_antrian'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $hasil['antrian'] ?></td>
	<td><?php echo $hasil['nama_poli'] ?></td>
	<td><?php echo $hasil['keterangan'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_datang'], 0,5)." WIB" ?></td>
	<td>
        <a href="?module=pemeriksaan&id=<?php echo $hasil['id_antrian']; ?>"><center>Periksa</a>
        <a>-</a>
        <a href="">Uji Lab</a>
        <a>-</a>
        <a href="?module=uji_rontgen&id=<?php echo $hasil['id_antrian']; ?>" class="with-tip">Rontgen</center></a>
	</td>
    <td>
	<a href="">Checkout</a>
	</td>	
</tr>
<?php
      $no++;
    }
    ?>

</table>
  </div>
  </div>
  </div>
<?php
	break;
	case "riwayat_inap":
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Riwayat Rawat Inap</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Antrian</th>
	<th>Pasien</th>
	<th>Antrian</th>
	<th>Poli</th>
	<th>Ket.</th>
	<th>Kedatangan</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	$data = mysqli_query($con,"Select id_antrian, nama_pasien, nama_poli, antrian, keterangan, tgl_datang, jam_datang From perawatan_pasien, pasien, tujuan Where perawatan_pasien.id_pasien=pasien.id_pasien And perawatan_pasien.id_poli=tujuan.id_poli And antrian='Rawat Inap' And keterangan='Keluar'");
	while($hasil= mysqli_fetch_array($data)){
	$tgl_datang	= tgl_indo($hasil['tgl_datang']);
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_antrian'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $hasil['antrian'] ?></td>
	<td><?php echo $hasil['nama_poli'] ?></td>
	<td><?php echo $hasil['keterangan'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_datang'], 0,5)." WIB" ?></td>
	<td>
	<a href="?module=pemeriksaan&id=<?php echo $hasil['id_antrian']; ?>"><center>Periksa</a>
	<a>-</a>
	<a href="">Uji Lab</a>
	<a>-</a>
	<a href="?module=uji_rontgen&id=<?php echo $hasil['id_antrian']; ?>" class="with-tip">Rontgen</center></a>
</tr>
<?php
      $no++;
    }
    ?>

</table>
  </div>
  </div>
  </div>
<?php
	break;
	case "riwayat_igd":
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Riwayat IGD</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Antrian</th>
	<th>Pasien</th>
	<th>Antrian</th>
	<th>Poli</th>
	<th>Ket.</th>
	<th>Kedatangan</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	$data = mysqli_query($con,"Select id_antrian, nama_pasien, nama_poli, antrian, keterangan, tgl_datang, jam_datang From perawatan_pasien, pasien, tujuan Where perawatan_pasien.id_pasien=pasien.id_pasien And perawatan_pasien.id_poli=tujuan.id_poli And antrian='IGD' And keterangan='Keluar'");
	while($hasil= mysqli_fetch_array($data)){
	$tgl_datang	= tgl_indo($hasil['tgl_datang']);
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_antrian'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $hasil['antrian'] ?></td>
	<td><?php echo $hasil['nama_poli'] ?></td>
	<td><?php echo $hasil['keterangan'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_datang'], 0,5)." WIB" ?></td>
	<td>
	<a href="?module=pemeriksaan&id=<?php echo $hasil['id_antrian']; ?>"><center>Periksa</a>
	<a>-</a>
	<a href="">Uji Lab</a>
	<a>-</a>
	<a href="?module=uji_rontgen&id=<?php echo $hasil['id_antrian']; ?>" class="with-tip">Rontgen</center></a>
</tr>
<?php
      $no++;
    }
    ?>

</table>
  </div>
  </div>
  </div>
<?php
	break;
	}
?>