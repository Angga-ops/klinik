<?php 

include "../../../config/koneksi.php";

$cek = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM nurse WHERE id_nurse = '$_GET[dr1]'"));
$cek2 = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM nurse WHERE id_nurse = '$_GET[dr2]'"));

$poli = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_poli FROM dr_praktek WHERE id_drpraktek = '$cek[drpraktek]'"));
$poli2 = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_poli FROM dr_praktek WHERE id_drpraktek = '$cek2[drpraktek]'"));

if($poli['id_poli'] != $poli2['id_poli']){
    echo "error";
} else {
    mysqli_query($con,"UPDATE nurse SET perawat='$cek2[perawat]' WHERE id_nurse='$cek[id_nurse]'");
    mysqli_query($con,"UPDATE nurse SET perawat='$cek[perawat]' WHERE id_nurse='$cek2[id_nurse]'");
}



?>