<?php 

include "../../../config/koneksi.php";

$q = "SELECT * FROM rujuk_inap WHERE antrian_pasien = '$_GET[idantrian]'";
$k = mysql_num_rows(mysql_query($q));
if($k > 0){
    $alert = "Pasien sudah ada rujukan di resepsionis/kasir";
} else {
    $alert = "Rujukan pasien sudah dikirim ke resepsionis/kasir";
    mysql_query("INSERT INTO rujuk_inap VALUES (NULL,'$_GET[idantrian]')");
}

?>

<script>
alert("<?php echo $alert; ?>");
location.href = "../../media.php?module=home";
</script>