<?php 
session_start();

include "../../../config/koneksi.php";

$id_kk = $_SESSION['klinik'];

$kd_brg  = $_POST['kd_brg'];
$nama    = $_POST['nama_brg'];
$ket     = $_POST['ket'];
$jum     = $_POST['jumlah'];

$q1 = mysqli_query($con,"SELECT *FROM produk_rs WHERE kode_produk='$kd_brg'");
$cek = mysqli_num_rows($q1);

if ($cek>0) {
  $j = mysqli_fetch_array($q1);
  $jumlah = $j['jumlah']+$jum;
  mysqli_query($con,"UPDATE produk_rs SET jumlah='$jumlah',keterangan='$ket' WHERE kode_produk='$kd_brg'");
}else{
  $p = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM produk WHERE nama_p='$nama'"));
  mysqli_query($con,"INSERT INTO produk_rs 
    (kode_produk,nama_produk,id_kat,id_sat,jumlah,harga_jual,keterangan,id_kk) VALUES 
    ('$kd_brg','$nama','$p[id_kategori]','$p[id_s]','$jum','$p[harga_jual]','$ket','$id_kk')");
}


exit();

?>