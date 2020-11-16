<?php 
include '../config/koneksi.php';

$search = $_GET["query"];

$q1 = mysqli_query($con, "SELECT *FROM daftar_klinik WHERE nama_klinik LIKE '%".$search."%' ");

$klinik = array();

while ($row = mysqli_fetch_array($q1)) {
	$klinik[] = array(
   	"jenis"=>$row['jenis'],
   	"value"=>$row['id_kk'],
   	"name"=>$row['nama_klinik']
   );
}
echo $klinik;

?>