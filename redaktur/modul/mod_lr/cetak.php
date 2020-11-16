<?php 
include "../../conf/koneksi.php";

$tgl = isset($_GET['tgl'])? "LIKE '%".$_GET['tgl']."%'" : "LIKE '%".date("Y-m")."%'";
$tgls = isset($_GET['tgl'])? $_GET['tgl'] : date("Y-m");

?>

            <h3 class="box-title">Laporan Neraca Keuangan Bulan <?php echo strftime("%B %Y",strtotime($tgls)); ?></h3> <table class="table table-striped table-bordered table-hover">
             
             <tbody>
             <tr>
             <td colspan=2><strong>PENDAPATAN</strong></td>
             </tr>

             <?php 

             //pendapatan usaha yg dihitung dari nota
             $lancar = 0;
$piut = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM( b.hrg_sub )AS total
FROM nota a
JOIN nota_detail b ON a.id_nota = b.id_nota
WHERE a.tgl_mulai LIKE'%$tgls%'"));

$lancar = $lancar + $piut['total'];

echo "<tr><td>Pendapatan Usaha</td><td>Rp ".number_format($piut['total'],0,",",".")."</td></tr>";

$sql = "SELECT * FROM item_keuangan WHERE group_item = 'pendapatan'";
$qdata = mysqli_query($conn,$sql);

while($hasil = mysqli_fetch_assoc($qdata)){
 $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."' AND tgl $tgl"));
 $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
 echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
 $lancar = $lancar + $data['nilai'];
}

echo "<tr><td><strong>Total Pendapatan</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>
<tr>
             <td colspan=2><strong>HARGA POKOK PENDAPATAN</strong></td>
             </tr>

             <?php 


$sql = "SELECT * FROM item_keuangan WHERE group_item = 'hpp'";
$qdata = mysqli_query($conn,$sql);
$lancar2 = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
 $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."' AND tgl $tgl"));
 $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
 echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
 $lancar2 = $lancar2 + $data['nilai'];
}

echo "<tr><td><strong>Total Harga Pokok Pendapatan</strong><td><strong>Rp ".number_format($lancar2,0,",",".")."</strong></td></tr>";


echo "<tr><td><strong>Laba Kotor Pendapatan</strong><td><strong>Rp ".number_format($lancar - $lancar2,0,",",".")."</strong></td></tr>";

$pendapatan = $lancar - $lancar2;

?>
<tr>
             <td colspan=2><strong>BIAYA</strong></td>
             </tr>
<?php 


$sql = "SELECT * FROM item_keuangan WHERE group_item = 'biaya'";
$qdata = mysqli_query($conn,$sql);
$lancar3 = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
$data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."' AND tgl $tgl"));
$nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
$lancar3 = $lancar3 + $data['nilai'];
}

echo "<tr><td><strong>Total Biaya</strong><td><strong>Rp ".number_format($lancar3,0,",",".")."</strong></td></tr>"; 
echo "<tr><td><strong>Jumlah Biaya</strong><td><strong>Rp ".number_format($lancar3,0,",",".")."</strong></td></tr>"; 

$biaya = $lancar3;
$akhir = $pendapatan - $biaya;


echo "<tr><td><strong>LABA RUGI</strong><td><strong>Rp ".number_format($akhir,0,",",".")."</strong></td></tr>"; 


?>
                            </tbody></table>
                             <script>window.print();</script>