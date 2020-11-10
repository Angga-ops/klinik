<?php 

include "../../../config/koneksi.php";

    switch($_GET[retur]){
        case "1": 
        
        //asumsi barang yg diretur kembali ke stok jml ke luar = jml masuk

        $sql = "INSERT INTO retur_jual VALUES ('','$_GET[history]','$_GET[retur]','$_GET[tgl]','$_GET[username]','$_GET[jml]',NULL)";

        $subtotal = $k[sub_total];

        mysql_query($sql);

        break;
        
        case "2": 
        
        //barang lama kembali ke stok
        
        $sisa = $u[jumlah] + (int) $_GET[jml];

        //$sql4 = "UPDATE produk SET jumlah = '$sisa' WHERE id_p = '$u[id_p]'";

        $sql = "INSERT INTO retur_jual VALUES ('','$_GET[history]','$_GET[retur]','$_GET[tgl]','$_GET[username]','$_GET[jml]',NULL)";

        /*$subt = $k[harga] * (int) $_GET[jml];

        $subts = $k[sub_total] - $subt;

        $subtotal = $subts;

        mysql_query($sql4);*/

        mysql_query($sql);

        // Get data produk master

        $produk = mysql_fetch_assoc(mysql_query("SELECT kode FROM history_kasir WHERE id='$_GET[history]'"));
        $master = mysql_fetch_assoc(mysql_query("SELECT * FROM produk_master WHERE kd_produk='$produk[kode]'"));

        // Memeriksa apakah barang ada di tabel produk_rusak
        $check = mysql_query("SELECT * FROM produk_rusak WHERE kode_produk='$produk[kode]'");
        if(mysql_num_rows($check) > 0){
            mysql_query("UPDATE produk_rusak SET jumlah = jumlah + '$_GET[jml]'");
        }
        else{
            mysql_query("INSERT INTO produk_rusak VALUES('','$master[kd_produk]','$master[nama_produk]','$master[id_satuan]','$master[id_kategori]','$_GET[jumlah]','')");
        }
        
        break;
    }

?>