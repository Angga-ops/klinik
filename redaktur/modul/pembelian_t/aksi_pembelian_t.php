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
		mysqli_query($con, "Delete From beli Where no_fak='$id'");
		mysqli_query($con, "Delete From history_beli_t Where no_fak='$id'");
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
		$hrg_jual			= $_POST['harga_jual'];
		$batas_cabang			= $_POST['batas_cabang'];
		$batas_minim			= $_POST['batas_minim'];
		//$id_sup			= $_POST['id_sup'];
		$diskon_harga   = $hrg_tot*($diskon/100);
		$sub_tot		= $hrg_tot-$diskon_harga;
		//$no_fak			= $_POST['no_fak'];
		$tgl_beli		= $_POST['tgl_beli'];
		//$suplier		= $_POST['suplier'];
		//$total			= $_POST['total'];
		$pembayaran		= $_POST['pembayaran'];
		$ket			= $_POST['ket'];

		$jumlahkan 		= "SELECT SUM(sub_tot) AS total FROM pembelian_t";
		mysqli_query($con, "INSERT INTO pembelian_t(kd_brg,nama_brg,satuan_t,kategori_t,hrg,hrg_jual,batas_cabang,batas_minim,jumlah,diskon,sub_tot,tgl_beli) VALUES('$kd_brg','$nama_brg','$satuan','$kategori', '$hrg','$hrg_jual','$batas_cabang','$batas_minim','$jumlah', '$diskon', '$sub_tot', '$tgl_beli')");
		

	}
	//Update Produk pusat yang Ada
	elseif ($act == 'update') {
		$id				= $_POST['id_t'];
		$kd_brg 		= $_POST['kd_brg'];
		$nama_brg 		= $_POST['nama_brg'];
		$satuan		    = $_POST['satuan'];
		$kategori		= $_POST['kategori'];
		$jumlah			= $_POST['jumlah'];
		$hrg 			= $_POST['hrg'];
		$hrg_tot		= $jumlah*$hrg;
		$diskon			= $_POST['diskon'];
		$hrg_jual			= $_POST['harga_jual'];
		$batas_cabang			= $_POST['batas_cabang'];
		$batas_minim			= $_POST['batas_minim'];
		//$id_sup			= $_POST['id_sup'];
		$diskon_harga   = $hrg_tot*($diskon/100);
		$sub_tot		= $hrg_tot-$diskon_harga;
		//$no_fak			= $_POST['no_fak'];
		$tgl_beli		= $_POST['tgl_beli'];
		//$suplier		= $_POST['suplier'];
		//$total			= $_POST['total'];
		$pembayaran		= $_POST['pembayaran'];
		$ket			= $_POST['ket'];
		$update		= mysqli_query($con, "UPDATE pembelian_t SET kd_brg='$kd_brg', nama_brg='$nama_brg', satuan='$satuan', kategori='$kategori', jumlah='$jumlah', hrg='$hrg', diskon='$diskon', sub_tot='$sub_tot', tgl_beli='$tgl_beli') Where id='$id'");
		catat($con, $_SESSION['namauser'], 'Edit Data Produk'.' ('.$id.')');
	}
	elseif($module == 'pembelian_kk' AND $act == 'transaksi'){
		$no_fak = $_POST['no_fak'];
		$tgl    = date("Y-m-d");
		$supp   = $_POST['id_sup'];
		$pem    = $_POST['pembayaran'];
		$ket    = $_POST['ket'];
		$total  = $_POST['total'];

		mysqli_query($con, "INSERT INTO beli (no_fak, tgl_beli,total, id_sup, pembayaran, ket) VALUES('$no_fak', '$tgl','$total', '$supp', '$pem', '$ket')");
		
		mysqli_query($con, "INSERT INTO history_beli_t (no_fak, tgl_beli, kd_brg, nama_brg, satuan, kategori, hrg, jumlah, diskon, sub_tot) SELECT '$no_fak','$tgl',kd_brg,nama_brg,satuan,kategori,hrg,jumlah,diskon,sub_tot FROM pembelian_t ");

		$q = mysqli_query($con, "SELECT * FROM history_beli_t Where no_fak='$no_fak'");

		while ($cek = mysqli_fetch_array($q)) {
			$q2 = mysqli_query($con, "SELECT * FROM produk_pusat where nama_produk='$cek[nama_brg]'");
			$jum = mysqli_num_rows($q2);

			if ($jum >0) {
				$p = mysqli_fetch_array($q2);
				$jumlah = $p['jumlah']+$cek['jumlah'];
				mysqli_query($con, "UPDATE produk_pusat SET jumlah='$jumlah' where nama_produk='$cek[nama_brg]'");
			}else{
				mysqli_query($con, "INSERT INTO produk_pusat(
					nama_produk,harga_beli,harga_jual,jumlah,id_sat,id_supp,kode_produk,id_kategori,batas_cabang,batas_minim
					");
			}
			
		}

		//mysql_query("TRUNCATE TABLE pembelian_t");

		//header('location:../../media.php?module=lap_pembelian');
		header('location:../../media.php?module=pembelian_t');


	}
	header('location:../../media.php?module=pembelian_t');
	exit();
?>