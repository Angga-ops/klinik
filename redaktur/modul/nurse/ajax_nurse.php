<?php 

include "../../../config/koneksi.php";


//cek jika ada jadwal dobel
$k = mysqli_num_rows(mysqli_query($con,"SELECT id_nurse FROM nurse WHERE drpraktek = '$_GET[dr]' AND perawat = '$_GET[nurse]'"));

if($k > 0){
    echo "error";
} else {
    mysqli_query($con,"INSERT INTO nurse VALUES (NULL,'$_GET[dr]','$_GET[nurse]')");
    echo "success";
}


?>