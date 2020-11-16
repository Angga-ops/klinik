<?php 
include "../../../config/koneksi.php";

$id = $_POST['id_p'];

$q1 = mysqli_query($con,"SELECT *FROM produk_rs WHERE id_pr='$id'");


$response = array();

 while($row = mysqli_fetch_array($q1) ){
   $response = array(
   	"nama"=>$row['nama_produk'],
   	"kode"=>$row['kode_produk'],
   	"jum"=>$row['jumlah'],
      "ket"=>$row['keterangan'],
      "id"=>$row['id_pr']
   );
 }
  echo json_encode($response);

exit();
?>