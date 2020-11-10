<?php 

include "../../../config/koneksi.php";

$sql = "DELETE FROM antrian_pasien WHERE id = '$_GET[id]'";

mysql_query($sql);

header("Location: ../../media.php?module=home");

?>