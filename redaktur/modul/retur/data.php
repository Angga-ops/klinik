<?php 

include "../../../config/koneksi.php";

$re = mysql_query("SELECT * FROM master_retur_jual");
while($ret = mysql_fetch_assoc($re)){
    $retur .= "<option value='$ret[id]'>$ret[retur]</option>";
}

$d = '';

$pasien = explode("/",$_GET[faktur]);

$k = mysql_query("SELECT * FROM history_kasir WHERE jenis = 'Produk' AND (no_faktur = '$_GET[faktur]' OR id_pasien = '$pasien[1]' OR nama = '$_GET[faktur]')");
while($ki = mysql_fetch_assoc($k)){

$cek = mysql_num_rows(mysql_query("SELECT history FROM retur_jual WHERE history = '$ki[id]'"));

$cust = mysql_fetch_assoc(mysql_query("SELECT * FROM pasien WHERE id_pasien = '$ki[id_pasien]'"));

if($cek == 0){
    $aksi = "<select style='width: 40px' class='ctrl form-control' id='tukar-$ki[id]' onchange='tukar(this.id)'><option value='0'>-pilih-</option>$retur</select><button style='display: none' class='btn btn-sm btn-info' id='btl-$ki[id]' onclick='batal(this.id)'>Batalkan</button>";

    $returs = "<input style='width: 40px' type='text' class='ctrl form-control' id='jml-$ki[id]' />";

    //$ganti = "<div id='scrollable-dropdown-menu'><input id='ganti-$ki[id]' class='ctrl form-control ganti' style='width: 96px' /></div>";

    $hrg = "<div id='hrg-$ki[id]'>$ki[sub_total]</div>";
    
        $d .= '{"pasien":"'.$cust[nama_pasien].' ('.$cust[id_pasien].') <br/> Faktur: '.$ki[no_faktur].'","aksi":"'.$aksi.'","retur":"'.$returs.'","jml":"'.$ki[jumlah].'","prd":"'.$ki[nama].'","hrg":"'.$hrg.'"},';
    }
}

$d .= '{"pasien":" ","aksi":" ","retur":" ","jml":" ","prd":" ","status":" ","hrg":" "},{"pasien":" ","aksi":" ","retur":" ","jml":" ","prd":" ","status":" ","hrg":" "},{"pasien":" ","aksi":" ","retur":" ","jml":" ","prd":" ","hrg":" "},';

$d = substr($d,0,strlen($d) - 1);

echo '['.$d.']';



?>