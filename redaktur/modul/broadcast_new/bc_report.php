<?php

include "../../../config/koneksi.php";

include "../mod_log/aksi_log.php";


$message = "$_POST[pesan]";

	switch($_POST['tipe']){
				case "1": 
				
				
		$simpan = mysqli_query($con, "Insert Into broadcast_treatment(treatment,subjek,isi,tgl_kirim, pengirim) Values('$_POST[val]','$_POST[subject]','$message',NOW(),'$_POST[namauser]')") or die(mysqli_error($con));

		catat($con, $_POST['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
				
				break;
				case "2": 
				
				
		$simpan = mysqli_query($con, "Insert Into broadcast_pekerjaan(pekerjaan,subjek,isi,tgl_kirim, pengirim) Values('$_POST[val]','$_POST[subject]','$message',NOW(),'$_POST[namauser]')") or die(mysqli_error($con));

		catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
				
				
				break;
				case "3": 
				
					
		$simpan = mysqli_query($con, "Insert Into broadcast_nominal(nominal,subjek,isi,tgl_kirim, pengirim) Values('$_POST[val]','$_POST[subject]','$message',NOW(),'$_POST[namauser]')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
				
				
				break;
				case "4": 
				
				$simpan = mysqli_query($con, "Insert Into broadcast(klaster,subjek,isi) Values('$_POST[val]','$_POST[subject]','$message')") or die(mysqli_error($con));
				catat($con, $_SESSION['namauser'], 'Data Kategori Baru'.' ('.$nmrgn.')');
				
				
				break;
			
			}

unlink("error_log");
?>