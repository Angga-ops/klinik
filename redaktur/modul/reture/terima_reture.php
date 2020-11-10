<?php

include "../../../config/koneksi.php";

$nor = $_POST['nor'];

mysql_query("UPDATE reture SET keterangan='Selesai' WHERE no_reture='$nor'");

exit();

?>