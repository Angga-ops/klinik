<?php 

include "../../../config/koneksi.php";

include '../../../config/fungsi_rupiah.php';

$nofak     = $_POST['nofak'];

$filt = ($_POST['layan'] == "jalan")? "AND jenis != 'Produk' AND kategori != '2'" : "";

$q = mysqli_query($con, "SELECT *FROM history_kasir WHERE no_faktur='$nofak' AND status='Belum Lunas' $filt");

$total =0;
while ($ks=mysqli_fetch_array($q)) {
	$total += $ks['sub_total'];
}
$ongkir = $_POST['ongkir'];
$out1	= $total;
$total += $ongkir;

$tot = array(

"rupiah1"=>rupiah($total),
"rupiah"=>rupiah($out1)


);

echo json_encode($tot);

exit();

?>