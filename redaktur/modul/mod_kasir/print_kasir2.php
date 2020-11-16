<?php

session_start();

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");
include "../../../config/koneksi.php";
include "../../../config/fungsi_rupiah.php";
include "../../../config/fungsi_indotgl.php";
require_once("../../dompdf/dompdf_config.inc.php");
/*
require '../../escpos/autoload.php';

use Mike42\Escpos\PrintConnectors\FilePrintConnector;
use Mike42\Escpos\PrintConnectors\WindowsPrintConnector;
use Mike42\Escpos\Printer; */

$id_kk     = $_SESSION['klinik'];
$no_faktur = $_GET['nofak'];

$idd = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'"));

$nota=mysqli_fetch_array(mysqli_query($con,"SELECT * FROM pembayaran where no_faktur='$no_faktur'"));

$ky=mysqli_query($con,"SELECT * FROM pembayaran p JOIN history_kasir h ON p.no_faktur=h.no_faktur  WHERE p.no_faktur='$no_faktur'");

$kd = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM history_kasir WHERE no_faktur='$no_faktur'"));

$kasir = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_karyawan FROM karyawan WHERE id_karyawan = '$kd[id_kasir]'"));

$cust = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien = '$kd[id_pasien]'"));

/*
try {

	$n_printer = "".$idd['printer_kasir'].""; // Nama Printer yang di sharing
	$connector = new WindowsPrintConnector($n_printer);
	$printer = new Printer($connector);
	$printer -> text("No.Faktur  : " . $no_faktur . "\n");
	$printer -> text("No.Antrian : " . $nota['no_urut'] . "\n");
	$printer -> text("Tanggal    : " . $nota['tanggal'] . "\n");
	$printer -> text("#item #Qty #Harga #Sub Total\n");
	$printer -> text("=======================================\n");


	while ($p=mysqli_fetch_array($ky)) {
		$printer -> text("".$p['nama']."".$p['jumlah']."".$p['harga']."".$p['jumlah']*$p['harga']."\n");
	}
	

	$printer -> text("=======================================\n");
	$printer -> text("Total                ".$nota['total']."\n");
	$printer -> text("Uang                  ".$nota['uang']."\n");
	$printer -> text("Kembalian        ".$nota['kembalian']."\n");
	$printer -> cut();
	$printer -> close();

}catch(Exception $e){
	echo "Couldn't print to this printer: " . $e -> getMessage() . "\n";
}



//header('location:media.php?module=history_transaksi'); */
ob_start();
?>
<!DOCTYPE html>
<html><body>
<style>
@media print {
    body {transform: scale(.5);}
	body,th,td { font-size: 8px;  }
	th,td {padding: 1%; }
	table {width: 100%; }
}
@page {
	margin: 0.1cm;
	size: 80mm 200mm;
}
</style>

<center>
<h5><strong></strong><?php echo $idd['nama_klinik']; ?></strong></h5>
----------------------------------------
<h5><?php echo $idd['alamat']; ?> - Telp: <?php echo $idd['telepon']; ?></h5>
</center>


<table>
<tr>
<td>No.Faktur  </td><td>:</td><td><?php echo $no_faktur; ?></td></tr>
<td>No.Antrian </td><td>:</td><td><?php echo $nota['no_urut']; ?></td></tr>
<td>Pasien     </td><td>:</td><td><?php echo $cust['nama_pasien']." (".$cust['id_pasien'].")"; ?></td></tr>
<td>Kasir      </td><td>:</td><td><?php echo $kasir['nama_karyawan']; ?></td></tr>
<td>Tgl        </td><td>:</td><td><?php echo strftime("%d %B %Y",strtotime($nota['tgl'])); ?></td></tr>
</table>

<table style="width: 30%">
<tr>
<th>#item     </th>
<th style="width: 2%">#Harga            </th> 
<th style="width: 2%">#SubTotal</th>
</tr>
<tr>
<td colspan=3>========================================</td>
</tr>
<?php 
$no = 1;
$tot = 0;
while ($p=mysqli_fetch_array($ky)) {
    
    $nil = $p['jumlah']." x Rp ".number_format($p['harga'],0,",",".");
    $nils = (strlen($nil) > 18)? 1 : 18 - strlen($nil);
    
    $spasi = "";
    
    for($sp = 0; $sp < $nils; $sp++){
        $spasi .= " "; 
    }
    
	echo "<tr><td colspan=3>".$no.". ".$p['nama']."</td></tr><tr><td><td>          ".$nil."".$spasi."</td><td>Rp ".number_format($p['jumlah']*$p['harga'],0,",",".")."</td></tr>";

	$tot = $tot + ($p['jumlah']*$p['harga']);
	
		$dokter = (is_null($p['id_dr']) || $p['id_dr'] == 0)? "" : $p['id_dr'];
		
		$no++;
}

$total = $tot + $nota['uang_ongkir'];

?>
<td colspan=3>========================================</td>
</table>

<table><tr>
    <?php
if($dokter == ""){} else {
	$dr = mysqli_fetch_array(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = '$dokter'"));
	?>
<td>Dokter     </td><td>:</td><td><?php echo $dr['nama_lengkap']; ?></td></tr>
	<?php
}

$ongkir = ($nota['uang_ongkir'] == "")? 0 : $nota['uang_ongkir']; ?></tr>
<tr>
<td>Belanja     </td><td>:</td><td>Rp <?php echo number_format($tot,0,",","."); ?></td></tr>
<td>Ongkos Kirim      </td><td>:</td><td>Rp <?php echo number_format($ongkir,0,",","."); ?></td></tr>
<td>Hemat Spesial     </td><td>:</td><td>Rp <?php echo number_format($total - $nota['total'],0,",","."); ?></td></tr>
<td>Total     </td><td>:</td><td>Rp <?php echo number_format($nota['total'],0,",","."); ?></td></tr>
<td>Uang      </td><td>:</td><td>Rp <?php echo number_format($nota['uang'],0,",","."); ?></td></tr>
<td>Kembalian </td><td>:</td><td>Rp <?php echo number_format($nota['kembalian'],0,",","."); ?></td></tr>
<tr><td colspan=3><center>  Retur Produk berlaku 1 x 24 Jam</center></td></tr>
</table>
<br><br>	

<?php
$html = ob_get_contents(); //Proses untuk mengambil hasil dari OB..
ob_end_clean(); 

/*

$dompdf = new DOMPDF();
$dompdf->load_html($html);
$dompdf->set_paper("z1", "portrait");
$dompdf->render();
$dompdf->stream('struk.pdf',array('Attachment'=>0));
*/

echo $html;
?>
<script>window.print();</script>
</body></html>