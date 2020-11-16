<?php 

include "../../../config/koneksi.php";

$cek = mysqli_query($con,"SELECT no_faktur FROM pembayaran_lab WHERE no_faktur = '$_GET[faktur]'");

if(mysqli_num_rows($cek) > 0){
    //update
   
    $byr = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(sub_total) jml FROM history_kasir WHERE no_faktur = '$_GET[faktur]'"));
    $susuk = (int) $_GET['uang'] - $byr['jml'];
    $tot_lama = mysqli_fetch_assoc($cek);
    $tot = $tot_lama['total'] + $byr['jml'];
    mysqli_query($con,"UPDATE pembayaran_lab SET uang='$_GET[uang]', total='$tot', tgl='".date("Y-m-d")."', kembalian='$susk'  WHERE no_faktur = '$_GET[faktur]'");
    echo "<script>location.href='print.php?faktur=$_GET[faktur]'</script>";
} else {
    //insert
    //data pasien
    //mysql_query("DELETE FROM antrian_pasien WHERE no_faktur='$_GET[faktur]' AND jenis_layanan='lab'");
    $pas = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM antrian_pasien WHERE no_faktur = '$_GET[faktur]' AND jenis_layanan IN ('lab','poliklinik','igd') AND rujuk_inap IS NULL"));
    
   $byr = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(sub_total) jml FROM history_kasir WHERE no_faktur = '$_GET[faktur]'"));
    $susuk = (int) $_GET['uang'] - $byr['jml'];
    mysqli_query($con,"INSERT INTO pembayaran_lab (no_faktur,id_pasien,status,tgl,total,uang,kembalian) VALUES ('$_GET[faktur]','$pas[id_pasien]','Lunas','".date("Y-m-d")."','$byr[jml]','$_GET[uang]','$susuk')");
    echo "<script>location.href='print.php?faktur=$_GET[faktur]'</script>";
   
}

?>