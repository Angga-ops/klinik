<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'dr' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysql_query("Delete From ruangan Where id='$id'");
		catat($_SESSION['namauser'], 'Hapus Ruangan'.' ('.$id.')');
		header('location:../../media.php?module=druangan');
	}
	// Input Kamar Baru
	elseif ($module == 'dr' AND $act == 'input') {
		$nama_ruangan		= $_POST['nama_ruangan'];
		$status				= $_POST['status'];
		$kapasitas			= $_POST['kapasitas'];
		$terpakai			= $_POST['terpakai'];
		$id_kk				= $_POST['cabang'];

		$simpan		= mysql_query("Insert Into ruangan(nama_ruangan,status,kapasitas,terpakai,id_kk) Values('$nama_ruangan','$status','$kapasitas','$terpakai','$id_kk')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Ruanagan Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=druangan');
		} else {
			header('location:../../media.php?module=druangan');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'dr' AND $act == 'update') {
		$id			        = $_POST['id'];
		$nama_ruangan		= $_POST['nama_ruangan'];
		$kapasitas			= $_POST['kapasitas'];
		$id_kk				= $_POST['cabang'];
		$update		= mysql_query("UPDATE ruangan Set nama_ruangan='$nama_ruangan', kapasitas='$kapasitas', id_kk='$id_kk' Where id='$id'");
		catat($_SESSION['namauser'], 'Edit Data Ruangan'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=druangan');
		} else {
			header('location:../../media.php?module=druangan');
		}
	}