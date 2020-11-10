<?php

include "../../../config/koneksi.php";

$q1 = mysql_fetch_assoc(mysql_query("SELECT * FROM antrian_pasien WHERE id = '$_POST[antrian]'"));

$q2 = mysql_num_rows(mysql_query("SELECT * FROM perawatan_pasien WHERE no_faktur = '$q1[no_faktur]' AND id_pasien = '$q1[id_pasien]'"));

if($q2 > 0){
    $alert = "data pasien sudah ada";
} else {

$q3 = "INSERT INTO perawatan_pasien (id_dr,id_kasir,no_faktur,id_pasien,id_ruang,tanggal_pendaftaran,bb,tb,keluhan,jenis_pasien,asuransi,status,suhu,tensi,nadi,respirasi) SELECT id_dr,id_kasir,no_faktur,id_pasien,'$_POST[ruang]',tanggal_pendaftaran,bb,tb,keluhan,jenis_pasien,asuransi,status,suhu,tensi,nadi,respirasi FROM antrian_pasien WHERE id = '$_POST[antrian]'";    


mysql_query($q3);

//cari id perawatan pasien
$id = mysql_fetch_assoc(mysql_query("SELECT id FROM perawatan_pasien WHERE no_faktur = '$q1[no_faktur]' AND id_pasien = '$q1[id_pasien]'"));
    
$q4 = "UPDATE antrian_pasien SET rujuk_inap = '$id[id]' WHERE id = '$_POST[antrian]'";

mysql_query($q4);

$q5 = "DELETE FROM rujuk_inap WHERE antrian_pasien = '$_POST[antrian]'";

mysql_query($q5);

}


?>

<script>
location.href = "../../media.php?module=rujuk_inap";
</script>