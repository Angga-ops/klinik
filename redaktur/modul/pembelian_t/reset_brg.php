<?php 
include "../../../config/koneksi.php";

session_start();

mysqli_query($con,"DELETE FROM pembelian_t WHERE id_t='$id'");

exit();
?>