<?php 
setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");
include "../../../config/koneksi.php";
//cek apakah faktur yg dicari ada id retur

$f = mysqli_query($con,"SELECT a.id,a.id_kk FROM history_kasir a JOIN retur_jual b ON a.id = b.history WHERE no_faktur = '$_GET[faktur]'");

while($fa = mysqli_fetch_assoc($f)){
    $d .= $fa['id'].",";
    $cab = $fa['id_kk'];
}

$d = substr($d,0,strlen($d) - 1);

if(strlen($d) == 0){
    echo "<script>alert('tidak ada retur untuk no faktur ini');</script>";
} else {
    $sql = "SELECT * FROM retur_jual a JOIN history_kasir b ON a.history = b.id WHERE a.history IN ($d)";

$cb = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM daftar_klinik WHERE id_kk = '$cab'"));
?>

<html><head><style>
    td,th {padding: 0.5%;font-size: 9px}
    th {border-bottom: 2px double black}
	table {border-collapse: collapse; width: 90%}
</style></head><body>

<center>
<h1>Klinik Surya Medika Satui</h1>
<small>
<strong>
<?php echo $cb['alamat']." ".$cb['telepon']; ?>
</strong>
</small>
<hr/>
<h4>Layanan Retur Produk</h4>
</center>

<table>
<thead>
<tr>

<th style="width: 15%">Asal Faktur</th>
<th style="width: 15%">Tgl Retur</th>
<th>Produk</th>
<th>Jml Retur</th>
<th>Harga Produk</th>
<th>Total Uang Dikembalikan</th>
<th>Ket</th>

</tr>
</thead>
<tbody>

<?php 

$s = mysqli_query($con,$sql);
while($sx = mysqli_fetch_assoc($s)){
    $ket = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM master_retur_jual WHERE id = $sx[retur]"));
    //$prd = mysql_fetch_assoc(mysql_query("SELECT nama_p FROM produk WHERE kode_barang = '$sx[replaces]'"));
    $k = mysqli_fetch_assoc(mysqli_query($con,"SELECT id_pasien FROM history_kasir WHERE id = '$sx[history]'"));
    $cust = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien = '$k[id_pasien]'"));
    echo "<tr>";
    echo "<td>$sx[no_faktur] <br/> $cust[nama_pasien] ($cust[id_pasien])</td>";
    echo "<td>".strftime("%d %B %Y",strtotime($sx['tgl']))."</td>";
    echo "<td>$sx[nama]</td>";
    echo "<td>$sx[jml]</td>";
    echo "<td style='text-align:right'>Rp ".number_format($sx['harga'],0,",",".")."</td>";
    if($sx['retur'] == "2"){
        echo "<td style='text-align:right'>Rp ".number_format($sx['harga']*$sx['jml'],0,",",".")."</td>";
    } else {
        echo "<td style='text-align:right'>0</td>";
    }
    echo "<td>$ket[retur]</td>";
    echo "</tr>";
}

?>

</tbody>
</table>


<script>
window.print();
</script>

<?php } ?>

</body></html>