<?php 
include "../../conf/koneksi.php";

$tgl = isset($_GET['tgl'])? "LIKE '%".$_GET['tgl']."%'" : "LIKE '%".date("Y-m")."%'";
$tgls = isset($_GET['tgl'])? $_GET['tgl'] : date("Y-m");

?>

            <h3 class="box-title">Laporan Neraca Keuangan Bulan <?php echo strftime("%B %Y",strtotime($tgls)); ?></h3>
<table class="table table-striped table-bordered table-hover">
             
              <tbody>
              <tr>
              <td colspan=2><strong>ASET</strong></td>
              </tr>
              <tr>
              <td colspan=2><strong>ASET LANCAR</strong></td>
              </tr>
              <?php 

$sql = "SELECT * FROM item_keuangan WHERE group_item = 'lancar'";
$qdata = mysqli_query($conn,$sql);
$lancar = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."' AND tgl $tgl"));
  $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
  echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data['nilai'];
}

//piutang usaha yg dihitung dari nota

$piut = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM( b.hrg_sub )AS total
FROM nota a
JOIN nota_detail b ON a.id_nota = b.id_nota
WHERE a.tgl_mulai LIKE'%$tgls%'"));

$lancar = $lancar + $piut['total'];

echo "<tr><td>Piutang Usaha</td><td>Rp ".number_format($piut['total'],0,",",".")."</td></tr>";

echo "<tr><td><strong>Total Aset Lancar</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>
              <tr>
              <td colspan=2><strong>ASET TETAP</strong></td>
              </tr>
              <?php 

$sql = "SELECT * FROM item_keuangan WHERE group_item = 'tetap'";
$qdata = mysqli_query($conn,$sql);
$lancar = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."'  AND tgl  $tgl"));
  $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
  echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data['nilai'];
}

echo "<tr><td><strong>Total Aset Tetap</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>
              <tr>
              <td colspan=2><strong>KEWAJIBAN & EKUITAS</strong></td>
              </tr>
              <tr>
              <td colspan=2><strong>KEWAJIBAN</strong></td>
              </tr>
              <?php 

$sql = "SELECT * FROM item_keuangan WHERE group_item = 'wajib'";
$qdata = mysqli_query($conn,$sql);
$lancar = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."'  AND tgl  $tgl"));
  $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
  echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data['nilai'];
}

echo "<tr><td><strong>Total Kewajiban</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>
              <tr>
              <td colspan=2><strong>EKUITAS</strong></td>
              </tr>
              <?php 

$sql = "SELECT * FROM item_keuangan WHERE group_item = 'ekuitas'";
$qdata = mysqli_query($conn,$sql);
$lancar = 0;
while($hasil = mysqli_fetch_assoc($qdata)){
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil['id_item']."'  AND tgl  $tgl"));
  $nilai = is_null($data['nilai'])? 0 : number_format($data['nilai'],0,",",".");
  echo "<tr><td>".$hasil['nama_item']."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data['nilai'];
}

echo "<tr><td><strong>Total Ekuitas</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>


                             </tbody></table>
                             <script>window.print();</script>