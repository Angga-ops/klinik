<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus data barang
	if ($act == 'hapus'){
		$id		= $_POST['id_brg'];
		$del	= mysql_query("Delete From gudang Where id_brg='$id'");
		catat($_SESSION['namauser'], 'Hapus Data Stok Barang'.' ('.$id.')');
		header('location:../../media.php?module=stok_barang');
	}

	// Input data barang Baru
	elseif ($act == 'input') {
		$id         = $_POST['id_brg'];
		$nm  	    = $_POST['nama_brg'];
		$jml		= $_POST['jumlah_brg'];
		$hrg	    = $_POST['harga_brg'];
		$simpan		= mysql_query("Insert Into gudang(id_brg,nama_brg,jumlah_brg,harga_brg) Values('$id','$nm','$jml','$hrg')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Stok Barang'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=stok_barang');
		} else {
			header('location:../../media.php?module=stok_barang');
		}
	}
	//Update Stok barang yang Ada
	elseif ($act == 'update') {
		$id			= $_POST['id']; 
		$nm		    = $_POST['nama_brg'];
		$jml	    = $_POST['jumlah_brg'];
		$hrg	    = $_POST['harga_brg'];
		$update		= mysql_query("Update gudang Set nama_brg='$nm', jumlah_brg='$jml', harga_brg='$hrg' Where id_brg='$id'");
		catat($_SESSION['namauser'], 'Edit Data Stok Barang'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=stok_barang');
		} else {
			header('location:../../media.php?module=stok_barang');
		}
	}