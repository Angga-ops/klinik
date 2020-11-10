<?php 

include "../../../config/koneksi.php";

$cek = mysql_fetch_assoc(mysql_query("SELECT * FROM nurse WHERE id_nurse = '$_GET[dr1]'"));
$cek2 = mysql_fetch_assoc(mysql_query("SELECT * FROM nurse WHERE id_nurse = '$_GET[dr2]'"));

$poli = mysql_fetch_assoc(mysql_query("SELECT id_poli FROM dr_praktek WHERE id_drpraktek = '$cek[drpraktek]'"));
$poli2 = mysql_fetch_assoc(mysql_query("SELECT id_poli FROM dr_praktek WHERE id_drpraktek = '$cek2[drpraktek]'"));

if($poli[id_poli] != $poli2[id_poli]){
    echo "error";
} else {
    mysql_query("UPDATE nurse SET perawat='$cek2[perawat]' WHERE id_nurse='$cek[id_nurse]'");
    mysql_query("UPDATE nurse SET perawat='$cek[perawat]' WHERE id_nurse='$cek2[id_nurse]'");
}



?>