<?php
session_start();
$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id  = $_POST['id'];


	
	$q1 = mysql_query("SELECT *FROM history_apotek WHERE id ='$id'");
	$data = mysql_fetch_array($q1);

	$nama = $data['nama'];

	$qp     = mysql_query("SELECT *FROM produk WHERE  nama_p='$nama'");
	
	$p      = mysql_fetch_array($qp);

	$jumlah = $p['jumlah'];
	$jumlah++;

	mysql_query("UPDATE produk SET jumlah='$jumlah' WHERE nama_p='$nama'"); 

	$jumlah = $data['jumlah'];
	$jumlah--;
	if($jumlah==0){
		mysql_query("DELETE FROM history_apotek WHERE id='$id'");
	}else{
		mysql_query("UPDATE history_apotek SET jumlah='$jumlah' WHERE id='$id'");
	}


exit();

?>