<?php 

include "../../../config/koneksi.php";


//cek jika ada jadwal dobel
$k = mysql_num_rows(mysql_query("SELECT id_nurse FROM nurse WHERE drpraktek = '$_GET[dr]' AND perawat = '$_GET[nurse]'"));

if($k > 0){
    echo "error";
} else {
    mysql_query("INSERT INTO nurse VALUES (NULL,'$_GET[dr]','$_GET[nurse]')");
    echo "success";
}


?>