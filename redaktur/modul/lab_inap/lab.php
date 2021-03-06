

<section class="content">

    
 <div class="row">

<div class="col-md-12">

<div class="callout callout-info">

<div class="row">
<div class="col-md-4">
<label>Dari Tanggal</label>
<input type="text" class="form-control datepicker" id="tgl1" autocomplete="off"/>
</div>


<div class="col-md-4">
<label>Sampai Tanggal</label>
<input type="text" class="form-control datepicker" id="tgl2" autocomplete="off"/>
</div>


<div class="col-md-4">
<label>&nbsp;</label>
<input type="button" class="btn btn-success" value="Cari" style="margin-top: 5%" onclick="cari()"/>
</div>

</div>

</div>

</div>

</div>


 <div class="row">

<div class="col-md-12">

<div class="box box-success">

        <div class="box-header">

          <h3 class="box-title">Data Pemeriksaan Lab untuk Pasien Rawat Inap</h3>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

            

          <table id="example1" class="table table-bordered table-striped">

              <thead>

        <tr>

             <th>Aksi</th>
             <th>Tgl Pendaftaran</th>
             <th>No Faktur</th>
             <th>Id Pasien</th>
             <th>Nama Pasien</th>
             <th>Dokter Pemeriksa</th>
  
        </tr>

    </thead>

  <tbody>

<?php 


$date_now = date("Y-m-d");

 //cari range expired
 $skrg = date("d");
 if($skrg <= 24){
 $now = date("Y-m-24");
 $last = date("Y-m",strtotime("-1 month"))."-25";
 } else {
  $last = date("Y-m-25");
  $now = date("Y-m",strtotime("+1 month"))."-24";
 }

 //hari perawat login
 $hari = date("N",strtotime($date_now));
                    
 //cari id_dr
 $nrs = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_dr FROM dr_praktek a JOIN nurse b ON a.id_drpraktek = b.drpraktek
 WHERE b.perawat = '$_SESSION[id_user]'  AND a.hari = '$hari' AND a.expired >= '$last' AND a.expired <= '$now'"));
 $id_dr = $nrs['id_dr'];

 $nurse = ($_SESSION['jenis_u'] == "JU-08")? "id_dr IS NOT NULL" : "id_dr = '$id_dr'";

$tgl = isset($_GET['tgl1'])? "WHERE tanggal_pendaftaran >= '$_GET[tgl1]' AND tanggal_pendaftaran <= '$_GET[tgl2]' AND $nurse" : "WHERE $nurse";
$ob = mysqli_query($con, "SELECT * FROM perawatan_pasien $tgl");
while($obat = mysqli_fetch_assoc($ob)){
    $dr = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM user WHERE id_user = $obat[id_dr]"));
    $pas = mysqli_fetch_assoc(mysqli_query($con, "SELECT * FROM pasien WHERE id_pasien = '$obat[id_pasien]'"));
    echo "<tr>";
   
      //perawat
      echo "<td><a href='modul/lab_inap/lab_print.php?pasien=$obat[id_pasien]&faktur=$obat[no_faktur]'  target='_BLANK'><button class='btn btn-sm btn-info'>Print Notice Lab</button></a></td>";
    
   
    echo "<td>$obat[tanggal_pendaftaran]</td>";
    echo "<td>$obat[no_faktur]</td>";
    echo "<td>$obat[id_pasien]</td>";
    echo "<td>$pas[nama_pasien]</td>";
    echo "<td>$dr[nama_lengkap]</td>";
    echo "</tr>";
}

?>

</tbody>

            </table>


<style>
.tbl {border-collapse: collapse; width: 100%}
.tbl td {padding: 1%}
#scrollable-dropdown-menu .tt-dropdown-menu {
max-height: 40px;
overflow-y: auto;
}
#scrollable-dropdown-menu .tt-suggestion {
font-size: 9.5px;
}
#dataorder td, #dataorder th {font-size: 9.5px !important}
#dataorder td {border-top: none}
.ctrl {font-size: 9px !important;}
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

function cari(){
    var a = $("#tgl1").val();
    var b = $("#tgl2").val();
    location.href = "?module=apotek_inap&tgl1=" + a + "&tgl2=" + b;
}

$(document).ready(function(){
    $("#example1").dataTable();
});
</script>