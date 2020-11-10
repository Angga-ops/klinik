<?php

session_start();

include "../../../config/koneksi.php";

$id_kk    = $_SESSION["klinik"];
$pengirim = $_SESSION['namalengkap'];

$nor		= $_POST['no_reture'];
$tanggal	= $_POST['tgl'];

$q   = mysql_query("SELECT *FROM produk_rs WHERE id_kk='$id_kk'");
$cek = mysql_num_rows($q);
if ($cek==0) {
 	echo "No";
 	exit();
 } 
$q = mysql_query("SELECT *FROM produk_rs WHERE id_kk='$id_kk'");

while($ps = mysql_fetch_array($q)){
	$qt = mysql_query("SELECT *FROM produk WHERE kode_barang='$ps[kode_produk]'");
	$cek = mysql_num_rows($qt);
	$pp = mysql_fetch_array($qt);
	if ($cek>0) {
		$jumlah = $pp['jumlah']-$ps['jumlah'];
		mysql_query("UPDATE produk SET jumlah='$jumlah' WHERE kode_barang='$ps[kode_produk]'");
	}	
}

mysql_query("INSERT INTO produk_reture
	(no_reture,kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,keterangan) SELECT 
	'$nor',kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,keterangan FROM produk_rs");

mysql_query("INSERT INTO reture (no_reture,asal_cabang,tanggal,pengirim,keterangan) VALUES ('$nor','$id_kk','$tanggal','$pengirim','Sedang Proses Pengiriman')");

mysql_query("DELETE FROM produk_rs WHERE id_kk='$id_kk'");


exit();
?>