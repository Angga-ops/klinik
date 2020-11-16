<?php 

session_start();

include "../../../config/koneksi.php";

$id_kk = $_SESSION['klinik'];

mysqli_query($con, "DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara'");

exit();


?>