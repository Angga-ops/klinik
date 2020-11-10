<?php 

include "../../../config/koneksi.php";

switch($_GET[act]){
    case "simpan":
    $jsonp = json_decode($_POST[serial],true);
    

        if($jsonp[status] == "produk"){
            $sub_total = (int) $jsonp[jml] * (int) $jsonp[hrg];
            $sql = "INSERT INTO history_kasir(nama,jumlah,harga,id_kk,harga_beli,kode,jenis,id_pasien,status,no_urut,tanggal,penginput,no_faktur,diskon,sub_total,ket,id_dr) VALUES('$jsonp[item]','$jsonp[jml]','$jsonp[hrg]','$jsonp[cab]','$jsonp[hrgb]','$jsonp[kdprod]','Produk','$jsonp[pasien]','Lunas','1','$jsonp[tgl]','Dokter','$jsonp[fak]','$jsonp[disc]','$sub_total','$jsonp[ket]','$jsonp[kddr]')";
        } else {
            $sub_total = 1 * (int) $jsonp[hrg];
            $sql = "INSERT INTO history_kasir
            (no_faktur,id_pasien,tanggal,no_urut,nama,harga,jumlah,id_kk,jenis,status,penginput,harga_beli,diskon,ket,sub_total,id_dr) 
            VALUES('$jsonp[fak]','$jsonp[pasien]','$jsonp[tgl]','1','$jsonp[item]','$jsonp[hrg]','1','$jsonp[cab]','Treatment','Lunas','Dokter','$jsonp[hrgb]','$jsonp[disc]','$jsonp[ket]','$sub_total','$jsonp[kddr]')";
        }

mysql_query($sql);
$id = mysql_fetch_assoc(mysql_query("SELECT id FROM history_kasir ORDER BY id DESC LIMIT 1"));
echo $id[id];


    break;
    case "hapus":
    mysql_query("DELETE FROM history_kasir WHERE id = '$_GET[id]'");
    break;
}

?>