<?php 
include "../../../config/koneksi.php";

$src = $_POST['src'];

$id  = $_POST['id'];

switch ($src) {
	case 'rs':
		$q1 = mysql_query("SELECT *FROM produk_rs WHERE id_pr='$id'");
		$response = array();
		while($row = mysql_fetch_array($q1) ){

			$nop  = $row['no_pengiriman'];
			$kode = $row['kode_produk'];
			$pp = mysql_fetch_array(mysql_query("SELECT *FROM produk_pengiriman WHERE no_pengiriman='$nop' AND kode_produk='$kode'"));
			$limit = $pp['jumlah'];

			$response = array(
				"nama"=>$row['nama_produk'],
				"kode"=>$row['kode_produk'],
				"nop"=>$row['id_pr'],
				"jumlah"=>$row['jumlah'],	
				"ket"=>$row['keterangan'],
				"limit"=>$limit
			);
		}
		break;
	
	default:
		$q1 = mysql_query("SELECT *FROM produk_pengiriman WHERE id_pp='$id'");
		$response = array();
		while($row = mysql_fetch_array($q1) ){
			$response = array(
				"nama"=>$row['nama_produk'],
				"kode"=>$row['kode_produk'],
				"nop"=>$row['id_pp'],
				"jumlah"=>$row['jumlah']
			);
		}
  
		break;
}

echo json_encode($response);

exit();

?>