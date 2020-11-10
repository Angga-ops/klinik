<?php 

include "../../../config/koneksi.php";

$sql = "SELECT id_pasien,nama_pasien,no_telp FROM pasien WHERE nama_pasien LIKE '%$_POST[search]%' AND id_kk = '$_GET[cab]'";

$k = mysql_query($sql);
$d = array();
while($ki = mysql_fetch_assoc($k)){
    $dx = array("label"=> $ki[nama_pasien]." (".$ki[id_pasien].")","kd"=> $ki[id_pasien],"hp"=> $ki[no_telp]);
    array_push($d,$dx);
}


echo json_encode($d);
?>