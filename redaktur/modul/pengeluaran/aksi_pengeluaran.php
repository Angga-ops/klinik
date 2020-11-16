<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";

	$act	= $_GET['act'];
	// Hapus Produk
	if ($act == 'hapus'){
		$id		= $_GET['id'];
		$del	= mysqli_query($con,"Delete From pengeluaran Where id_p='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data pengeluaran'.' ('.$id.')');
		header('location:../../media.php?module=pengeluaran');
	}
	// Input Produk Baru
	elseif ($act == 'input') {
		$id_kk		= $_POST['id_kk'];
		$tanggal	= $_POST['tanggal'];
		$kasir 		= $_POST['kasir'];
		$biaya		= $_POST['biaya'];
		$kategori	= $_POST['kategori'];
		$ket		= $_POST['keterangan'];

		$simpan = mysqli_query($con,"INSERT Into pengeluaran(tanggal,kasir,biaya_p,kategori_p,ket,id_kk) Values('$tanggal','$kasir','$biaya','$kategori','$ket','$id_kk')") or die(mysqli_error($con));

	 	catat($con, $_SESSION['namauser'], 'Data pengeluaran Baru'.' ('.$nmrgn.')');

		if($simpan){
			header('location:../../media.php?module=pengeluaran');
		} else {
			header('location:../../media.php?module=pengeluaran');
		}
	}
	//Update Produk yang Ada
	elseif ($act == 'update') {

		$id			= $_POST['id'];
		$tanggal	= $_POST['tanggal'];
		$kasir 		= $_POST['kasir'];
		$biaya		= $_POST['biaya'];
		$kategori	= $_POST['kategori'];
		$ket		= $_POST['keterangan'];
		$id_kk		= $_POST['id_kk'];
		

		$update		= mysqli_query($con, "UPDATE pengeluaran Set tanggal='$tanggal',kasir='$kasir',biaya_p='$biaya',kategori_p='$kategori',ket='$ket', id_kk='$id_kk' Where id_p='$id'");

		catat($con, $_SESSION['namauser'], 'Edit Data pengeluaran'.' ('.$id.')');
		if($update){
			header('location:../../media.php?module=pengeluaran');
		} else {
			header('location:../../media.php?module=pengeluaran');
		}
	}