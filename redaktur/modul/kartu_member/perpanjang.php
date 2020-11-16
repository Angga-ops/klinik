<?php

include "../../../config/koneksi.php";

$id      = $_POST['id_pasien'];
$tgl_exp = $_POST['tgl_exp'];
$tgl_p   = $_POST['tgl_p'];

if ($tgl_p<$tgl_exp) {
	echo "kurang";
	exit();
}


mysqli_query($con, "UPDATE pasien SET km_exp='$tgl_p' WHERE id_pasien='$id'");


exit();


?>