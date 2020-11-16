<?php

include "../../../config/koneksi.php";

$q1 = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM antrian_pasien WHERE id = '$_POST[antrian]'"));

$q2 = mysqli_num_rows(mysqli_query($con,"SELECT * FROM perawatan_pasien WHERE no_faktur = '$q1[no_faktur]' AND id_pasien = '$q1[id_pasien]'"));

if($q2 > 0){
    $alert = "data pasien sudah ada";
} else {

$q3 = "INSERT INTO perawatan_pasien (id_dr,id_kasir,no_faktur,id_pasien,id_ruang,tanggal_pendaftaran,bb,tb,keluhan,jenis_pasien,asuransi,status,suhu,tensi,nadi,respirasi) SELECT id_dr,id_kasir,no_faktur,id_pasien,'$_POST[ruang]',tanggal_pendaftaran,bb,tb,keluhan,jenis_pasien,asuransi,status,suhu,tensi,nadi,respirasi FROM antrian_pasien WHERE id = '$_POST[antrian]'";    


mysqli_query($con,$q3);

//cari id perawatan pasien
$id = mysqli_fetch_assoc(mysqli_query($con,"SELECT id FROM perawatan_pasien WHERE no_faktur = '$q1[no_faktur]' AND id_pasien = '$q1[id_pasien]'"));
    
$q4 = "UPDATE antrian_pasien SET rujuk_inap = '$id[id]' WHERE id = '$_POST[antrian]'";

mysqli_query($con,$q4);

$q5 = "DELETE FROM rujuk_inap WHERE antrian_pasien = '$_POST[antrian]'";

mysqli_query($con,$q5);

}


?>

<script>
location.href = "../../media.php?module=rujuk_inap";
</script>