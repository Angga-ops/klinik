<?php 

include "../../../config/koneksi.php";
include "../../../config/fungsi_rupiah.php";
include "../../../config/kode_otomatis.php";


$id = $_POST['id'];

$kl   = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$id'"));

$ini  = "P"; 

$ini .= inisial2($kl['nama_klinik']);

$ini .= "-";


$nop = array();

$q = mysqli_query($con,"SELECT *FROM pengiriman WHERE cabang='$id'");

$cek = mysqli_num_rows($q);

if ($cek>0) {
	while ($p=mysqli_fetch_array($q)) {
		$no_p  = $p["no_pengiriman"];
		$nop[] = substr($no_p, 3);
	}

	$max = max($nop);

	$max++;
	if ($max==null) {
		$max = 1;
	}
	$ini .= $max;

}
else{

	$max = 1;

	$ini .= $max;
}


echo $ini;

exit();

?>