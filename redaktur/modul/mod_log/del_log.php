<?php
	session_start();
	include "../../../config/koneksi.php";
	include ("../mod_log/aksi_log.php");
	$module	= $_GET['module'];
	// Hapus Log Aktivitas
	if ($module=='hapus'){
			$del		= mysql_query("Delete From log");
			catat($_SESSION['namauser'], 'Hapus Data Log');
			header('location:../../media.php?module=log');        
	}
?>