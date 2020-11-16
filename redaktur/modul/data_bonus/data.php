
<?php 



?>

<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

       <div class="row">

<div class="col-md-3">
<select class="form-control" id="karyawan">
<option value="all">Semua Karyawan</option>
<?php 

$kar = mysqli_query($con, "SELECT username,nama_karyawan,(SELECT nama_klinik FROM daftar_klinik WHERE id_kk = karyawan.id_kk) klinik FROM karyawan ORDER BY id_kk");
while($kary = mysqli_fetch_assoc($kar)){
  echo "<option value='$kary[username]'>$kary[nama_karyawan] $kary[klinik]</option>";
}

?>
</select>
</div>
<div class="col-md-3">
<input type="text" class="form-control picker" id="tgl1" autocomplete="off" value="<?php echo date("Y-m"); ?>"/>
</div>
<div class="col-md-3">
<input type="text" class="form-control picker" id="tgl2" autocomplete="off"  value="<?php echo date("Y-m"); ?>"/>
</div>
<div class="col-md-3">
<button class="btn btn-info zbtn">Cari</button>
</div>

       </div>

         </div>





        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Data Bonus</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                

              <table id="example1" class="table table-bordered table-striped">

<?php 

//default
$tgl = date("Y-m");
$where = "WHERE tgl LIKE '%$tgl%'";

switch($_GET['act']){
  case "items":

$where = "WHERE username = '$_GET[username]' AND tgl >= '$_GET[tgl1]-01' AND tgl <= '$_GET[tgl2]-31'";

?>

                  <thead>

            <tr>

                 <th>Karyawan</th>
                 <th>Pasien</th>
                 <th>Produk</th>
                 <th>Harga</th>
                 <th>Satuan</th>
                 <th>Kategori</th>

                 <th>Jumlah</th>

                 <th>Kehadiran</th>
                 <th>Ket</th>
               
               

            </tr>

        </thead>

      <tbody>

<?php $bn = mysqli_query($con, "SELECT * FROM bonus $where");

while($bnx = mysqli_fetch_assoc($bn)){

$h = mysqli_fetch_assoc(mysqli_query($con, "SELECT aksi FROM log WHERE username = '$bnx[username]' AND aksi LIKE '%bonus%' AND tanggal >= '$bnx[tgl]'"));

$j = mysqli_fetch_assoc(mysqli_query($con, "SELECT a.nama_produk,a.harga_jual,b.kategori,c.satuan FROM produk_master a JOIN kategori b ON a.id_kategori = b.id_kategori JOIN data_satuan c ON a.id_satuan = c.id_s WHERE a.kd_produk = '$bnx[produk]'"));

$k = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_pasien,nama_pasien FROM pasien WHERE id = $bnx[pasien]"));


$u = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_karyawan FROM karyawan WHERE username = '$bnx[username]'"));

echo "<tr>";
echo "<td>$u[nama_karyawan]</td>";
echo "<td>$k[nama_pasien] $k[id_pasien]</td>";
echo "<td>$j[nama_produk]</td>";
echo "<td>Rp ".number_format($j['harga_jual'],0,",",".")."</td>";
echo "<td>$j[satuan]</td>";
echo "<td>$j[kategori]</td>";
echo "<td>$bnx[jml]</td>";
echo "<td>$h[aksi]</td>";
echo "<td>$bnx[ket]</td>";
echo "</tr>";

}
?>
    
    </tbody>

    <?php break;
    default:
    ?>

<thead>

<tr>
     <th>Karyawan</th>
     <th>Produk</th>
     <th>Harga</th>
     <th>Satuan</th>
     <th>Kategori</th>
     <th>Jumlah</th>  
</tr>

</thead>
<tbody>

<?php 

if(isset($_GET['act'])){
$where = "WHERE tgl >= '$_GET[tgl1]-01' AND tgl <= '$_GET[tgl2]-31'";
} else {}

$ex = mysqli_query($con, "SELECT COUNT(jml) AS tot, bonus.* FROM bonus $where GROUP BY username,produk");

while($exo = mysqli_fetch_assoc($ex)){


  $j = mysqli_fetch_assoc(mysqli_query($con, "SELECT a.nama_produk,a.harga_jual,b.kategori,c.satuan FROM produk_master a JOIN kategori b ON a.id_kategori = b.id_kategori JOIN data_satuan c ON a.id_satuan = c.id_s WHERE a.kd_produk = '$exo[produk]'"));

  $u = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_karyawan FROM karyawan WHERE username = '$exo[username]'"));

echo "<tr>";
echo "<td>$u[nama_karyawan]</td>";echo "<td>$j[nama_produk]</td>";
echo "<td>Rp ".number_format($j['harga_jual'],0,",",".")."</td>";
echo "<td>$j[satuan]</td>";
echo "<td>$j[kategori]</td>";
echo "<td>$exo[tot]</td>";
echo "</tr>";

}

?>


</tbody>

    <?php break; } ?>

                </table>


<style>
.tbl {border-collapse: collapse; width: 100%}
.tbl td {padding: 1%}
.ui-datepicker-calendar {
    display: none;
    }
</style>

     </div></div></div></div>



</section>

<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/typeahead.css">
<script src="<?php echo $url2; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>



$(document).ready(function(){

  $(".zbtn").click(function(){
    var t1 = $("#tgl1").val();
    var t2 = $("#tgl2").val();
    if($("#karyawan").val() == "all"){
      location.href="media.php?module=data_bonus&act=all&tgl1=" + t1 + "&tgl2=" + t2;
    } else {
      location.href="media.php?module=data_bonus&username=" + $("#karyawan").val() + "&act=items&tgl1=" + t1 + "&tgl2=" + t2;
    }
   
  });

  $(".picker").datepicker({
    changeMonth: true,
        changeYear: true,
        dateFormat: 'yy-mm',
        showButtonPanel: true,
        onClose: function(dateText, inst) { 
            $(this).datepicker('setDate', new Date(inst.selectedYear, inst.selectedMonth, 1));
        }
});

    $("#example1").dataTable();


});
</script>