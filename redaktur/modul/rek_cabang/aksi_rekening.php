<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'rekening' AND $act == 'hapus'){
		$id		= $_GET['id_rekening'];
		$del	= mysqli_query($con,"Delete From rekening Where id_rekening='$id'");
		catat($con,$_SESSION['namauser'], 'Hapus Kategori Produk'.' ('.$id.')');
		header('location:../../media.php?module=rek_cabang');
	}
	// Input Produk Baru
	elseif ($module == 'rekening' AND $act == 'input') {
		$klinik 		= $_POST['klinik'];
		$nama_bank 		= $_POST['nama_bank'];
		$no_rek 		= $_POST['no_rek'];
		$atas_nama 		= $_POST['atas_nama'];
		$simpan = mysqli_query($con,"Insert Into rekening(id_kk,nama_bank,no_rek,atas_nama) Values('$klinik','$nama_bank','$no_rek','$atas_nama')") or die(mysqli_error($con));
	 	catat($con,$_SESSION['namauser'], 'Data Rekening Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=rek_cabang');
		} else {
			header('location:../../media.php?module=rek_cabang');
		}
	}
	//Update Produk yang Ada
	elseif ($module == 'rekening' AND $act == 'update') {
		$id				= $_POST['id_rekening'];
		$klinik 		= $_POST['klinik'];
		$nama_bank 		= $_POST['nama_bank'];
		$no_rek 		= $_POST['no_rek'];
		$atas_nama 		= $_POST['atas_nama'];
		
		$update		= mysqli_query($con,"Update rekening Set id_kk='$klinik', nama_bank='$nama_bank', no_rek='$no_rek', atas_nama='$atas_nama' Where id_rekening='$id'");
		catat($con, $_SESSION['namauser'], 'Edit KategoriKa Produk'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=rek_cabang');
		} else {
			header('location:../../media.php?module=rek_cabang');
		}
	}