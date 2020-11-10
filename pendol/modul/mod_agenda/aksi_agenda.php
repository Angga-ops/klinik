<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../../../config/library.php";

$module=$_GET[module];
$act=$_GET[act];

// Hapus agenda
if ($module=='agenda' AND $act=='hapus'){
  mssql_query("DELETE FROM agenda WHERE id_agenda='$_GET[id]'");
  header('location:../../media.php?module='.$module);
}

// Input agenda
elseif ($module=='agenda' AND $act=='input'){
  $mulai=$_POST['waktu'];

  mssql_query("INSERT INTO agenda(tema,
                                  tema_seo, 
                                  isi_agenda,
                                  tempat,
								  waktu,
                                  tgl_posting,
                                  pengirim, 
                                  username) 
					              VALUES('$_POST[tema]',
					                       '$tema_seo', 
                                 '$_POST[isi_agenda]',
                                 '$_POST[tempat]',
                                 '$mulai',
                                 '$tgl_sekarang',
                                 '$_POST[pengirim]',
                                 '$_SESSION[namauser]')");
  header('location:../../media.php?module='.$module);
}

// Update agenda
elseif ($module=='agenda' AND $act=='update'){
  $waktu=$_POST['waktu'];
  $tema_seo = seo_title($_POST['tema']);
  mssql_query("UPDATE agenda SET tema        = '$_POST[tema]',
                                 tema_seo    = '$tema_seo',
                                 isi_agenda  = '$_POST[isi_agenda]',
                                 tempat      = '$_POST[tempat]',  
                                 waktu    	 = '$waktu', 								 
                                 pengirim    = '$_POST[pengirim]'  
                           WHERE id_agenda   = '$_POST[id]'");
  header('location:../../media.php?module='.$module);
}
}
?>
