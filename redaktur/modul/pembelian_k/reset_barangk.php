<?php 
include "../../../config/koneksi.php";

session_start();

mysqli_query($con,"DELETE FROM pembelian_k WHERE id_t='$id'");

exit();
?>