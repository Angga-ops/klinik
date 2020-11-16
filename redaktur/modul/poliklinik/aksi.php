<?php 

include "../../../config/koneksi.php";

switch($_GET['act']){
    case "add":
    mysqli_query($con,"INSERT INTO poliklinik VALUES (NULL,'$_POST[poli]')");
    break;
    case "edit": 
    mysqli_query($con,"UPDATE poliklinik SET poli = '$_POST[poli]' WHERE id_poli = '$_GET[id]'");
    break;
    case "del": 
    mysqli_query($con,"DELETE FROM poliklinik WHERE id_poli = '$_GET[id]'");
    break;
}


?>
<script>
location.href="../../media.php?module=poliklinik";
</script>