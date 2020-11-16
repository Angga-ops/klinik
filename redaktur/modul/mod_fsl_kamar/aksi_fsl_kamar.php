<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'dk' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysqli_query($con, "Delete From detail_kamar Where id_dk='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Fasilitas Kamar'.' ('.$id.')');
		header('location:../../media.php?module=fsl_kamar');
	}
	// Input Kamar Baru
	elseif ($module == 'dk' AND $act == 'input') {
		$kmr		= $_POST['kamar'];
		$keadaan	= $_POST['keadaan'];
		$fasilitas	= $_POST['fasilitas'];
		$simpan		= mysqli_query($con, "Insert Into detail_kamar(id_kamar,keadaan,fasilitas) Values('$kmr','$keadaan','$fasilitas')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Fasilitas Kamar Baru'.' ('.$nmkmr.')');
		if($simpan){
			header('location:../../media.php?module=fsl_kamar');
		} else {
			header('location:../../media.php?module=fsl_kamar');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'dk' AND $act == 'update') {
		$id			= $_POST['id'];
		$kmr		= $_POST['kamar'];
		$keadaan	= $_POST['keadaan'];
		$fasilitas	= $_POST['fasilitas'];
		$update		= mysqli_query($con, "Update detail_kamar Set id_kamar='$kmr', keadaan='$keadaan', fasilitas='$fasilitas' Where id_dk='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Fasilitas Kamar'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=fsl_kamar');
		} else {
			header('location:../../media.php?module=fsl_kamar');
		}
	}