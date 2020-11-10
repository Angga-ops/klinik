<?php

include "../../../config/koneksi.php";

$act = $_GET['act'];
$id = $_POST['id'];
$nama = $_POST['nama'];

switch ($act) {
	case 'edit':
		mysql_query("UPDATE daftar_klinik SET printer_kasir='$nama' WHERE id_kk='$id'");
		header('location:../../media.php?module=set_print');
		break;
	
	default:
		# code...
		break;
}

?>
