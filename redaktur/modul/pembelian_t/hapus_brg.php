<?php
session_start();
$id_kk = $_SESSION['klinik'];
include "../../../config/koneksi.php";

$id = $_POST['id_t'];

$hapus=mysqli_query($con,"DELETE FROM pembelian_t WHERE id_t ='$id' ");


if(isset($hapus)){
	echo "YES";
}else{
	echo "NO";
}

?>