<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'stok' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysqli_query($con,"Delete From kategori Where id_kategori='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Kategori Produk'.' ('.$id.')');
		header('location:../../media.php?module=kategori');
	}
	// Input Produk Baru
	elseif ($module == 'stok' AND $act == 'input') {
		$kategori 		= $_POST['kategori'];
		$simpan = mysqli_query($con,"Insert Into kategori(kategori) Values('$kategori')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=kategori');
		} else {
			header('location:../../media.php?module=kategori');
		}
	}
	//Update Produk yang Ada
	elseif ($module == 'stok' AND $act == 'update') {
		$id				= $_POST['id'];
		$batas_minim 		= $_POST['batas_minim'];
		
		$update		= mysqli_query($con,"Update produk Set batas_minim='$batas_minim' Where id_p='$id'");
		catat($con, $_SESSION['namauser'], 'Edit KategoriKa Produk'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=stok_cabang');
		} else {
			header('location:../../media.php?module=stok_cabang');
		}
	}