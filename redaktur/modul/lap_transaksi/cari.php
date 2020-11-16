<?php

include "../../../config/koneksi.php";

if(isset($_POST['search'])){

$search = $_POST['search'];

$query = mysqli_query($con, "SELECT * FROM pasien WHERE nama_pasien like'%".$search."%'");

$response = array();

while($row = mysqli_fetch_array($query)){
   $response[] = array(
   	"label"=>$row['nama_pasien']
   );
}

echo json_encode($response);

exit();

}

?>