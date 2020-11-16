<?php
	// panggil fungsi validasi xss dan injection
	require_once('fungsi_validasi.php');
	$server = "localhost";
	$username = "root";
	$password = "";
	$database="creativ5_klinik";
	//$database = "suryame2_testing";
	//$username="root";
	//$password="";
	//$username = "creativ5_klincgs";
	//$password = "cYA;QxYd_eC~";
	
	//Koneksi dan memilih database di server
	$con = mysqli_connect($server,$username,$password,$database) or die("Koneksi gagal");
	// mysqli_select_db($database) or die("Database tidak bisa dibuka");
	// buat variabel untuk validasi dari file fungsi_validasi.php
	//$val = new Rizalvalidasi;

    date_default_timezone_set("Asia/Manila");
    error_reporting(E_ERROR | E_PARSE);

    //$url = "http://creativegamastudio.com//klinik";
	//$url2 = "http://creativegamastudio.com//klinik/redaktur/";
	// $url = "klinik/";
	// $url2 = "klinik/redaktur/";

	$url = "../";
  	$url2 = "";
?>
