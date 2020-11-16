<?php 

include "../../../config/koneksi.php";
$now = date("Y-m-d");
$c = mysqli_query($con,"SELECT id FROM perawatan_pasien WHERE no_faktur = '$_POST[no_faktur]'");
if(mysqli_num_rows($c) > 0){
    echo "error";
} else {
   
    $asuransi = $_POST['ass'] == ""? "NULL" : $_POST['ass'];
    $dr = $_POST['dokter'] == ""? "NULL" : $_POST['dokter'];
    mysqli_query($con,"INSERT INTO perawatan_pasien (suhu,tensi,id_kasir,no_faktur,id_pasien,tanggal_pendaftaran,id_ruang,jenis_pasien,id_dr,asuransi,bb,tb,keluhan,status) VALUES ('$_POST[suhu]','$_POST[tensi]',$_POST[id_kasir],'$_POST[nofak]','$_POST[id_pasien]','$now',$_POST[ruang],'$_POST[pas]',$dr,$asuransi,$_POST[bb],$_POST[tb],'$_POST[sakit]',NULL)");


}

?>