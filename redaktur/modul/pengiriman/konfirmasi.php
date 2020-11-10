<?php
include "../../../config/koneksi.php";

$nop = $_GET['nop'];


mysql_query("UPDATE pengiriman SET status='Terkonfirmasi' WHERE no_pengiriman='$nop'");


?>
<script>
alert("Konfirmasi Pengiriman Tidak Sesuai Selesai");
window.location.href="../../media.php?module=pengiriman&act=lapor";
</script>



