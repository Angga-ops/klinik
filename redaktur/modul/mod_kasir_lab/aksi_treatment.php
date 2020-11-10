<?php

include "../../../config/koneksi.php";

    $nofak = $_GET[faktur];

    //cek rawat inap atau rawat jalan atau dftr lgs

    $ap = mysql_fetch_assoc(mysql_query("SELECT * FROM antrian_pasien WHERE no_faktur = '$nofak' AND rujuk_inap IS NULL"));
    $pp = mysql_fetch_assoc(mysql_query("SELECT * FROM perawatan_pasien WHERE no_faktur = '$nofak'"));

    if(is_null($ap[jenis_layanan])){

        //rawat inap
        //mysql_query("DELETE FROM antrian_pasien WHERE no_faktur='$nofak' and jenis_layanan='lab'");
        ?>
        
        <script>
        alert("Jasa Laboratorium untuk pasien rawat inap berhasil ditambahkan ke pembayaran di kasir/resepsionis");
        location.href="../../media.php?module=home";
        </script>
        
        <?php

    } else {

        //rawat jalan atau dftr lgs
        ?> 
        
        <script>
        location.href="../../media.php?module=bayar_lab&faktur=<?php echo $nofak; ?>";
        </script>
        
        <?php


    }
	

?>