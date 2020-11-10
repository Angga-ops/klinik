<?php  

include "../../../config/koneksi.php";
include ('../../../config/fungsi_rupiah.php');

$total = mysql_query("SELECT SUM(sub_tot) AS total FROM pembelian_t");
$k = mysql_fetch_array($total);
$tot = array();

$out =  $k['total'];
$out = rupiah($out);

$tot = array(
"rupiah"=>$out,
"total"=>$k['total']
);
echo json_encode($tot);
?>