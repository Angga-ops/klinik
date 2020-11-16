 <section class="content">
    
    <div class="row">
    <div class="col-md-12">

        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Pasien Rawat Inap</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
                 <th>Atur Dr Visit</th>
                 <th>Visit</th>
                 <th>Notice Lab</th>
                 <th>Detail</th>
                 <th>No Biling</th>
                 <th>ID Pasien</th>
                 <th>Nama Pasien</th>
               
            </tr>
        </thead>
      <tbody>

<?php 

$k1 = mysqli_query($con,"SELECT * FROM perawatan_pasien WHERE id_dr = '$_SESSION[id_dr]' AND status IS NULL ORDER BY tanggal_pendaftaran DESC");
$no = 1;
while($ki1 = mysqli_fetch_assoc($k1)){
    $pas = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien = '$ki1[id_pasien]'"));
    if($ki1['id_dr'] == $_SESSION['id_dr']){
        //pasien dari dokter yg sdg login
        echo "<tr>";
    echo "<td><button id='$ki1[id]' class='btn btn-sm btn-info' data-toggle='modal' data-target='#modal-default3' onclick='leave(this.id)' data-faktur='$ki1[no_faktur]' data-pasien='$ki1[id_pasien]'>Pulangkan</button></td>";
    echo "<td><button id='$ki1[id]' class='btn btn-sm btn-info' data-toggle='modal' data-target='#modal-default' onclick='visit(this.id)' data-faktur='$ki1[no_faktur]' data-pasien='$ki1[id_pasien]'>Atur</button></td>";
    echo "<td><a href='?module=visit_treatment&nofak=$ki1[no_faktur]'><button class='btn btn-sm btn-info'>Kunjungi</button></a></td>";
    echo "<td><button data-toggle='modal' data-target='#modal-default-notice' class='btn btn-sm btn-warning' onclick='nl(this.id)' id='nl".$no."' data-faktur='$ki1[no_faktur]' data-pasien='$ki1[id_pasien]' data-dr='$_SESSION[id_dr]' data-layanan='inap'  data-jamin='$ki1[jenis_pasien]'>Buat</button></td>";
    echo "<td><button id='$ki1[id]'  class='btn btn-sm btn-info' data-toggle='modal' data-target='#modal-default2' onclick='detail(this.id)' data-faktur='$ki1[no_faktur]' data-pasien='$ki1[id_pasien]'>Buka</button></td>";
    echo "<td>$ki1[no_faktur]</td>";
    echo "<td>$ki1[id_pasien]</td>";
    echo "<td>$pas[nama_pasien]</td>";
    echo "</tr>";
    } else {}
    $no++;
}


$k2 = mysqli_query($con,"SELECT b.* FROM dr_visit a JOIN perawatan_pasien b ON a.no_faktur = b.no_faktur WHERE a.id_dr = '$_SESSION[id_dr]' AND b.status IS NULL");

while($ki2 = mysqli_fetch_assoc($k2)){
    $pas = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien = '$ki2[id_pasien]'"));
   
        //dokter visit
        echo "<tr>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td><a href='?module=visit_treatment&nofak=$ki2[no_faktur]'><button class='btn btn-sm btn-info'>Kunjungi</button></a></td>";
        echo "<td></td>";
        echo "<td></td>";
        echo "<td>$ki2[no_faktur]</td>";
        echo "<td>$ki2[id_pasien]</td>";
        echo "<td>$pas[nama_pasien]</td>";
        echo "</tr>";
    
    
}

?>




        </tbody>
                </table>
     </div></div></div></div>

     
<!-- noticelab -->

<?php include "modul/mod_home/add_noticelab.php"; ?>

<!-- noticelab -->

<style>
.col-md-12 {margin-bottom: 1%}
</style>

<div class="modal fade" id="modal-default3">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Pasien Rawat Inap Pulang</h4>
              </div>
              <div class="modal-body">


              <input type="hidden" id="pasien"/>
<input type="hidden" id="faktur"/>
              <div class="row">
<div class="col-md-12">
<label>Alasan Boleh Pulang</label>
<textarea class='form-control' id="status"></textarea>
</div>
</div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-default pull-left" id="pulangkan" onclick="pulangkan()">OK</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->
     
     <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Detail Kondisi Pasien Rawat Inap</h4>
              </div>
              <div class="modal-body">


              <div class="row">
<div class="col-md-12">
<table class="table" id="detailpas" style="width: 100%">
<thead>
<tr>
<th>Tgl</th>
<th>Ket</th>
<th>Nama Dokter</th>
</tr>
</thead>
</table>
</div>
</div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


        <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Atur Dokter Visit</h4>
              </div>
              <div class="modal-body">

              <span><strong>Dokter yang diizinkan visit akan melihat data pasien ini pada saat login</strong></span>

<div class="row">               
<div class="col-md-12">
<label>Pilih Dokter</label>
<select class="form-control" id="dr1">
<option value="">--silakan pilih--</option>
<?php 

$u = mysqli_query($con,"SELECT * FROM user WHERE id_ju = 'JU-02' AND id_user != '$_SESSION[id_dr]'");
while($ux = mysqli_fetch_assoc($u)){
    echo "<option value='$ux[id_user]'>$ux[nama_lengkap] </option>";
}
?>
</select>
</div>
</div>
<input type="hidden" id="pasien"/>
<input type="hidden" id="faktur"/>

<div class="row">
<div class="col-md-12">
<table class="table" id="drvisit" style="width: 100%">
<thead>
<tr>
<th>Nama Dokter</th><th>Aksi</th>
</tr>

</thead>
</table>
</div>
</div>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tukarin" onclick="switched()">Tambahkan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>


function leave(id){

var faktur = $("#" + id).data("faktur");
var pasien = $("#" + id).data("pasien");
$("#faktur").val(faktur);
$("#pasien").val(pasien);


}

function pulangkan(){
    var faktur = $("#faktur").val();
    var pasien = $("#pasien").val();
    var status = $("#status").val();
    var xhr = $.ajax({
        url: "modul/rawat_inap/leaved.php",
        data: {"status": status,"faktur": faktur,"pasien": pasien},
        success: function(data){
            location.reload();
        }
    });
        if(xhr.readyState == "1"){
            $("#tukarin").html("menambah...");
        }
}

function detail(id){

$("#detailpas").dataTable().fnDestroy();

var faktur = $("#" + id).data("faktur");
var pasien = $("#" + id).data("pasien");

$("#detailpas").dataTable({
"bFilter": false,
"bPaginate": false,
"bProcessing": true,
"sAjaxSource": "modul/rawat_inap/detailpas.php?faktur=" + faktur + "&pasien=" + pasien
});

}

function hapus(id){
    var cek = confirm("apakah akan menghapus?");
    if(cek){
        var xhr = $.ajax({
        url: "modul/rawat_inap/visited2.php?id=" + id,
        success: function(data){
            location.reload();
        }
    });
        if(xhr.readyState == "1"){
            $("#" + id).html("menghapus...");
        }
    }
    
}

function switched(){
    var faktur = $("#faktur").val();
    var pasien = $("#pasien").val();
    var dr = $("#dr1").val();
    var xhr = $.ajax({
        url: "modul/rawat_inap/visited.php",
        data: {"dr": dr,"faktur": faktur,"pasien": pasien},
        success: function(data){
            location.reload();
        }
    });
        if(xhr.readyState == "1"){
            $("#tukarin").html("menambah...");
        }
}

function visit(id){

    $("#drvisit").dataTable().fnDestroy();

    var faktur = $("#" + id).data("faktur");
    var pasien = $("#" + id).data("pasien");
    $("#faktur").val(faktur);
    $("#pasien").val(pasien);

$("#drvisit").dataTable({
    "bFilter": false,
    "bPaginate": false,
    "bProcessing": true,
    "sAjaxSource": "modul/rawat_inap/drvisit.php?faktur=" + faktur + "&pasien=" + pasien
});

}


$(document).ready(function(){
    $("#example1").DataTable();
   
});
</script>