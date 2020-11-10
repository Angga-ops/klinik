 <?php

include "../../../config/koneksi.php";
include "../../../config/fungsi_seo.php";
include "../mod_log/aksi_log.php";

/*
$tes = '["08122958269","085641733787","085659249959"]';
$nomor = json_decode($tes,true);
$message = ""; */

///////////////////////////////////////////////////////


$nomor = json_decode($_POST[data],true);
$message = "$_POST[pesan]";


$error = 0;
		
 foreach($nomor as $k => $v){ 
     
		$msg = preg_replace( "/(\n)/", "<ENTER>", $message );
		$msg = preg_replace( "/(\r)/", "<ENTER>", $message );

		$phone_no = preg_replace( "/(\n)/", ",", $v );
		$phone_no = preg_replace( "/(\r)/", "", $v );

		$data = array("phone_no" => $phone_no, "key" => "13e160f37cf7b6a129e3b7432dfda614f0238a54b2d7d009", "message" => $message);
		$data_string = json_encode($data);

$ch = curl_init('http://116.203.92.59/api/send_message');
curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
curl_setopt($ch, CURLOPT_VERBOSE, 0);
curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
curl_setopt($ch, CURLOPT_TIMEOUT, 15);
curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
curl_setopt($ch, CURLOPT_HTTPHEADER, array(
'Content-Type: application/json',
'Content-Length: ' . strlen($data_string))
);
$result = curl_exec($ch);

if($result != "Success"){
	$error = 1;
}

		} 

echo $error;	
curl_close($ch);	
        ?>