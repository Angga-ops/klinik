<?php
session_start();
$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id  = $_POST['id'];


	
	$q1 = mysqli_query($con,"SELECT *FROM history_kasir WHERE id ='$id'");
	$data = mysqli_fetch_array($q1);

	$nama = $data['nama'];

	$qp     = mysqli_query($con,"SELECT *FROM produk WHERE id_kk='$_SESSION[klinik]' AND nama_p='$nama'");
	
	$p      = mysqli_fetch_array($qp);

	$jumlah = $p['jumlah'];
	$jumlah++;

	mysqli_query($con,"UPDATE produk SET jumlah='$jumlah' WHERE id_kk='$_SESSION[klinik]' AND nama_p='$nama'"); 

	$jumlah = $data['jumlah'];
	$jumlah--;
	if($jumlah==0){
		mysqli_query($con,"DELETE FROM history_kasir WHERE id='$id'");
	}else{
		mysqli_query($con,"UPDATE history_kasir SET jumlah='$jumlah' WHERE id='$id'");
	}


exit();

?>