<?php 

include "../../../config/koneksi.php";

switch($_GET[act]){
    case "add": 
    
    mysql_query("INSERT INTO kategori_biaya VALUES (NULL,'$_POST[nama]')");
    
    break;

    case "edit": 
    
    mysql_query("UPDATE kategori_biaya SET kategori = '$_POST[nama]' WHERE id = '$_POST[id]'");
    
    break;

    case "del": 
    
    mysql_query("DELETE FROM kategori_biaya WHERE id = '$_GET[id]'");
    
    break;

}


?>

<script>
location.href="../../media.php?module=kategori_biaya";
</script>