<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'dt' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysqli_query($con,"Delete From treatment Where id='$id'");
		catat($con,$_SESSION['namauser'], 'Hapus Ruangan'.' ('.$id.')');
		header('location:../../media.php?module=treatment');
	}
	// Input Kamar Baru
	elseif ($module == 'dt' AND $act == 'input') {
		$kat				= $_POST['kategori'];
		$nama_t				= $_POST['nama_t'];
		$modal				= $_POST['modal'];
		$manfaat			= $_POST['manfaat'];
		$umum				= $_POST['umum'];
		$bpjs				= $_POST['bpjs'];
		$lain				= $_POST['lain'];
		$jasa				= $_POST['jasa'];
		$simpan		= mysqli_query($con,"Insert Into treatment(nama_t,manfaat,harga,bpjs,lain,jasa_dokter,modal,kategori) Values('$nama_t','$manfaat','$umum','$bpjs','$lain','$jasa','$modal','$kat')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Treatment Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=treatment');
		} else {
			header('location:../../media.php?module=treatment');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'dt' AND $act == 'update') {
		$kat				= $_POST['kategori'];
		$id					= $_POST['id'];
		$nama_t				= $_POST['nama_t'];
		$modal				= $_POST['modal'];
		$manfaat			= $_POST['manfaat'];
		$umum				= $_POST['umum'];
		$bpjs				= $_POST['bpjs'];
		$lain				= $_POST['lain'];
		$jasa				= $_POST['jasa'];
		$update		= mysqli_query($con,"Update treatment Set kategori='$kat', nama_t='$nama_t', manfaat='$manfaat', harga='$umum',bpjs='$bpjs',lain='$lain',jasa_dokter='$jasa',modal='$modal' Where id='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Ruangan'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=treatment');
		} else {
			header('location:../../media.php?module=treatment');
		}
	}