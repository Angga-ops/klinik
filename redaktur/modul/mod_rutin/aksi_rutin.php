<?php 
session_start();
include "../../conf/koneksi.php";

$act = $_GET["act"];


switch($act){
    case "add": 
    
    $sql = "INSERT INTO rutin VALUES(NULL,'".$_POST["id_item"]."','".$_POST["nilai"]."','".$_POST["tgl"]."','".$_SESSION["namalengkap"]."')";

    mysqli_query($conn,$sql);
    header("Location: ../../laundry.php?module=admin_routine");
    
    break;
    case "edit": 

    $sql = "UPDATE rutin SET id_item='".$_POST["id_item"]."',nilai='".$_POST["nilai"]."',tgl='".$_POST["tgl"]."',user='".$_SESSION["namalengkap"]."'  WHERE id='".$_POST["id"]."'";

    
    mysqli_query($conn,$sql);
    header("Location: ../../laundry.php?module=admin_routine");
    
    break;
    case "del":

    mysqli_query($conn,"DELETE FROM rutin WHERE id = '".$_GET["id"]."'");
    header("Location: ../../laundry.php?module=admin_routine");


    break;

}

?>