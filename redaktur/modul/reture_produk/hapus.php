<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

mysql_query("DELETE FROM produk_rs WHERE id_pr='$id'");

exit();
?>