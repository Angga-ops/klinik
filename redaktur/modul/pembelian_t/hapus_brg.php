<?php
session_start();
$id_kk = $_SESSION['klinik'];
include "../../../config/koneksi.php";

$id = $_POST['id_t'];

$hapus=mysql_query("DELETE FROM pembelian_t WHERE id_t ='$id' ");


if(isset($hapus)){
	echo "YES";
}else{
	echo "NO";
}

?>