<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'krisar' AND $act == 'hapus'){
		$id		= $_GET['id_krisar'];
		$del	= mysqli_query($con, "Delete From krisar Where id_krisar='$id'");
		header('location:../../media.php?module=kritik_saran');
	}
	// Input Produk Baru
	elseif ($module == 'krisar' AND $act == 'input') {
		$cabang 		= $_POST['cabang'];
		$tanggal 		= $_POST['tanggal'];
		$nama		= $_POST['nama'];
		$no_telp 		= $_POST['no_telp'];
		$beauty 		= $_POST['beauty'];
		$krisar 		= $_POST['krisar'];
		$simpan = mysqli_query($con, "Insert Into krisar(tanggal,nama,no_telp,beauty,krisar,id_kk) Values('$tanggal','$nama','$no_telp','$beauty','$krisar','$cabang')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Krisar Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=kritik_saran');
		} else {
			header('location:../../media.php?module=kritik_saran');
		}
	}
	//Update Produk yang Ada
	elseif ($module == 'krisar' AND $act == 'update') {
		$id_krisar				= $_POST['id_krisar'];
		$cabang 		= $_POST['cabang'];
		$tanggal 		= $_POST['tanggal'];
		$nama 		= $_POST['nama'];
		$no_telp 		= $_POST['no_telp'];
		$beauty 		= $_POST['beauty'];
		$krisar 		= $_POST['krisar'];
		
		$update		= mysqli_query($con, "Update krisar Set tanggal='$tanggal',nama='$nama',no_telp='$no_telp',beauty='$beauty',krisar='$krisar', id_kk='$cabang' Where id_krisar='$id_krisar'");
		catat($con, $_SESSION['namauser'], 'Edit Krisar Produk'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=kritik_saran');
		} else {
			header('location:../../media.php?module=kritik_saran');
		}
	}