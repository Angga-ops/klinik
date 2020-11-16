<?php 

include "../../../config/koneksi.php";

$sql = "SELECT * FROM kasir_sementara WHERE id IN ($_GET[data])";

?>

<h4>No Billing : <?php echo $_GET['faktur']; ?></h4>
<h4>ID Pasien : <?php echo $_GET['pasien']; ?></h4>

<table>

<thead>

<tr>
<th>Obat</th>
<th>Keterangan</th>
<th>Jml</th>  
</tr>

</thead>

<tbody>
<?php 

$q = mysqli_query($con, $sql);
while($qu = mysqli_fetch_assoc($q)){
echo "<tr>";
echo "<td>$qu[nama]</td>";
echo "<td>$qu[ket]</td>";
echo "<td>$qu[jumlah]</td>";
echo "</tr>";
}


?>
</tbody>
</table>
<script>
window.print();
</script>