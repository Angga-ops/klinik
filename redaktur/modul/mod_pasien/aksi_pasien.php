<?php
	session_start();
	include('../../../config/koneksi.php');
	include('../../../config/fungsi_seo.php');
	include('../mod_log/aksi_log.php');	
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	if ($module == 'pasien' AND $act == 'mitra'){ 
		$jp		= $_GET['jenis_pasien'];
		$sql	= mysqli_query($con,"Select * From jenis_mitra Where id_jenispem='$jp'");
		?>
		<option value="">-- Pilih Mitra --</option>
		<?php
		while ($d = mysqli_fetch_array($sql)){
		?>
		<option value="<?php echo $d['id_mitra']; ?>"><?php echo $d['nama_mitra']; ?></option>
		<?php
		}		
	}
	// Hapus Pasien
	elseif ($module == 'pasien' AND $act == 'hapus'){
		$id		= $_GET['id'];
		$delete	= mysqli_query($con,"Delete From pasien Where id='$id'");
		catat($con,$_SESSION['namauser'], 'Hapus Data Pasien'.' ('.$id.')');
		header('location:../../media.php?module='.$module);
	}
	// Update pasien
	elseif ($module=='pasien' AND $act=='update'){
		$lahir	= $_POST['thn_lahir'].'-'.$_POST['bln_lahir'].'-'.$_POST['tgl_lahir'];
		$update	= mysqli_query($con,"UPDATE pasien SET no_rm = '$_POST[no_rm]',
                                nama_pasien = '$_POST[nama_pasien]',
                                nama_ayah = '$_POST[nama_ayah]',
                                nama_ibu = '$_POST[nama_ibu]',
                                agama = '$_POST[agama]',
                                suku = '$_POST[suku]',
                                kewarganegaraan = '$_POST[kewarganegaraan]',
                                pendidikan = '$_POST[pendidikan]',
                                pekerjaan = '$_POST[pekerjaan]',
                                status_pernikahan = '$_POST[pernikahan]',
                                gol_darah = '$_POST[darah]',
                                alamat = '$_POST[alamat]',
                                jk = '$_POST[jk]',
                                tgl_lahir = '$lahir',
                                umur = '$_POST[umur]',
                                no_telp = '$_POST[no_telp]',
                                no_hp1 = '$_POST[no_hp1]',
                                no_hp2 = '$_POST[no_hp2]',
                                id_jenispem = '$_POST[jenis_pasien]',
                                id_mitra = '$_POST[mitra]',
								riwayat_penyakit = '$_POST[riwayat_penyakit]',
                                alergi_obat = '$_POST[alergi_obat]'
                                WHERE id = '$_POST[id]'");
		catat($con,$_SESSION['namauser'], "Berhasil update pasien $_POST[nama]");
		header('location:../../media.php?module=pasien');
	}
?>