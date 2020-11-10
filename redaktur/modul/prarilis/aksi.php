<?php

include "../../../config/koneksi.php";

switch($_GET[act]){

case "add":

$s = mysql_query("SELECT id_p, nama_p FROM produk WHERE nama_p = '$_POST[prd]' AND id_kk = '$_POST[klinik]'");

$ux = mysql_fetch_assoc(mysql_query("SELECT * FROM produk_master WHERE nama_produk = '$_POST[prd]'"));

if(mysql_num_rows($s) > 0){

    $ss = mysql_fetch_assoc($s);

mysql_query("UPDATE produk SET id_kategori = '$_POST[kat]',id_s = '$_POST[sat]',jumlah = '$_POST[jml]' WHERE id_p = '$ss[id_p]'");

} else {
    
mysql_query("INSERT INTO produk (kode_barang,nama_p,harga_jual,harga_beli,batas_minim,batas_maks,id_s,id_kategori,id_kk,jumlah) VALUES ('$ux[kd_produk]','$ux[nama_produk]','$ux[harga_jual]','$ux[harga_beli]','$_POST[jml]','$_POST[jml]','$ux[id_satuan]','$ux[id_kategori]','$_POST[klinik]','$_POST[jml]')");

}


break;

case "edit":

mysql_query("UPDATE produk SET id_kategori = '$_POST[kat]',id_s = '$_POST[sat]', jumlah = '$_POST[jml]' WHERE id_p = '$_POST[id]'");

break;

case "del":

mysql_query("DELETE FROM prarilis WHERE id = '$_GET[id]'");

break;

}

header("Location: ../../../redaktur/media.php?module=prerelease");

?>