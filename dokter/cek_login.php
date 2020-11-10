<?php

	include ('../config/koneksi.php');

	require ('../redaktur/modul/mod_log/aksi_log.php');



	$klinik   = $_POST['klinik'];

	$username = anti_injection($_POST['username']);

	$pass     = anti_injection(md5($_POST['password']));

	$q1 = mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass' AND blokir='N'");

	$qq = mysql_fetch_array($q1);





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

		$filter = mysql_real_escape_string(stripslashes(strip_tags(htmlspecialchars($data,ENT_QUOTES))));

		return $filter;

	}

	$username = anti_injection($_POST['username']);

	$pass     = anti_injection(md5($_POST['password']));

	

	// pastikan username dan password adalah berupa huruf atau angka.

	if (!ctype_alnum($username) OR !ctype_alnum($pass)){

		echo "Sekarang loginnya tidak bisa di injeksi lho.";

	} else {

		$login	= mysql_query("SELECT * FROM user WHERE username='$username' AND password='$pass' AND blokir='N' AND id_ju='JU-02'");

		$ketemu	= mysql_num_rows($login);

		$r		= mysql_fetch_array($login);

		$ip 	= $_SERVER['REMOTE_ADDR'];

	// Apabila username dan password ditemukan

	if ($ketemu > 0){

		session_start();

		$_SESSION['namauser']     	= $r['username'];

		$_SESSION['namalengkap']  	= $r['nama_lengkap'];

		$_SESSION['passuser']     	= $r['password'];

		$_SESSION['id_user']       	= $r['id_user'];

		$_SESSION['jenis_u']		= $r['id_ju'];

		$_SESSION['klinik']			= $klinik;

		if ($r['id_ju']=='JU-02') {

			$_SESSION['id_dr']	= $r['id_user'];

			$tgl = date("Y-m-d");

			$jam = date("H:i:s");

			$cek = mysql_num_rows(mysql_query("SELECT *FROM kehadiran_dr WHERE id_dr='$r[id_user]' AND tanggal='$tgl' AND id_kk='$klinik'"));

			if($cek==0){

				mysql_query("INSERT INTO kehadiran_dr (id_dr,id_kk,tanggal,jam) VALUES ('$r[id_user]','$klinik','$tgl','$jam')");

			}

		}



		$sql = mysql_query("select id_pasien, COUNT(id_pasien) as jumlah from history_kasir where jenis='Treatment' group by id_pasien order by jumlah");
		while ($data = mysql_fetch_array($sql)) {
			/*echo $data['id_pasien'];
			echo $data['jumlah'];
			*/
			if ($data['jumlah'] >= 7) {
				$sql2 = mysql_query("UPDATE pasien set klaster='M' where id_pasien='$data[id_pasien]'");
			}	
		 }


		catat($_SESSION['namauser'], "Berhasil Login dengan IP $ip");

		header('location:../redaktur/media.php?module=home');

	} else {

		catat($username, "Gagal Login");

		echo "<script>

alert('Username atau Password Salah!!'); location.href = '".$url."/dokter/index.php';

</script>";		

		}

	}

?>