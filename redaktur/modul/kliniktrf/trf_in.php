
<?php 

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");


?>

<section class="content">

    

<div class="row">

<div class="col-md-12">

     <div class="callout callout-success">

<strong>Perhatian</strong> Jika ada produk kiriman yang tidak sesuai dan akan dikembalikan ke klinik asal caranya sbb:
<ul>
<li>Pada menu Terima Kiriman, cari kode pengiriman dari produk yang dimaksud lalu klik tombol "Detail"</li>
<li>Cari produk yang dimaksud lalu klik tombol "Terima"</li>
<li>Buat Data Tambah Kiriman untuk produk yang tidak sesuai dan sudah diterima tadi dengan tujuan klinik asal</li>
</ul>

     </div>





    </div>

</div>



 <div class="row">

<div class="col-md-12">

<div class="box box-success">

        <div class="box-header">

          <h3 class="box-title">Data Terima Kiriman</h3>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

            

          <table id="example1" class="table table-bordered table-striped">

              <thead>

        <tr>

             <th>Aksi</th>
             <th>Kode Pengiriman</th>
             <th>Tgl Pengiriman</th>
             <th>Asal</th>
             <th>Operator</th>          
        </tr>

    </thead>

  <tbody>

<?php 

$data = mysqli_query($con, "SELECT * FROM kliniktrf WHERE tujuan = '$_SESSION[klinik]' GROUP BY kd_trf");
while($datax = mysqli_fetch_assoc($data)){
  $loc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$datax[asal]'"));
  echo "<tr>";
  echo "<td><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modal-default2' onclick='details(this.id)' id='$datax[kd_trf]'>Detail</button></td>";
  echo "<td>$datax[kd_trf]</td>";
  echo "<td>".strftime("%d %B %Y",strtotime($datax['tgl']))."</td>";
  echo "<td>$loc[nama_klinik]</td>";
  echo "<td>$datax[username]</td>";
  echo "</tr>";
}

?>

</tbody>

            </table>


<style>
.tbl {border-collapse: collapse; width: 100%}
.tbl td {padding: 1%}
</style>

 </div></div></div></div>


    
 <div class="modal fade" id="modal-default2">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detail Kiriman</h4>
            <span id="msg"></span>
          </div>
          <div class="modal-body">
          <table class="table">
          <tr>
          <td>Kode Transfer</td><td>:</td><td><input type="text" disabled class="form-control" id="kdtrfx" /></td></tr><tr>
          <td>Klinik Asal</td><td>:</td><td><input type="text" disabled class="form-control" id="asalx" /></td>
          </tr>
          </table>
          <table id="trforder" class="table">
          <thead>
          <tr>
          <th>Aksi</th>
          <th>Kd Barang</th>
          <th>Nm Barang</th>
          <th>Jml</th>
          <th>Status</th>
          </tr>
          </thead>
          </table>
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
          </div>
        </div>
        <!-- /.modal-content -->
      </div>
      <!-- /.modal-dialog -->
    </div>
    <!-- /.modal -->


</section>

<link rel="stylesheet" href="<?php echo $url1; ?>bower_components/typeahead.css">
<script src="<?php echo $url1; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

<link rel="stylesheet" href="<?php echo $url1; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url1; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url1; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

function terima(id){
    var ids = id.split("-");
    var xhr = $.ajax({
        url: "modul/kliniktrf/aksi_trf.php?act=terima",
        data: {"id": ids[1]},
        success: function(data){
            $("#" + "status-" + ids[1]).html("Diterima");
            $("#" + id).hide();
                }
    });
}


function details(id){

$("#kdtrfx").val(id);


var xhr = $.ajax({
  url: "modul/kliniktrf/aksi_trf.php?act=detail2",
  data: {"kdtrf": id},
  success: function(data){

    $("#asalx").val(data);

    if ( $.fn.DataTable.isDataTable( '#trforder' ) ) {
  $('#trforder').dataTable().destroy();
} else {
    var tbl2 = $('#trforder').DataTable({
    "ajax": {
        "url" : "modul/kliniktrf/detail2.json",
        "dataSrc" : "aaData"
    }
   });

   tbl2.draw();
}

   



  }
});
}

$(document).ready(function(){

$("#example1").dataTable();



});

</script>