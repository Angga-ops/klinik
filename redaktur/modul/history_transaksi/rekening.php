<?php

include "../../../config/koneksi.php";

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = mysqli_query($con, "SELECT * FROM rekening WHERE no_rek like'%".$search."%'");

 $response = array();

 while($row = mysqli_fetch_array($query)){
   $response[] = array(
   	"label"=>$row['no_rek']
   );
 }

 echo json_encode($response);
}

exit;
?>