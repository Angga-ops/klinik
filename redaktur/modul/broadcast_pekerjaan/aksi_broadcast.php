<?php

	session_start();

	include "../../../config/koneksi.php";

	include "../../../config/fungsi_seo.php";

	include "../mod_log/aksi_log.php";

	include "exelreader.php";

	$module	= $_GET['module'];

	$act	= $_GET['act'];

		$subjek 		= $_POST['subjek'];

		$pekerjaan		= $_POST['pekerjaan'];

		$isi			= $_POST['isi'];

		$tgl_kirim			= date('Y-m-d');

		$pengirim			= $_POST['pengirim'];

		//Broadcast pesanenter

		$nomor1 = mysqli_query($con, "SELECT * from pasien where pekerjaan='$pekerjaan'");

		$message = $isi;

		while ($nomor2 = mysqli_fetch_array($nomor1)) 

		 $nomor[] = $nomor2;

       foreach($nomor as $nomor2){ 

		$phone_no = $nomor2['no_telp'];

		$message = preg_replace( "/(\n)/", "<ENTER>", $message );

		$message = preg_replace( "/(\r)/", "<ENTER>", $message );



		$phone_no = preg_replace( "/(\n)/", ",", $phone_no );

		$phone_no = preg_replace( "/(\r)/", "", $phone_no );



		$data = array("phone_no" => $phone_no, "key" => "9f9dbeee0cb25c499224beba815f4c4d5a4df9aab5ba599c", "message" => $message);

		$data_string = json_encode($data);

		$ch = curl_init('http://116.203.92.59/api/send_message');

		curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");

		curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);

		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);

		curl_setopt($ch, CURLOPT_VERBOSE, 0);

		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);

		curl_setopt($ch, CURLOPT_TIMEOUT, 15);

		curl_setopt($ch, CURLOPT_HTTPHEADER, array(

		'Content-Type: application/json',

		'Content-Length: ' . strlen($data_string))

		);

		$result = curl_exec($ch);

			//insert db

	

		}

		



		

		$simpan = mysqli_query($con, "Insert Into broadcast_pekerjaan(pekerjaan,subjek,isi,tgl_kirim, pengirim) Values('$pekerjaan','$subjek','$isi','$tgl_kirim','$pengirim')") or die(mysqli_error($con));

	 	catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');

		if($simpan){

			header('location:../../media.php?module=bc_pekerjaan');

		} else {

			header('location:../../media.php?module=bc_pekerjaan');

		}

	?>