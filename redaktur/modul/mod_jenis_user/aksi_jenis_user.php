<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_seo.php');
	include('../mod_log/aksi_log.php');
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Jenis User
	if ($module == 'ju' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con, "Delete From jenis_user Where id_ju='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Jenis User'.' ('.$id.')');
		header('location:../../media.php?module=jenis_user');
	}
	// Input Jenis User
	elseif ($module == 'ju' AND $act == 'input') {
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$simpan		= mysqli_query($con, "Insert Into jenis_user(id_ju,nama_ju) Values('$id','$nm')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Jenis User'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=jenis_user');
		} else {
			header('location:../../media.php?module=jenis_user');
		}
	}
	// Update Jenis User
	elseif ($module == 'ju' AND $act == 'edit') {
		$id		= $_POST['id'];
		$nm		= $_POST['nama'];
		$edit	= mysqli_query($con, "Update jenis_user Set nama_ju='$nm' Where id_ju='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Jenis User'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=jenis_user');
		} else {
			header('location:../../media.php?module=jenis_user');
		}
	}