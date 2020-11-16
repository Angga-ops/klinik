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

 <div class='callout callout-success'>
 
 <div class="row">
 <div class="col-md-6">
 <a href='#' data-toggle='modal' data-target='#modal-default' class='news'><button class='btn btn-info'>Tambah Data</button></a>
 </div>

 </div>
 </div>

<div class="row">
      <div class="col-xs-12"><div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="user_example">
              <thead>
                <tr> 
                <th>Aksi</th>
								<th>Nama Item</th>
                <th>Grup Item</th>
                <th>Tgl</th>
                <th>Nilai</th>
                   </tr>
              </thead>
              <tbody>

<?php 

$sql = "SELECT * FROM rutin";
$qdata = mysqli_query($conn,$sql);
while($hasil = mysqli_fetch_assoc($qdata)){

  $item = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM item_keuangan WHERE id_item = '".$hasil['id_item']."'"));

    $aksi = "<a href='#' data-toggle='modal' data-target='#modal-default'  alt='$hasil[id]' id='".(rand(1,1000000))."' onclick='edit(this.id)'><small class='label bg-blue'>Edit</small></a> <a href='modul_admin/mod_rutin/aksi_rutin.php?act=del&id=$hasil[id]' onclick='return confirm(\" Apakah Anda ingin menghapus? \");'><small class='label bg-red'>Hapus</small></a>";


    echo "<tr>";
    echo "<td>$aksi</td>";
    echo "<td>$item[nama_item]</td>";
    echo "<td>$item[group_item]</td>";
    echo "<td>".strftime("%d %B %Y",strtotime($hasil['tgl']))."</td>";
    echo "<td>Rp ".number_format($hasil['nilai'],0,",",".")."</td>";
    echo "</tr>";


}

?>

                             </tbody></table>
          </div>
          <!-- /.box-body -->
        </div></div></div>
    
        <div class="modal fade" id="modal-default">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span></button>
                  <h4 class="modal-title"></h4>
                </div>
                <div class="modal-body">
                <div id="ajax-user"></div>
                <form id="user" method="POST" >
                <input type="hidden" id="rutin" name="id" />
                <table class="table">
               <tr>
               <td>Nama Item Data</td><td>:</td><td>
               <select name="id_item" id="item" class="form-control">
               <?php $k = mysqli_query($conn,"SELECT * FROM item_keuangan ORDER BY group_item ASC"); 
               while($kx = mysqli_fetch_assoc($k)){
                 echo "<option value='".$kx['id_item']."'>".$kx['nama_item']."</option>";
               }
               ?>
               </select>
               </td>
               </tr>
               <tr>
               <td>Nilai</td><td>:</td><td>
               <input type="textbox" name="nilai" id="nilai" class="form-control" autocomplete="off"/>
               </td>
               </tr>
               <tr>
               <td>Tanggal</td><td>:</td><td>
               <input type="textbox" value="<?php echo date("Y-m-d"); ?>" name="tgl" id="tgl" class="picker form-control" autocomplete="off"/>
               </td>
               </tr>
                </table>
                </div>
                <div class="modal-footer">
                  <button type="button" class="btn btn-danger pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-success">Simpan</button></form>
                </div>
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>

 <div class="modal fade" id="modal-default-2">
            <div class="modal-dialog">
              <div class="modal-content">
               
                <div class="modal-body">
                 
                <div class="progress">
                <div class="progress-bar active progress-bar-primary progress-bar-striped" role="progressbar" aria-valuenow="100" aria-valuemin="0" aria-valuemax="100" style="width: 100%">
                </div>
              </div>

                </div>
               
              </div>
              <!-- /.modal-content -->
            </div>
            <!-- /.modal-dialog -->
          </div>
      
      </section>
        <!-- User defined -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



<script>

//fungsi edit diletakkan di luar onready 

function edit(id){ 
  
  var id_item = $("#" + id).attr("alt");

  //console.log(id_item);

  var xhr = $.ajax({
        timeout: 5000,
        error: function(a,b){
          if(b === "timeout"){
            $("#ajax-user").html("<strong>server mengalami gangguan</strong><br/>");
          }
        },
        url: "modul_admin/mod_rutin/ajax_rutin.php",
        data: { "id" : id_item },
        dataType: "JSON",
        success: function(data){
          $("#user").attr("action","modul_admin/mod_rutin/aksi_rutin.php?act=edit");
          $("#ajax-user").html("");
          $("#rutin").val(id_item);
          $("#item").val(data[0].id_item);
          $("#nilai").val(data[0].nilai);
          $("#tgl").val(data[0].tgl);
          

        }
      });                 

      if(xhr.readyState == 1){
        $("#ajax-user").html("<div class='progress'><div class='progress-bar active progress-bar-primary progress-bar-striped' role='progressbar' aria-valuenow='100' aria-valuemin='0' aria-valuemax='100' style='width: 100%'></div></div>");
      }
}

$(document).ready(function(){

   var tbl =  $('#user_example').DataTable({
    "scrollX" : true
   });

    $(".picker").datepicker({
    autoclose: true,
        format: "yyyy-mm-dd"
});

$(".news").click(function(){
  $("#user")[0].reset();
  $("#user").attr("action","modul_admin/mod_rutin/aksi_rutin.php?act=add");
});


});



</script>
    <!-- Main content -->
    <!-- /.content -->
  </div>
