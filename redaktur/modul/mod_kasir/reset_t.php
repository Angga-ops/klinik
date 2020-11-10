<?php 
include "../../../config/koneksi.php";

session_start();

$id_kk = $_SESSION['klinik'];


mysql_query("DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara'");

exit();
?>