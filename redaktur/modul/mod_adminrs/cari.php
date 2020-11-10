<?php 

session_start();

include "../../../config/koneksi.php";


$nama = $_GET["nama"];

// Query ke database.
$query  = mysql_query("SELECT * FROM biaya_administrasi WHERE nama LIKE '%$nama%'");

$check = mysql_num_rows($query);

if($check > 0){
	echo "Ada";
} else{
	echo "Tidak ada";
}

?>