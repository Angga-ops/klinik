<?php

include "../../../config/koneksi.php";

$id_kk		= $_POST['klinik'];

$objek   	= $_POST['objek'];
$subjek  	= $_POST['subjek'];
$ases	 	= $_POST['assest'];
$tanggal 	= $_POST['tanggal'];
$nofak	 	= $_POST['nofak'];
$id_pasien  = $_POST['id_pasien'];
$id_dr		= $_POST['id_dr'];


	$lokasi_file1    = $_FILES['foto1']['tmp_name'];
	$tipe_file1      = $_FILES['foto1']['type'];
	$nama_file1      = $_FILES['foto1']['name'];
	$acak           = rand(1,99);
	$nama_file_unik1 = $acak.$nama_file1; 
		


	$lokasi_file2    = $_FILES['foto2']['tmp_name'];
	$tipe_file2      = $_FILES['foto2']['type'];
	$nama_file2      = $_FILES['foto2']['name'];
	$acak           = rand(1,99);
	$nama_file_unik2 = $acak.$nama_file2; 
	


	$lokasi_file3    = $_FILES['foto3']['tmp_name'];
	$tipe_file3      = $_FILES['foto3']['type'];
	$nama_file3      = $_FILES['foto3']['name'];
	$acak           = rand(1,99);
	$nama_file_unik3 = $acak.$nama_file3; 
	


	$lokasi_file4    = $_FILES['foto4']['tmp_name'];
	$tipe_file4      = $_FILES['foto4']['type'];
	$nama_file4      = $_FILES['foto4']['name'];
	$acak           = rand(1,99);
	$nama_file_unik4 = $acak.$nama_file4; 
	

	if (empty($lokasi_file1)) {
		if (empty($lokasi_file2)) {
			if (empty($lokasi_file3)) {
				if (empty($lokasi_file4)) { ?>
					<script>
						alert("Silahkan Isi Minimal 1 foto");
						window.location.href="../../media.php?module=prarilis_pt";
					</script>
				<?php
				}
			}
		}
	}

	if (empty($lokasi_file1)) {
		$nama_file_unik1 = null;
	}else{
		move_uploaded_file($lokasi_file1, "../../../file_user/foto_pasien/$nama_file_unik1");
	}

	if (empty($lokasi_file2)) {
		$nama_file_unik2 = null;
	}else{
		move_uploaded_file($lokasi_file2, "../../../file_user/foto_pasien/$nama_file_unik2");
	}

	if (empty($lokasi_file3)) {
		$nama_file_unik3 = null;
	}else{
		move_uploaded_file($lokasi_file3, "../../../file_user/foto_pasien/$nama_file_unik3");	
	}

	if (empty($lokasi_file4)) {
		$nama_file_unik4 = null;
	}else{
		move_uploaded_file($lokasi_file4, "../../../file_user/foto_pasien/$nama_file_unik4");
	}

	

	

	

		

mysql_query("INSERT INTO pasca_treatment(id_kk,id_dr,id_pasien,no_faktur,tanggal,subjek,objek,assestment,foto1,foto2,foto3,foto4) VALUES 
	('$id_kk','$id_dr','$id_pasien','$nofak','$tanggal','$subjek','$objek','$ases','$nama_file_unik1','$nama_file_unik2','$nama_file_unik3','$nama_file_unik4')");

?>
<script>
alert("Pengisian data pasca treatment prarilis selesai");
window.location.href="../../media.php?module=prarilis_pth";
</script>