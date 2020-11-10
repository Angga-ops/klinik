<?php
session_start();
include "../../../config/koneksi.php";
include '../../../config/fungsi_rupiah.php';

$total 	 	= preg_replace("/[^0-9]/","", $_POST['tot']);
$uang      = $_POST['uang'];
$uang_tr      = $_POST['uang_tr'];

$kembalian = $uang+$uang_tr-$total;

echo rupiah($kembalian);

exit();
?>