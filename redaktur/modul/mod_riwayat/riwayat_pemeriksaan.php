<?php
	switch($_GET['act']){
	default:
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Pemeriksaan Pasien</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Pemeriksaan</th>
	<th>Id. Antrian</th>
	<th>Id. Pasien</th>
	<th>Pasien</th>
	<th>Kedatangan</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	//Ambil Id Periksa Nama Pasien
	$data 			= mysqli_query($con,"Select id_periksa, nama_pasien, jam_periksa, tgl_periksa From pasien, pemeriksaan_pasien, perawatan_pasien Where pemeriksaan_pasien.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien Order by id_periksa");
	//Ambil Id Antrian
	$hasil2			= mysqli_fetch_array(mysqli_query($con,"Select * From pemeriksaan_pasien"));
	//Ambil Id Pasien
	$hasil3			= mysqli_fetch_array(mysqli_query($con,"Select id_periksa, id_pasien From pemeriksaan_pasien, perawatan_pasien Where pemeriksaan_pasien.id_antrian=perawatan_pasien.id_antrian Order by id_periksa"));
	while($hasil	= mysqli_fetch_array($data)){
	$tgl_datang		= tgl_indo($hasil['tgl_periksa']);
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_periksa'] ?></td>
	<td><?php echo $hasil2['id_antrian'] ?></td>
	<td><?php echo $hasil3['id_pasien'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_periksa'], 0,5)." WIB" ?></td>
	<td>
    	<?php
			$idp		= $hasil['id_periksa'];
			$sel_rsp	= mysqli_query($con,"Select count(id_resep) as jum From obat_keluar Where id_periksa='$idp' Group by id_periksa");
			$cek_rsp	= mysqli_fetch_array($sel_rsp);
			$rsp		= $cek_rsp['jum'];
			if($rsp >= 1){
		?>
        	<a href="#">Riwayat</center></a>
 		<?php
			} else {
		?>   
        	<a href="?module=racik_resep&act=tebus_obat&id=<?php echo $hasil['id_periksa']; ?>"><center>Racik Resep</a>
        	<a>-</a>
        	<a href="#">Riwayat</center></a>
		<?php
			}
		?>
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
	case "uji_lab":
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Pemeriksaan Lab</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Pemeriksaan</th>
	<th>Id. Antrian</th>
	<th>Id. Pasien</th>
	<th>Pasien</th>
	<th>Kedatangan</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	$data 			= mysqli_query($con,"Select id_plab, nama_pasien, jam_ujilab, tgl_ujilab From pasien, pemeriksaan_lab, perawatan_pasien Where pemeriksaan_lab.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien Order by id_plab");
	$hasil2			= mysqli_fetch_array(mysqli_query($con,"Select * From pemeriksaan_lab"));
	$hasil3			= mysqli_fetch_array(mysqli_query($con,"Select id_plab, id_pasien From pemeriksaan_lab, perawatan_pasien Where pemeriksaan_lab.id_antrian=perawatan_pasien.id_antrian Order by id_plab"));
	while($hasil	= mysqli_fetch_array($data)){
	$tgl_datang		= tgl_indo($hasil['tgl_ujilab']);
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_plab'] ?></td>
	<td><?php echo $hasil2['id_antrian'] ?></td>
	<td><?php echo $hasil3['id_pasien'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_ujilab'], 0,5)." WIB" ?></td>
	<td>
	<a href="?module=pemeriksaan&id=<?php echo $hasil['id_antrian']; ?>"><center>Riwayat</center></a>
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
	case "rontgen":
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Pemeriksaan Rontgen</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Pemeriksaan</th>
	<th>Id. Antrian</th>
	<th>Id. Pasien</th>
	<th>Pasien</th>
	<th>Kedatangan</th>
	<th>Proses</th>
   </thead>
   <tbody>
<?php
	$data 			= mysqli_query($con,"Select id_prontgen, nama_pasien, jam_rontgen, tgl_rontgen From pasien, pemeriksaan_rontgen, perawatan_pasien Where pemeriksaan_rontgen.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien Order by id_prontgen");
	//$tampil=mysql_query("SELECT * FROM antrianbaru ORDER BY ID DESC");
	$hasil2			= mysqli_fetch_array(mysqli_query($con,"Select * From pemeriksaan_rontgen"));
	$hasil3			= mysqli_fetch_array(mysqli_query($con,"Select id_prontgen, id_pasien From pemeriksaan_rontgen, perawatan_pasien Where pemeriksaan_rontgen.id_antrian=perawatan_pasien.id_antrian Order by id_prontgen"));
	while($hasil	= mysqli_fetch_array($data)){
	$tgl_datang		= tgl_indo($hasil['tgl_rontgen']);
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_prontgen'] ?></td>
	<td><?php echo $hasil2['id_antrian'] ?></td>
	<td><?php echo $hasil3['id_pasien'] ?></td>
	<td><?php echo $hasil['nama_pasien'] ?></td>
	<td><?php echo $tgl_datang." - ".substr($hasil['jam_rontgen'], 0,5)." WIB" ?></td>
	<td>
	<a href="?module=pemeriksaan&id=<?php echo $hasil['id_antrian']; ?>"><center>Riwayat</center></a>
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