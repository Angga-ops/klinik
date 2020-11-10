<?php

include "../../../config/koneksi.php";

if(isset($_POST['search'])){
 $search = $_POST['search'];

 $query = mysql_query("SELECT * FROM rekening WHERE no_rek like'%".$search."%'");

 $response = array();

 while($row = mysql_fetch_array($query)){
   $response[] = array(
   	"label"=>$row['no_rek']
   );
 }

 echo json_encode($response);
}

exit;
?>