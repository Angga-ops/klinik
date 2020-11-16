<?php 

include "../../../config/koneksi.php";

$r = mysqli_query($con, "SELECT * FROM biaya_administrasi WHERE nama = '$_POST[nama]' AND biaya = '$_POST[biaya]'");

switch($_GET['act']){
    case "input": 
    if(mysqli_num_rows($r) > 0){
        $alert = "maaf data ini sudah ada";
    } else {
        $alert = "data berhasil ditambahkan";
        mysqli_query($con, "INSERT INTO biaya_administrasi VALUES (NULL,'$_POST[nama]','$_POST[biaya]')");
    }

    break;
    case "edit": 
    $alert = "data berhasil diperbarui";
    mysqli_query($con, "UPDATE biaya_administrasi SET nama = '$_POST[nama]', biaya = '$_POST[biaya]' WHERE id = '$_POST[id]'");
    break;
    case "del": 
    $alert = "data berhasil dihapus";
    mysqli_query($con, "DELETE FROM biaya_administrasi WHERE id = '$_GET[id]'");
    break;
}

?>
<script>
alert("<?php echo $alert; ?>");
location.href="../../media.php?module=admin_rs";
</script>