<?php

session_start();

include "../../../config/koneksi.php";

$nop      = $_POST["nop"];
$id_kk    = $_SESSION['klinik'];
$penerima = $_SESSION['namalengkap'];
$tanggal  = date("Y-m-d");


$q1  = mysqli_query($con,"SELECT *FROM produk_reture");
$cek = mysqli_num_rows($q1); 

// Mencari No Reture
$array = array();
if($cek>0){
	while($pr = mysqli_fetch_array($q1)){
		$nor     = substr($pr["no_reture"], 2);
		$array[] = $nor;
	}
	$no_reture = max($array);
	$no_reture++;
	$no_reture = "R-".$no_reture;
}else{
	$no_reture = "R-1";
}

// Menambahkan dan mengecek
$q = mysqli_query($con,"SELECT *FROM produk_pengiriman WHERE no_pengiriman='$nop'");

while ($cek = mysqli_fetch_array($q)) {

	$qr   = mysqli_query($con,"SELECT *FROM produk_rs WHERE no_pengiriman='$nop' AND nama_produk='$cek[nama_produk]'");
	$cekr = mysqli_num_rows($qr);
	$jr   = mysqli_fetch_array($qr);
	$jumlah_reture=0;
	
	if ($cekr>0) {
		$jumlah_reture = $jr['jumlah'];
	}

	$q2 = mysqli_query($con,"SELECT *FROM produk WHERE nama_p='$cek[nama_produk]' AND id_kk='$id_kk'");
	$jum = mysqli_num_rows($q2);



	if($jum>0){

		$p = mysqli_fetch_array($q2);
		$jumlah = $p['jumlah']+$cek['jumlah']-$jumlah_reture;
		mysqli_query($con,"UPDATE produk SET jumlah='$jumlah' WHERE nama_p='$cek[nama_produk]' AND id_kk='$id_kk'");

	}else{

		$kb     = $cek['kode_produk'];
		$np     = $cek['nama_produk'];
		$hj     = $cek['harga_jual'];
		$jumlah = $cek['jumlah']-$jumlah_reture;
		$id_s	= $cek['id_sat'];
		$id_k	= $cek['id_kat'];
		$maks	= $cek['cabang_maks'];
		$min	= $cek['cabang_min'];
		$hb		= $cek['harga_b'];
		mysqli_query($con,"INSERT INTO produk (kode_barang,nama_p,harga_jual,id_s,id_kategori,id_kk,jumlah,harga_beli,batas_minim,batas_maks) VALUES ('$kb','$np','$hj','$id_s','$id_k','$id_kk','$jumlah','$hb','$min','$maks')");
	}
}

$q3 = mysqli_query($con,"SELECT *FROM produk_rs WHERE no_pengiriman='$nop'");
while($pr = mysqli_fetch_array($q3)){
	$q4 = mysqli_query($con,"SELECT *FROM produk_pengiriman WHERE nama_produk='$pr[nama_produk]' AND no_pengiriman='$nop'");
	$tes = mysqli_num_rows($q4);
	if ($tes>0) {
		$pp1 = mysqli_fetch_array($q4);
		$jumlah1 = $pp1['jumlah']-$pr['jumlah'];
		mysqli_query($con,"UPDATE produk_pengiriman SET jumlah_diterima='$jumlah1',ket='Tidak Sesuai' WHERE nama_produk='$pr[nama_produk]' AND no_pengiriman='$nop'");
	}
}


mysqli_query($con,"UPDATE pengiriman SET penerima='$penerima',keterangan='Telah Diterima' WHERE no_pengiriman='$nop'");

mysqli_query($con,"INSERT INTO produk_reture (no_reture,kode_produk,nama_produk,id_kat,id_sat,jumlah,harga_jual,keterangan) SELECT '$no_reture',kode_produk,nama_produk,id_kat,id_sat,jumlah,harga_jual,keterangan FROM produk_rs WHERE no_pengiriman='$nop'");

mysqli_query($con,"INSERT INTO reture (no_pengiriman,no_reture,tanggal,pengirim,asal_cabang,keterangan) VALUES ('$nop','$no_reture','$tanggal','$penerima','$id_kk','Sedang Proses Pengiriman') ");

mysqli_query($con,"DELETE FROM produk_rs WHERE no_pengiriman='$nop'");

exit();

?>