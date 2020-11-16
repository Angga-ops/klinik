<?php 

include "../../../config/koneksi.php";

mysqli_query($con,"DELETE FROM dr_visit WHERE id = $_GET[id]");

?>