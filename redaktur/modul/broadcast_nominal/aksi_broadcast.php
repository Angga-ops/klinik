<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
		$subjek 		= $_POST['subjek'];
		$nominal		= $_POST['nominal'];
		$isi			= $_POST['isi'];
		$tgl_kirim		= date('Y-m-d');
		$pengirim		= $_POST['pengirim'];
		//Broadcast pesanenter
		$layer2 = array();
		$nomor1 = mysqli_query($con, "SELECT * from pembayaran where total>='$nominal' group by id_pasien");
		while($layer = mysqli_fetch_array($nomor1)){
			$layer2[] = $layer['id_pasien']; 
		}

		$limit = count($layer2);
		$c=0;
		while ($c<$limit) {
			$id   = $layer2[$c];
			$layer3 = mysqli_query($con, "SELECT * FROM pasien where id_pasien='$id'");
			while ($nomor2 = mysqli_fetch_array($layer3)){
				$nomor[] = $nomor2['no_telp'];
			}
			$c++;
		}
		$message = $isi;
       	foreach($nomor as $nomor3){ 
		$phone_no = $nomor3;
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
		

		
		$simpan = mysqli_query($con, "Insert Into broadcast_nominal(nominal,subjek,isi,tgl_kirim, pengirim) Values('$nominal','$subjek','$isi','$tgl_kirim','$pengirim')") or die(mysqli_error($con));
	 	catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
		if($simpan){
			header('location:../../media.php?module=bc_nominal');
		} else {
			header('location:../../media.php?module=bc_nominal');
		}
	?>