<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Hapus data_gtm
	if ($module == 'sm' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con,"Delete From sub_menu Where id_sm='$id'");
		catat($con,$_SESSION['namauser'], 'Hapus Data Menu'.' ('.$id.')');
			header('location:../../media.php?module=set_menu');
	}
	// Input data_gtm Baru
	elseif ($module == 'sm' AND $act == 'input') {
		$ju			= $_POST['jenis_user'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$lnk		= $_POST['page'];
		$urutan		= $_POST['urutan'];
		$icon		= $_POST['icon'];
		$sts		= $_POST['status'];
		$simpan		= mysqli_query($con,"Insert Into sub_menu(id_ju,id_sm,nama_sm,page_sm,icon_fa,sts_sm,urutan) Values('$ju','$id','$nm','$lnk','$icon','$sts','$urutan')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Menu Baru'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=set_menu');
		} else {
			header('location:../../media.php?module=set_menu');
		}
	}
	//Update data_gtm yang Ada
	elseif ($module == 'sm' AND $act == 'edit') {
		$ju			= $_POST['jenis_user'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$urutan		= $_POST['urutan'];
		$lnk		= $_POST['page'];
		$icon		= $_POST['icon'];
		$sts		= $_POST['status'];
		$edit		= mysqli_query($con,"Update sub_menu Set urutan='$urutan',id_ju='$ju', nama_sm='$nm', page_sm='$lnk', icon_fa='$icon' , sts_sm='$sts' Where id_sm='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Menu'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=set_menu');
		} else {
			header('location:../../media.php?module=set_menu');
		}
	}