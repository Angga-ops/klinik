<?php
function inisial($str){
	$words = explode(" ", $str);
	$acronym = "";

	foreach ($words as $w) {
	  if ($w[0]!="K") {
	  	$acronym .= $w[0].".";
	  }
	}



	return $acronym;
}

function inisial2($str){
	$words = explode(" ", $str);
	$acronym = "";

	foreach ($words as $w) {
	  if ($w[0]!="K") {
	  	$acronym .= $w[0];
	  }
	}



	return $acronym;
}

function buatKode($tabel, $inisial){
	global $con;
	$struktur	= mysqli_query($con, "SELECT * FROM $tabel");
	// $field		= mysqli_field_name($struktur,0);
	// $panjang	= mysqli_field_len($struktur,0);
	$q		= mysqli_fetch_field_direct($struktur,0);
	$field = $q->name;
	$panjang = $q->length;
	// membaca panjang kolom
	$hasil 		= mysqli_fetch_field($con, $struktur,0);
	//$panjang	= $hasil->max_length; 
 	$qry	= mysqli_query($con, "SELECT MAX(".$field.") FROM ".$tabel);
 	$row	= mysqli_fetch_array($qry); 
 	if ($row[0]=="") {
 		$angka=0;
	}
 	else {
 		$angka		= substr($row[0], strlen($inisial));
 	}
	
 	$angka++;
 	$angka	=strval($angka); 
 	$tmp	="";
 	for($i=1; $i<=($panjang-strlen($inisial)-strlen($angka)); $i++) {
		$tmp=$tmp."0";	
	}
 	return $inisial.$tmp.$angka;
}

function form_tanggal($nama,$value=''){
echo" <input type='text' name='$nama' id='$nama' size='9' maxlength='20' value='$value' readonly/>&nbsp;
<img src='../images/calendar-add-icon.png' align='top' style='cursor:pointer; margin-top:7px;' alt='kalender'onclick=\"displayCalendar(document.getElementById('$nama'),'dd-mm-yyyy',this)\"/>			
";
}


function InggrisTgl($tanggal){
	$tgl=substr($tanggal,0,2);
	$bln=substr($tanggal,3,2);
	$thn=substr($tanggal,6,4);
	$awal="$thn-$bln-$tgl";
	return $awal;
}

function IndonesiaTgl($tanggal){
	$tgl=substr($tanggal,8,2);
	$bln=substr($tanggal,5,2);
	$thn=substr($tanggal,0,4);
	$awal="$tgl-$bln-$thn";
	return $awal;
}
 
function lastday($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('d', $result);
}
function lastmonth($month = '', $year = '') {
   if (empty($month)) {
      $month = date('m');
   }
   if (empty($year)) {
      $year = date('Y');
   }
   $result = strtotime("{$year}-{$month}-01");
   $result = strtotime('-1 second', strtotime('+1 month', $result));
   return date('m', $result);
}
function format_angka($angka) {
	if ($angka > 1) {
		$hasil =  number_format($angka,0, ",",".");
	}
	else {
		$hasil = 0; 
	}
	return $hasil;
}
?>