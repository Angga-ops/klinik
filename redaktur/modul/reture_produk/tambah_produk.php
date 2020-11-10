<?php 
session_start();

include "../../../config/koneksi.php";

$id_kk = $_SESSION['klinik'];

$kd_brg  = $_POST['kd_brg'];
$nama    = $_POST['nama_brg'];
$ket     = $_POST['ket'];
$jum     = $_POST['jumlah'];

$q1 = mysql_query("SELECT *FROM produk_rs WHERE kode_produk='$kd_brg'");
$cek = mysql_num_rows($q1);

if ($cek>0) {
  $j = mysql_fetch_array($q1);
  $jumlah = $j['jumlah']+$jum;
  mysql_query("UPDATE produk_rs SET jumlah='$jumlah',keterangan='$ket' WHERE kode_produk='$kd_brg'");
}else{
  $p = mysql_fetch_array(mysql_query("SELECT *FROM produk WHERE nama_p='$nama'"));
  mysql_query("INSERT INTO produk_rs 
    (kode_produk,nama_produk,id_kat,id_sat,jumlah,harga_jual,keterangan,id_kk) VALUES 
    ('$kd_brg','$nama','$p[id_kategori]','$p[id_s]','$jum','$p[harga_jual]','$ket','$id_kk')");
}


exit();

?>