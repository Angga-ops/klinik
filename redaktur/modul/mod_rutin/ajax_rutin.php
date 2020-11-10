<?php 
include "../../conf/koneksi.php";


$id = $_GET["id"];

$k = mysqli_query($conn,"SELECT * FROM rutin WHERE id = '$id'");
$js = array();
while($kx = mysqli_fetch_assoc($k)){
$js[] = $kx;
}

echo json_encode($js); 

/*
$i = 0;
while($i < 9000000){
    echo $i;
    $i++;
} */

?>