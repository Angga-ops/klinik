<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Hapus data_gtm
	if ($module == 'jt' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con, "Delete From jenis_tindakan Where id_jentik='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Jenis Tindakan'.' ('.$id.')');
		header('location:../../media.php?module=jenis_tindakan');        
	}
	// Input data_gtm Baru
	elseif ($module == 'jt' AND $act ==  'input') {
		$poli		= $_POST['tujuan'];
		$nm			= $_POST['nama'];
		$simpan		= mysqli_query($con, "Insert Into jenis_tindakan(id_goltm,nama_jentik) Values('$poli','$nm')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Jenis Tindakan Baru'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=jenis_tindakan');        
		} else {
			header('location:../../media.php?module=jenis_tindakan');        
		}
	}
	//Update data_gtm yang Ada
	elseif ($module == 'jt' AND $act ==  'edit') {
		$poli	= $_POST['tujuan'];
		$id		= $_POST['id'];
		$nm		= $_POST['nama'];
		$edit	= mysqli_query($con, "Update jenis_tindakan Set id_goltm='$poli', nama_jentik='$nm' Where id_jentik='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Jenis Tindakan'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=jenis_tindakan');        
		} else {
			header('location:../../media.php?module=jenis_tindakan');        
		}
	}