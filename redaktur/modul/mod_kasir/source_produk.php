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
 while($row = mysqli_fetch_array($result) ){

	$k = mysqli_query($con,"SELECT jenis_pasien FROM antrian_pasien WHERE no_faktur = '$_POST[nofak]'");
		$kx = mysqli_num_rows($k);
		
		$m = mysqli_query($con,"SELECT jenis_pasien FROM history_ap WHERE no_faktur = '$_POST[nofak]'");
		$mx = mysqli_num_rows($m);

		$md = mysqli_query($con,"SELECT jenis_pasien FROM perawatan_pasien WHERE no_faktur = '$_POST[nofak]'");
		$mdx = mysqli_num_rows($md);

		if($kx > 0){
		$tipes = mysqli_fetch_assoc($k);
		} else if($mx > 0){
		$tipes = mysqli_fetch_assoc($m);
		} else {
		$tipes = mysqli_fetch_assoc($md);
		}

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