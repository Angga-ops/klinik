<?php 

include "../../../config/koneksi.php";
$now = date("Y-m-d");
$c = mysql_query("SELECT id FROM antrian_pasien_lama WHERE no_faktur = '$_POST[no_faktur]'");
if(mysql_num_rows($c) > 0){
    echo "error";
} else {
    $kunjung = mysql_fetch_assoc(mysql_query("SELECT MAX(kunjungan_ke) ke FROM history_ap WHERE id_pasien = '$_POST[id_pasien]'"));
    $ant = mysql_fetch_assoc(mysql_query("SELECT MAX(no_urut) ree FROM antrian_pasien_lama WHERE tanggal_pendaftaran = '$now' AND jenis_layanan = 'poliklinik'"));
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
    $asuransi = $_POST[ass] == ""? "NULL" : $_POST[ass];
    $dr = $_POST[dokter] == ""? "NULL" : $_POST[dokter];
    $poli = $_POST[poli] == ""? "NULL" : $_POST[poli];
    mysql_query("INSERT INTO antrian_pasien_lama (no_urut,no_faktur,id_pasien,tanggal_pendaftaran,status,kunjungan_ke,jenis_layanan,jenis_pasien,id_dr,asuransi,poliklinik,bb,tb,keluhan,tgl_out) VALUES ($antrian,'$_GET[nofak]','$_POST[id_pasien]','$_POST[tgl_reg]','$_POST[status]',$kunjungan,'poliklinik','$_POST[pas]',$dr,$asuransi,$poli,'$_POST[bb]','$_POST[tb]','$_POST[sakit]','$_POST[tgl_out]')");


}

//pembayaran hitung total biaya dari history_kasir_lama per faktur per id_pasien
$tot = mysql_fetch_assoc(mysql_query("SELECT SUM(sub_total) AS tot FROM history_kasir_lama WHERE no_faktur = '$_GET[nofak]' AND id_pasien = '$_POST[id_pasien]'"));

mysql_query("INSERT INTO pembayaran_lama (no_faktur,id_pasien,status,tgl,total,uang) VALUES ('$_GET[nofak]','$_POST[id_pasien]','Belum Lunas','$_POST[tgl_reg]',$tot[tot],$tot[tot])");


?>