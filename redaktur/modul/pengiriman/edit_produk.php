<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

$q1 = mysqli_query($con,"SELECT *FROM produk_ps WHERE id='$id'");


$response = array();

 while($row = mysqli_fetch_array($q1) ){
   $response = array(
   	"harga"=>$row['harga_jual'],
   	"sat"=>$row['id_sat'],
   	"kat"=>$row['id_kat'],
   	"nama"=>$row['nama_produk'],
   	"kode"=>$row['kode_produk'],
   	"id"=>$row['id'],
   	"j"=>$row['jumlah']
   );
 }
  echo json_encode($response);

exit();
?>