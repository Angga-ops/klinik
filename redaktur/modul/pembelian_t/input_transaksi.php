<?php 
include "../../../config/koneksi.php";

$no_fak = $_POST['no_fak'];
		$tgl    = date("Y-m-d");
		$supp   = $_POST['id_sup'];
		$pem    = $_POST['pembayaran'];
		$ket    = $_POST['ket'];
		$total  = $_POST['total'];

		mysqli_query($con, "INSERT INTO beli (no_fak, tgl_beli, id_sup, pembayaran, ket,total) VALUES('$no_fak', '$tgl', '$supp', '$pem', '$ket', '$total')");
		
		mysqli_query($con, "INSERT INTO history_beli_t (no_fak, tgl_beli, kd_brg, nama_brg, satuan, kategori, hrg, hrg_jual, batas_cabang, batas_minim, jumlah, diskon, sub_tot) SELECT '$no_fak','$tgl',kd_brg,nama_brg,satuan_t,kategori_t,hrg,hrg_jual,batas_cabang,batas_minim,jumlah,diskon,sub_tot FROM pembelian_t ");

		$q = mysqli_query($con, "SELECT * FROM history_beli_t Where no_fak='$no_fak'");

		while ($cek = mysqli_fetch_array($q)) {
			$q2 = mysqli_query($con, "SELECT * FROM produk_pusat where kode_barang='$cek[kd_brg]'");
			$jum = mysqli_num_rows($q2);

			if ($jum>0) {
				$p = mysqli_fetch_array($q2);
				$jumlah = $p['jumlah']+$cek['jumlah'];
				mysqli_query($con, "UPDATE produk_pusat SET jumlah='$jumlah' where kode_barang='$cek[kd_brg]'");
			}else{
				$nama_brg = $cek['nama_brg'];
				$hrg_beli = $cek['hrg'];
				$hrg_jual = $cek['hrg_jual'];
				$jumlah = $cek['jumlah'];
				$id_sat = $cek['satuan'];
				$kd_brg = $cek['kd_brg'];
				$kategori = $cek['kategori'];
				$batas_cabang = 100;
				$batas_minim = 10;
				mysqli_query($con, "INSERT INTO produk_pusat (
					kode_barang,nama_p,jumlah) VALUES('$kd_brg','$nama_brg','$jumlah')
					");
			}
		}
		mysqli_query($con, "TRUNCATE TABLE pembelian_t");
		header('location:../../media.php?module=pembelian_t');
?>