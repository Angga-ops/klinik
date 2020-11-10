<?php 

include "../../../config/koneksi.php";

mysql_query("DELETE FROM dr_visit WHERE id = $_GET[id]");

?>