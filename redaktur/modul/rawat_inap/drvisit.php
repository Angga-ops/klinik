<?php 

include "../../../config/koneksi.php";

$sql = "SELECT * FROM dr_visit WHERE id_pasien = '$_GET[pasien]' AND no_faktur = '$_GET[faktur]'";

$json = '{"aaData":[';

    $k = mysqli_query($con,$sql);
    while($ki = mysqli_fetch_assoc($k)){
        $dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM user WHERE id_user = '$ki[id_dr]'"));
        $u .= '["'.$dr['nama_lengkap'].'","<button class=\'btn btn-sm btn-danger\' onclick=\'hapus('.$ki['id'].')\'>Hapus</button>"],';
    }

    $u = substr($u,0,strlen($u)-1);

    $json .= $u.']}';

    echo $json;

?>