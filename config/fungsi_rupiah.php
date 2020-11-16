<?php
 function rupiah($data)
 {
$rupiah = "";
$jml = strlen($data);

 while($jml > 3)
 {
$rupiah = "." . substr($data,-3) . $rupiah;
$l = strlen($data) - 3;
$data = substr($data,0,$l);
$jml = strlen($data);
 }
 $rupiah = "Rp " . $data . $rupiah . ",-";
 return $rupiah;
 }
function rupiah2($data)
{
	$rupiah = "";
	$jml = strlen($data);
	
	while($jml > 3)
	{
	$rupiah = "." . substr($data,-3) . $rupiah;
	$l = strlen($data) - 3;
	$data = substr($data,0,$l);
	$jml = strlen($data);
	}
	$rupiah = $data . $rupiah . ",-";
	return $rupiah;
}
function uang($data)
	{
	$rupiah = "";
	$jml = strlen($data);
	
	while($jml > 3)
	{
	$rupiah = "." . substr($data,-3) . $rupiah;
	$l = strlen($data) - 3;
	$data = substr($data,0,$l);
	$jml = strlen($data);
	}
	$rupiah = $data.$rupiah;
	return $rupiah;
	}
?>