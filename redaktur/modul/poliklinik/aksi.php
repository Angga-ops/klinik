<?php 

include "../../../config/koneksi.php";

switch($_GET[act]){
    case "add":
    mysql_query("INSERT INTO poliklinik VALUES (NULL,'$_POST[poli]')");
    break;
    case "edit": 
    mysql_query("UPDATE poliklinik SET poli = '$_POST[poli]' WHERE id_poli = '$_GET[id]'");
    break;
    case "del": 
    mysql_query("DELETE FROM poliklinik WHERE id_poli = '$_GET[id]'");
    break;
}


?>
<script>
location.href="../../media.php?module=poliklinik";
</script>