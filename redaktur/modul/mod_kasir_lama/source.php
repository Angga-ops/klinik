<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query2 = "SELECT * FROM treatment WHERE nama_t like'%".$search."%' AND kategori = '$_POST[kategori]'";
 
 $result2 = mysqli_query($con,$query2);

 $response = array();

$cek = mysqli_num_rows($result2);

if($cek == 0){
	
} else {
	while($row2 = mysqli_fetch_array($result2) ){

		$kat = mysqli_fetch_assoc(mysqli_query($con,"SELECT kategori FROM kategori_biaya WHERE id = '$row2[kategori]'"));
		
	  $response[] = array(
		  "harga"=>$row2["harga"],
		  "label"=>$row2['nama_t']
		 
	  );
	}
}

//echo $cek;
 echo json_encode($response);
}

exit;
?>