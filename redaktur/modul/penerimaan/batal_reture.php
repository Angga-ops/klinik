<?php

include "../../../config/koneksi.php";

$nop = $_POST['nop'];

mysqli_query($con,"DELETE FROM produk_rs WHERE no_pengiriman='$nop'");

exit();

?>