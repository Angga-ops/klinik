<?php

session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";
$src = $_GET['src'];

switch ($src) {
	case 'nama':

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM produk WHERE id_kk='$id_kk' AND nama_p like'%".$search."%'";
 
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array(
   	"label"=>$row['nama_p'],
   	"kode"=>$row['kode_barang']
   );
 }

 echo json_encode($response);
}

		break;
	
	default:

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM produk WHERE id_kk='$id_kk' AND kode_barang like'%".$search."%'";
 
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array(
   	"nama"=>$row['nama_p'],
   	"label"=>$row['kode_barang']
   );
 }

 echo json_encode($response);
}


		break;
}


exit;
?>