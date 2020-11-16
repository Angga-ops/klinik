<?php
session_start();

$id_kk = $_SESSION['klinik'];

include "../../../config/koneksi.php";

$id     = $_POST['id'];

//khusus utk treatment cari data di history_kasir
$r = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM kasir_sementara WHERE id = '$id'"));
$ri = mysqli_query($con,"SELECT * FROM history_kasir WHERE no_faktur = '$r[no_faktur]' AND id_pasien = '$r[id_pasien]' AND nama = '$r[nama]' AND jenis = 'Treatment'");

if(mysqli_num_rows($ri) > 0){
    $rij = mysqli_fetch_assoc($ri);
    mysqli_query($con,"DELETE FROM history_kasir WHERE id='$rij[id]'");
    mysqli_query($con,"DELETE FROM kasir_sementara WHERE id='$id'");
} else {
    mysqli_query($con,"DELETE FROM history_kasir WHERE id='$id'");
    mysqli_query($con,"DELETE FROM kasir_sementara WHERE id='$id'");
}

exit();	

?>