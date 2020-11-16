<?php

session_start();

include "../../../config/koneksi.php";
include "../../../config/rupiah.php";
include "../../../config/fungsi_indotgl.php";

$id_kk = $_SESSION['klinik'];

if ($_GET['nofak']){
	$rn=chr(13).chr(10);
	$esc=chr(27);
	$cutpaper=$esc."m";
	$bold_on=$esc."E1";
	$bold_off=$esc."E0";
	$reset=pack('n', 0x1B30);


	$no_faktur = $_GET["nofak"];

	$idd = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'"));

	$nota=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM pembayaran where no_faktur='$no_faktur'"));

	$ky=mysqli_query($con, "SELECT * FROM pembayaran p JOIN history_kasir h ON p.no_faktur=h.no_faktur  WHERE p.no_faktur='$no_faktur'");


	//formating data text:
	$string  = "No.Faktur  : ".$nota['no_faktur']." \n";
	$string .= "No.Antrian : ".$nota['no_urut']." \n";
	$string .= "Tanggal    : ".tgl_indo($nota['tanggal'])." \n";
	$string .= "=============================\n";

	ob_start();
	$tbl = "";
	$total = '0';

	$tbl .= "#Nama #Qty #Harga #Sub total";
	$tbl .= "=============================\n";

	while ($item=mysqli_query($con, $kt)) {
		$tbl .= "".$ky['nama']." ".$ky['jumlah']." ".$ky['harga']." ".$ky['harga']*$ky['jumlah']."\n";
	}

	
	echo $tbl;

	$string .= ob_get_contents();
	ob_end_clean();
	$string .= "=============================\n";
	$string .= "Total       ".$nota['total']."\n";
	$string .= "Uang        ".$nota['uang']."\n";
	$string .= "Kembalian   ".$nota['kembalian']."\n";
	
	//Cut Kertas
	$printer = printer_open("".$idd['printer_kasir']."");  
	/* write the text to the print job */  
	printer_write($printer, $string);   
	/* close the connection */
	printer_close($printer);
}
header('location:../../index.php?module=history_transaksi');
?>