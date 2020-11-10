<?php 

include "../../../config/koneksi.php";
mysql_query("DELETE FROM antrian_pasien WHERE no_faktur='$_GET[faktur]'");
//id obat berdasarkan pembelian
$idobat = json_decode($_GET[data],true);

//dibeli penuh
$full = "SELECT * FROM kasir_sementara WHERE id IN ($idobat[full])";

$nostock = 0;

$fu = mysql_query($full);
while($ful = mysql_fetch_assoc($fu)){
    //cek stok
    $stok = mysql_fetch_assoc(mysql_query("SELECT * FROM produk WHERE kode_barang = '$ful[kode]' AND nama_p = '$ful[nama]'  AND jumlah > 0"));
    if($stok[jumlah] > 0){

        $sisa = $stok[jumlah] - $ful[jumlah];
        mysql_query("UPDATE produk SET jumlah = '$sisa' WHERE kode_barang = '$ful[kode]' AND nama_p = '$ful[nama]'");
        mysql_query("INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit,half) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,'Lunas',ket,penginput,kategori,tgl_visit,'Tidak' FROM kasir_sementara WHERE id = '$ful[id]'");
        mysql_query("DELETE FROM kasir_sementara WHERE id = '$ful[id]'");

    } else {
        mysql_query("UPDATE kasir_sementara SET ganti_resep = '1' WHERE id = '$ful[id]'");
        $nostock++;
    }
}

//dibeli separuh
$half = "SELECT * FROM kasir_sementara WHERE id IN ($idobat[half])";


$ha = mysql_query($half);
while($hal = mysql_fetch_assoc($ha)){
    //cek stok
    $stok = mysql_fetch_assoc(mysql_query("SELECT * FROM produk WHERE kode_barang = '$hal[kode]' AND nama_p = '$hal[nama]' AND jumlah > 0"));
    if($stok[jumlah] > 0){

        $jml = $hal[jumlah] * 0.5;

        $subt = $hal[harga] * $jml;

        $sisa = $stok[jumlah] - $jml;
        mysql_query("UPDATE produk SET jumlah = '$sisa' WHERE kode_barang = '$hal[kode]' AND nama_p = '$hal[nama]'");
        mysql_query("INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit,half) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,'$jml',diskon,'$subt',id_kk,jenis,'Lunas',ket,penginput,kategori,tgl_visit,'Ya' FROM kasir_sementara WHERE id = '$hal[id]'");
        mysql_query("DELETE FROM kasir_sementara WHERE id = '$hal[id]'");

    } else {
        mysql_query("UPDATE kasir_sementara SET ganti_resep = '1' WHERE id = '$ful[id]'");
        $nostock++;
    }
}


if($nostock == 0){

//pembayaran
$tot = mysql_fetch_assoc(mysql_query("SELECT SUM(sub_total) AS al FROM history_kasir WHERE no_faktur = '$_GET[faktur]' AND id_pasien = '$_GET[pasien]'"));

$susuk = (int) $_GET[uang] - $tot[al];

mysql_query("INSERT INTO pembayaran_apotek (no_faktur,id_pasien,status,tgl,total,uang,kembalian,id_kasir) VALUES ('$_GET[faktur]','$_GET[pasien]','Lunas','NOW()','$tot[al]','$_GET[uang]','$susuk','$_SESSION[jenis_u]')");
mysql_query("UPDATE antrian_pasien SET status='Lunas' WHERE no_faktur='$_GET[faktur]'");


    ?> 
    
    <script>
    location.href = 'print.php?faktur=<?php echo $_GET[faktur]; ?>';
    </script>
    
    <?php
} else {
    ?> 
    
    <script>
   alert("Sebanyak <?php echo $nostock; ?> item obat stoknya kosong. Silakan minta pasien menghubungi dokter untuk Ganti Resep dengan menunjukkan Bukti Pembayaran dari Kasir/Resepsionis");
   window.close();
    </script>
    
    <?php
}


?>