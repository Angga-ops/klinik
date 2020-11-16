<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];
$no_fak = $_POST['no_fak'];
$tgl_beli = $_POST['tgl_beli'];
$total = $_POST['total'];
$id_sup = $_POST['id_sup'];
$pembayaran = $_POST['pembayaran'];
$tgl_tempo = $_POST['tgl_tempo'];


//query update
$query = "UPDATE beli_k SET no_fak='$no_fak' , tgl_beli='$tgl_beli', total='$total', id_sup='$id_sup', tgl_tempo='$tgl_tempo' WHERE id='$id'";
mysqli_query($con,$query);
header('location:../../media.php?module=pembelian_k');


//mysql_close($host);
?>