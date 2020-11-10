<?php

include "../../../config/koneksi.php";

$nop = $_POST['nop'];

mysql_query("DELETE FROM produk_rs WHERE no_pengiriman='$nop'");

exit();

?>