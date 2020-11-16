<?php
include "../../../config/koneksi.php";

$cabang		= $_POST['cabang'];
$nop		= $_POST['no_peng'];
$tanggal	= date("Y-m-d");
$pengirim 	= $_POST['pengirim'];
$status     = "Sedang Proses Pengiriman";

if ($cabang==0) {
	echo "K";
	exit();
}
$q   = mysqli_query($con,"SELECT *FROM produk_ps");
$cek = mysqli_num_rows($q);
if ($cek==0) {
 	echo "No";
 	exit();
 } 
$q = mysqli_query($con,"SELECT *FROM produk_ps");

while($ps = mysqli_fetch_array($q)){
	$qt = mysqli_query($con,"SELECT *FROM produk_pusat WHERE kode_produk='$ps[kode_produk]'");
	$cek = mysqli_num_rows($qt);
	$pp = mysqli_fetch_array($qt);
	if ($cek>0) {
		$jumlah = $pp['jumlah']-$ps['jumlah'];
		mysqli_query($con,"UPDATE produk_pusat SET jumlah='$jumlah' WHERE kode_produk='$ps[kode_produk]'");
	}

	
}
mysqli_query($con,"INSERT INTO produk_pengiriman 
	(no_pengiriman,kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,harga_b,cabang_maks,cabang_min) SELECT 
	'$nop',kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,harga_b,cabang_maks,cabang_min FROM produk_ps");

mysqli_query($con,"INSERT INTO pengiriman (no_pengiriman,cabang,tanggal,pengirim,keterangan) VALUES ('$nop','$cabang','$tanggal','$pengirim','$status')");

mysqli_query($con,"TRUNCATE table produk_ps");


exit();
?>