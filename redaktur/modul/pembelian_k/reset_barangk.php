<?php 
include "../../../config/koneksi.php";

session_start();

mysql_query("DELETE FROM pembelian_k WHERE id_t='$id'");

exit();
?>