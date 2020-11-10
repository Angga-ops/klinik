<?php  

session_start();

$id_kk  = $_SESSION['klinik'];


include "../../../config/koneksi.php";

include ('../../../config/fungsi_rupiah.php');

$q = mysql_query("SELECT *FROM kasir_sementara WHERE id_kk='$id_kk' AND status='sementara'");
$total =0;
while ($ks=mysql_fetch_array($q)) {
	$total += $ks['sub_total'];
}
$ongkir = $_POST['ongkir'];
$out1	= $total;
$total += $ongkir;
$out    = rupiah($total);


$tot = array(

"rupiah"=>$out,
"rupiah1"=>$out1


);

echo json_encode($tot);

?>