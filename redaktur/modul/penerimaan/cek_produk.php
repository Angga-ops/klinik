<?php 

include "../../../config/koneksi.php";

$id  = $_POST['id'];
$jumlah  = $_POST['jumlah'];
$ket  = $_POST['ket'];


mysql_query("UPDATE produk_pengiriman SET jumlah_diterima='$jumlah',ket='$ket' WHERE id_pp='$id'");

exit();


?>