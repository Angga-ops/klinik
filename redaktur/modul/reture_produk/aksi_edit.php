<?php

include "../../../config/koneksi.php";

$id     = $_POST['id'];
$ket	= $_POST['ket'];
$jum    = $_POST['jum'];

mysqli_query($con,"UPDATE produk_rs SET 
	keterangan='$ket',jumlah='$jum' WHERE id_pr='$id'");

exit();

?>