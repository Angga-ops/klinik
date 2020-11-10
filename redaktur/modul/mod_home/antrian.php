<?php 

include "../../../config/koneksi.php";

$now = DATE('Y-m-d');
$antrian = mysql_fetch_assoc(mysql_query("SELECT * FROM antrian_pasien WHERE no_faktur='$_GET[nofak]'"));
//cek no_faktur di antrian_pasien
if(!$antrian){
	$antrian = mysql_fetch_assoc(mysql_query("SELECT * FROM perawatan_pasien WHERE no_faktur='$_GET[nofak]'"));
}

$kunjung = mysql_fetch_assoc(mysql_query("SELECT MAX(kunjungan_ke) ke FROM history_ap WHERE id_pasien = '$antrian[id_pasien]'"));
 $no = mysql_fetch_assoc(mysql_query("SELECT MAX(no_urut) ree FROM antrian_pasien WHERE tanggal_pendaftaran = '$now' AND jenis_layanan = 'lab'"));
 $urut = $no['ree'] + 1;

$query = mysql_query("INSERT INTO antrian_pasien VALUES (NULL,'$urut','$_GET[nofak]','$antrian[id_pasien]',NOW(),NULL,'$kunjung[ke]','lab',$antrian[id_dr],'$antrian[asuransi]','$antrian[poliklinik]','$antrian[bb]','$antrian[tb]','$antrian[keluhan]','$antrian[jenis_pasien]','$antrian[id_kasir]','$antrian[ruang]','$antrian[tgl_out]','$antrian[online]','$antrian[suhu]','$antrian[tensi]','$antrian[respirasi]','$antrian[nadi]','$antrian[rujuk_inap]')");
if($query){
	mysql_query("UPDATE noticelab SET status='S' WHERE no_faktur='$_GET[nofak]'");
	$return = "Notice berhasil dimasukkan ke dalam antrian";
}
?>
<script>
alert("<?php echo $return; ?>");
location.href="../../media.php?module=home";
</script>

<?php  ?>