<?php

session_start();

include "../../../config/koneksi.php";

$id_kk    = $_SESSION["klinik"];
$pengirim = $_SESSION['namalengkap'];

$nor		= $_POST['no_reture'];
$tanggal	= $_POST['tgl'];

$q   = mysqli_query($con,"SELECT *FROM produk_rs WHERE id_kk='$id_kk'");
$cek = mysqli_num_rows($q);
if ($cek==0) {
 	echo "No";
 	exit();
 } 
$q = mysqli_query($con,"SELECT *FROM produk_rs WHERE id_kk='$id_kk'");

while($ps = mysqli_fetch_array($q)){
	$qt = mysqli_query($con,"SELECT *FROM produk WHERE kode_barang='$ps[kode_produk]'");
	$cek = mysqli_num_rows($qt);
	$pp = mysqli_fetch_array($qt);
	if ($cek>0) {
		$jumlah = $pp['jumlah']-$ps['jumlah'];
		mysqli_query($con,"UPDATE produk SET jumlah='$jumlah' WHERE kode_barang='$ps[kode_produk]'");
	}	
}

mysqli_query($con,"INSERT INTO produk_reture
	(no_reture,kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,keterangan) SELECT 
	'$nor',kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,keterangan FROM produk_rs");

mysqli_query($con,"INSERT INTO reture (no_reture,asal_cabang,tanggal,pengirim,keterangan) VALUES ('$nor','$id_kk','$tanggal','$pengirim','Sedang Proses Pengiriman')");

mysqli_query($con,"DELETE FROM produk_rs WHERE id_kk='$id_kk'");


exit();
?>