<?php
session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id     = $_POST['id'];

//khusus utk treatment cari data di history_kasir
$r = mysql_fetch_assoc(mysql_query("SELECT * FROM history_kasir WHERE id = '$id'"));


    mysql_query("DELETE FROM history_kasir WHERE id='$id'");



exit();	

?>