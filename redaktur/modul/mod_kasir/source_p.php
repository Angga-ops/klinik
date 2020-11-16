<?php

session_start();

include "../../../config/koneksi.php";

if(isset($_POST['search'])){
	if($_POST['cara']=='nama'){

		$search = $_POST['search'];

		 $query = mysqli_query($con,"SELECT * FROM pasien WHERE nama_pasien like'%".$search."%'  AND id_kk = '$_SESSION[klinik]'");

		 $response = array();

		 while($row = mysqli_fetch_array($query)){
		   $response[] = array(
		   	"alamat"=>$row['alamat'],
		   	"jk"=>$row['jk'],
		   	"tgl_lahir"=>$row['tgl_lahir'],
		   	"umur"=>$row['umur'],
		   	"no_telp"=>$row['no_telp'],
		   	"label"=>$row['id_pasien']." | ".$row['nama_pasien']." | ".$row['tgl_lahir'],
		   	"nama"=>$row['nama_pasien'],
		   	"id"=>$row['id_pasien']
		   );
		 }

		 echo json_encode($response);

	}elseif ($_POST['cara']=='kode'){

		$search = $_POST['search'];

		 $query = mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien like'%".$search."%'  AND id_kk = '$_SESSION[klinik]'");

		 $response = array();

		 while($row = mysqli_fetch_array($query)){
		   $response[] = array(
		   	"alamat"=>$row['alamat'],
		   	"jk"=>$row['jk'],
		   	"tgl_lahir"=>$row['tgl_lahir'],
		   	"umur"=>$row['umur'],
		   	"no_telp"=>$row['no_telp'],
		   	"label"=>$row['id_pasien']." | ".$row['nama_pasien']." | ".$row['tgl_lahir'],
		   	"nama"=>$row['nama_pasien'],
		   	"id"=>$row['id_pasien']
		   );
		 }

		 echo json_encode($response);

	}elseif ($_POST['cara']=='tanggal'){

		$search = $_POST['search'];

		 $query = mysqli_query($con,"SELECT * FROM pasien WHERE tgl_lahir like'%".$search."%'  AND id_kk = '$_SESSION[klinik]'");

		 $response = array();

		 while($row = mysqli_fetch_array($query)){
		   $response[] = array(
		   	"alamat"=>$row['alamat'],
		   	"jk"=>$row['jk'],
		   	"tgl_lahir"=>$row['tgl_lahir'],
		   	"umur"=>$row['umur'],
		   	"no_telp"=>$row['no_telp'],
		   	"label"=>$row['id_pasien']." | ".$row['nama_pasien']." | ".$row['tgl_lahir'],
		   	"nama"=>$row['nama_pasien'],
		   	"id"=>$row['id_pasien']
		   );
		 }

		 echo json_encode($response);

	}else {

		$search = $_POST['search'];

		 $query = mysqli_query($con,"SELECT * FROM pasien WHERE nama_pasien like'%".$search."%'  AND id_kk = '$_SESSION[klinik]'");

		 $response = array();

		 while($row = mysqli_fetch_array($query)){
		   $response[] = array(
		   	"alamat"=>$row['alamat'],
		   	"jk"=>$row['jk'],
		   	"tgl_lahir"=>$row['tgl_lahir'],
		   	"umur"=>$row['umur'],
		   	"no_telp"=>$row['no_telp'],
		   	"label"=>$row['id_pasien']." | ".$row['nama_pasien']." | ".$row['tgl_lahir'],
		   	"nama"=>$row['nama_pasien'],
		   	"id"=>$row['id_pasien']
		   );
		 }

		 echo json_encode($response);

	}
}

exit;
?>