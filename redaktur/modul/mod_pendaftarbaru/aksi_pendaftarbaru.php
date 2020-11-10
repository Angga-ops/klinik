<?php
	session_start();
	include ("../../../config/koneksi.php");
	include ("../../../config/fungsi_seo.php");
	include ("../mod_log/aksi_log.php");
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Pasien
	if ($module=='pendaftarbaru' AND $act=='mitra'){ 
		$jp		= $_GET['jenis_pasien'];
		$sql	= mysql_query("Select * From jenis_mitra Where id_jenispem='$jp'");
		?>
		<option value="">-- Pilih Mitra --</option>
		<?php
		while ($d = mysql_fetch_array($sql)){
		?>
		<option value="<?php echo $d['id_mitra']; ?>"><?php echo $d['nama_mitra']; ?></option>
		<?php
		}		
	}
	elseif ($module=='pendaftarbaru' AND $act=='input'){ 
	$simpan = mysql_query("INSERT INTO pasien(id_pasien,
                                  nama_pasien,
                                  nama_ayah,
                                  nama_ibu,
                                  agama,
                                  suku,
                                  kewarganegaraan,
                                  pendidikan,
                                  pekerjaan,
                                  status_pernikahan,
                                  gol_darah,
                                  alamat,
                                  jk,
                                  tgl_lahir,
                                  umur,
                                  no_telp,
                                  no_hp1,
                                  no_hp2,
								  id_jenispem,
								  id_mitra,
                                  riwayat_penyakit,
                                  alergi_obat,
								  tgl_pendaftaran)
              VALUES ('$_POST[no_id]',
                      '$_POST[nama_pasien]',
                      '$_POST[nama_ayah]',
                      '$_POST[nama_ibu]',
                      '$_POST[agama]',
                      '$_POST[suku]',
                      '$_POST[kewarganegaraan]',
                      '$_POST[pendidikan]',
                      '$_POST[pekerjaan]',
                      '$_POST[pernikahan]',
                      '$_POST[darah]',
                      '$_POST[alamat]',
                      '$_POST[jk]',
                      '$_POST[tgl_lahir]',
                      '$_POST[umur]',
                      '$_POST[no_telp]',
                      '$_POST[no_hp1]',
                      '$_POST[no_hp2]',
                      '$_POST[jenis_pasien]',
                      '$_POST[mitra]',
                      '$_POST[riwayat_penyakit]',
                      '$_POST[alergi_obat]',
                      '$_POST[tgl_daftar]')") or die(mysql_error());

		catat($_SESSION['namauser'], 'Pasien Baru'.' ('.$_POST['no_id'].')');
		header('location:../../media.php?module=pendaftarbaru');
	}
?>
