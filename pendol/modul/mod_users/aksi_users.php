<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
include "../../../config/koneksi.php";
include "../../../config/library.php";
include "../../../config/fungsi_thumb.php";
$module=$_GET[module];
$act=$_GET[act];

// Input user
if ($module=='user' AND $act=='input'){
  $pass=md5($_POST[password]);
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;
  $count=mssql_fetch_array(mssql_query("SELECT username FROM users WHERE username = '$_POST[username]'"));
 if($count['username']!= $_POST['username'])
 {
    // Apabila ada gambar yang diupload
  if (!empty($lokasi_file)){
    if ($tipe_file != "image/jpeg" AND $tipe_file != "image/pjpeg"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=berita)</script>";
    }
    else{
    UploadImage($nama_file_unik);

     mssql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
								 tempat,
								 tanggal,
                                 email, 
                                 no_telp,
								 img,
								 level,
								 daftar,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
								'$_POST[tempat]',
								'$_POST[tanggal]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'$nama_file_unik',
								'$_POST[level]',
								'$tgl_sekarang',
                                '$pass')");
  header('location:../../media.php?module='.$module);
  }
  }
  else{
      mssql_query("INSERT INTO users(username,
                                 password,
                                 nama_lengkap,
								 tempat,
								 tanggal,
                                 email, 
                                 no_telp,
								 level,
								 daftar,
                                 id_session) 
	                       VALUES('$_POST[username]',
                                '$pass',
                                '$_POST[nama_lengkap]',
								'$_POST[tempat]',
								'$_POST[tanggal]',
                                '$_POST[email]',
                                '$_POST[no_telp]',
								'$_POST[level]',
								'$tgl_sekarang',
                                '$pass')");
  header('location:../../media.php?module='.$module);
  }
   }else{
    header('location:../../media.php?module=user&act=tambahuser&msg=1');
  }
}

// Update user
elseif ($module=='user' AND $act=='update'){
  $lokasi_file    = $_FILES['fupload']['tmp_name'];
  $tipe_file      = $_FILES['fupload']['type'];
  $nama_file      = $_FILES['fupload']['name'];
  $acak           = rand(1,99);
  $nama_file_unik = $acak.$nama_file;
  $pass=md5($_POST['password']);
   if(empty($lokasi_file) or empty($_POST['password'])){
	 mssql_query("UPDATE users SET nama_lengkap  = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  tanggal		 = '$_POST[tanggal]',
								  tempat		 = '$_POST[tempat]',
                                  blokir         = '$_POST[blokir]',
								  level		     = '$_POST[level]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_session     = '$_POST[id]'");
	header('location:../../media.php?module='.$module);
  }if($lokasi_file!='' && empty($_POST['password'])){
  		if ($tipe_file != "image/jpeg" AND $tipe_file != "image/*"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=berita')</script>";
    }
    else{
    UploadFoto($nama_file_unik);
    mssql_query("UPDATE users SET 
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  tanggal		 = '$_POST[tanggal]',
								  tempat		 = '$_POST[tempat]',
                                  blokir         = '$_POST[blokir]',
								  level		     = '$_POST[level]',
								  img		 = '$nama_file_unik',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE id_session      = '$_POST[id]'");
						      	unlink("http://localhost/lokomedia/img_foto/$_GET[namafile]");   
    unlink("../../../img_foto/small_$_GET[namafile]");
    unlink("../../../img_foto/slide_$_GET[namafile]"); 
	header('location:../../media.php?module='.$module);
  }
  }if($lokasi_file==null && $_POST['password']!=null){
  	 mssql_query("UPDATE users SET password        = '$pass',
								  nama_lengkap  = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  tanggal		 = '$_POST[tanggal]',
								  tempat		 = '$_POST[tempat]',
                                  blokir         = '$_POST[blokir]',
								  level		     = '$_POST[level]',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE  id_session     = '$_POST[id]'");
	header('location:../../media.php?module='.$module);
  }if($lokasi_file!=null && $_POST[password]!=null){
			if ($tipe_file != "image/jpeg" AND $tipe_file != "image/*"){
    echo "<script>window.alert('Upload Gagal, Pastikan File yang di Upload bertipe *.JPG');
        window.location=('../../media.php?module=berita')</script>";
    }
    else{
    UploadFoto($nama_file_unik);
    mssql_query("UPDATE users SET password        = '$pass',
                                  nama_lengkap   = '$_POST[nama_lengkap]',
                                  email          = '$_POST[email]',
								  tanggal		 = '$_POST[tanggal]',
								  tempat		 = '$_POST[tempat]',
                                  blokir         = '$_POST[blokir]',
								  level		     = '$_POST[level]',
								  img		 = '$nama_file_unik',
                                  no_telp        = '$_POST[no_telp]'  
                           WHERE id_session      = '$_POST[id]'");
						      	unlink("http://localhost/lokomedia/img_foto/$_GET[namafile]");   
    unlink("../../../img_foto/small_$_GET[namafile]");
    unlink("../../../img_foto/slide_$_GET[namafile]"); 
	header('location:../../media.php?module='.$module);
  }
  } 
  
}
}
?>
