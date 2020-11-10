<?php

include "../../../config/koneksi.php";


$k = mysql_fetch_assoc(mysql_query("SELECT * FROM produk WHERE id_p = $_GET[id]"));


$sat = mysql_fetch_assoc(mysql_query("SELECT satuan AS uan FROM data_satuan WHERE id_s = $k[id_s]"));

$kat = mysql_fetch_assoc(mysql_query("SELECT kategori AS egori FROM kategori WHERE id_kategori = $k[id_kategori]"));

echo '{"prd":"'.$k[nama_p].'","kd":"'.$k[kode_barang].'","jml":"'.$k[jumlah].'","kat":"'.$k[id_kategori].'","sat":"'.$k[id_s].'","sup":"'.$k[id_supplier].'","beli":"'.$k[beli].'","jual":"'.$k[jual].'","tgl":"'.$k[tgl_terima].'"}';

?>