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
$q   = mysql_query("SELECT *FROM produk_ps");
$cek = mysql_num_rows($q);
if ($cek==0) {
 	echo "No";
 	exit();
 } 
$q = mysql_query("SELECT *FROM produk_ps");

while($ps = mysql_fetch_array($q)){
	$qt = mysql_query("SELECT *FROM produk_pusat WHERE kode_produk='$ps[kode_produk]'");
	$cek = mysql_num_rows($qt);
	$pp = mysql_fetch_array($qt);
	if ($cek>0) {
		$jumlah = $pp['jumlah']-$ps['jumlah'];
		mysql_query("UPDATE produk_pusat SET jumlah='$jumlah' WHERE kode_produk='$ps[kode_produk]'");
	}

	
}
mysql_query("INSERT INTO produk_pengiriman 
	(no_pengiriman,kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,harga_b,cabang_maks,cabang_min) SELECT 
	'$nop',kode_produk,nama_produk,id_kat,id_sat,harga_jual,jumlah,harga_b,cabang_maks,cabang_min FROM produk_ps");

mysql_query("INSERT INTO pengiriman (no_pengiriman,cabang,tanggal,pengirim,keterangan) VALUES ('$nop','$cabang','$tanggal','$pengirim','$status')");

mysql_query("TRUNCATE table produk_ps");


exit();
?>