<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];


if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM biaya_administrasi WHERE nama like'%".$search."%'";
 
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($result) ){
   $response[] = array(
   	"harga"=>$row['biaya'],
   	"label"=>$row['nama'],
  // 	"modal"=>$row['modal'],
   );
 }

 echo json_encode($response);
}

exit;
?>