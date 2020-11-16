<?php 

include "../../../config/koneksi.php";
mysqli_query($con,"DELETE FROM antrian_pasien WHERE no_faktur='$_GET[faktur]'");
//id obat berdasarkan pembelian
$idobat = json_decode($_GET['data'],true);

//dibeli penuh
$full = "SELECT * FROM kasir_sementara WHERE id IN ($idobat[full])";

$nostock = 0;

$fu = mysqli_query($con,$full);
while($ful = mysqli_fetch_assoc($fu)){
    //cek stok
    $stok = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM produk WHERE kode_barang = '$ful[kode]' AND nama_p = '$ful[nama]'  AND jumlah > 0"));
    if($stok['jumlah'] > 0){

        $sisa = $stok['jumlah'] - $ful['jumlah'];
        mysqli_query($con,"UPDATE produk SET jumlah = '$sisa' WHERE kode_barang = '$ful[kode]' AND nama_p = '$ful[nama]'");
        mysqli_query($con,"INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit,half) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,'Lunas',ket,penginput,kategori,tgl_visit,'Tidak' FROM kasir_sementara WHERE id = '$ful[id]'");
        mysqli_query($con,"DELETE FROM kasir_sementara WHERE id = '$ful[id]'");

    } else {
        mysqli_query($con,"UPDATE kasir_sementara SET ganti_resep = '1' WHERE id = '$ful[id]'");
        $nostock++;
    }
}

//dibeli separuh
$half = "SELECT * FROM kasir_sementara WHERE id IN ($idobat[half])";


$ha = mysqli_query($con,$half);
while($hal = mysqli_fetch_assoc($ha)){
    //cek stok
    $stok = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM produk WHERE kode_barang = '$hal[kode]' AND nama_p = '$hal[nama]' AND jumlah > 0"));
    if($stok['jumlah'] > 0){

        $jml = $hal['jumlah'] * 0.5;

        $subt = $hal['harga'] * $jml;

        $sisa = $stok['jumlah'] - $jml;
        mysqli_query($con,"UPDATE produk SET jumlah = '$sisa' WHERE kode_barang = '$hal[kode]' AND nama_p = '$hal[nama]'");
        mysqli_query($con,"INSERT INTO history_kasir (no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,jumlah,diskon,sub_total,id_kk,jenis,status,ket,penginput,kategori,tgl_visit,half) SELECT no_faktur,id_pasien,id_dr,id_kasir,tanggal,no_urut,nama,kode,harga_beli,harga,'$jml',diskon,'$subt',id_kk,jenis,'Lunas',ket,penginput,kategori,tgl_visit,'Ya' FROM kasir_sementara WHERE id = '$hal[id]'");
        mysqli_query($con,"DELETE FROM kasir_sementara WHERE id = '$hal[id]'");

    } else {
        mysqli_query($con,"UPDATE kasir_sementara SET ganti_resep = '1' WHERE id = '$ful[id]'");
        $nostock++;
    }
}


if($nostock == 0){

//pembayaran
$tot = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(sub_total) AS al FROM history_kasir WHERE no_faktur = '$_GET[faktur]' AND id_pasien = '$_GET[pasien]'"));

$susuk = (int) $_GET['uang'] - $tot['al'];

mysqli_query($con,"INSERT INTO pembayaran_apotek (no_faktur,id_pasien,status,tgl,total,uang,kembalian,id_kasir) VALUES ('$_GET[faktur]','$_GET[pasien]','Lunas','NOW()','$tot[al]','$_GET[uang]','$susuk','$_SESSION[jenis_u]')");
mysqli_query($con,"UPDATE antrian_pasien SET status='Lunas' WHERE no_faktur='$_GET[faktur]'");


    ?> 
    
    <script>
    location.href = 'print.php?faktur=<?php echo $_GET['faktur']; ?>';
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