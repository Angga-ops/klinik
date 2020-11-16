<?php

include "../../../config/koneksi.php";

switch($_GET["act"]){
    case "input": 
    $today = DATE("Y-m-d");
    $jam = str_replace(".",":",$_POST['jam']);
    //cek sdh ada blm untuk poliklinik dan hari yg dipilih
    $c = mysqli_num_rows(mysqli_query($con, "SELECT id_drpraktek FROM dr_praktek WHERE id_poli = $_POST[klinik] AND hari = $_POST[hari] AND jam = '$jam' AND expired>='$today'"));

    if($c > 0){
        echo "<script>alert('Poliklinik dan Hari Piket yang dipilih sudah ada dokter jaga. Silakan pilih Poliklinik dan Hari Piket lain'); location.href='../../media.php?module=jadwal_dokter';</script>";
    } else {
        mysqli_query($con, "INSERT INTO dr_praktek VALUES (NULL,'$_POST[klinik]','$_POST[dokter]','$_POST[hari]','$_POST[jam]','$_POST[expired]')");
        echo "<script>location.href='../../media.php?module=jadwal_dokter';</script>";
    }
    
    break;
    case "del": 
    
    //hapus data perawat
   mysqli_query($con, "DELETE FROM nurse WHERE drpraktek = '$_GET[id]'");
    //hapus dr praktek   
    mysqli_query($con, "DELETE FROM dr_praktek WHERE id_drpraktek = '$_GET[id]'");
    echo "<script>location.href='../../media.php?module=jadwal_dokter';</script>";
    break;
}

?>