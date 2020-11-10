<?php

include "../../../config/koneksi.php";

switch($_GET["act"]){
    case "input": 
    $jam = $_POST[jam];
    $tgl = $_POST[tgl];
    $d = date("N",strtotime($tgl));
   
        mysql_query("INSERT INTO dr_pengganti VALUES (NULL,'$_POST[dr]','$tgl','$d','$jam','$_POST[klinik]')");
        echo "<script>location.href='../../media.php?module=dr_ganti';</script>";
    
    break;

    case "del": 
       
        mysql_query("DELETE FROM dr_pengganti WHERE id = $_GET[id]");
      
    
    break;
}

?>