<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'ds' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysql_query("Delete From data_satuan Where id_s='$id'");
		catat($_SESSION['namauser'], 'Hapus Data Satuan'.' ('.$id.')');
		header('location:../../media.php?module=data_satuan');
	}
	// Input Kamar Baru
	elseif ($module == 'ds' AND $act == 'input') {
		$satuan		        = $_POST['satuan'];
		// $status				= $_POST['status'];
		// $kapasitas			= $_POST['kapasitas'];
		// $terpakai			= $_POST['terpakai'];
		$simpan		= mysql_query("Insert Into data_satuan(satuan) Values('$satuan')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Satuan Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=data_satuan');
		} else {
			header('location:../../media.php?module=data_satuan');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'ds' AND $act == 'update') {
		$id			        = $_POST['id'];
		$satuan		        = $_POST['satuan'];
		// $status				= $_POST['status'];
		// $kapasitas			= $_POST['kapasitas'];
		// $terpakai			= $_POST['terpakai'];
		$update		= mysql_query("Update data_satuan Set satuan='$satuan' Where id_s='$id'");
		catat($_SESSION['namauser'], 'Edit Data Ruangan'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=data_satuan');
		} else {
			header('location:../../media.php?module=data_satuan');
		}
	}