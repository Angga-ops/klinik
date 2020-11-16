<?php 
include "../../../config/koneksi.php";
session_start();
$id_kk      = $_SESSION['klinik'];
$id_r       = $_POST['id_ruangan'];
$no_urut    = $_POST['no_urut'];
$konsultasi = $_POST['konsultasi'];
$id 	    = $_POST['id_pasien'];
$tgl        = date("Y-m-d");
$id_dr	    = $_POST['id_dr'];
$no_faktur  = $_POST['nofak'];

if ($konsultasi=="") {
	$konsultasi = "No";
}

mysqli_query($con,"UPDATE history_kasir SET id_dr='$id_dr' WHERE no_faktur='$no_faktur' AND jenis='Treatment'");
mysqli_query($con,"UPDATE ruangan SET status='Kosong',terpakai='0' WHERE id='$id_r'");



mysqli_query($con,"INSERT INTO history_ap 
	(no_urut,id_pasien,tanggal_pendaftaran,status,id_kk,kunjungan_ke,konsultasi,no_faktur,pembayaran) SELECT
	 no_urut,id_pasien,tanggal_pendaftaran,'Selesai',id_kk,kunjungan_ke,'$konsultasi','$no_faktur',pembayaran FROM antrian_pasien WHERE no_urut='$no_urut' AND id_kk='$id_kk'");

mysqli_query($con,"DELETE FROM antrian_pasien WHERE no_urut='$no_urut' AND id_kk='$id_kk'");

$q1 = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$no_faktur' AND id_kk='$id_kk'");
while($hk = mysqli_fetch_array($q1)){
	if ($hk['status']=="Belum Lunas") {
		mysqli_query($con,"UPDATE history_ap SET pembayaran='Belum Lunas' WHERE no_urut='$no_urut' AND id_kk='$id_kk'");
	}
}
echo $no_faktur;

exit();
?>