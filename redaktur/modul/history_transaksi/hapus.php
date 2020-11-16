<?php
session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id     = $_POST['id'];

//khusus utk treatment cari data di history_kasir
$r = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM history_kasir WHERE id = '$id'"));


    mysqli_query($con, "DELETE FROM history_kasir WHERE id='$id'");



exit();	

?>