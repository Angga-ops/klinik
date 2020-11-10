<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'pekerjaan' AND $act == 'hapus'){
		$id		= $_GET['id_pekerjaan'];
		$del	= mysql_query("Delete From pekerjaan Where id_pekerjaan='$id'");
		catat($_SESSION['namauser'], 'Hapus Kategori Produk'.' ('.$id.')');
		header('location:../../media.php?module=pekerjaan');
	}
	// Input Produk Baru
	elseif ($module == 'pekerjaan' AND $act == 'input') {
		$pekerjaan 		= $_POST['pekerjaan'];
		$simpan = mysql_query("Insert Into pekerjaan(pekerjaan) Values('$pekerjaan')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=pekerjaan');
		} else {
			header('location:../../media.php?module=pekerjaan');
		}
	}
	//Update Produk yang Ada
	elseif ($module == 'pekerjaan' AND $act == 'update') {
		$id				= $_POST['id_pekerjaan'];
		$pekerjaan 		= $_POST['pekerjaan'];
		
		$update		= mysql_query("Update pekerjaan Set pekerjaan='$pekerjaan' Where id_pekerjaan='$id'");
		catat($_SESSION['namauser'], 'Edit KategoriKa Produk'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=pekerjaan');
		} else {
			header('location:../../media.php?module=pekerjaan');
		}
	}