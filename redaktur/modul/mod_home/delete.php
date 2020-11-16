<?php 

include "../../../config/koneksi.php";

$sql = "DELETE FROM antrian_pasien WHERE id = '$_GET[id]'";

mysqli_query($con, $sql);

header("Location: ../../media.php?module=home");

?>