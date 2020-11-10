<?php
session_start();
$id_kk = $_SESSION['klinik'];
include "../../../config/koneksi.php";

$id  = $_POST['id'];


	
	$q1 = mysql_query("SELECT *FROM kasir_sementara WHERE id ='$id' AND id_kk='$id_kk'");
	$data = mysql_fetch_array($q1);

	$jumlah = $data['jumlah'];
	$jumlah++;
	if($jumlah==0){
		mysql_query("DELETE FROM kasir_sementara WHERE id='$id' AND id_kk='$id_kk'");
	}else{
		mysql_query("UPDATE kasir_sementara SET jumlah='$jumlah' WHERE id='$id' AND id_kk='$id_kk'");
	}


exit();

?>