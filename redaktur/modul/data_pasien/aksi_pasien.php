<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'data_pasien' AND $act == 'hapus'){
		$id		= $_GET['id_pasien'];
		$del	= mysqli_query($con, "Delete From pasien Where id='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Pasien'.' ('.$id.')');
		header('location:../../media.php?module=data_pasien');
	}
	//Update Produk yang Ada
	elseif ($module == 'data_pasien' AND $act == 'update') {
		$id = $_POST['id'];
		$id_pasien				= $_POST['norm'];
		$nama_pasien			= $_POST['nama'];
		$alamat					= $_POST['alamat'];
		$jk						= $_POST['jk'];
		$tgl_lahir				= $_POST['tgl_lahir'];
		$umur = new DateTime($tgl_lahir);
		$today = new DateTime();
		$y = $today->diff($umur);
		$no_telp				= $_POST['no_telp'];
		$tgl_pendaftaran		= $_POST['tgl_pendaftaran'];
		$pekerjaan				= $_POST['pekerjaan'];
		
		
		$update		= mysqli_query($con, "Update pasien Set id_pasien='$id_pasien',nama_pasien='$nama_pasien',alamat='$alamat',jk='$jk',tgl_lahir='$tgl_lahir',umur='$y->y',no_telp='$no_telp',tgl_pendaftaran='$tgl_pendaftaran',pekerjaan='$pekerjaan' Where id='$id'");
		catat($con, $_SESSION['namauser'], 'Edit KategoriKa Produk'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=data_pasien');
		} else {
			header('location:../../media.php?module=data_pasien');
		}
	}