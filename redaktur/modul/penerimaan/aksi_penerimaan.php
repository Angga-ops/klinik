<?php

session_start();

include "../../../config/koneksi.php";

$nop      = $_POST["nop"];
$id_kk    = $_SESSION['klinik'];
$penerima = $_SESSION['namalengkap'];

$qc = mysqli_query($con,"SELECT *FROM produk_pengiriman WHERE no_pengiriman='$nop'");
while($cek_cek = mysqli_fetch_array($qc)){
	/*
	if ($cek_cek['ket']==Null) {
		echo "belum semua";
		exit();
	}else if($cek_cek['ket']==""){
		echo "belum semua";
		exit();
	} */
	if(is_null($cek_cek['ket']) || $cek_cek['ket'] == "" || empty($cek_cek["ket"])){
		echo "belum semua";
		exit();
	}
}

$missing = "No";
$q = mysqli_query($con,"SELECT *FROM produk_pengiriman WHERE no_pengiriman='$nop'");

while ($cek = mysqli_fetch_array($q)) {

	if ($cek['ket']=="Tidak Sesuai") {
		$missing = "Yes";
	}

	$q2 = mysqli_query($con,"SELECT *FROM produk WHERE nama_p='$cek[nama_produk]' AND id_kk='$id_kk'");
	$jum = mysqli_num_rows($q2);

	if($jum>0){

		$p = mysqli_fetch_array($q2);
		$jumlah = $p['jumlah']+$cek['jumlah_diterima'];
		mysqli_query($con,"UPDATE produk SET jumlah='$jumlah' WHERE nama_p='$cek[nama_produk]' AND id_kk='$id_kk'");

	}else{

		$kb     = $cek['kode_produk'];
		$np     = $cek['nama_produk'];
		$hj     = $cek['harga_jual'];
		$jumlah = $cek['jumlah_diterima'];
		$id_s	= $cek['id_sat'];
		$id_k	= $cek['id_kat'];
		$maks	= $cek['cabang_maks'];
		$min	= $cek['cabang_min'];
		$hb		= $cek['harga_b'];
		 
		mysqli_query($con,"INSERT INTO produk (kode_barang,nama_p,harga_jual,id_s,id_kategori,id_kk,jumlah,harga_beli,batas_minim,batas_maks) VALUES ('$kb','$np','$hj','$id_s','$id_k','$id_kk','$jumlah','$hb','$min','$maks')");
	}
}
$status = "Aman";
if ($missing=="Yes") {
	$status = "Lapor";
}

mysqli_query($con,"UPDATE pengiriman SET penerima='$penerima',keterangan='Telah Diterima',status='$status' WHERE no_pengiriman='$nop'");

exit();

?>