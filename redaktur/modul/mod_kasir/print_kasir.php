<?php

session_start();

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");
include "../../../config/koneksi.php";


$no_faktur = $_GET['nofak'];

$idd = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='1'"));

$nota=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM pembayaran where no_faktur='$no_faktur'"));

$ky=mysqli_query($con,"SELECT * FROM pembayaran p JOIN history_kasir h ON p.no_faktur=h.no_faktur  WHERE p.no_faktur='$no_faktur'");

$kd = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM history_kasir WHERE no_faktur='$no_faktur'"));

$kasir = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_karyawan FROM karyawan WHERE id_karyawan = '$kd[id_kasir]'"));

$cust = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien = '$kd[id_pasien]'"));

$poli = mysqli_fetch_assoc(mysqli_query($con,"SELECT poli FROM poliklinik WHERE id_poli = (SELECT poliklinik FROM history_ap WHERE no_faktur = '$no_faktur')"));

$apx = mysqli_query($con,"SELECT * FROM history_ap WHERE no_faktur = '$no_faktur'");
$apx2 = mysqli_query($con,"SELECT * FROM perawatan_pasien WHERE no_faktur = '$no_faktur'");
$apx3 = mysqli_query($con,"SELECT * FROM antrian_pasien WHERE no_faktur = '$no_faktur'");
if(mysqli_num_rows($apx) > 0){
	$ap = mysqli_fetch_assoc($apx);
	$dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM user WHERE id_user = ($ap[id_dr])"));
} else if(mysqli_num_rows($apx2) > 0){
	$ap = mysqli_fetch_assoc($apx2);
	$dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM user WHERE id_user = ($ap[id_dr])"));
} else {
	$ap = mysqli_fetch_assoc($apx3);
	$dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM user WHERE id_user = ($ap[id_dr])"));
}



if($ap['jenis_pasien'] == "bpjs"){
	$asuransi = "BPJS Kesehatan";
}  else if($ap['jenis_pasien'] == "lain") {
	$asur = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama FROM asuransi WHERE id = $ap[asuransi]"));
	$asuransi = $asur['nama'];
} else {
	$asuransi = "UMUM";
}

?>
<script src="<?php echo $url2; ?>/modul/mod_kasir/terbilang.js?v=<?php echo rand(1,1000); ?>"></script>
<style>
@media print {
    body {transform: scale(1);}
	body,th,td { font-size: 8px;  }
	th,td {padding: 1%; }
	table {width: 100%; }
}
@page {
	margin: 0.1cm;
	size: 80mm 200mm;
}

.tbl th, .tbl td {border: solid 1px black; padding: 1%}
.tbl th {background: black; color: white}
.tbl {width: 100%; border-collapse: collapse}
</style>
<h5 style="margin: 0"><?php echo $idd['nama_klinik']; ?></strong></h5>
----------------------------------------
<h5  style="margin: 0"><?php echo $idd['alamat']; ?> - Telp: <?php echo $idd['telepon']; ?></h5>
<br/>

<h3>No Tagihan: <?php echo $no_faktur; ?></h3>
<div style="width: 100%"><h2 style="display: inline">Invoice <?php 

if(is_null($ap["jenis_layanan"])){
	echo "Rawat Inap"; $tglout = $ap['tgl_out'];
} else {
	switch($ap["jenis_layanan"]){
		case "poliklinik" : echo "Rawat Jalan"; $tglout = $ap['tanggal_pendaftaran']; break;
		case "igd" : echo "Rawat Jalan/IGD"; $tglout = $ap['tanggal_pendaftaran']; break;
		default: echo ucfirst($ap["jenis_layanan"]); $tglout = $ap['tgl_out']; break;
	}
}

?> (COPY)</h2> Dicetak tanggal: <?php echo strftime("%d %B %Y",strtotime("now")); ?></div>
<div style="width: 100%; text-align: right">No RM: <?php echo $cust["id_pasien"]; ?></div>
<br/><br/>
<strong>Nama Pasien: <?php echo $cust["nama_pasien"]; ?> <?php if($poli['poli'] == ""){ } else { echo "(".$poli['poli'].")"; } ?></strong>
<table>
<tr>
<td><strong>Tgl Registrasi:</strong></td><td><?php echo strftime("%d %B %Y",strtotime($ap['tanggal_pendaftaran'])); ?></td><td><strong>Dokter Pemeriksa:</strong></td><td><?php echo $dr['nama_lengkap']; ?></td>
</tr>
<tr>
<td><strong>Tgl Keluar:</strong></td><td><?php echo strftime("%d %B %Y",strtotime($tglout)); ?></td><td><strong>Penjamin:</strong></td><td><?php echo $asuransi; ?></td>
</tr>
<tr>
<td><strong>Kelas Dijamin:</strong></td><td></td><td><strong>Bill To:</strong></td><td></td>
</tr>
<tr>
<td colspan=2></td><td><strong>Perusahaan:</strong></td><td></td>
</tr>
</table>

<table class="tbl">
<tr>
<th>Keterangan/Item Detail</th><th>Qty</th><th>Satuan</th><th>Discount (Rp)</th><th>Subtotal</th>
</tr>
<tr>
<td colspan=5>Administrasi</td>
</tr>
<?php 
$admin_satuan = 0;
$admin_diskon = 0;
$admin_subtotal = 0;
$t = mysqli_query($con,"SELECT * FROM history_kasir WHERE jenis = 'Jasa' AND no_faktur = '$no_faktur'");
while($ti = mysqli_fetch_assoc($t)){
?>
<tr>
<td><?php echo $ti["nama"]; ?></td>
<td><?php echo $ti["jumlah"]; ?></td>
<td><?php echo number_format($ti["harga"],0,",","."); ?></td>
<td><?php echo number_format((($ti["diskon"]/100)*$ti["harga"]),0,",","."); ?></td>
<td><?php echo number_format($ti["sub_total"],0,",","."); ?></td>
</tr>
<?php

$admin_diskon = $admin_diskon + (($ti["diskon"]/100)*$ti["harga"]);
$admin_satuan = $admin_satuan + $ti['harga'];
$admin_subtotal = $admin_subtotal + $ti['sub_total'];

} ?>
<tr>
<td colspan=2>Subtotal Administrasi</td><td><?php echo number_format($admin_satuan,0,",","."); ?></td><td><?php echo number_format($admin_diskon,0,",","."); ?></td><td><?php echo number_format($admin_subtotal,0,",","."); ?></td>
</tr>
<tr>
<td colspan=5>Biaya Tindakan</td>
</tr>
<?php 
$tindakan_satuan = 0;
$tindakan_diskon = 0;
$tindakan_subtotal = 0;
$t = mysqli_query($con,"SELECT * FROM history_kasir WHERE jenis = 'treatment' AND no_faktur = '$no_faktur' AND kategori != '2'");
while($ti = mysqli_fetch_assoc($t)){
?>
<tr>
<td><?php echo $ti["nama"]." (dokter: ".$dr['nama_lengkap'].")"; ?></td>
<td><?php echo $ti["jumlah"]; ?></td>
<td><?php echo number_format($ti["harga"],0,",","."); ?></td>
<td><?php echo number_format((($ti["diskon"]/100)*$ti["harga"]),0,",","."); ?></td>
<td><?php echo number_format($ti["sub_total"],0,",","."); ?></td>
</tr>
<?php

$tindakan_diskon = $tindakan_diskon + (($ti["diskon"]/100)*$ti["harga"]);
$tindakan_satuan = $tindakan_satuan + $ti['harga'];
$tindakan_subtotal = $tindakan_subtotal + $ti['sub_total'];

} ?>
<tr>
<td colspan=2>Subtotal Biaya Tindakan</td><td><?php echo number_format($tindakan_satuan,0,",","."); ?></td><td><?php echo number_format($tindakan_diskon,0,",","."); ?></td><td><?php echo number_format($tindakan_subtotal,0,",","."); ?></td>
</tr>

<?php if($ap['jenis_layanan'] == "poliklinik" || $ap['jenis_layanan'] == "igd"){ } else { ?>

<tr>
<td colspan=5>Biaya Obat-obatan</td>
<?php 
$obat_satuan = 0;
$obat_diskon = 0;
$obat_subtotal = 0;
$t = mysqli_query($con,"SELECT * FROM history_kasir WHERE jenis = 'produk' AND no_faktur = '$no_faktur'");
while($ti = mysqli_fetch_assoc($t)){
?>
<tr>
<td><?php echo $ti["nama"]." (".$ti["ket"].")"; ?></td>
<td><?php echo $ti["jumlah"]; ?></td>
<td><?php echo number_format($ti["harga"],0,",","."); ?></td>
<td><?php echo number_format((($ti["diskon"]/100)*$ti["harga"]),0,",","."); ?></td>
<td><?php echo number_format($ti["sub_total"],0,",","."); ?></td>
</tr>
<?php

$obat_diskon = $obat_diskon + (($ti["diskon"]/100)*$ti["harga"]);
$obat_satuan = $obat_satuan + $ti['harga'];
$obat_subtotal = $obat_subtotal + $ti['sub_total'];

} ?>
<tr>
<td colspan=2>Subtotal Biaya Obat-obatan</td><td><?php echo number_format($obat_satuan,0,",","."); ?></td><td><?php echo number_format($obat_diskon,0,",","."); ?></td><td><?php echo number_format($obat_subtotal,0,",","."); ?></td>
</tr>

<tr>
<td colspan=5>Biaya Jasa Lab</td>
</tr>
<?php 
$lab_satuan = 0;
$lab_diskon = 0;
$lab_subtotal = 0;
$t = mysqli_query($con,"SELECT * FROM history_kasir WHERE jenis = 'treatment' AND no_faktur = '$no_faktur' AND kategori = '2'");
while($ti = mysqli_fetch_assoc($t)){
?>
<tr>
<td><?php echo $ti["nama"]; ?></td>
<td><?php echo $ti["jumlah"]; ?></td>
<td><?php echo number_format($ti["harga"],0,",","."); ?></td>
<td><?php echo number_format((($ti["diskon"]/100)*$ti["harga"]),0,",","."); ?></td>
<td><?php echo number_format($ti["sub_total"],0,",","."); ?></td>
</tr>
<?php

$lab_diskon = $lab_diskon + (($ti["diskon"]/100)*$ti["harga"]);
$lab_satuan = $lab_satuan + $ti['harga'];
$lab_subtotal = $lab_subtotal + $ti['sub_total'];

} ?>
<tr>
<td colspan=2>Subtotal Biaya Lab</td><td><?php echo number_format($lab_satuan,0,",","."); ?></td><td><?php echo number_format($lab_diskon,0,",","."); ?></td><td><?php echo number_format($lab_subtotal,0,",","."); ?></td>
</tr>



<?php } ?>
</table>
<br/>
<div style="width: 100%; text-align: right"><strong>Total setelah diskon <?php echo number_format($tindakan_subtotal + $obat_subtotal + $admin_subtotal + $lab_subtotal,0,",","."); ?></strong></div>
<div style="width: 100%;"><strong>Terbilang (<div id="terbilang" style="display: inline"></div>)</strong>
<br/><br/>
<center><?php if($ap['jenis_layanan'] == "poliklinik" || $ap['jenis_layanan'] == "igd"){ echo "UNTUK PEMBAYARAN OBAT RAWAT JALAN MOHON TUNJUKKAN INVOICE INI KE BAGIAN FARMASI/APOTEK"; } else { } ?></center>
</div>
<script>
var k = terbilang(<?php echo ($tindakan_subtotal + $obat_subtotal + $admin_subtotal); ?>);
document.getElementById("terbilang").innerHTML = k;
window.print();
</script>