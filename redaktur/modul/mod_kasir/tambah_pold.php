<?php 

include "../../../config/koneksi.php";

$nama   = $_POST['nama_t'];
$harga  = $_POST['harga_t'];
$id_kk  = $_POST['id_kk'];
$id     = $_POST['id_pasien'];
$modal  = $_POST['modal'];
$diskon = $_POST['dis'];
$ket    = $_POST['ket'];

$sub_total  = $harga;
$sub_total -= ($diskon/100)*$harga;

$q1 = mysqli_query($con,"SELECT *FROM kasir_sementara WHERE nama='$nama' AND status='sementara' AND id_kk='$id_kk' AND id_pasien='$id'");

$cek = mysqli_num_rows($q1);

if ($cek>0) {
	echo "ada";
	exit();
}

mysqli_query($con,"INSERT INTO kasir_sementara
	 (nama, harga, id_kk, jenis, jumlah, id_pasien, status,harga_beli,diskon,sub_total,ket) VALUES(
	'$nama','$harga','$id_kk','Treatment','1','$id','sementara','$modal','$diskon','$sub_total','$ket')");

exit();


?>