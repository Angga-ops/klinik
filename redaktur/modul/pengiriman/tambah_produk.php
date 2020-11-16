<?php 

include "../../../config/koneksi.php";


$kd_brg  = $_POST['kd_brg'];
$nama    = $_POST['nama_brg'];
$kat	 = $_POST['kat_brg'];
$sat	 = $_POST['sat_brg'];
$jumlah	 = $_POST['jumlah'];
$harga 	 = $_POST['harga'];
$harga_b = $_POST['harga_b'];
$min	 = $_POST['min'];
$max	 = $_POST['max'];
$q1 = mysqli_query($con,"SELECT *FROM produk_ps WHERE kode_produk='$kd_brg'");
$cek = mysqli_num_rows($q1);

if ($cek>0) {
	$j = mysqli_fetch_array($q1);
	$jumlah = $j['jumlah']+$jumlah;
	mysqli_query($con,"UPDATE produk_ps SET jumlah='$jumlah' WHERE kode_produk='$kd_brg'");
}else{
	mysqli_query($con,"INSERT INTO produk_ps 
		(kode_produk,nama_produk,id_kat,id_sat,jumlah,harga_jual,harga_b,cabang_maks,cabang_min) VALUES 
		('$kd_brg','$nama','$kat','$sat','$jumlah','$harga','$harga_b','$max','$min')");
}


exit();

?>