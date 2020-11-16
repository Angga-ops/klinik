<?php 

include "../../../config/koneksi.php";

//cari nama produk di master
$nama = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_produk AS prod FROM produk_master WHERE kd_produk = '$_POST[produk]'"));

//cek jml produk sblm pengiriman
$jml = mysqli_fetch_assoc(mysqli_query($con, "SELECT jumlah AS sblm FROM produk WHERE kode_barang = '$_POST[produk]'"));

//cek jml produk di gudang pusat (yg diisi saat pembelian)
$jml_di = mysqli_fetch_assoc(mysqli_query($con, "SELECT jumlah AS gudang FROM produk_pusat WHERE kode_barang = '$_POST[produk]'"));

//STOP kl $jml_di[gudang] < $_POST[jml]

if( $jml_di['gudang'] < $_POST['jml'] ){
    ?> 
    
    <script>alert("Jumlah yang akan dikirim melebihi stok gudang. Silakan cek kembali pengiriman atau lakukan pembelian produk ini");
    location.href="../../media.php?module=gudang";
    </script>
    
    <?php
} else {

//hitung selisih jumlah yg dikirim dengan $jml_di[gudang]
$sisa_gudang = $jml_di["gudang"] - $_POST['jml'];

//updatekan $sisa_gudang ke gudang pusat
$update_gudang_pusat = "UPDATE produk_pusat SET jumlah = '$sisa_gudang' WHERE kode_barang = '$_POST[produk]'";

mysqli_query($con, $update_gudang_pusat);

//cek kl $jml[sblm] null maka insert alias kiriman pertama produk setelah pembelian
//cek kl $jml[sblm] tdk null maka update, $jml[sblm] disimpan

if(!$jml){
    $kiriman = "INSERT INTO produk VALUES (NULL,'$_POST[produk]','$nama[prod]','$_POST[jml]')";
} else {
    //totalkan $jml[sblm] + $_POST[jml]
    $jmln = $jml['sblm'] + $_POST['jml'];
    $kiriman = "UPDATE produk SET jumlah = '$jmln' WHERE kode_barang = '$_POST[produk]'";
}

//rekam proses pengiriman
$rekam = "INSERT INTO produk_pengiriman VALUES (NULL,NOW(),'$_POST[produk]','$nama[prod]','$_POST[jml]','$jml[sblm]')";


mysqli_query($con, $kiriman);
mysqli_query($con, $rekam); ?>

<script>
    location.href="../../media.php?module=gudang";
    </script>

<?php

}

?>
