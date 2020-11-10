<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'katpel' AND $act == 'hapus'){
		$id		= $_GET['id_katpel'];
		$del	= mysql_query("Delete From kategori_pelanggan Where id_katpel='$id'");
		catat($_SESSION['namauser'], 'Hapus Kategori Produk'.' ('.$id.')');
		header('location:../../media.php?module=kategori_pelanggan');
	}
	// Input Produk Baru
	elseif ($module == 'katpel' AND $act == 'input') {
		$kategori 		= $_POST['kategori'];
		$diskon_p 		= $_POST['diskon_p'];
		$diskon_t 		= $_POST['diskon_t'];
		$keterangan 		= $_POST['keterangan'];
		$simpan = mysql_query("Insert Into kategori_pelanggan(kategori,keterangan,diskon_p,diskon_t) Values('$kategori','$keterangan','$diskon_p','$diskon_t')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Kategori Pelanggan Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=kategori_pelanggan');
		} else {
			header('location:../../media.php?module=kategori_pelanggan');
		}
	}
	//Update Produk yang Ada
	elseif ($module == 'katpel' AND $act == 'update') {
		$id				= $_POST['id_katpel'];
		$kategori 		= $_POST['kategori'];
		$diskon_p 		= $_POST['diskon_p'];
		$diskon_t 		= $_POST['diskon_t'];
		$keterangan 		= $_POST['keterangan'];
		
		$update		= mysql_query("Update kategori_pelanggan Set kategori='$kategori', keterangan='$keterangan', diskon_p='$diskon_p', diskon_t='$diskon_t' Where id_katpel='$id'");
		catat($_SESSION['namauser'], 'Edit Kategori pelanggan baru'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=kategori_pelanggan');
		} else {
			header('location:../../media.php?module=kategori_pelanggan');
		}
	}