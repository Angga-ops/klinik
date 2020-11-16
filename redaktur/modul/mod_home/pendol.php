<?php 
session_start();
include "../../../config/koneksi.php";
mysqli_query($con, "UPDATE antrian_pasien SET id_kasir='$_SESSION[id_user]', suhu='$_POST[suhu]',tensi='$_POST[tensi]',respirasi='$_POST[respirasi]',nadi='$_POST[nadi]',tb='$_POST[tb]', bb='$_POST[bb]', keluhan='$_POST[keluhan]' WHERE no_faktur='$_POST[faktur]'");
?>
<script>
location.href="../../media.php?module=home";
</script>