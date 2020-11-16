<?php

session_start();

include "../../../config/koneksi.php";

switch($_GET['act']){
    case "out":

    $j = json_decode($_GET['serial'],true);

    foreach($j as $key => $val){

        //kurangkan produk dari cabang
        $p = "SELECT * FROM produk WHERE kode_barang = '$val[kode_produk]' AND id_kk = '$val[asal]'";

        $j = mysqli_fetch_assoc(mysqli_query($con, $p));

        $sisax = $j['jumlah'] - (int) $val['jml'];

        mysqli_query($con, "UPDATE produk SET jumlah = '$sisax' WHERE id_p = '$j[id_p]'");

        $sql = "INSERT INTO kliniktrf VALUES ('','$val[asal]','$val[tujuan]','$val[kode_produk]','$val[jml]','0','$val[tgl]','$val[kdtrf]','$val[username]')";
       mysqli_query($con, $sql);
    }

    break;
    case "detail":

    $sql = "SELECT * FROM kliniktrf WHERE kd_trf = '$_GET[kdtrf]'";
    $u = mysqli_query($con, $sql);
    while($ux = mysqli_fetch_assoc($u)){
        $nm = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_p FROM produk WHERE kode_barang = '$ux[kode_produk]' AND id_kk = '$ux[asal]'"));
        $stat = ($ux['status'] == 0)? "" : "diterima";
        $dt .= '["'.$ux['kode_produk'].'","'.$nm['nama_p'].'","'.$ux['jml'].'","'.$stat.'"],';
        $loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$ux[tujuan]'"));
    }
    $dt = substr($dt,0,strlen($dt) - 1);
    $data = '{"aaData":['.$dt.']}';


    echo $loc['nama_klinik'];
    file_put_contents("detail.json",$data);

    break;
    case "detail2":

    $sql = "SELECT * FROM kliniktrf WHERE kd_trf = '$_GET[kdtrf]'";
    $u = mysqli_query($con, $sql);
    while($ux = mysqli_fetch_assoc($u)){
        $nm = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_p FROM produk WHERE kode_barang = '$ux[kode_produk]' AND id_kk = '$ux[asal]'"));

        if($ux['status'] == 0){
            $stat = "<div id='status-$ux[id]'></div>";
            $aksi = "<button id='btn-$ux[id]' class='btn btn-sm btn-info' onclick='terima(this.id)'>Terima</button>";
        } else {
            $stat = "Diterima";
            $aksi = "";
        }


        $dt .= '["'.$aksi.'","'.$ux['kode_produk'].'","'.$nm['nama_p'].'","'.$ux['jml'].'","'.$stat.'"],';
        $loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$ux[asal]'"));
    }
    $dt = substr($dt,0,strlen($dt) - 1);
    $data = '{"aaData":['.$dt.']}';


    echo $loc['nama_klinik'];
    file_put_contents("detail2.json",$data);

    break;
    case "terima":

    $sqld = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM kliniktrf WHERE id = '$_GET[id]'"));
    $sqld1 = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_p,jumlah FROM produk WHERE kode_barang = '$sqld[kode_produk]' AND id_kk = '$sqld[tujuan]'"));
    $sisa = $sqld1['jumlah'] + $sqld['jml'];
    mysqli_query($con, "UPDATE produk SET jumlah = '$sisa' WHERE kode_barang = '$sqld[kode_produk]' AND id_kk = '$sqld[tujuan]'");
    mysqli_query($con, "UPDATE kliniktrf SET status = 1 WHERE id = '$_GET[id]'");

    break;
}

?>