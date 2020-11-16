<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM treatment WHERE nama_t like'%".$search."%'";
 $query2 = "SELECT * FROM biaya_administrasi WHERE nama like'%".$search."%'";
 
 $result = mysqli_query($con,$query);
 $result2 = mysqli_query($con,$query2);

 $response = array();


$cek = ($_POST['kategori'] == "4")? 0 : mysqli_num_rows($result);

if($cek > 0){
	while($row = mysqli_fetch_array($result) ){
		$k = mysqli_query($con,"SELECT jenis_pasien FROM antrian_pasien WHERE no_faktur = '$_POST[nofak]'");
		$kx = mysqli_num_rows($k);
		
		$m = mysqli_query($con,"SELECT jenis_pasien FROM history_ap WHERE no_faktur = '$_POST[nofak]'");

		$tipes = ($kx > 0)? mysqli_fetch_assoc($k) : mysqli_fetch_assoc($m);
		
		switch($tipes['jenis_pasien']){
			case "umum": $harga = $row['harga']; break;
			case "bpjs": $harga = $row['bpjs']; break;
			case "lain": $harga = $row['lain']; break;
		}
	  $response[] = array(
		  "harga"=>$harga,
		  "label"=>$row['nama_t'],
		  "modal"=>$row['modal'],
		  "status"=>"0"
	  );
	}
} else {
	while($row2 = mysqli_fetch_array($result2) ){
		
	  $response[] = array(
		  "harga"=>$row2["biaya"],
		  "label"=>$row2['nama'],
		  "status"=>"1"
		 
	  );
	}
}

//echo $cek;
 echo json_encode($response);
}

exit;
?>