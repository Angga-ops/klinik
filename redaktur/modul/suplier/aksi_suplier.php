<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'sup' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysqli_query($con,"Delete From suplier Where id_sup='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Suplier'.' ('.$id.')');
		header('location:../../media.php?module=suplier');
	}
	// Input Kamar Baru
	elseif ($module == 'sup' AND $act == 'input') {
		$nama_sup		    = $_POST['nama_sup'];
		$alamat				= $_POST['alamat'];
		$tlp     			= $_POST['tlp'];
		$email  			= $_POST['email'];
		$penanggung_jwb     = $_POST['penanggung_jwb'];
		$simpan		= mysqli_query($con,"Insert Into suplier(nama_sup,alamat,tlp,email,penanggung_jwb) Values('$nama_sup','$alamat','$tlp','$email','$penanggung_jwb')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Suplier Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=suplier');
		} else {
			header('location:../../media.php?module=suplier');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'sup' AND $act == 'update') {
		$id 			= $_POST['id'];
		$nama_sup		= $_POST['nama_sup'];
		$alamat		    = $_POST['alamat'];
		$tlp			= $_POST['tlp'];
		$email			= $_POST['email'];
		$penanggung_jwb	= $_POST['penanggung_jwb'];
		$update		    = mysqli_query($con,"Update suplier Set nama_sup='$nama_sup', alamat='$alamat', tlp='$tlp', email='$email', penanggung_jwb='$penanggung_jwb' Where id_sup='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Ruangan'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=suplier');
		} else {
			header('location:../../media.php?module=suplier');
		}
	}