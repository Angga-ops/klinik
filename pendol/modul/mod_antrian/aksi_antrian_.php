<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
//include "../../../config/fungsi_seo.php";
date_default_timezone_set('Asia/Jakarta');
$module=$_GET[module];
$act=$_GET[act];

// Input antrian
if ($module=='antrian' AND $act=='input'){
  $ambil = mysql_fetch_array(mysql_query("SELECT max(nourutdr) as noantrian FROM regbooking WHERE 
  waktudr='$_POST[kunjungan]' AND kodebagian='$_POST[poliklinik]' AND kodedokter='$_POST[dokter]'  
  AND utktglreg='$_POST[tglantri]'"));
    
  if($ambil[noantrian] < 6 ){
	  $nourut = 6;
  }else{
	  $nourut = $ambil[noantrian] + 1;
  }
  
  $urutbooking=mysql_num_rows(mysql_query("SELECT * FROM regbooking WHERE utktglreg='$_POST[tglantri]'"));
  if (!empty($urutbooking)){
	  $urut = $urutbooking + 1;
  }else{
     $urut =  1;
  }
  $urut1= sprintf("%04d", $urut);
  
  $thn=substr($_POST[tglantri],2,2);
  $thn2=substr($_POST[tglantri],0,4);
  $bln = substr($_POST[tglantri],5,2);
  $tgl = substr($_POST[tglantri],8,2);
  $nobooking = $thn."".$bln."".$tgl."".$urut1; 
   $sekarang = date('Y-m-d');
   $tanggal = $_POST[tglantri];
$jam = $_POST[jam_mulai];
$jammulai = $thn2."-".$bln."-".$tgl." ".$jam;

  
  
$cekantri = mysql_num_rows(mysql_query("SELECT * FROM regbooking WHERE 
    utktglreg='$_POST[tglantri]' AND nopasien='$_POST[nopasien]'"));
	
  if(!empty($cekantri)){
							   
		 echo "<script>window.alert('Mohon maaf Anda sudah terdaftar.');
        window.location=('../../media.php?module=download')</script>";
			
		  }else{			
   mysql_query("INSERT INTO REGPAS (NOREG, NOPASIEN, KODEPT, TGLREG, JAMREG, ASALREG,
BARULAMA, REGTELP, CRKUNJUNG, VALIDRI, USLOGNM, CLIENT, KONDISIPAS)
values ('$nobooking', '$_POST[nopasien]', '$_POST[penjamin]','$_POST[tglantri]',
 '$jammulai', 'J', 'L', 'Y', 'A', 'O', 'PENDOL', 'WEBSITE','N')");



mysql_query("INSERT INTO REGDR (KODEDOKTER, DOKTERPGNT, NOREG, WAKTUREG, NOURUTDR,
BAGREGDR, FLAGICD, TGLINPUT, FLAGRESUME) values ( '$_POST[dokter]', '$_POST[dokter]',
 '$nobooking','$_POST[kunjungan]', '$nourut', '$_POST[poliklinik]', 'N', GETDATE(), 'T')");


if($_POST[penjamin]!='UMUM'){

 mysql_query("INSERT INTO TRXPMR (NOREG, KODEBAGIAN, KODEPMR, KODEDOKTER, TGLPMR,
TGLINPUT, DRKIRIM, DRPERIKSA, TIPEPMR, PAJAKPMR, PROSENPMR, BIAYAPMR, BIAYAPMRIIL, SUBSIDIRS,
TARIFASKES, SUBSIDIASKES, STDBIAYA, SELISIH, BIAYARS, BIAYARSRIIL, BIAYADR, BIAYADRRIIL, BIAYASU,
BIAYASURIIL, BIAYAST, BIAYASTRIIL, BIAYANM, BIAYANMRIIL, BIAYAIUR, BYIURRS, BYIURDR, BYIURSU,
BYIURST, BYIURNM, PROSENDR, JMLPMR, USLOGNM, ASALREG, SUBSIDITEMP, KODEPT, CURRENTBAG,
NILAIDISC, FLAGDISC, PAKET, PERSEN, NOKWT, STPIUTANG, STTUNAI, STIPELT, STIPELP) values 
( '$nobooking', '$_POST[poliklinik]', 'ADM011', '$_POST[dokter]', '$_POST[tglantri]', GETDATE(), ' ', 
'$_POST[dokter]', 'B', '0.00', '0.00', '10000', '10000','0','10000', '0','10000',
'0','3112', '3112','0.00', '0','0', '0', '4388', '4388','0', '0', '0','0', 
'0','0', '0', '0','0.00', '1.00', 'PENDOL','J', '0', '$_POST[penjamin]', 
'$_POST[poliklinik]', '0','T', ' ', '0.00',' ', 'O', 'O', 'O', 'O')");

}else {

mysql_query("INSERT INTO TRXPMR (NOREG, KODEBAGIAN, KODEPMR, KODEDOKTER, TGLPMR,
TGLINPUT, DRKIRIM, DRPERIKSA, TIPEPMR, PAJAKPMR, PROSENPMR, BIAYAPMR, BIAYAPMRIIL, SUBSIDIRS,
TARIFASKES, SUBSIDIASKES, STDBIAYA, SELISIH, BIAYARS, BIAYARSRIIL, BIAYADR, BIAYADRRIIL, BIAYASU,
BIAYASURIIL, BIAYAST, BIAYASTRIIL, BIAYANM, BIAYANMRIIL, BIAYAIUR, BYIURRS, BYIURDR, BYIURSU,
BYIURST, BYIURNM, PROSENDR, JMLPMR, USLOGNM, ASALREG, SUBSIDITEMP, KODEPT, CURRENTBAG,
NILAIDISC, FLAGDISC, PAKET, PERSEN, NOKWT, STPIUTANG, STTUNAI, STIPELT, STIPELP) values 
( '$nobooking', '$_POST[poliklinik]', 'ADM011', '$_POST[dokter]', '$_POST[tglantri]', GETDATE(), ' ', 
'$_POST[dokter]', 'B', '0.00', '0.00', '10000', '0','0','0', '0','10000', '0','3112',
'0','0.00', '0','0', '0', '4388', '0','0', '0', '10000','3112', '0','0', '4388',
 '0','0.00', '1.00', 'PENDOL','J', '0', '$_POST[penjamin]', '$_POST[poliklinik]', 
 '0','T', ' ', '0.00',' ', 'O', 'O', 'O', 'O')");

}


 mysql_query("INSERT INTO REGBOOKING (NOBOOKING, KODEBAGIAN, KODEDOKTER, WAKTUDR,
TYPEPASIEN, NOPASIEN, NAMAPASIEN, UTKTGLREG, JAMDTG, TGLPESAN, JAMPESAN, VALID, TIPEBOOKING,
NOURUTDR)values ('$nobooking', '$_POST[poliklinik]', '$_POST[dokter]', 
'$_POST[kunjungan]', 'L', '$_POST[nopasien]', '$_SESSION[namalengkap]', 
'$_POST[tglantri]', '$_POST[jam_mulai]', '$sekarang',GETDATE(), 'V', '1', '$nourut')");  

//header('location:../../media.php?module='.$module);
		  }
  /*
  
  mysql_query("INSERT INTO regbooking(tipebooking,namapasien,nobooking,waktudr,kodebagian,kodedokter,nopasien,nourutdr,utktglreg) 
  VALUES('1','$_SESSION[namalengkap]','$nobooking','$_POST[kunjungan]','$_POST[poliklinik]','$_POST[dokter]','$_POST[nopasien]','$nourut','$_POST[tglantri]')");
  
  mysql_query("INSERT INTO regdr(kodedokter, noreg,waktureg,nourutdr,bagregdr) 
  VALUES('$_POST[dokter]','$nobooking','$_POST[kunjungan]','$nourut','$_POST[poliklinik]')"); 
  
   mysql_query("INSERT INTO regpas(noreg,nopasien,kodept,barulama) 
  VALUES('$nobooking','$_POST[nopasien]','$_POST[penjamin]','L')"); */


  
  
  
  
  ?>

<?php
}

// Update antrian
elseif ($module=='antrian' AND $act=='update'){
  $antrian_seo = seo_title($_POST['nama_antrian']);
  mysql_query("UPDATE antrian SET nama_antrian='$_POST[nama_antrian]', menu='$_POST[menu]', antrian_seo='$antrian_seo', aktif='$_POST[aktif]' 
               WHERE id_antrian = '$_POST[id]'");
 // header('location:../../media.php?module='.$module);
}
}
?>
