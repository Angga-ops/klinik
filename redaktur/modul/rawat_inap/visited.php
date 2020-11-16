<?php 

include "../../../config/koneksi.php";

mysqli_query($con,"INSERT INTO dr_visit VALUES (NULL,'$_GET[pasien]','$_GET[faktur]','$_GET[dr]')");

?>