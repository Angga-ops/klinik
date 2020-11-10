<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Kamar
	if ($module == 'produk_keluar' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysql_query("Delete From pengiriman Where id_pengiriman='$id'");
		catat($_SESSION['namauser'], 'Hapus Data Suplier'.' ('.$id.')');
		header('location:../../media.php?module=produk_keluar');
	}
	// Input Kamar Baru
	elseif ($module == 'produk_keluar' AND $act == 'input') {
		$nomer		        = $_POST['nomer'];
		$kode_barang		= $_POST['kode_barang'];
		$nama_p          	= $_POST['nama_p'];
		$id_kategori  		= $_POST['id_kategori'];
		$id_s               = $_POST['id_s'];
		$harga_jual         = $_POST['harga_jual'];
		$jumlah             = $_POST['jumlah'];
		$tgl                = $_POST['tgl'];
		$id_kk              = $_POST['id_kk'];
		$pengiriman         = $_POST['pengiriman'];
		$simpan		= mysql_query("Insert Into pengiriman(nomer,kode_barang,nama_p,id_kategori,id_s,harga_jual,jumlah,tgl,id_kk,pengiriman) Values('$nomer','$kode_barang','$nama_p','$id_kategori','$id_s','$harga_jual','$jumlah','$tgl','$id_kk','$pengiriman')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Suplier Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=produk_keluar');
		} else {
			header('location:../../media.php?module=produk_keluar');
		}
	}
	//Update Kamar yang Ada
	elseif ($module == 'produk_keluar' AND $act == 'update') {
		$id 				= $_POST['id'];
		$nomer		        = $_POST['nomer'];
		$kode_barang		= $_POST['kode_barang'];
		$nama_p          	= $_POST['nama_p'];
		$id_kategori  		= $_POST['id_kategori'];
		$id_s               = $_POST['id_s'];
		$harga_jual         = $_POST['harga_jual'];
		$jumlah             = $_POST['jumlah'];
		$tgl                = $_POST['tgl'];
		$id_kk              = $_POST['id_kk'];
		$pengiriman         = $_POST['pengiriman'];
		$update		    = mysql_query("Update pengiriman Set nomer='$nomer', kode_barang='$kode_barang', nama_p='$nama_p', id_kategori='$id_kategori', id_s='$id_s', harga_jual='$harga_jual', jumlah='$jumlah', tgl='$tgl', id_kk='$id_kk', pengiriman='$pengiriman' Where id_pengiriman='$id'");
		catat($_SESSION['namauser'], 'Edit Data Ruangan'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=produk_keluar');
		} else {
			header('location:../../media.php?module=produk_keluar');
		}
	}