<?php 
include '../config/koneksi.php';

$search = $_GET["query"];

$q1 = mysql_query("SELECT *FROM daftar_klinik WHERE nama_klinik LIKE '%".$search."%' ");

$klinik = array();

while ($row = mysql_fetch_array($q1)) {
	$klinik[] = array(
   	"jenis"=>$row['jenis'],
   	"value"=>$row['id_kk'],
   	"name"=>$row['nama_klinik']
   );
}
echo $klinik;

?>