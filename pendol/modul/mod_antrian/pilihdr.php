<?php
include "../../../config/koneksi.php";

$sql = "SELECT * FROM dr_praktek WHERE hari='$_GET[hari]' AND jam='$_GET[wkt]' AND id_poli='$_GET[poli]'";

$k = mysql_query($sql);
if(mysql_num_rows($k) > 0){
    echo "<select class='form-control' name='dr'>";
    while($ki = mysql_fetch_assoc($k)){
        $dr = mysql_fetch_assoc(mysql_query("SELECT * FROM user WHERE id_user = $ki[id_dr]"));
        echo "<option value='$ki[id_dr]'>$dr[nama_lengkap]</option>";
    }
    echo "</select>";
} else {
    echo "<select class='form-control' disabled><option value=''>--tdk ada data--</option></select>";
}


?>
