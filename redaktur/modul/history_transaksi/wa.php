<?php
session_start();
setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");
include "../../../config/koneksi.php";

$id_kk     = $_SESSION['klinik'];
$no_faktur = $_GET['faktur'];

$idd = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'"));

$nota=mysqli_fetch_array(mysqli_query($con, "SELECT * FROM pembayaran where no_faktur='$no_faktur'"));

$ky=mysqli_query($con, "SELECT * FROM pembayaran p JOIN history_kasir h ON p.no_faktur=h.no_faktur  WHERE p.no_faktur='$no_faktur'");

$kd = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM history_kasir WHERE no_faktur='$no_faktur'"));

$kasir = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_karyawan FROM karyawan WHERE id_karyawan = '$kd[id_kasir]'"));

$cust = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$kd[id_pasien]'"));

$telp = substr($cust['no_telp'],1,strlen($cust['no_telp']) - 1);

$json = '{"telp":"62'.$telp.'","namaklinik":"'.$idd['nama_klinik'].'","alamatklinik":"'.$idd['alamat'].'",';

$json .= '"nofaktur":"'.$no_faktur.'","antrian":"'.$nota['no_urut'].'","pasien":"'.$cust['nama_pasien'].' ('.$cust['id_pasien'].')",';    

$json .= '"kasir":"'.$kasir['nama_karyawan'].'","tgl":"'.strftime("%d %B %Y",strtotime($nota['tgl'])).'","produk":"';

$tot = 0;

while ($p=mysqli_fetch_array($ky)) {

$json .= $p['nama'].'*'.$p['jumlah'].' x Rp '.number_format($p['harga'],0,",",".").'*';

$tot = $tot + ($p['jumlah'] * $p['harga']);

$dokter = (is_null($p['id_dr']) || $p['id_dr'] == 0)? "" : $p['id_dr'];

}

$total = $tot + $nota['uang_ongkir'];

$disc = number_format($total - $nota['total'],0,",",".");


if($dokter == ""){} else {
	$dr = mysqli_fetch_array(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = '$dokter'"));
}


$ongkir = ($nota['uang_ongkir'] == "")? 0 : $nota['uang_ongkir'];

$json .= '","dokter":"'.$dr['nama_lengkap'].'","belanja":"'.number_format($total,0,",",".").'","bayar":"'.number_format($nota['uang'],0,",",".").'","kembalian":"'.number_format($nota['kembalian'],0,",",".").'","note":"Retur Produk berlaku 1 x 24 Jam","disc":"'.$disc.'","total":"'.number_format($nota['total'],0,",",".").'","ongkir":"'.number_format($ongkir,0,",",".").'"}'; 

?>


    
<script>
var json = JSON.parse('<?php echo $json; ?>');

var result = "```----------------------------------------%0A";
result += json.namaklinik + "%0A";
result += json.alamatklinik + "%0A";
result += "----------------------------------------%0A";
result += "Faktur: " + json.nofaktur + "%0A";
result += "Antrian: " + json.antrian + "%0A";
result += "Pasien: " + json.pasien + "%0A";
result += "Kasir: " + json.kasir + "%0A";
result += "Tgl: " + json.tgl + "%0A";
result += "Produk:%0A";

var regex = /\*/gi;
var txt = json.produk.replace(regex,"%0A");

result += txt;

result += "Dokter: " + json.dokter + "%0A";
result += "Belanja: Rp " + json.belanja + "%0A";
result += "Ongkos Kirim: Rp " + json.ongkir + "%0A";
result += "Hemat spesial: Rp " + json.disc + "%0A";
result += "Total: Rp " + json.total + "%0A";
result += "Bayar: Rp " + json.bayar + "%0A";
result += "Kembalian: Rp " + json.kembalian + "%0A";
result += "*" + json.note + "*";

result += "```";


// * = %0A

	location.href = "https://api.whatsapp.com/send?phone=" + json.telp + "&text=" + result;

  </script>