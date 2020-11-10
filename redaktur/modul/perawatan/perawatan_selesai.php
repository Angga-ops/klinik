<?php 
include "../../../config/koneksi.php";
session_start();
$id_kk      = $_SESSION['klinik'];
$id_r       = $_POST['id_ruangan'];
$no_urut    = $_POST['no_urut'];
$konsultasi = $_POST['konsultasi'];
$id 	    = $_POST['id_pasien'];
$tgl        = date("Y-m-d");
$id_dr	    = $_POST['id_dr'];
$no_faktur  = $_POST['nofak'];

if ($konsultasi=="") {
	$konsultasi = "No";
}

mysql_query("UPDATE history_kasir SET id_dr='$id_dr' WHERE no_faktur='$no_faktur' AND jenis='Treatment'");
mysql_query("UPDATE ruangan SET status='Kosong',terpakai='0' WHERE id='$id_r'");



mysql_query("INSERT INTO history_ap 
	(no_urut,id_pasien,tanggal_pendaftaran,status,id_kk,kunjungan_ke,konsultasi,no_faktur,pembayaran) SELECT
	 no_urut,id_pasien,tanggal_pendaftaran,'Selesai',id_kk,kunjungan_ke,'$konsultasi','$no_faktur',pembayaran FROM antrian_pasien WHERE no_urut='$no_urut' AND id_kk='$id_kk'");

mysql_query("DELETE FROM antrian_pasien WHERE no_urut='$no_urut' AND id_kk='$id_kk'");

$q1 = mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$no_faktur' AND id_kk='$id_kk'");
while($hk = mysql_fetch_array($q1)){
	if ($hk['status']=="Belum Lunas") {
		mysql_query("UPDATE history_ap SET pembayaran='Belum Lunas' WHERE no_urut='$no_urut' AND id_kk='$id_kk'");
	}
}
echo $no_faktur;

exit();
?>