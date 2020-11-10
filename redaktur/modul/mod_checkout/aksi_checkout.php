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
		$simpan		= mysql_query("Insert Into checkout(id_antrian,id_tagihan,id_checkout,kondisi_pas,keterangan,jam_checkout,tgl_checkout) 
						Values('$ida','$idt','$idcko','$ket','$kon','$jam','$tgl')") or die(mysql_error());
		//Update Data Antrian
		$updt_antrn	= mysql_query("Update perawatan_pasien Set keterangan='Keluar' Where id_antrian='$ida'") or die(mysql_error());
		//Update Data Tagihan
		$updt_tghn	= mysql_query("Update tagihan Set keterangan='Keluar' Where id_antrian='$ida'") or die(mysql_error());
		//Update Data Kamar
		$updt_kmr	= mysql_query("Update kamar Set id_antrian='' Where id_antrian='$ida'") or die(mysql_error());
		//Catat Log Aktivitas				
		catat($_SESSION['namauser'], 'Proses Checkout'.' ('.$ida.')');
	} if($simpan){
		header('location:../../media.php?module=checkout');
	} else {
		header('location:../../media.php?module=checkout');
	}
?>