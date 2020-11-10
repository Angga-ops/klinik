<?php 

include "../../../config/koneksi.php";

mysql_query("INSERT INTO dr_visit VALUES (NULL,'$_GET[pasien]','$_GET[faktur]','$_GET[dr]')");

?>