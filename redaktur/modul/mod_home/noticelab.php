<?php 

include "../../../config/koneksi.php";

//cek asal notice
$now = DATE('Y-m-d');
$inap = (isset($_POST['notice']))? "AND rawat_inap IS NOT NULL" : "";
$isinap = (isset($_POST['notice']))? "1" : "NULL";
$k = mysqli_num_rows(mysqli_query($con, "SELECT * FROM noticelab WHERE id_pasien='$_POST[id]' AND tgl='$now' AND no_faktur='$_POST[nofak]' $inap"));

if($k > 0){
    $return = "Perintah sudah pernah dikirim";
} else {
    $return = "Perintah pemeriksaan lab berhasil dikirim";
    $r = $_POST['tarif'];
    $rs = $_POST['jamin'];
    foreach($r as $key => $val){
        mysqli_query($con, "INSERT INTO noticelab VALUES (NULL,'$_POST[nofak]','$_POST[id]','$_POST[dr]',NOW(),$isinap,'$val','$rs[$key]','T')");
    }
   }


?>
<script>
alert("<?php echo $return; ?>");
location.href="../../media.php?module=home";
</script>

<?php  ?>