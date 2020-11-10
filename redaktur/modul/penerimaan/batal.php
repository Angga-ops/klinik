<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];

mysql_query("DELETE FROM produk_rs WHERE id_pr='$id'");

exit();

?>