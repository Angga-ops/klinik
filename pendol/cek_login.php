<?php
include "../config/koneksi.php";
function anti_injection($data){
  $filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));
  return $filter;
}

$username = anti_injection($_POST['username']);
$t = substr($_POST['password'],0,2);
$b = substr($_POST['password'],2,2);
$ht = substr($_POST['password'],4,4);
$pass     = $ht."-".$b."-".$t;
 

// pastikan username dan password adalah berupa huruf atau angka.
if (empty($username) OR empty($pass)){
  header('location:index.php?msg=1');
}else{
$login=mysql_query("SELECT * FROM pasien WHERE id_pasien='$username' AND tgl_lahir='$pass' ");
$ketemu=mysql_num_rows($login);
$r=mysql_fetch_array($login);

// Apabila username dan password ditemukan
if ($ketemu > 0){
  session_start();
  include "timeout.php";

  $_SESSION['KCFINDER']=array();
  $_SESSION['KCFINDER']['disabled'] = false;
  $_SESSION['KCFINDER']['uploadURL'] = "../tinymcpuk/gambar";
  $_SESSION['KCFINDER']['uploadDir'] = "";

  $_SESSION[namauser]     = $r[id_pasien];
  $_SESSION[namalengkap]  = $r[nama_pasien];
  $_SESSION[passuser]     = $r[tgl_lahir];
  $_SESSION[leveluser]= 'user';
  
  
  // session timeout
  $_SESSION[login] = 1;
  timer();
/*
	$sid_lama = session_id();
	
	session_regenerate_id();

	$sid_baru = session_id();

  //mysql_query("UPDATE users SET id_session='$sid_baru' WHERE username='$username'");
  */
 // header('location:media.php?module=home');
 echo '<META HTTP-EQUIV="Refresh" Content="0; URL=media.php?module=home">';
exit;
}else{
  header('location:index.php?msg=2');
}
}
?>
