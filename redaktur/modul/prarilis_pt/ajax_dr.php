<?php 

include "../../../config/koneksi.php";

$sql = "SELECT id_user,nama_lengkap FROM user WHERE nama_lengkap LIKE '%$_POST[search]%' AND id_ju = 'JU-02'";

$k = mysqli_query($con,$sql);
$d = array();
while($ki = mysqli_fetch_assoc($k)){
    $dx = array("label"=> $ki['nama_lengkap'],"kd"=> $ki['id_user']);
    array_push($d,$dx);
}


echo json_encode($d);
?>