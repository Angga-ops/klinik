<?php

session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id = $_POST['id'];

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $tipes = $_POST[jamin]; /*
 switch($tipes){
	 case "umum": $harga = "AND penjamin = 'UMUM'"; break;
	 case "bpjs": $harga = "AND penjamin = 'BPJS'"; break;
	 case "lain": $harga = "AND penjamin = 'ASURANSI'"; break;
 }
 
 $query = "SELECT * FROM produk_master  WHERE  nama_produk like '".$search."%' $harga";
*/

$query = "SELECT * FROM produk a JOIN produk_master b ON a.kode_barang = b.kd_produk WHERE  a.jumlah>0 AND a.nama_p like'%".$search."%'";



 // 7 9 12 13
 $result = mysql_query($query);

 $response = array();
 while($row = mysql_fetch_array($result) ){

	
switch($tipes){
	case "umum": $harga = $row[jual_umum]; break;
	case "bpjs": $harga = $row[jual_bpjs]; break;
	case "lain": $harga = $row[jual_lain]; break;
}

	
   $response[] = array("harga"=>$harga,
   	"label"=>$row['nama_produk'],
   	"kode"=>$row['kd_produk'],
   	"harga_b"=>$row['harga_beli'],
   	"limit"=>$row['jumlah'],
   	"diskon"=>$bd
   );
 }

 echo json_encode($response);
}

exit();
?>