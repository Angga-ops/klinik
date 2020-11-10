<?php 

$dt = mysql_fetch_assoc(mysql_query("SELECT * FROM antrian_pasien_lama a JOIN pasien b ON a.id_pasien = b.id_pasien WHERE a.no_faktur = '$_GET[faktur]'"));

$poli = mysql_fetch_assoc(mysql_query("SELECT * FROM poliklinik WHERE id_poli = $dt[poliklinik]"));
$dr = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user = $dt[id_dr]"));

?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">Detail Billing Lama</h4>
            <a href="modul/history_kasir_lama/print.php?faktur=<?php echo $_GET[faktur]; ?>" target="_BLANK"><button id="print" class="btn btn-info"><i class="fa fa-print"></i></button></a>
		</div>
		<div class="box-body">
<div class="row">
<div class="col-md-3">
<label>Nomer Billing</label><br/>
<?php echo $dt[no_faktur]; ?>
</div>
<div class="col-md-3">
<label>Nomer RM</label><br/>
<?php echo $dt[id_pasien]; ?>
</div>
<div class="col-md-3">
<label>Tgl Registrasi</label><br/>
<?php echo $dt[tanggal_pendaftaran]; ?>
</div>
<div class="col-md-3">
<label>Tgl Keluar</label><br/>
<?php echo $dt[tgl_out]; ?>
</div>
</div>
<br/><br/>
<div class="row">
<div class="col-md-3">
<label>Nama Pasien</label><br/>
<?php echo $dt[nama_pasien]; ?>
</div>
<div class="col-md-3">
<label>Poliklinik</label><br/>
<?php echo $poli[poli]; ?>
</div>
<div class="col-md-3">
<label>Nama Dokter Pemeriksa</label><br/>
<?php echo $dr[nama_lengkap]; ?>
</div>
<div class="col-md-3">
<label>Penjamin</label><br/>
<?php echo $dt[jenis_pasien]; ?>
</div>
</div>

<br/><br/>

<div class="row">
<div class="col-md-3">
<label>Jenis Layanan</label><br/>
<?php echo $dt[jenis_layanan]; ?>
</div>
<div class="col-md-3">
<label>Status</label><br/>
<?php echo $dt[status]; ?>
</div>
<div class="col-md-3">
</div>
<div class="col-md-3">
</div>
</div>

<br/><br/>

<div class="row">
<div class="col-md-12">
<table class="table">
<tr>
<th>Keterangan</th>
<th>Qty</th>
<th>Harga</th>
<th>Diskon</th>
<th>Sub Total</th>
</tr>
<?php 

$u = mysql_query("SELECT * FROM history_kasir_lama WHERE no_faktur = '$_GET[faktur]' ORDER BY kategori DESC");

$kat = "";
$tot = 0;
while($ux = mysql_fetch_assoc($u)){
    $kate = mysql_fetch_assoc(mysql_query("SELECT * FROM kategori_biaya WHERE id = $ux[kategori]"));
    if($kat == $ux[kategori]){} else if($ux[kategori] == "0"){
        echo "<tr><td colspan=5>Biaya Obat-obatan</td></tr>";
    } else {
        echo "<tr><td colspan=5>$kate[kategori]</td></tr>";
    }

if($ux[ket] == "-"){} else if($ux[id_dr] == "0"){
$dr = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user = $ux[id_dr]"));
    $ket = "Dokter $dr[nama_lengkap] $ux[tgl_visit]";
} else {
   $ket = $ux[ket];
}

    $dsc = ($ux[diskon]/100 * $ux[harga]);
    echo "<tr>";
    echo "<td>$ux[nama] $ket</td>";
    echo "<td>$ux[jumlah]</td>";
    echo "<td>".number_format($ux[harga],0,",",".")."</td>";
    echo "<td>".number_format($dsc,0,",",".")."</td>";
    echo "<td>".number_format($ux[sub_total],0,",",".")."</td>";
    echo "</tr>";
    $kat = $ux[kategori];
    $tot = $tot + $ux[sub_total];
}

echo "<tr><td colspan=4>TOTAL</td><td>".number_format($tot,0,",",".")."</td></tr>";

?>
</table>
</div>
</div>

</div>
</section>