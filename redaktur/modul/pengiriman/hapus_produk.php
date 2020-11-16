<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

mysqli_query($con,"DELETE FROM produk_ps WHERE id='$id'");

exit();
?>