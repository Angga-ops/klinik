<?php 

include "../../../config/koneksi.php";

$r = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM biaya_administrasi WHERE id = '$_GET[id]'"));

echo '{"nama":"'.$r['nama'].'","biaya":"'.$r['biaya'].'"}';

?>