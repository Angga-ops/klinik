<?php 
session_start();
setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");
include "../../../config/koneksi.php";

    $sql = "SELECT * FROM kliniktrf WHERE kd_trf = '$_GET[kdtrf]'";

$cb = mysql_fetch_assoc(mysql_query("SELECT * FROM daftar_klinik WHERE id_kk = '$_SESSION[klinik]'"));
?>

<html><head><style>
    td,th {padding: 0.5%;font-size: 9px}
    th {border-bottom: 2px double black}
	table {border-collapse: collapse; width: 90%}
</style></head><body>

<center>
<h1>KS Beauty</h1>
<small>
<strong>
Cabang <?php echo $cb[nama_klinik]; ?><br/>
<?php echo $cb[alamat]." ".$cb[telepon]; ?>
</strong>
</small>
<hr/>
<h4>Pengiriman Produk Antar Cabang</h4>
</center>

<table>
<thead>
<tr>

<th style="width: 15%">Tgl Kiriman</th>
<th>Produk</th>
<th>Jml</th>
<th>Tujuan</th>

</tr>
</thead>
<tbody>

<?php 

$s = mysql_query($sql);
while($sx = mysql_fetch_assoc($s)){
    $prd = mysql_fetch_assoc(mysql_query("SELECT nama_p FROM produk WHERE kode_barang = '$sx[kode_produk]'"));
    $loc = mysql_fetch_assoc(mysql_query("SELECT * FROM daftar_klinik WHERE id_kk = '$sx[tujuan]'"));
    echo "<tr>";
    echo "<td>".strftime("%d %B %Y",strtotime($sx[tgl]))."</td>";
    echo "<td>$prd[nama_p]</td>";
    echo "<td>$sx[jml]</td>";
    echo "<td>$loc[nama_klinik]</td>";
    echo "</tr>";
}

?>

</tbody>
</table>


<script>
window.print();
</script>


</body></html>