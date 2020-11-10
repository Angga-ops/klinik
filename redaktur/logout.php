<?php
  session_start();
  //require "modul/mod_log/aksi_log.php";
  if($_SESSION['jenis_u']=='JU-01'){
  	$admin = "YES";
  }
  session_destroy();
  if($admin=="YES"){
  	echo "<script>alert('Anda telah keluar dari halaman administrator'); window.location = '../admin/'</script>";
  }else if($_SESSION['jenis_u']=='JU-02'){
	  echo "<script>alert('Anda telah keluar dari halaman dokter'); window.location = '../dokter/'</script>";
  }else if($_SESSION['jenis_u']=='JU-08'){
	  echo "<script>alert('Anda telah keluar dari halaman laboratorium'); window.location = '../lab/'</script>";
  }else if($_SESSION['jenis_u']=='JU-07'){
	  echo "<script>alert('Anda telah keluar dari halaman apotek'); window.location = '../apotek/'</script>";
  }else if($_SESSION['jenis_u']=='JU-10'){
	  echo "<script>alert('Anda telah keluar dari halaman perawat'); window.location = '../perawat/'</script>";
  }else{
  	echo "<script>alert('Anda telah keluar dari halaman pasien'); window.location = 'index.php'</script>";
  }
  
?>
