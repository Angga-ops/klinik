<?php

session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id = $_POST['id'];

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = "SELECT * FROM produk a JOIN produk_master b ON a.kode_barang = b.kd_produk WHERE  a.jumlah>0 AND a.nama_p like'%".$search."%'";
 // 7 9 12 13
 $result = mysqli_query($con,$query);

 $response = array();
 while($row = mysqli_fetch_array($con,$result) ){

	$tipes = mysqli_fetch_assoc(mysqli_query($con,"SELECT jenis_pasien FROM antrian_pasien WHERE no_faktur = '$_POST[id]'"));
	switch($tipes['jenis_pasien']){
		case "umum": $harga = $row['jual_umum']; break;
		case "bpjs": $harga = $row['jual_bpjs']; break;
		case "lain": $harga = $row['jual_lain']; break;
	}
   $response[] = array("harga"=>$harga,
   	"label"=>$row['nama_p'],
   	"kode"=>$row['kode_barang'],
   	"harga_b"=>$row['harga_beli'],
   	"limit"=>$row['jumlah'],
   	"diskon"=>$bd
   );
 }

 echo json_encode($response);
}

exit();
?>