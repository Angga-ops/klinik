<?php 
$bc = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM modul WHERE link = '?module=".$_GET["module"]."'"));
?>
<section class="content-header">
  <h1>
   <?php echo $bc["nama_modul"]; ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="laundry.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $bc["nama_modul"]; ?></li>
  </ol>
</section>

<!-- breadcrumb end -->

<section class="content">
<style>
.tbl td { padding: 5px }
span.select2 { width: 100% !important }
</style>


 <?php 
 
 $tgl = isset($_POST[tgl])? "LIKE '%".$_POST[tgl]."%'" : "LIKE '%".date("Y-m")."%'";
 $tgls = isset($_POST[tgl])? $_POST[tgl] : date("Y-m");
 
 ?>

 <div class='callout callout-success'>
 
 <div class="row">
 <div class="col-xs-4">
 <a href='modul_admin/mod_neraca/cetak.php?tgl=<?php echo $tgls; ?>' target='_BLANK'><button class='btn btn-info'>Print Laporan</button></a>
 </div>

 <div class="col-md-4 col-xs-4">
 <form action="" method="post">  <div class="input-group">
                   <input type="text" class="form-control picker" value="<?php echo date("Y-m"); ?>" autocomplete="off" name="tgl"/>
                <span class="input-group-addon"  style="cursor: pointer"> <label for="btn2"><i class="fa fa-search"  style="cursor: pointer"></i></label></span>
                 <input type="submit" id="btn2" style="display: none"/>
                  
             
                    
             </div> </form>
 </div>

 </div>
 </div>


<div class="row">
      <div class="col-xs-12"><div class="box">
          <div class="box-header">
            <h3 class="box-title">Laporan Bulan <?php echo strftime("%B %Y",strtotime($tgls)); ?></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
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
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil[id_item]."' AND tgl $tgl"));
  $nilai = is_null($data[nilai])? 0 : number_format($data[nilai],0,",",".");
  echo "<tr><td>".$hasil[nama_item]."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data[nilai];
}

//piutang usaha yg dihitung dari nota

$piut = mysqli_fetch_assoc(mysqli_query($conn,"SELECT SUM( b.hrg_sub )AS total
FROM nota a
JOIN nota_detail b ON a.id_nota = b.id_nota
WHERE a.tgl_mulai LIKE'%$tgls%'"));

$lancar = $lancar + $piut[total];

echo "<tr><td>Piutang Usaha</td><td>Rp ".number_format($piut[total],0,",",".")."</td></tr>";

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
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil[id_item]."'  AND tgl  $tgl"));
  $nilai = is_null($data[nilai])? 0 : number_format($data[nilai],0,",",".");
  echo "<tr><td>".$hasil[nama_item]."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data[nilai];
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
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil[id_item]."'  AND tgl  $tgl"));
  $nilai = is_null($data[nilai])? 0 : number_format($data[nilai],0,",",".");
  echo "<tr><td>".$hasil[nama_item]."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data[nilai];
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
  $data = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM rutin WHERE id_item = '".$hasil[id_item]."'  AND tgl  $tgl"));
  $nilai = is_null($data[nilai])? 0 : number_format($data[nilai],0,",",".");
  echo "<tr><td>".$hasil[nama_item]."</td><td>Rp ".$nilai."</td></tr>";
  $lancar = $lancar + $data[nilai];
}

echo "<tr><td><strong>Total Ekuitas</strong><td><strong>Rp ".number_format($lancar,0,",",".")."</strong></td></tr>";

?>


                             </tbody></table>
          </div>
          <!-- /.box-body -->
        </div></div></div>
    
      
      </section>


<script>


$(document).ready(function(){
  $(".picker").datepicker({
    minViewMode: 1,
    autoclose: true,
        format: "yyyy-mm"
});
});



</script>
    <!-- Main content -->
    <!-- /.content -->
  </div>
