<?php 
include "../../../config/koneksi.php";


$id  = $_POST['id'];

$q1 = mysql_query("SELECT *FROM produk_pengiriman WHERE id_pp='$id'");
$response = array();
while($row = mysql_fetch_array($q1) ){
/*
	if ($row['ket']==Null) {
		$ket = "Sesuai";
	}else if($row['ket']==""){
		$ket = "Sesuai";
	} */
	
	if(is_null($row['ket']) || $row['ket'] == "" || empty($row['ket'])){
		$ket = "Sesuai";
	}else{
		$ket = $row['ket'];
	}
	$response = array(
		"nop"=>$row['id_pp'],
		"jumlah"=>$row['jumlah'],
		"ket"=>$ket
	);
}

echo json_encode($response);

exit();

?>