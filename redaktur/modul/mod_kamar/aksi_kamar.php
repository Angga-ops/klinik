<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module=='kamar' AND $act=='hapus'){
		mysqli_query($con, "Delete From kamar Where id_kamar='$_GET[id_kamar]'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Kamar'.' ('.$_POST['id_kamar'].')');
		header('location:../../media.php?module=kamar');
	}
	// Input Kamar Baru
	elseif ($module == 'kamar' AND $act == 'input') {
		$idjk		= $_POST['kelas'];
		$nmkmr		= $_POST['nama_kamar'];
		$biaya		= $_POST['biaya_kamar'];
		$simpan		= mysqli_query($con, "Insert Into kamar(id_jenkamar,nama_kamar,biaya_kamar) Values('$idjk','$nmkmr','$biaya')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Kamar Baru'.' ('.$nmkmr.')');
		if($simpan){
			header('location:../../media.php?module=kamar');
		} else {
			header('location:../../media.php?module=kamar');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'kamar' AND $act == 'update') {
		$id			= $_POST['id'];
		$kelas		= $_POST['kelas'];
		$nm			= $_POST['nama_kamar'];
		$biaya		= $_POST['biaya_kamar'];
		$update		= mysqli_query($con, "Update kamar Set id_jenkamar='$kelas', nama_kamar='$nm', biaya_kamar='$biaya' Where id_kamar='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Kamar'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=kamar');
		} else {
			header('location:../../media.php?module=kamar');
		}
	}
