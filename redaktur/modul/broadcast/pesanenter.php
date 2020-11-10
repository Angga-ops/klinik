
<?php
$message = "Haloo";
        $phone_no = "087884494009";

        $message = preg_replace( "/(\n)/", "<ENTER>", $message );
        $message = preg_replace( "/(\r)/", "<ENTER>", $message );

        $phone_no = preg_replace( "/(\n)/", ",", $phone_no );
        $phone_no = preg_replace( "/(\r)/", "", $phone_no );

        $data = array("phone_no" => $phone_no, "key" => "9f9dbeee0cb25c499224beba815f4c4d5a4df9aab5ba599c", "message" => $message);
        $data_string = json_encode($data);
        $ch = curl_init('http://116.203.92.59/api/send_message');
        curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
        curl_setopt($ch, CURLOPT_POSTFIELDS, $data_string);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        curl_setopt($ch, CURLOPT_VERBOSE, 0);
        curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 0);
        curl_setopt($ch, CURLOPT_TIMEOUT, 15);
        curl_setopt($ch, CURLOPT_HTTPHEADER, array(
        'Content-Type: application/json',
        'Content-Length: ' . strlen($data_string))
        );
        $result = curl_exec($ch);

?>