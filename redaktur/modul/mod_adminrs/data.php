<?php 

include "../../../config/koneksi.php";

$r = mysql_fetch_assoc(mysql_query("SELECT * FROM biaya_administrasi WHERE id = '$_GET[id]'"));

echo '{"nama":"'.$r[nama].'","biaya":"'.$r[biaya].'"}';

?>