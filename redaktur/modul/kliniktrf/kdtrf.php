<?php 

include "../../../config/koneksi.php";

$u = mysql_query("SELECT kd_trf FROM kliniktrf ORDER BY id DESC LIMIT 1");
$v = mysql_num_rows($u);

if($v == 0){

$h = 1;
$z = "KT-".str_pad(($h),6,"0",STR_PAD_LEFT);

} else {
    
$j = mysql_fetch_assoc($u);
$k = substr($j[kd_trf],3,strlen($j[kd_trf]));
$h = (int) $k;
$z = "KT-".str_pad(($h + 1),6,"0",STR_PAD_LEFT);

}


echo $z;


?>