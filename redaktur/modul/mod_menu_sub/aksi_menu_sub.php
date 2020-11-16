<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Hapus data_gtm
	if ($module == 'ms' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con,"Delete From menu_sub Where id_ms='$id'");
		catat($con,$_SESSION['namauser'], 'Hapus Data Menu Sub'.' ('.$id.')');
		header('location:../../media.php?module=menu_sub');
	}
	// Input data_gtm Baru
	elseif ($module == 'ms' AND $act == 'input') {
		$mn			= $_POST['menu'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$lnk		= $_POST['page'];
		$sts		= $_POST['status'];
		$simpan		= mysqli_query($con,"Insert Into menu_sub(id_menu,id_ms,nama_ms,page_ms,sts_ms) Values('$mn','$id','$nm','$lnk','$sts')") or die(mysqli_error($con));
		catat($con,$_SESSION['namauser'], 'Data Menu Sub Baru'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=menu_sub');
		} else {
			header('location:../../media.php?module=menu_sub');
		}
	}
	//Update data_gtm yang Ada
	elseif ($module == 'ms' AND $act == 'edit') {
		$mn			= $_POST['menu'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$lnk		= $_POST['page'];
		$sts		= $_POST['status'];
		$edit		= mysqli_query($con,"Update menu_sub Set id_menu='$mn', nama_ms='$nm', page_ms='$lnk', sts_ms='$sts' Where id_ms='$id'") or die(mysqli_error($con));
		catat($con,$_SESSION['namauser'], 'Edit Data Menu Sub'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=menu_sub');
		} else {
			header('location:../../media.php?module=menu_sub');
		}
	}