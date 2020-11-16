<?php

include "../../../config/koneksi.php";

$k = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM bonus WHERE id = '$_GET[id]'"));


$j = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM produk_master WHERE kd_produk = '$k[produk]'"));


$x = mysqli_fetch_assoc(mysqli_query($con, "SELECT id,id_pasien,nama_pasien FROM pasien WHERE id = $k[pasien]"));

echo '{"acs":"'.$x["nama_pasien"].' '.$x['id_pasien'].'","cus":"'.$x["id"].'","prod":"'.$j["nama_produk"].'","prd":"'.$j["kd_produk"].'","jml":"'.$k["jml"].'","ket":"'.$k["ket"].'","tgl":"'.$k["tgl"].'","klinik":"'.$k["klinik"].'","username":"'.$k["username"].'"}';
?>