<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

mysqli_query($con,"DELETE FROM produk_rs WHERE id_pr='$id'");

exit();
?>