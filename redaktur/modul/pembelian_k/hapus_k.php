<?php
session_start();
$id_kk = $_SESSION['klinik'];
include "../../../config/koneksi.php";

$id = $_POST['id_k'];

$hapus=mysqli_query($con,"DELETE FROM pembelian_k WHERE id_k ='$id' ");


if(isset($hapus)){
	echo "YES";
}else{
	echo "NO";
}

?>