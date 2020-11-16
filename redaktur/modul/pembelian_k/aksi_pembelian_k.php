<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk pusat
	if ($act == 'hapus'){
		$id		= $_GET['no_fak'];
		mysqli_query($con,"Delete From beli_k Where no_fak='$id'");
		mysqli_query($con,"Delete From history_beli_k Where no_fak='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Produk'.' ('.$id.')');
		
	}
	// Input Produk pusat Baru
	elseif ($act == 'input') {
		$kd_brg 		= $_POST['kd_brg'];
		$nama_brg 		= $_POST['nama_brg'];
		$satuan		    = $_POST['satuan'];
		$kategori		= $_POST['kategori'];
		$jumlah			= $_POST['jumlah'];
		$hrg 			= $_POST['hrg'];
		$hrg_tot		= $jumlah*$hrg;
		$diskon			= $_POST['diskon'];
		//$id_sup			= $_POST['id_sup'];
		$diskon_harga   = $hrg_tot*($diskon/100);
		$sub_tot		= $hrg_tot-$diskon_harga;
		//$no_fak			= $_POST['no_fak'];
		//$tgl_beli		= $_POST['tgl_beli'];
		//$suplier		= $_POST['suplier'];
		//$total			= $_POST['total'];
		$tgl_tempo		= $_POST['tgl_tempo'];

		$jumlahkan 		= "SELECT SUM(sub_tot) AS total FROM pembelian_k";
		mysqli_query($con,"INSERT INTO pembelian_k(kd_brg,nama_brg,satuan,kategori,jumlah,hrg,diskon,sub_tot) VALUES('$kd_brg','$nama_brg','$satuan','$kategori','$jumlah', '$hrg', '$diskon', '$sub_tot')") or die(mysqli_error($con));
		//echo "input";

	}
	//Update Produk pusat yang Ada
	elseif ($act == 'update') {
		$id				= $_POST['id_k'];
		$kd_brg 		= $_POST['kd_brg'];
		$nama_brg 		= $_POST['nama_brg'];
		$satuan		    = $_POST['satuan'];
		$kategori		= $_POST['kategori'];
		$jumlah			= $_POST['jumlah'];
		$hrg 			= $_POST['hrg'];
		$hrg_tot		= $jumlah*$hrg;
		$diskon			= $_POST['diskon'];
		//$id_sup			= $_POST['id_sup'];
		$diskon_harga   = $hrg_tot*($diskon/100);
		$sub_tot		= $hrg_tot-$diskon_harga;
		//$no_fak			= $_POST['no_fak'];
		$tgl_beli		= $_POST['tgl_beli'];
		//$suplier		= $_POST['suplier'];
		//$total			= $_POST['total'];
		$tgl_tempo		= $_POST['tgl_tempo'];
		$update		= mysqli_query($con,"UPDATE pembelian_k SET kd_brg='$kd_brg', nama_brg='$nama_brg', satuan='$satuan', kategori='$kategori', jumlah='$jumlah', hrg='$hrg', diskon='$diskon', sub_tot='$sub_tot' Where id='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Produk'.' ('.$id.')');
}
	elseif($module == 'pembelian_kk' AND $act == 'transaksi'){
		$no_fak = $_POST['no_fak'];
		$tgl    = date('Y-m-d');
		$supp   = $_POST['id_sup'];
		$tgl_tempo	= $_POST['tgl_tempo'];
		$total  = $_POST['total'];

		mysqli_query($con,"INSERT INTO beli_k (no_fak, tgl_beli,total, id_sup, tgl_tempo) VALUES('$no_fak', '$tgl','$total', '$supp', '$tgl_tempo')");
		
		mysqli_query($con,"INSERT INTO history_beli_k (no_fak, tgl_beli, kd_brg, nama_brg, satuan, kategori, hrg, jumlah, diskon, sub_tot) SELECT '$no_fak','$tgl',kd_brg,nama_brg,satuan,kategori,hrg,jumlah,diskon,sub_tot FROM pembelian_k ");

		//mysql_query("TRUNCATE TABLE pembelian_t");
		header('location:../../media.php?module=pembelian_k');



	}
	header('location:../../media.php?module=pembelian_k');
	exit();
	?>