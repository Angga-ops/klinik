<?php 
include "../../../config/koneksi.php";

session_start();

$id_kk = $_SESSION['klinik'];


mysqli_query($con,"DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara'");

exit();
?>