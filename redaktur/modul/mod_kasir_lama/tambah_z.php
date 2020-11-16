<?php 

include "../../../config/koneksi.php";
$now = date("Y-m-d");
$c = mysqli_query($con,"SELECT id FROM antrian_pasien WHERE no_faktur = '$_POST[no_faktur]'");
if(mysqli_num_rows($c) > 0){
    echo "error";
} else {
    $kunjung = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(kunjungan_ke) ke FROM history_ap WHERE id_pasien = '$_POST[id_pasien]'"));
    $ant = mysqli_fetch_assoc(mysqli_query($con,"SELECT MAX(no_urut) ree FROM antrian_pasien WHERE tanggal_pendaftaran = '$now' AND jenis_layanan = 'lab'"));
    if(is_null($ant["ree"])){
        $antrian = 1;
    } else {
        $antrian = $ant["ree"] + 1;
    }
    if(is_null($kunjung["ke"])){
        $kunjungan = 1;
    } else {
        $kunjungan = $kunjung["ke"] + 1;
    }
    $asuransi = $_POST['ass'] == ""? "NULL" : $_POST['ass'];
    $dr = $_POST['dokter'] == ""? "NULL" : $_POST['dokter'];
    $poli = $_POST['poli'] == ""? "NULL" : $_POST['poli'];
    mysqli_query($con,"INSERT INTO antrian_pasien (id_kasir,no_urut,no_faktur,id_pasien,tanggal_pendaftaran,status,kunjungan_ke,jenis_layanan,jenis_pasien,id_dr,asuransi,poliklinik,bb,tb,keluhan) VALUES ($_POST[id_kasir],$antrian,'$_POST[nofak]','$_POST[id_pasien]','$now',NULL,$kunjungan,'lab','$_POST[pas]',$dr,$asuransi,$poli,$_POST[bb],$_POST[tb],'$_POST[sakit]')");

   
}

?>