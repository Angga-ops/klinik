<?php

include "../../../config/koneksi.php";

$id     = $_POST['id'];
$kd_brg = $_POST['kb'];
$nama   = $_POST['nb'];
$kat	= $_POST['kat_brg'];
$sat	= $_POST['sat_brg'];
$jumlah	= $_POST['j'];
$harga 	= $_POST['hj'];

mysql_query("UPDATE produk_ps SET 
	kode_produk='$kd_brg',
	nama_produk='$nama',
	id_kat='$kat',
	id_sat='$sat',
	jumlah='$jumlah',
	harga_jual='$harga' WHERE id='$id'");

exit();

?>