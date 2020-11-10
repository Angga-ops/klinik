<?php 

session_start();

include "../../../config/koneksi.php";

$id_kk = $_SESSION['klinik'];

mysql_query("DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara'");

exit();


?>