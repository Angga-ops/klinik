<?php

session_start();



include "../../../config/koneksi.php";
$id_kk  = $_SESSION['klinik'];
$id     = $_POST['id'];
$act 	= $_POST['act'];
$jumlah = $_POST['jum'];
$ket	= $_POST['ket'];

switch ($act) {
	case 'edit':
		mysql_query("UPDATE produk_rs SET jumlah='$jumlah',keterangan='$ket' WHERE id_pr='$id'");
		echo "edit";
		break;
	
	default:

		mysql_query("INSERT INTO produk_rs (no_pengiriman, kode_produk, nama_produk, id_kat, id_sat, jumlah, harga_jual, keterangan,id_kk) 	SELECT no_pengiriman,kode_produk,nama_produk,id_kat,id_sat,'$jumlah',harga_jual,'$ket','$id_kk' FROM produk_pengiriman WHERE id_pp ='$id' ");

		break;
}


exit();

?>