<?php

include "../../../config/koneksi.php";

$nor = $_POST['nor'];

mysqli_query($con,"UPDATE reture SET keterangan='Selesai' WHERE no_reture='$nor'");

exit();

?>