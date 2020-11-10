<?php 

include "../../../config/koneksi.php";

$sql = "SELECT * FROM prarilis WHERE klinik = '$_GET[klinik]'";

$u = mysql_query($sql);

$num = 0;
while($ux = mysql_fetch_assoc($u)){

$np = strtoupper($ux[nama_produk]);
//cek di produk
$n = mysql_num_rows(mysql_query("SELECT id_p FROM produk WHERE nama_p = '$np' AND id_kk = '$_GET[klinik]'"));


if($n > 0){
    //sdh ada biarkan saja
} else {
    mysql_query("INSERT INTO produk (kode_barang,nama_p,harga_jual,harga_beli,batas_minim,batas_maks,id_s,id_kategori,id_kk,jumlah) VALUES ('$ux[kode_produk]','$np','$ux[jual]','$ux[beli]','1',$ux[jml],$ux[id_satuan],$ux[id_kategori],$ux[klinik],$ux[jml])");


    mysql_query("INSERT INTO produk_master (kd_produk,nama_produk,harga_jual,harga_beli,id_satuan,id_kategori) VALUES ('$ux[kode_produk]','$np','$ux[jual]','$ux[beli]',$ux[id_satuan],$ux[id_kategori])");

    $num++;
}



}



echo "<script>alert('$num produk berhasil ditambahkan'); location.href='../../media.php?module=prarilis_stock';</script>";

?>