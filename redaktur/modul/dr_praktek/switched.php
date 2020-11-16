<?php 

include "../../../config/koneksi.php";

$cek = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM dr_praktek WHERE id_drpraktek = '$_GET[dr1]'"));
$cek2 = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM dr_praktek WHERE id_drpraktek = '$_GET[dr2]'"));

if($cek['id_poli'] != $cek2['id_poli']){
    echo "error";
} else {
    mysqli_query($con, "UPDATE dr_praktek SET hari='$cek2[hari]' , jam='$cek2[jam]' WHERE id_drpraktek='$cek[id_drpraktek]'");
    mysqli_query($con, "UPDATE dr_praktek SET hari='$cek[hari]' , jam='$cek[jam]' WHERE id_drpraktek='$cek2[id_drpraktek]'");
}



?>