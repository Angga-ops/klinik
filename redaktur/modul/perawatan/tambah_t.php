<?php 

include "../../../config/koneksi.php";

$nama      = $_POST['nama_t'];
$harga     = $_POST['harga_t'];
$id_kk     = $_POST['id_kk'];
$id        = $_POST['id_pasien'];
$no        = $_POST['no_urut'];
$tgl       = date("Y-m-d");
$no_faktur = $_POST['nofak'];
$modal	   = $_POST['modal'];


$q1 = mysql_query("SELECT *FROM history_kasir WHERE nama='$nama' AND id_kk='$id_kk' AND no_faktur='$no_faktur' ");

$cek = mysql_num_rows($q1);

if ($cek>0) {
	echo "ada";
	exit();
}

mysql_query("INSERT INTO history_kasir
	 (no_faktur,id_pasien,tanggal,no_urut,nama,harga,jumlah,id_kk,jenis,status,ket,harga_beli) 
	 VALUES('$no_faktur','$id','$tgl','$no','$nama','$harga','1','$id_kk','Treatment','Belum Lunas','Input Dokter','$modal')");

exit();


?>