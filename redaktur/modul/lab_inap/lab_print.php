<?php 

include "../../../config/koneksi.php";

$sql = "SELECT * FROM noticelab a JOIN treatment b ON a.jasa = b.id WHERE b.kategori = 2";

?>

<h4>No Billing : <?php echo $_GET['faktur']; ?></h4>
<h4>ID Pasien : <?php echo $_GET['pasien']; ?></h4>

<table>

<thead>

<tr>
<th>Layanan Lab</th>
</tr>

</thead>

<tbody>
<?php 

$q = mysqli_query($con, $sql);
while($qu = mysqli_fetch_assoc($q)){
echo "<tr>";
echo "<td>$qu[nama_t]</td>";
echo "</tr>";
}


?>
</tbody>
</table>
<script>
window.print();
</script>