<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

$q1 = mysql_query("SELECT *FROM produk_ps WHERE id='$id'");


$response = array();

 while($row = mysql_fetch_array($q1) ){
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