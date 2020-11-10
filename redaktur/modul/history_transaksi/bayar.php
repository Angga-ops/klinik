<?php

include "../../../config/koneksi.php";

session_start();
$id_kk	   = $_SESSION['klinik'];
$tgl       = $_POST['tgl'];
$id        = $_POST['id_pasien'];
$uang      = $_POST['uang'];
$uang_tr   = $_POST['uang_tr'];
$ongkir	   = $_POST['ongkir'];
$no_urut   = $_POST['no_urut'];
$kembalian = preg_replace("/[^0-9]/","", $_POST['kembalian']);
$total 	   = preg_replace("/[^0-9]/","", $_POST['total']);
$id_kasir  = $_SESSION['id_user'];
$nofak	   = $_POST['nofak'];
$metode	   = $_POST['metode'];
$id_rek	   = $_POST['no_rek'];

if ($uang+$uang_tr<$total+$ongkir) {
	echo "Kurang";
	exit();
}

$pem     = mysql_fetch_array(mysql_query("SELECT *FROM pembayaran WHERE no_faktur='$nofak'"));
$total   = $total   + $pem['total'];
$uang    = $uang    + $pem['uang'];
$uang_tr = $uang_tr + $pem['uang_transfer'];
mysql_query("UPDATE history_kasir SET status='Lunas',id_kasir='$id_kasir' WHERE no_faktur='$nofak' AND status='Belum Lunas'");

if(is_null($pem['total'])){
if($uang == $total){
	mysql_query("INSERT INTO pembayaran (status,no_faktur,id_pasien,id_kk,no_urut,tgl,total,uang,uang_transfer,uang_ongkir,m_pembayaran,id_rek,ket,kembalian,id_kasir) VALUES ('Lunas','$nofak','$id','$id_kk','$no_urut','$tgl','$total','$uang','$uang_tr','$ongkir','$metode','$id_rek',NULL,'$kembalian','$id_kasir')");
} else {
	mysql_query("INSERT INTO pembayaran (no_faktur,id_pasien,id_kk,no_urut,tgl,total,uang,uang_transfer,uang_ongkir,m_pembayaran,id_rek,ket,kembalian,id_kasir) VALUES ('$nofak','$id','$id_kk','$no_urut','$tgl','$total','$uang','$uang_tr','$ongkir','$metode','$id_rek',NULL,'$kembalian','$id_kasir')");
}

} else {
	
mysql_query("UPDATE pembayaran SET status = 'Lunas', total='$total',uang='$uang',uang_transfer='$uang_tr' WHERE no_faktur='$nofak'");

}

mysql_query("UPDATE history_ap SET pembayaran='Lunas' WHERE no_faktur='$nofak'");
mysql_query("DELETE FROM kasir_sementara WHERE no_faktur='$nofak' AND jenis = 'Treatment'");

exit();

?>