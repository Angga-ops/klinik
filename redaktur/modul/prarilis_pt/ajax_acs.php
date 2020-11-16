<?php 

include "../../../config/koneksi.php";

$sql1 = "SELECT kode_barang,nama_p,harga_jual,harga_beli FROM produk WHERE nama_p LIKE '%$_POST[search]%' AND id_kk = '$_GET[cab]'";

$sql2 = "SELECT nama_t,harga,modal  FROM treatment WHERE nama_t LIKE '%$_POST[search]%'";

$p = mysqli_num_rows(mysqli_query($con,$sql1));
$t = mysqli_num_rows(mysqli_query($con,$sql2));

if($p != 0){

    $d = array();
    $s1 = mysqli_query($con,$sql1);
while($ki = mysqli_fetch_assoc($s1)){
    $dx = array("label"=> $ki['nama_p'],"harga"=> $ki['harga_jual'],"hargab"=> $ki['harga_beli'],"status"=> "produk","kdprod"=> $ki['kode_barang']);
    array_push($d,$dx);
}


echo json_encode($d);

} else if($t != 0){

    $d = array();
    $s2 = mysqli_query($con,$sql2);
while($ki = mysqli_fetch_assoc($s2)){
    $dx = array("label"=> $ki['nama_t'],"harga"=> $ki['harga'],"hargab"=> $ki['modal'],"status"=> "treatment");
    array_push($d,$dx);
}


echo json_encode($d);

}



?>