<?php 

session_start();

include "../../../config/koneksi.php";


$nama       = $_POST['nama'];
$id_kk      = $_SESSION['klinik'];
$id_dr      = $_POST['dokter'];
$date_now   = date("Y-m-d");
$kunjungan  = 1;
$konsultasi = $_POST['konsultasi'];
$id_kasir   = $_SESSION['id_user']; 
$total 	 	= preg_replace("/[^0-9]/","", $_POST['total']);
$uang		= preg_replace("/[^0-9]/","", $_POST['uang']);
$kembalian  = preg_replace("/[^0-9]/","", $_POST['kembalian']);
$no_faktur  = $_POST['nofak'];
$metode		= $_POST['metode'];
$id_rek		= $_POST['no_rek'];
$uang_t		= $_POST['uang_t'];
$uang_o		= $_POST['ongkir'];

$qp = mysqli_query($con,"SELECT *FROM pasien WHERE id_pasien='$nama'");
$cekp = mysqli_num_rows($qp);
if ($cekp==0) {
	echo "pasien";
	exit();
}

if ($uang+$uang_t<$total) {
	echo "kurang";
	exit();
}

if ($_POST['konsultasi']=="") {
	$konsultasi = "No";
}

if (empty($_POST['nama'])) {
	echo "nama";
}

$ps = mysqli_query($con,"SELECT *FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara' AND jenis='Produk'");
$cek  = mysqli_num_rows(mysqli_query($con,"SELECT *FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara' AND jenis='Treatment'"));
$cek1 = mysqli_num_rows($ps);

if ($cek==0) {
	if ($cek1==0) {
		if($konsultasi=="No"){
			echo "No";
			exit();
		}elseif($konsultasi=="Yes"){
			$only_konsultasi = "TRUE";
		}
	}
}

if ($only_konsultasi=="TRUE") {
	if($id_dr=="belum"){
		echo "D";
		exit();
	}
}




$q1  =  mysqli_query($con,"SELECT *FROM history_ap WHERE tanggal_pendaftaran='$date_now' AND id_kk='$id_kk'");
$not = mysqli_num_rows($q1);
$q2   = mysqli_query($con,"SELECT *FROM antrian_pasien WHERE tanggal_pendaftaran='$date_now' AND id_kk='$id_kk'");
$not2 = mysqli_num_rows($q2);

//$no_urut = $not + $not2;
//$no_urut++;

$q3 = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(no_urut) AS urut FROM antrian_pasien WHERE tanggal_pendaftaran='$date_now' AND id_kk='$id_kk'"));
if(is_null($q3['urut'])){
$no_urut = 1;
} else {
$no_urut = $q3['urut'] + 1;
}


$h = mysqli_query($con,"SELECT *FROM pasien WHERE id_pasien='$nama'");
$t = mysqli_num_rows($h);
$d = mysqli_fetch_array($h);
$id_p = $d['id_pasien'];
$totk = mysqli_num_rows(mysqli_query($con,"SELECT *FROM history_ap WHERE id_pasien='$id_p'"));
$kunjungan = $totk;
$kunjungan++;
mysqli_query($con,"UPDATE pasien SET total_kunjungan='$kunjungan' WHERE id_pasien='$id_p'");


if ($only_konsultasi=="TRUE") {

	mysqli_query($con,"INSERT INTO antrian_pasien(no_urut,id_pasien,tanggal_pendaftaran,status,kunjungan_ke,id_kk,id_dr,konsultasi,no_faktur) VALUES ('$no_urut','$id_p','$date_now','Mengantri','$kunjungan','$id_kk','$id_dr','$konsultasi','$no_faktur')");
	
	
	echo "Yes";

	exit();
}

if($cek1>0){

	// produk
	mysqli_query($con,"UPDATE kasir_sementara SET status='antri',no_urut='$no_urut',tanggal='$date_now',id_kasir='$id_kasir' WHERE id_pasien='$id_p' AND jenis='Produk' AND status='sementara'");

	while ($pm = mysqli_fetch_array($ps)) {
		$q3 =  mysqli_query($con,"SELECT *FROM produk WHERE id_kk='$id_kk' AND nama_p='$pm[nama]'");
		$tot =  mysqli_num_rows($q3);
		if ($tot>0) {
			$hap    = mysqli_fetch_array($q3);
			$jumlah_min = $hap["jumlah"]-$pm["jumlah"];
			mysqli_query($con,"UPDATE produk SET jumlah='$jumlah_min' WHERE id_kk='$id_kk' AND nama_p='$pm[nama]'");
		}

	}

}

if ($id_dr!='belum') {
	$konsultasi = "Yes";
}else{
	$konsultasi = "No";
}


if ($cek1>0) {

		mysqli_query($con,"INSERT INTO history_kasir (id_pasien,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,id_kk,jenis,status,no_faktur,diskon,sub_total,ket,penginput) 
	SELECT  '$id_p','$id_kasir','$date_now','$no_urut',nama,kode,harga_beli,harga,jumlah,id_kk,jenis,'Lunas','$no_faktur',diskon,sub_total,ket,'Kasir' FROM kasir_sementara WHERE id_pasien='$id_p' AND no_urut='$no_urut' AND id_kk='$id_kk'");

		mysqli_query($con,"DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND id_pasien='$id_p' AND no_urut='$no_urut' AND jenis='Produk'");

	
}

if ($cek>0) {

	mysqli_query($con,"UPDATE kasir_sementara SET status='antri',no_urut='$no_urut',tanggal='$date_now',id_kasir='$id_kasir' WHERE id_pasien='$id_p' AND jenis='Treatment' AND id_kk='$id_kk'");

	// Pindahkan ke table history
	mysqli_query($con,"INSERT INTO history_kasir(id_pasien,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,id_kk,jenis,status,no_faktur,diskon,ket,sub_total,penginput) 
		SELECT '$id_p','$id_kasir','$date_now','$no_urut',nama,kode,harga_beli,harga,jumlah,id_kk,jenis,'Lunas','$no_faktur',diskon,ket,sub_total,'Kasir' 
		FROM kasir_sementara WHERE id_pasien='$id_p' AND no_urut='$no_urut' AND id_kk='$id_kk'");

	// Delete table sementara
	mysqli_query($con,"DELETE FROM kasir_sementara WHERE id_kk='$id_kk' AND id_pasien='$id_p' AND no_urut='$no_urut'");
}
// treatment


// Pembayaran
mysqli_query($con,"INSERT INTO pembayaran 
	(id_pasien,no_urut,tgl,total,uang,kembalian,id_kk,id_kasir,no_faktur,m_pembayaran,id_rek,uang_transfer,uang_ongkir) VALUES 
	('$id_p','$no_urut','$date_now','$total','$uang','$kembalian','$id_kk','$id_kasir','$no_faktur','$metode','$id_rek','$uang_t','$uang_o')");

if ($id_dr=="belum") {
	// Tidak konsultasi dengan dokter
	mysqli_query($con,"INSERT INTO history_ap(id_kk,no_urut,id_pasien,tanggal_pendaftaran,status,pembayaran,kunjungan_ke,no_faktur,konsultasi) VALUES ('$id_kk','$no_urut','$id_p','$date_now','Selesai','Lunas','$kunjungan','$no_faktur','$konsultasi') ");
}else{
	// Antrian Pasien
	mysqli_query($con,"INSERT INTO antrian_pasien(no_urut,id_pasien,tanggal_pendaftaran,status,kunjungan_ke,id_kk,id_dr,konsultasi,pembayaran,no_faktur) VALUES ('$no_urut','$id_p','$date_now','Mengantri','$kunjungan','$id_kk','$id_dr','$konsultasi','Lunas','$no_faktur')");
}




echo $no_faktur;

exit();

?>