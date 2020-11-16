<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	include ("../../../config/koneksi.php");
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";	
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	//Input Checkout
	if ($module == 'checkout' AND $act == 'input'){
		$idcko		= $_POST['id_cko'];
		$idt		= $_POST['id_tag'];
		$ida		= $_POST['id_antrian'];
		$kon		= $_POST['kondisi'];
		$ket		= $_POST['keterangan'];
		$jam		= date("H:i:s");
		$tgl		= date("Y-m-d");
		$simpan		= mysqli_query($con, "Insert Into checkout(id_antrian,id_tagihan,id_checkout,kondisi_pas,keterangan,jam_checkout,tgl_checkout) 
						Values('$ida','$idt','$idcko','$ket','$kon','$jam','$tgl')") or die(mysqli_error($con));
		//Update Data Antrian
		$updt_antrn	= mysqli_query($con, "Update perawatan_pasien Set keterangan='Keluar' Where id_antrian='$ida'") or die(mysqli_error($con));
		//Update Data Tagihan
		$updt_tghn	= mysqli_query($con, "Update tagihan Set keterangan='Keluar' Where id_antrian='$ida'") or die(mysqli_error($con));
		//Update Data Kamar
		$updt_kmr	= mysqli_query($con, "Update kamar Set id_antrian='' Where id_antrian='$ida'") or die(mysqli_error($con));
		//Catat Log Aktivitas				
		catat($con, $_SESSION['namauser'], 'Proses Checkout'.' ('.$ida.')');
	} if($simpan){
		header('location:../../media.php?module=checkout');
	} else {
		header('location:../../media.php?module=checkout');
	}
?>