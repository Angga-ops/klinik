<?php

include "../../../config/koneksi.php";
$src = $_GET['src'];

switch ($src) {
	case 'nama':

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM produk_pusat WHERE nama_produk like'%".$search."%'";
 
 $result = mysql_query($query);

 $response = array();
 while($row = mysql_fetch_array($result) ){
   $response[] = array(
   	"harga"=>$row['harga_jual'],
      "harga_b"=>$row['harga_beli'],
   	"sat"=>$row['id_sat'],
   	"kat"=>$row['id_kategori'],
   	"label"=>$row['nama_produk'],
   	"kode"=>$row['kode_produk'],
      "maks"=>$row['batas_cabang'],
      "min"=>$row['batas_minim'],
      "limit"=>$row['jumlah']
   );
 }

 echo json_encode($response);
}

		break;
	
	default:

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM produk_pusat WHERE kode_produk like'%".$search."%'";
 
 $result = mysql_query($query);

 $response = array();
 while($row = mysql_fetch_array($result) ){
   $response[] = array(
   	"harga"=>$row['harga_jual'],
      "harga_b"=>$row['harga_beli'],
   	"sat"=>$row['id_sat'],
   	"kat"=>$row['id_kategori'],
   	"nama"=>$row['nama_produk'],
   	"label"=>$row['kode_produk'],
      "maks"=>$row['batas_cabang'],
      "min"=>$row['batas_minim'],
      "limit"=>$row['jumlah']
   );
 }

 echo json_encode($response);
}


		break;
}


exit;
?>