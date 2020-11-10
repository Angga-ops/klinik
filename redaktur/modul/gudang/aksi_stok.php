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
		$id_pp		= $_GET['id_pp'];
		$del	= mysql_query("Delete From produk_pusat Where id_pp='$id_pp'");
		header('location:../../media.php?module=gudang');
	}

	// Input data barang Baru
	elseif ($act == 'input') {
		$kd_produk			= $_POST['kd_produk']; 
		$nama_produk		= $_POST['nama_produk'];
		$kategori_produk	= $_POST['kategori_produk'];
		$stok_produk	    = $_POST['stok_produk'];
		$satuan	    		= $_POST['satuan'];
		$harga_beli	    	= $_POST['harga_beli'];
		$harga_jual	    	= $_POST['harga_jual'];
		$suplier	    	= $_POST['suplier'];
		$batas_cabang		= $_POST['batas_cabang'];
		$batas_minim		= $_POST['batas_minim'];
		$simpan		= mysql_query("Insert Into produk_pusat(nama_produk,harga_beli,harga_jual,jumlah,id_sat,id_supp,kode_produk,id_kategori,batas_cabang,batas_minim) Values('$nama_produk','$harga_beli','$harga_jual','$stok_produk','$satuan','$suplier','$kd_produk','$kategori_produk','$batas_cabang','$batas_minim')") or die(mysql_error());
	 	catat($_SESSION['namauser'], 'Data Stok Barang'.' ('.$nm.')');
		if($simpan){
			header('location:../../media.php?module=gudang');
		} else {
			header('location:../../media.php?module=gudang');
		}
	}
	//Update Stok barang yang Ada
	elseif ($act == 'update') {
		$id_pp 				= $_POST['id_pp'];
		$kd_produk			= $_POST['kd_produk']; 
		$nama_produk		= $_POST['nama_produk'];
		$kategori_produk	= $_POST['kategori_produk'];
		$stok_produk	    = $_POST['stok_produk'];
		$satuan	    		= $_POST['satuan'];
		$harga_beli	    	= $_POST['harga_beli'];
		$harga_jual	    	= $_POST['harga_jual'];
		$suplier	    	= $_POST['suplier'];
		$batas_cabang		= $_POST['batas_cabang'];
		$batas_minim		= $_POST['batas_minim'];
		$update		= mysql_query("Update produk_pusat Set nama_produk='$nama_produk', harga_beli='$harga_beli', harga_jual='$harga_jual', jumlah='$stok_produk', id_sat='$satuan', id_supp='$suplier', kode_produk='$kd_produk', id_kategori='$kategori_produk', batas_cabang='$batas_cabang', batas_minim='$batas_minim' Where id_pp='$id_pp'");
		catat($_SESSION['namauser'], 'Edit Data Stok Barang'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=gudang');
		} else {
			header('location:../../media.php?module=gudang');
		}
	}