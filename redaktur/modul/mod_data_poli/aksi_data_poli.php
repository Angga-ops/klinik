<?php
	session_start();
	include "../../../config/koneksi.php";
	include ("../../../config/fungsi_seo.php");
	include ("../mod_log/aksi_log.php");
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Poli
	if ($module=='data_poli' AND $act=='hapus'){
		$idp		= $_GET['id'];		
		$del		= mysqli_query($con, "Delete From tujuan Where id_poli='$idp'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Poli'.' ('.$idp.')');
		header('location:../../media.php?module=data_poli');
	}
	// Input Poli
	elseif ($module == 'data_poli' AND $act == 'input') {
		$idnp		= $_POST['iden_poli'];
		$nmp		= $_POST['nama_poli'];
		$biaya		= $_POST['biaya_poli'];
		$sts		= $_POST['aktif'];
		$simpan		= mysqli_query($con, "Insert Into tujuan(iden_poli,nama_poli,biaya_poli,aktif) Values('$idnp','$nmp','$biaya','$sts')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Poli Baru'.' ('.$idp.')');
		if($simpan){
			header('location:../../media.php?module=data_poli');
		} else {
			header('location:../../media.php?module=data_poli');
		}
	}
	// Update Poli
	elseif ($module == 'data_poli' AND $act == 'edit') {
		$idp		= $_POST['id_poli'];
		$idnp		= $_POST['iden_poli'];
		$nmp		= $_POST['nama_poli'];
		$biaya		= $_POST['biaya_poli'];
		$sts		= $_POST['aktif'];
		$edit		= mysqli_query($con, "Update tujuan Set iden_poli='$idnp', nama_poli='$nmp', biaya_poli='$biaya', aktif='$sts' Where id_poli='$idp'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Poli'.' ('.$idp.')');
		if($edit){
			header('location:../../media.php?module=data_poli');
		} else {
			header('location:../../media.php?module=data_poli');
		}
	}