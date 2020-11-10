<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Hapus data_gtm
	if ($module == 'sbm' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysql_query("Delete From menu Where id_menu='$id'");
		catat($_SESSION['namauser'], 'Hapus Data Sub Menu'.' ('.$id.')');
			header('location:../../media.php?module=sub_menu');
	}
	// Input data_gtm Baru
	elseif ($module == 'sbm' AND $act == 'input') {
		$mn			= $_POST['menu'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$lnk		= $_POST['page'];
		$sts		= $_POST['status'];
		$simpan		= mysql_query("Insert Into menu(id_sm,id_menu,nama_menu,page_menu,sts_menu) Values('$mn','$id','$nm','$lnk','$sts')") or die(mysql_error());
		catat($_SESSION['namauser'], 'Data Sub Menu Baru'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=sub_menu');
		} else {
			header('location:../../media.php?module=sub_menu');
		}
	}
	//Update data_gtm yang Ada
	elseif ($module == 'sbm' AND $act == 'edit') {
		$mn			= $_POST['menu'];
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$lnk		= $_POST['page'];
		$sts		= $_POST['status'];
		$edit		= mysql_query("Update menu Set id_sm='$mn', nama_menu='$nm', page_menu='$lnk', sts_menu='$sts' Where id_menu='$id'") or die(mysql_error());
		catat($_SESSION['namauser'], 'Edit Data Sub Menu'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=sub_menu');
		} else {
			header('location:../../media.php?module=sub_menu');
		}
	}