
<?php 

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");

$cx = mysql_query("SELECT kode_barang,nama_p,jumlah FROM produk WHERE id_kk = '$_SESSION[klinik]'");
$dx = '[';
while($cux = mysql_fetch_assoc($cx)){
    $dtx .= '{"nama":"'.$cux[nama_p].'","id":"'.$cux[kode_barang].'","jml":"'.$cux[jumlah].'"},';
}
$dtx = substr($dtx,0,strlen($dtx) - 1);
$dx .= $dtx.']';

file_put_contents("../redaktur/modul/kliniktrf/prod.json",$dx);

?>

<section class="content">

    

<div class="row">

<div class="col-md-12">

     <div class="callout callout-success">

     <button type="button" class="btn btn-info xbtn" data-toggle="modal" data-target="#modal-default">
           Tambah Kiriman
          </button>

     </div>





    </div>

</div>



 <div class="row">

<div class="col-md-12">

<div class="box box-success">

        <div class="box-header">

          <h3 class="box-title">Data Buat Kiriman</h3>

        </div>

        <!-- /.box-header -->

        <div class="box-body">

            

          <table id="example1" class="table table-bordered table-striped">

              <thead>

        <tr>

             <th>Aksi</th>
             <th>Kode Pengiriman</th>
             <th>Tgl Pengiriman</th>
             <th>Tujuan</th>
             <th>Operator</th>          
        </tr>

    </thead>

  <tbody>

<?php 

$data = mysql_query("SELECT * FROM kliniktrf WHERE asal = '$_SESSION[klinik]' GROUP BY kd_trf");
while($datax = mysql_fetch_assoc($data)){
  $loc = mysql_fetch_assoc(mysql_query("SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$datax[tujuan]'"));
  echo "<tr>";
  echo "<td><button type='button' class='btn btn-sm btn-warning' data-toggle='modal' data-target='#modal-default2' onclick='details(this.id)' id='$datax[kd_trf]'>Detail</button></td>";
  echo "<td>$datax[kd_trf]</td>";
  echo "<td>".strftime("%d %B %Y",strtotime($datax[tgl]))."</td>";
  echo "<td>$loc[nama_klinik]</td>";
  echo "<td>$datax[username]</td>";
  echo "</tr>";
}

?>

</tbody>

            </table>


<style>
.tbl {border-collpase: collapse; width: 100%}
.tbl td {padding: 1%}
</style>

 </div></div></div></div>

 <div class="modal fade" id="modal-default">
      <div class="modal-dialog">
        <div class="modal-content">
          <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Tambah Kiriman</h4>
            <span id="msg"></span>
          </div>
          <div class="modal-body">
<table class="tbl">


<tr>
<td>Kode Pengiriman</td>
<td>
<input type='text' class="form-control" id="kdtrf" readonly/>
</td>
</tr>

<tr>
<td>Klinik Tujuan</td>
<td>
<select class="form-control" id="tujuan">
<option value="">--silakan pilih--</option>
<?php

$ux = mysql_query("SELECT * FROM daftar_klinik WHERE id_kk != '$_SESSION[klinik]'");
while($uxi = mysql_fetch_assoc($ux)){
  echo "<option value='$uxi[id_kk]'>$uxi[nama_klinik]</option>";
}

?>
</select>
<small>klinik tujuan yang sudah dipilih akan terkunci. silakan refresh halaman ini untuk mengganti klinik tujuan dan data pengiriman</small>
</td>
</tr>

<tr>
<td>Kode/Nama Produk </td>
<td>
<input type="text" id="prod" class="form-control" placeholder=""/>
<small>ketik nama produk untuk menambah. hanya produk yang ada di stok yang muncul di sini</small>
<br/>
<input type="text" class="form-control" id="prd" readonly/>
<input type="hidden" id="jmlx" />
</td>
</tr>

<tr>
<td>Jumlah</td>
<td><input type="text" id="jml" class="form-control" value="0"/></td>
</tr>

<tr>
<td colspan=2><input type="button" class="btn btn-danger cbtn" value="+Tambah Produk" /></td>
</tr>

<input type="hidden" id="tgl" value="<?php echo date("Y-m-d"); ?>" />
<input type="hidden" id="asal" value="<?php echo $_SESSION[klinik]; ?>" />
<input type="hidden" id="username" value="<?php echo $_SESSION[namauser]; ?>"  />
</table>

<style>
 .deleted { background: black; }
</style>

 <table class="table" id="dataorder">
 <thead>
 <tr>
 <th>Aksi</th>
 <th>Kd Prod</th>
 <th>Nm Prod</th>
 <th>Jml</th>
 </tr>
 </thead>
 <tbody></tbody>
</table>

<input type="hidden" id="json"/>
<span id="json_" style='display: none'></span>

          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
            <button type="button" class="btn btn-primary qbtn">Simpan</button>
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
            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
              <span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title">Detail Kiriman</h4>
            <span id="msg"></span>
          </div>
          <div class="modal-body">
          <table class="table">
          <tr>
          <td>Kode Transfer</td><td>:</td><td><input type="text" disabled class="form-control" id="kdtrfx" /></td></tr><tr>
          <td>Klinik Tujuan</td><td>:</td><td><input type="text" disabled class="form-control" id="tujuanx" /></td>
          </tr>
          </table>
        
          <table id="trforder" class="table">
          <thead>
          <tr>
       
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
            <button type="button" class="btn btn-info " data-dismiss="modal" onclick="cetak()">Cetak</button>
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

function cetak(){
  var kdtrf = $("#kdtrfx").val();
  window.open("modul/kliniktrf/cetak.php?kdtrf=" + kdtrf,"_BLANK");
}

function details(id){

$("#kdtrfx").val(id);


var xhr = $.ajax({
  url: "modul/kliniktrf/aksi_trf.php?act=detail",
  data: {"kdtrf": id},
  success: function(data){

    $("#tujuanx").val(data);

    if ( $.fn.DataTable.isDataTable( '#trforder' ) ) {
  $('#trforder').dataTable().destroy();
} else {
    var tbl2 = $('#trforder').DataTable({
    "ajax": {
        "url" : "modul/kliniktrf/detail.json",
        "dataSrc" : "aaData"
    }
   });

   tbl2.draw();
}



  }
});
}



var json = '';
  var jsondata = '';

  //fungsi hapus

  function dels(id){

   

    $("#" + id).parents("tr").addClass("deleted");
    var tbl =  $('#dataorder').DataTable();
    tbl.row(".deleted").remove().draw();

      var dtjson = $("#json").val();
var js = JSON.parse(dtjson);
var jst = '';

for(i in js){
  if(js[i].num != id){
    jst += JSON.stringify(js[i]) + ",";
  }
}


jsondata = jst;

var jsdata = '[' + jst.substring(0,jst.length - 1) + ']';
$("#json").val(jsdata);
$("#json_").html(jsdata);

json = jsdata;


if(tbl.data().length == 0){
      $(".qbtn").attr("disabled",true);
    } else {}

  }


$(document).ready(function(){
  $(".qbtn").attr("disabled",true);

  $(".xbtn").click(function(){
  var xhr =  $.ajax({
      url: "modul/kliniktrf/kdtrf.php",
      success: function(data){
        
        $("#kdtrf").val(data);
      }
    });
    if(xhr.readyState == 1){
      $("#kdtrf").val("mencari kode pengiriman...");
    }

    $('#dataorder').DataTable({
                      "columns": [
        { "data": "aksi" },                
        { "data": "prd" },
        { "data": "prod" },
        { "data": "jml" }
    ]
                    });


  });


  $("#tujuan").change(function(){
    $(this).attr("disabled",true);
  });



var idnum = 1;

$(".cbtn").click(function(){
  var nama_p = $("#prod").val();
  var jmlx = parseInt($("#jmlx").val());
  var jml = parseInt($("#jml").val());
  var tuj = $("#tujuan").val();

if(nama_p == ""){
  alert("anda belum memilih produk");
} else if(jml == 0 || jml > jmlx){
    alert("jumlah yang anda isikan kosong atau melebihi persediaan");
  } else if(tuj == ""){
    alert("klinik tujuan kiriman masih kosong");
  } else {


//proses json disini


var asal = $("#asal").val();
var tujuan = $("#tujuan").val();
var kdtrf = $("#kdtrf").val();
var username = $("#username").val();
var tgl = $("#tgl").val();
var kode_produk = $("#prd").val();
var nama_produk = $("#prod").val();
var jmls = $("#jml").val();

var aksi = "<span class='label bg-red' id='" + idnum + "' style='cursor: pointer' onclick='dels(this.id)'>Hapus</span>";


var orderdata = '{"aksi":"' + aksi + '","prd":"' + kode_produk + '","prod":"' + nama_produk + '","jml":"' + jmls + '"}'; 

var jsons = JSON.parse(orderdata);
var tbl =  $('#dataorder').DataTable();
tbl.row.add(jsons).draw();


jsondata += '{"num":"' + idnum + '","asal":"' + asal + '","tujuan":"' + tujuan + '","kdtrf":"' + kdtrf + '","username":"' + username + '","tgl":"' + tgl + '","kode_produk":"' + kode_produk + '","nama_produk":"' + nama_produk + '","jml":"' + jmls + '"},'; 

var res = jsondata.substring(0,jsondata.length - 1);
json = '[' + res + ']';

$("#json").val(json);
$("#json_").html(json);

//hancurkan data
$("#prod").val("");
$("#prd").val("");
$("#jmlx").val("");
$("#jml").val("0");

idnum++;

$(".qbtn").attr("disabled",false);

  }


});

 //typeahead
        
 var namaCus = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/kliniktrf/prod.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


$('#prod').typeahead({
    hint: true,
  highlight: true,
minLength: 3
}, {
  name: 'nama-cus',
  display: 'nama',
  source: namaCus
} );
        


        $('#prod').bind('typeahead:select', function(ev, suggestion) {   
                $("#prd").val(suggestion.id); 
                $("#jmlx").val(suggestion.jml);
               });

//typeahead               



$(".qbtn").click(function(){
  var xhr = $.ajax({
    url: "modul/kliniktrf/aksi_trf.php?act=out",
    data: {"serial": $("#json").val()},
    success: function(data){
      location.reload();
    }
  });
});


$("#example1").dataTable();

});
</script>