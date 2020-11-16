<?php

include "../../../config/koneksi.php";

switch($_GET["act"]){
    case "input": 
    $jam = $_POST['jam'];
    $tgl = $_POST['tgl'];
    $d = date("N",strtotime($tgl));
   
        mysqli_query($con, "INSERT INTO dr_pengganti VALUES (NULL,'$_POST[dr]','$tgl','$d','$jam','$_POST[klinik]')");
        echo "<script>location.href='../../media.php?module=dr_ganti';</script>";
    
    break;

    case "del": 
       
        mysqli_query($con, "DELETE FROM dr_pengganti WHERE id = $_GET[id]");
      
    
    break;
}

?>