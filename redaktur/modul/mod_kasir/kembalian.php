<?php
session_start();

include "../../../config/koneksi.php";
include ('../../../config/fungsi_rupiah.php');

$uang    = $_POST['uang'];
$total 	 = preg_replace("/[^0-9]/","", $_POST['tot']);
$uang_tr = $_POST['uang_tr'];

$uang = $uang+$uang_tr;


$kembalian = rupiah($uang-$total);

echo $kembalian;

exit();
?>