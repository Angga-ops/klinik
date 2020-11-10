<?php

include "../../../config/koneksi.php";

if(isset($_POST['search'])){

$search = $_POST['search'];

$query = mysql_query("SELECT * FROM pasien WHERE nama_pasien like'%".$search."%'");

$response = array();

while($row = mysql_fetch_array($query)){
   $response[] = array(
   	"label"=>$row['nama_pasien']
   );
}

echo json_encode($response);

exit();

}

?>