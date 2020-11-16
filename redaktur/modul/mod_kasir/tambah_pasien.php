<?php

include "../../../config/koneksi.php";
session_start();

$date  = date("Y-m-d");
$id_kk = $_SESSION['klinik']; 

$nama      = $_POST['nama'];
$alamat    = $_POST['alamat'];
$nohp      = $_POST['nohp'];
$umur      = $_POST['umur'];
$tgl_l     = $_POST['tgl_lahir'];
$jk        = $_POST['jk'];
$id_dr     = $_POST['dokter'];
$pekerjaan = $_POST['pekerjaan'];
$id_pasien = $_POST['id_pasien'];
$kunjungan = 0;


$p = mysqli_query($con,"SELECT *FROM pasien WHERE id_pasien='$id_pasien'");
$cek = mysqli_num_rows($p);

if ($cek>0) {
	echo "sudah";
	exit();
}

mysqli_query($con,"INSERT INTO pasien (id_pasien,id_kk,nama_pasien,alamat,jk,tgl_lahir,umur,no_telp,tgl_pendaftaran,total_kunjungan,pekerjaan,klaster) VALUES ('$id_pasien','$id_kk','$nama','$alamat','$jk','$tgl_l','$umur','$nohp','$date','$kunjungan','$pekerjaan','D')");

exit();

?>