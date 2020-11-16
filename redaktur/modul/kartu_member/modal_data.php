<?php

include "../../../config/koneksi.php";

$data = array();

$id = $_POST['id'];

$q = mysqli_query($con, "SELECT *FROM pasien WHERE id_pasien='$id'");
$p = mysqli_fetch_array($q);

$data = array(
	"id"=>$p['id_pasien'],
	"tgl_exp"=>$p['km_exp'],
	"nama"=>$p['nama_pasien']
);

echo json_encode($data);

exit();
?>