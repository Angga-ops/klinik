<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'broadcast' AND $act == 'hapus'){
		$id		= $_GET['id_broadcast'];
		$del	= mysql_query("Delete From broadcast Where id_broadcast='$id'");
		
		header('location:../../media.php?module=broadcast');
	}
	
	?>