<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_thumb.php');
	require('../mod_log/aksi_log.php');
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus User
	if ($module == 'user' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$gambar	= mysqli_fetch_array(mysqli_query($con,"Select * From user Where id_user='$id'"));		
		$delete = mysqli_query($con,"Delete From user Where id_user='$id'");
		$folder	= "../../../foto_user/".$gambar["foto"];
		unlink($folder);
		header('location:../../media.php?module=user');
	}
	// Input User
	elseif ($module == 'user' AND $act == 'input'){
		$nm		= $_POST['nama'];
		$ju		= $_POST['jenis_user'];
		$id_kk  = $_POST['cabang'];
		$unm	= $_POST['username'];
		$pass	= md5($_POST['password']);
		$eml	= $_POST['email'];
		$kntk	= $_POST['kontak'];
		$sts	= $_POST['status'];
		//Penglolaan Gambar
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		$sel_unm		= mysqli_num_rows(mysqli_query($con,"Select * From user Where username='$unm'"));
		if($sel_unm >= 1){
		?>
        	<script>
			alert("Username Sudah Digunakan!");
			window.location.href="../../media.php?module=user";
            </script>
        <?php		
		} else {		
			UploadUser($nama_file_unik);
			//
			$simpan	= mysqli_query($con,"INSERT Into user(id_ju,id_kk,username,password,nama_lengkap,email,no_telp,foto,blokir) 
									Values('$ju','$id_kk','$unm','$pass','$nm','$eml','$kntk','$nama_file_unik','$sts')");
			if($simpan){
				header('location:../../media.php?module=user');
			} else {
				header('location:../../media.php?module=user');		
			}
		}
	}		
	// Update user
	elseif ($module == 'user' AND $act=='edit') {
		$id		= $_POST['id'];
		$nm		= $_POST['nama'];
		$ju		= $_POST['jenis_user'];
		$id_kk	= $_POST['cabang'];
		$unm	= $_POST['username'];
		$pass	= md5($_POST['password']);
		$eml	= $_POST['email'];
		$kntk	= $_POST['kontak'];
		$sts	= $_POST['status'];
		//Penglolaan Gambar
		$lokasi_file    = $_FILES['fupload']['tmp_name'];
		$tipe_file      = $_FILES['fupload']['type'];
		$nama_file      = $_FILES['fupload']['name'];
		$acak           = rand(1,99);
		$nama_file_unik = $acak.$nama_file; 
		UploadUser($nama_file_unik);
		$gambar	= mysqli_fetch_array(mysqli_query($con,"Select * From user Where id_user='$id'"));
		if(empty($_POST['password'])){
			if(empty($lokasi_file)){
			$update	= mysqli_query($con,"Update user Set id_ju='$ju',id_kk='$id_kk', username='$unm', nama_lengkap='$nm', email='$eml', no_telp='$kntk', blokir='$sts' Where id_user='$id'");			
			header('location:../../media.php?module=user');					
			} else {
				$update	= mysqli_query($con,"Update user Set id_ju='$ju',id_kk='$id_kk', username='$unm', nama_lengkap='$nm', email='$eml', no_telp='$kntk', foto='$nama_file_unik', blokir='$sts' Where id_user='$id'");			
				$folder	= "../../../foto_user/".$gambar["foto"];
				unlink($folder);
				header('location:../../media.php?module=user');
			}
		}else{
			if(empty($lokasi_file)){
			$update	= mysqli_query($con,"Update user Set id_ju='$ju',id_kk='$id_kk', username='$unm', password='$pass', nama_lengkap='$nm', email='$eml', no_telp='$kntk', blokir='$sts' Where id_user='$id'");			
			header('location:../../media.php?module=user');					
			} else {
				$update	= mysqli_query($con,"Update user Set id_ju='$ju',id_kk='$id_kk', username='$unm', password='$pass', nama_lengkap='$nm', email='$eml', no_telp='$kntk', foto='$nama_file_unik', blokir='$sts' Where id_user='$id'");			
				$folder	= "../../../foto_user/".$gambar["foto"];
				unlink($folder);
				header('location:../../media.php?module=user');
			}
		}	
		
	}
?>
