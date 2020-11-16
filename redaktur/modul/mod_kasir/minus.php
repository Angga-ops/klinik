<?php
session_start();
$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id  = $_POST['id'];


	
	$q1 = mysqli_query($con, "SELECT *FROM kasir_sementara WHERE id ='$id' AND id_kk='$id_kk'");
	$data = mysqli_fetch_array($q1);

	$jumlah = $data['jumlah'];
	$jumlah--;
	if($jumlah==0){
		mysqli_query($con, "DELETE FROM kasir_sementara WHERE id='$id' AND id_kk='$id_kk'");
	}else{
		mysqli_query($con, "UPDATE kasir_sementara SET jumlah='$jumlah' WHERE id='$id' AND id_kk='$id_kk'");
	}


exit();

?>