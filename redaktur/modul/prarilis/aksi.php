<?php

include "../../../config/koneksi.php";

switch($_GET['act']){

case "add":

$s = mysqli_query($con,"SELECT id_p, nama_p FROM produk WHERE nama_p = '$_POST[prd]' AND id_kk = '$_POST[klinik]'");

$ux = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM produk_master WHERE nama_produk = '$_POST[prd]'"));

if(mysqli_num_rows($s) > 0){

    $ss = mysqli_fetch_assoc($s);

mysqli_query($con,"UPDATE produk SET id_kategori = '$_POST[kat]',id_s = '$_POST[sat]',jumlah = '$_POST[jml]' WHERE id_p = '$ss[id_p]'");

} else {
    
mysqli_query($con,"INSERT INTO produk (kode_barang,nama_p,harga_jual,harga_beli,batas_minim,batas_maks,id_s,id_kategori,id_kk,jumlah) VALUES ('$ux[kd_produk]','$ux[nama_produk]','$ux[harga_jual]','$ux[harga_beli]','$_POST[jml]','$_POST[jml]','$ux[id_satuan]','$ux[id_kategori]','$_POST[klinik]','$_POST[jml]')");

}


break;

case "edit":

mysqli_query($con,"UPDATE produk SET id_kategori = '$_POST[kat]',id_s = '$_POST[sat]', jumlah = '$_POST[jml]' WHERE id_p = '$_POST[id]'");

break;

case "del":

mysqli_query($con,"DELETE FROM prarilis WHERE id = '$_GET[id]'");

break;

}

header("Location: ../../../redaktur/media.php?module=prerelease");

?>