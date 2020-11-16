<?php

include "../../../config/koneksi.php";


$k = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM produk WHERE id_p = $_GET[id]"));


$sat = mysqli_fetch_assoc(mysqli_query($con,"SELECT satuan AS uan FROM data_satuan WHERE id_s = $k[id_s]"));

$kat = mysqli_fetch_assoc(mysqli_query($con,"SELECT kategori AS egori FROM kategori WHERE id_kategori = $k[id_kategori]"));

echo '{"prd":"'.$k['nama_p'].'","kd":"'.$k['kode_barang'].'","jml":"'.$k['jumlah'].'","kat":"'.$k['id_kategori'].'","sat":"'.$k['id_s'].'","sup":"'.$k['id_supplier'].'","beli":"'.$k['beli'].'","jual":"'.$k['jual'].'","tgl":"'.$k['tgl_terima'].'"}';

?>