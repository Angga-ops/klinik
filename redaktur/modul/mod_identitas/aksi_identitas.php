<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_thumb.php');
	require('../mod_log/aksi_log.php');
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Update Identitas
	if ($module == 'iden' AND $act=='edit') {
		$id		= $_POST['id'];
		$nmo	= $_POST['nama_organisasi'];
		$nmw	= $_POST['nama_web'];
		$almt	= $_POST['alamat'];
		$info	= $_POST['informasi'];
		//Penglolaan Gambar
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		UploadIdentitas($nama_file_unik);
		$gambar	= mysql_fetch_array(mysql_query("Select * From identitas Where id='$id'"));		
		if(empty($lokasi_file)){
			$update	= mysql_query("Update identitas Set nama_organisasi='$nmo', nama_web='$nmw', alamat='$almt', informasi='$info' Where id='$id'");			
			header('location:../../media.php?module=identitas');					
		} else {
			$update	= mysql_query("Update identitas Set nama_organisasi='$nmo', nama_web='$nmw', alamat='$almt', informasi='$info', logo='$nama_file_unik' Where id='$id'");			
			$folder	= "../../../foto_identitas/".$gambar["logo"];
			unlink($folder);
			header('location:../../media.php?module=identitas');
		}
	}
?>
