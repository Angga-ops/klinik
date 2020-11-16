<?php

session_start();

include "../../../config/koneksi.php";
include('../../../config/fungsi_thumb.php');

$id_kk		= $_SESSION['klinik'];

$objek   	= $_POST['objek'];
$subjek  	= $_POST['subjek'];
$ases	 	= $_POST['assest'];
$tanggal 	= date("Y-m-d");
$nofak	 	= $_POST['nofak'];
$id_pasien  = $_POST['id_pasien'];
$id_dr		= $_SESSION['id_dr'];


	$lokasi_file1    = $_FILES['foto1']['tmp_name'];
	$tipe_file1      = $_FILES['foto1']['type'];
	$nama_file1      = $_FILES['foto1']['name'];
	$acak           = rand(1,99);
	$nama_file_unik1 = $acak.$nama_file1; 
		


	$lokasi_file2    = $_FILES['foto2']['tmp_name'];
	$tipe_file2      = $_FILES['foto2']['type'];
	$nama_file2      = $_FILES['foto2']['name'];
	$acak           = rand(1,99);
	$nama_file_unik2 = $acak.$nama_file2; 
	


	$lokasi_file3    = $_FILES['foto3']['tmp_name'];
	$tipe_file3      = $_FILES['foto3']['type'];
	$nama_file3      = $_FILES['foto3']['name'];
	$acak           = rand(1,99);
	$nama_file_unik3 = $acak.$nama_file3; 
	


	$lokasi_file4    = $_FILES['foto4']['tmp_name'];
	$tipe_file4      = $_FILES['foto4']['type'];
	$nama_file4      = $_FILES['foto4']['name'];
	$acak           = rand(1,99);
	$nama_file_unik4 = $acak.$nama_file4; 
	

	if (empty($lokasi_file1)) {
		if (empty($lokasi_file2)) {
			if (empty($lokasi_file3)) {
				if (empty($lokasi_file4)) {
				}
			}
		}
	}

	if (empty($lokasi_file1)) {
		$nama_file_unik1 = null;
	}else{
		move_uploaded_file($lokasi_file1, "../../../file_user/foto_pasien/$nama_file_unik1");
	}

	if (empty($lokasi_file2)) {
		$nama_file_unik2 = null;
	}else{
		move_uploaded_file($lokasi_file2, "../../../file_user/foto_pasien/$nama_file_unik2");
	}

	if (empty($lokasi_file3)) {
		$nama_file_unik3 = null;
	}else{
		move_uploaded_file($lokasi_file3, "../../../file_user/foto_pasien/$nama_file_unik3");	
	}

	if (empty($lokasi_file4)) {
		$nama_file_unik4 = null;
	}else{
		move_uploaded_file($lokasi_file4, "../../../file_user/foto_pasien/$nama_file_unik4");
	}

	

	

	

		

mysqli_query($con,"INSERT INTO pasca_treatment(id_kk,id_dr,id_pasien,no_faktur,tanggal,subjek,objek,assestment,foto1,foto2,foto3,foto4) VALUES 
	('$id_kk','$id_dr','$id_pasien','$nofak','$tanggal','$subjek','$objek','$ases','$nama_file_unik1','$nama_file_unik2','$nama_file_unik3','$nama_file_unik4')");

$qp = mysqli_query($con,"SELECT *FROM history_ap WHERE no_faktur='$nofak'");
$cek = mysqli_num_rows($qp);

if ($cek>0) {
	$q1 = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$nofak'");
	while($hk = mysqli_fetch_array($q1)){
		if ($hk['status']=="Belum Lunas") {
			mysqli_query($con,"UPDATE history_ap SET pembayaran='Belum Lunas' WHERE no_faktur='$nofak'");
		}
	}
}else{
	mysqli_query($con,"INSERT INTO history_ap (bb,tb,keluhan,suhu,tensi,id_kk,no_urut,id_pasien,tanggal_pendaftaran,status,pembayaran,no_faktur,kunjungan_ke,konsultasi,jenis_layanan,jenis_pasien,asuransi,poliklinik) SELECT bb,tb,keluhan,suhu,tensi,NULL,no_urut,id_pasien,tanggal_pendaftaran,'Selesai','Lunas',no_faktur,kunjungan_ke,'Yes',jenis_layanan,jenis_pasien,asuransi,poliklinik FROM antrian_pasien WHERE no_faktur='$nofak'");
	//mysql_query("DELETE FROM antrian_pasien WHERE no_faktur='$nofak'");
	$q1 = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$nofak'");
	while($hk = mysqli_fetch_array($q1)){
		if ($hk['status']=="Belum Lunas") {
			mysqli_query($con,"UPDATE history_ap SET pembayaran='Belum Lunas' WHERE no_faktur='$nofak'");
		}
	}
}

mysqli_query($con,"DELETE FROM noticelab WHERE no_faktur = '$nofak' AND id_pasien = '$id_pasien'");

?>
<script>
alert("Pemeriksaan pasien selesai");
window.location.href="../../media.php?module=home";
</script>

