<?php
session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id      = $_POST['id'];

mysql_query("DELETE FROM kasir_sementara WHERE id='$id' AND id_kk='$id_kk'");


exit();	

?>