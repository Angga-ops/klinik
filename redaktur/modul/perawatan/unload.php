<?php 
include "../../../config/koneksi.php";
session_start();
$id_kk = $_SESSION['klinik'];
$id_r = $_POST['id_r'];
$no_urut = $_POST['no_urut'];
mysqli_query($con,"UPDATE antrian_pasien SET status='Mengantri' WHERE no_urut='$no_urut' AND id_kk='$id_kk'");
mysqli_query($con,"UPDATE ruangan SET status='Kosong',terpakai='0' WHERE id='$id_r' AND id_kk='$id_kk'");
exit();
?> 