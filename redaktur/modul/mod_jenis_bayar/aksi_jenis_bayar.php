<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_seo.php');
	include('../mod_log/aksi_log.php');
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Jenis User
	if ($module == 'jp' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con, "Delete From jenis_pembayaran Where id_jenispem='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Jenis Pembayaran'.' ('.$id.')');
		header('location:../../media.php?module=jenis_bayar');
	}
	// Input Jenis User
	elseif ($module == 'jp' AND $act == 'input') {
		$id			= $_POST['id'];
		$nm			= $_POST['nama'];
		$simpan		= mysqli_query($con, "Insert Into jenis_pembayaran(id_jenispem,nama_jenispem) Values('$id','$nm')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Jenis Pembayaran Baru'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=jenis_bayar');
		} else {
			header('location:../../media.php?module=jenis_bayar');
		}
	}
	// Update Jenis User
	elseif ($module == 'jp' AND $act == 'edit') {
		$id		= $_POST['id'];
		$nm		= $_POST['nama'];
		$edit	= mysqli_query($con, "Update jenis_pembayaran Set nama_jenispem='$nm' Where id_jenispem='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Jenis Pembayaran'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=jenis_bayar');
		} else {
			header('location:../../media.php?module=jenis_bayar');
		}
	}