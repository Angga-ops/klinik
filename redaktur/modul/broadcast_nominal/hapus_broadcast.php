<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'bc_nominal' AND $act == 'hapus'){
		$id		= $_GET['id_broadcast'];
		$del	= mysqli_query($con, "Delete From broadcast_nominal Where id_broadcast='$id'");
		
		header('location:../../media.php?module=bc_nominal');
	}
	
	?>