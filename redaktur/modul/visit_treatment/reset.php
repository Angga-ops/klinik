<?php
session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id     = $_POST['id'];

//khusus utk treatment cari data di history_kasir
$r = mysql_fetch_assoc(mysql_query("SELECT * FROM kasir_sementara WHERE no_faktur = '$id'"));
$ri = mysql_query("SELECT * FROM history_kasir WHERE no_faktur = '$r[no_faktur]' AND id_pasien = '$r[id_pasien]' AND nama = '$r[nama]' AND jenis = 'Treatment'");

if(mysql_num_rows($ri) > 0){
    $rij = mysql_fetch_assoc($ri);
    mysql_query("DELETE FROM history_kasir WHERE no_faktur='$rij[no_faktur]'");
    mysql_query("DELETE FROM kasir_sementara WHERE no_faktur='$id'");
} else {
    mysql_query("DELETE FROM history_kasir WHERE no_faktur='$id'");
}

exit();	

?>