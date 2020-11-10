<?php 

include "../../../config/koneksi.php";

$sql = "SELECT * FROM history_kasir WHERE id_pasien = '$_GET[pasien]' AND no_faktur = '$_GET[faktur]'";
$sql2 = "SELECT * FROM pasca_treatment WHERE id_pasien = '$_GET[pasien]' AND no_faktur = '$_GET[faktur]'";

$json = '{"aaData":[';

    $k = mysql_query($sql);
    while($ki = mysql_fetch_assoc($k)){
        $dr = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user = '$ki[id_dr]'"));
        $u .= '["'.$ki[tanggal].'","'.$ki[nama].' '.$ki[ket].'","'.$dr[nama_lengkap].'"],';
    }

    $k2 = mysql_query($sql2);
    while($ki2 = mysql_fetch_assoc($k2)){
        $dr = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user = '$ki2[id_dr]'"));
        $u .= '["'.$ki2[tanggal].'","'.$ki2[assestment].' | '.$ki2[subjek].' | '.$ki2[objek].'","'.$dr[nama_lengkap].'"],';
    }


    $u = substr($u,0,strlen($u)-1);

    $json .= $u.']}';

    echo $json;

?>