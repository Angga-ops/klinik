<?php
session_start();
?>
<html>
<head><title>Print</title></head>
<script language="JavaScript">
  function loadprint(){
  window.print();
}
</script>
<body onload="loadprint();">
<?php

 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/fungsi_indotgl.php";
date_default_timezone_set('Asia/Jakarta');
    echo "
	
	<div class='row'>
			<div class='col-sm-12'>
			
			<table ><tr><td align=left><img src='../../images/2020_logo.png' width='50%' height='50%'> </td></tr>
			<tr><td align=left> <h3>Bukti Pendaftaran Antrian</h3></td></tr></table>
						
	<table cellpadding=4 cellspacing=6 >
         "; 
		 $tampil=mysql_query("SELECT * FROM antrian_pasien WHERE no_faktur='$_GET[nobooking]'");
		 $no=1;
		 while ($r=mysql_fetch_array($tampil)){
			 $pol = mysql_fetch_array(mysql_query("SELECT * FROM poliklinik WHERE id_poli='$r[poliklinik]'"));
			 $dok = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user='$r[id_dr]'"));
			 
			 $hari = date("w",strtotime($r[tanggal_pendaftaran]));
			 $wkt = mysql_fetch_assoc(mysql_query("SELECT jam FROM dr_praktek WHERE id_poli='$r[poliklinik]' AND id_dr='$r[id_dr]' AND hari='$hari'"));
			 $wktu = $wkt[jam];
       echo "<tr><td>No. Booking</td><td>:</td><td>".$r[no_faktur]."</td><tr>
	  <tr><td>No. Antrian</td><td>:</td><td>".$r[no_urut]."</td><tr>
            <tr><td>Poliklinik</td><td>:</td> <td >".$pol[poli]."</td><tr>
             <tr><td>Nama Dokter</td><td>:</td><td>$dok[nama_lengkap]</td><tr>
			 <tr><td>Tanggal Antrian</td><td>:</td><td>".tgl_indo(date("Y-m-d",strtotime($r[tanggal_pendaftaran])))."</td><tr>
			 <tr><td>Waktu Antrian</td><td>:</td><td>$wktu</td></tr>
			 <tr><td>Penjamin</td><td>:</td><td>$r[jenis_pasien]</td></tr>";
	  $no++;
	  
		 }
   
    echo "</table></div></div></div></div>";
    

}
?>
</body>
</html>