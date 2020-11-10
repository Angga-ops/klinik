<?php 

include "../../../config/koneksi.php";

$cek = mysql_fetch_assoc(mysql_query("SELECT * FROM dr_praktek WHERE id_drpraktek = '$_GET[dr1]'"));
$cek2 = mysql_fetch_assoc(mysql_query("SELECT * FROM dr_praktek WHERE id_drpraktek = '$_GET[dr2]'"));

if($cek[id_poli] != $cek2[id_poli]){
    echo "error";
} else {
    mysql_query("UPDATE dr_praktek SET hari='$cek2[hari]' , jam='$cek2[jam]' WHERE id_drpraktek='$cek[id_drpraktek]'");
    mysql_query("UPDATE dr_praktek SET hari='$cek[hari]' , jam='$cek[jam]' WHERE id_drpraktek='$cek2[id_drpraktek]'");
}



?>