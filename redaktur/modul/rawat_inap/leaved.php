<?php 

include "../../../config/koneksi.php";

mysql_query("UPDATE perawatan_pasien SET status = '$_GET[status]' , tgl_out = NOW() WHERE id_pasien = '$_GET[pasien]' AND no_faktur = '$_GET[faktur]'");

?>