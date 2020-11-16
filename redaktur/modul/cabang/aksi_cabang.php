<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_seo.php');
	include('../mod_log/aksi_log.php');
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Jenis User
	if ($module == 'ca' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con, "Delete From daftar_klinik Where id_kk='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Jenis User'.' ('.$id.')');
		header('location:../../media.php?module=cabang');
	}
	// Input Jenis User
	elseif ($module == 'ca' AND $act == 'input') {
		$nm				= $_POST['nama'];
		$al				= $_POST['alamat'];
		$jn 			= $_POST['jenis'];
		$tlp 			= $_POST['tlp'];
		$penanggung_jwb = $_POST['penanggung_jwb'];
		$simpan		= mysqli_query($con, "INSERT Into daftar_klinik(nama_klinik,alamat,jenis,telepon,penanggung_jawab) Values('$nm','$al','$jn','$tlp','$penanggung_jwb')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Cabang Klinik'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=cabang');
		} else {
			header('location:../../media.php?module=cabang');
		}
	}
	// Update Jenis User
	elseif ($module == 'ca' AND $act == 'edit') {
		$id				= $_POST['id'];
		$nm				= $_POST['nama'];
		$al				= $_POST['alamat'];
		$jn 			= $_POST['jenis'];
		$tlp 			= $_POST['tlp'];
		$penanggung_jwb = $_POST['penanggung_jwb'];
		$edit	= mysqli_query($con, "Update daftar_klinik Set nama_klinik='$nm',alamat='$al',jenis='$jn',telepon='$tlp',penanggung_jawab='$penanggung_jwb' Where id_kk='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Cabang Klinik'.' ('.$id.')');
		if($edit){
			header('location:../../media.php?module=cabang');
		} else {
			header('location:../../media.php?module=cabang');
		}
	}