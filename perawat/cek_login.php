<?php

	include ('../config/koneksi.php');

	require ('../redaktur/modul/mod_log/aksi_log.php');



	$klinik   = $_POST['klinik'];

	$username = anti_injection($_POST['username']);

	$pass     = anti_injection(md5($_POST['password']));

	$q1 = mysqli_query($con,"SELECT * FROM karyawan WHERE username='$username' AND password='$pass' AND blokir='N'");

	$qq = mysqli_fetch_array($q1);





	if ($qq['id_ju']=="JU-01") { 

		$klinik="Semua";

	}

	elseif($qq['id_ju']!="JU-01"){ /*

		if (empty($_POST['klinik'])) {

			?>

		  <script>

		    alert("Belum ada klinik yang dipilih silahkan pilih klinik terlebih dahulu!!");

		    window.history.back();

		  </script>

		  <?php

		} */

	} 



	function anti_injection($data){
		global $con;
		$filter = mysqli_real_escape_string($con,stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));

		return $filter;

	}

	$username = anti_injection($_POST['username']);

	$pass     = anti_injection(md5($_POST['password']));

	

	// pastikan username dan password adalah berupa huruf atau angka.

	if (!ctype_alnum($username) OR !ctype_alnum($pass)){

		echo "Sekarang loginnya tidak bisa di injeksi lho.";

	} else {

		$login	= mysqli_query($con,"SELECT * FROM karyawan WHERE username='$username' AND password='$pass' AND blokir='N' AND id_ju='JU-10'");

		$ketemu	= mysqli_num_rows($login);

		$r		= mysqli_fetch_array($login);

		$ip 	= $_SERVER['REMOTE_ADDR'];

	// Apabila username dan password ditemukan

	if ($ketemu > 0){

		session_start();

		$_SESSION['namauser']     	= $r['username'];

		$_SESSION['namalengkap']  	= $r['nama_lengkap'];

		$_SESSION['passuser']     	= $r['password'];

		$_SESSION['id_user']       	= $r['id_karyawan'];

		$_SESSION['jenis_u']		= $r['id_ju'];

		$_SESSION['klinik']			= $klinik;

		if ($r['id_ju']=='JU-02') {

			$_SESSION['id_dr']	= $r['id_user'];

			$tgl = date("Y-m-d");

			$jam = date("H:i:s");

		

		}



		catat($con, $_SESSION['namauser'], "Berhasil Login dengan IP $ip");

		header('location:../redaktur/media.php?module=home');

	} else {

		catat($con, $username, "Gagal Login");

		echo "<script>

alert('Username atau Password Salah!!'); location.href = 'index.php';

</script>";		

		}

	}

?>