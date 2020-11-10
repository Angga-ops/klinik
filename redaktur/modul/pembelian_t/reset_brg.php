<?php 
include "../../../config/koneksi.php";

session_start();

mysql_query("DELETE FROM pembelian_t WHERE id_t='$id'");

exit();
?>