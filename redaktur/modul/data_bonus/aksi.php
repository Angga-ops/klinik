<?php 

include "../../../config/koneksi.php";
include "../mod_log/aksi_log.php";

switch($_GET[act]){
    case "add":
    
    mysql_query("INSERT INTO bonus VALUES ('','$_POST[cus]','$_POST[prd]','$_POST[klinik]','$_POST[jml]','$_POST[tgl]','$_POST[ket]','$_POST[username]')");

    catat($_POST[username], 'Mengisi data bonus');
    
    break;

    case "edit":

    mysql_query("UPDATE bonus SET pasien = '$_POST[cus]', produk = '$_POST[prd]', klinik = '$_POST[klinik]', jml = '$_POST[jml]',ket = '$_POST[ket]' WHERE id = '$_POST[id_bns]'");

    case "del":

    mysql_query("DELETE FROM bonus WHERE id = '$_GET[id]'");

}

header("Location: ../../media.php?module=bonus");

?>