<?php 
header("Content-type: application/vnd-ms-excel");
include "../../../config/koneksi.php";
switch($_GET["flt"]){
    case "1": $broadcast = "jml perawatan"; break;
    case "2": $broadcast = "jns pekerjaan"; break;
    case "3": $broadcast = "jml nominal"; break;
    case "4": $broadcast = "klaster"; break;
}
$fname = "rekap broadcast message ".$broadcast.".xls";
header("Content-Disposition: attachment; filename=$fname");
?>

<!DOCTYPE html>
<html>
<body>
<table>
<?php switch($_GET["flt"]){
    case "1": ?>
    
    <tr>
<th>Jns Treatment</th>
<th>Subject Pesan</th>
<th>Isi Pesan</th>
<th>Tgl Kirim</th>
<th>Pengirim</th>
</tr>
    
    <?php 

$q = mysqli_query($con, "SELECT a.nama_t, b.* FROM treatment a JOIN broadcast_treatment b ON a.id = b.treatment");

while($qs = mysqli_fetch_assoc($q)){
    echo "<tr>";
    echo "<td>$qs[nama_t]</td>";
    echo "<td>$qs[subjek]</td>";
    echo "<td>$qs[isi]</td>";
    echo "<td>$qs[tgl_kirim]</td>";
    echo "<td>$qs[pengirim]</td>";
    echo "</tr>";
}

?>
    
     <?php break;
    case "2": ?>
    
    
    <tr>
<th>Jns Pekerjaan</th>
<th>Subject Pesan</th>
<th>Isi Pesan</th>
<th>Tgl Kirim</th>
<th>Pengirim</th>
</tr>
    
    <?php 

$q = mysqli_query($con, "SELECT b.* FROM broadcast_pekerjaan b");

while($qs = mysqli_fetch_assoc($q)){
    echo "<tr>";
    echo "<td>$qs[pekerjaan]</td>";
    echo "<td>$qs[subjek]</td>";
    echo "<td>$qs[isi]</td>";
    echo "<td>$qs[tgl_kirim]</td>";
    echo "<td>$qs[pengirim]</td>";
    echo "</tr>";
}

?>
    
     <?php  break;
    case "3": ?> 
    
    
    <tr>
<th>Nominal</th>
<th>Subject Pesan</th>
<th>Isi Pesan</th>
<th>Tgl Kirim</th>
<th>Pengirim</th>
</tr>
    
    <?php 

$q = mysqli_query($con, "SELECT b.* FROM broadcast_nominal b");

while($qs = mysqli_fetch_assoc($q)){
    echo "<tr>";
    echo "<td>Rp ".number_format($qs['nominal'],0,",",".")."</td>";
    echo "<td>$qs[subjek]</td>";
    echo "<td>$qs[isi]</td>";
    echo "<td>$qs[tgl_kirim]</td>";
    echo "<td>$qs[pengirim]</td>";
    echo "</tr>";
}

?>
    
    <?php  break;
    case "4": ?>
    
    
    <tr>
<th>Klaster</th>
<th>Subject Pesan</th>
<th>Isi Pesan</th>
<th>Tgl Kirim</th>
<th>Pengirim</th>
</tr>
    
    <?php 

$q = mysqli_query($con, "SELECT a.keterangan, b.* FROM kategori_pelanggan a JOIN broadcast b ON a.kategori = b.klaster");

while($qs = mysqli_fetch_assoc($q)){
    echo "<tr>";
    echo "<td>$qs[keterangan]</td>";
    echo "<td>$qs[subjek]</td>";
    echo "<td>$qs[isi]</td>";
    echo "</tr>";
}

?>
    
    
     <?php  break;
}
?>
</table>
</body>
</html>