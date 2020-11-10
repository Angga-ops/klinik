
<?php setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID"); ?>
<section class="content">

<div class="row">

<div class="col-md-12">

     <div class="callout callout-info">

<ul>
<li>Menu ini digunakan untuk menambahkan produk yang saat ini sdh ada di cabang sebelum aplikasi digunakan</li>
<li>Menambahkan produk melalui menu ini akan mengupdate stok di cabang jika produk yang ditambahkan sudah ada di aplikasi</li>
<li>Sebelum menambahkan pastikan dahulu produk yang dimaksud ada di menu ini dan silakan diedit sesuai kebutuhan</li>
<li>Produk yang bisa ditambahkan melalui menu ini hanya yang sudah ada di master produk aplikasi</li>

</ul>

     </div>





    </div>

</div>



    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

         <button type="button" class="btn btn-info xbtn" data-toggle="modal" data-target="#modal-default">
               Tambah Produk Prarilis
              </button>

         </div>





        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Data Produk Prarilis & Posisi Stock di Cabang</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                

              <table id="example1" class="table table-bordered table-striped">

                  <thead>

            <tr>

                 <th>Aksi</th>
                 <th>Produk</th>
                 <th>Satuan</th>
                 <th>Kategori</th>
                 <th>Jumlah</th>
                 <th>Tgl Diterima</th>
               
               

            </tr>

        </thead>

      <tbody>

<?php 

//loop semua nama produk di prarilis
$uf = array();
$e = mysql_query("SELECT nama_produk FROM prarilis WHERE klinik = '$_SESSION[klinik]'");
while($er = mysql_fetch_assoc($e)){
 array_push($uf,"'".$er[nama_produk]."'");
}

//cari nama_p yg ada di gudang cabang
foreach($uf as $k => $v){

  $car = mysql_query("SELECT id_p,id_s,id_kategori,kode_barang,nama_p,jumlah FROM produk WHERE id_kk = '$_SESSION[klinik]' AND nama_p = $v");
  
  
  echo "<!-- SELECT id_p,id_s,id_kategori,kode_barang,nama_p,jumlah FROM produk WHERE id_kk = '$_SESSION[klinik]' AND nama_p = $v -->";

  if(mysql_num_rows($car) > 0){


    $f = mysql_fetch_assoc($car);

    $sat = mysql_fetch_assoc(mysql_query("SELECT satuan AS uan FROM data_satuan WHERE id_s = $f[id_s]"));
      
    $kat = mysql_fetch_assoc(mysql_query("SELECT kategori AS egori FROM kategori WHERE id_kategori = $f[id_kategori]"));
    
        echo "<tr>";
        echo "<td>
               
        <span class='btn btn-sm btn-info' id='$f[id_p]' onclick='edits(this.id)'  data-toggle='modal' data-target='#modal-default'>Edit</span>
        
        
        </td>";
        echo "<td>$f[nama_p]</td>";
        echo "<td>$sat[uan]</td>";
        echo "<td>$kat[egori]</td>";
        echo "<td>$f[jumlah]</td>";
        echo "<td></td>";
        echo "</tr>";


  }

 

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
                <h4 class="modal-title">Data Produk Pra Rilis</h4>
                <span id="msg"></span>
              </div>
              <div class="modal-body">
<form id="users" method="POST">
    <table class="tbl">

    <tr>
    <td>Nama Produk</td>
    <td><input type="text" id="prd" class="form-control" name="prd" readonly style="display: none" />
    
    <select class="form-control" name="prd" id="prd2">
    <?php 

$sel = mysql_query("SELECT nama_produk FROM produk_master ORDER BY nama_produk ASC");
while($sels = mysql_fetch_assoc($sel)){
  echo "<option value='".strtoupper($sels[nama_produk])."'>".strtoupper($sels[nama_produk])."</option>";
}

?>
    </select>
    
    </td>
    </tr>

    <tr>
    <td>Kode Produk</td>
    <td><input type="text" id="kd" class="form-control" name="kd" readonly/></td>
    </tr>

    <tr>
    <td>Jumlah</td>
    <td><input type="text" id="jml" name="jml" class="form-control" /></td>
    </tr>

    <tr>
    <td>Kategori</td>
    <td><select id="kat" name="kat" class="form-control">
    <option value="">--silakan pilih--</option>
    <?php 
    
    $kat = mysql_query("SELECT * FROM kategori");
    while($kate = mysql_fetch_assoc($kat)){
        echo "<option value='$kate[id_kategori]'>$kate[kategori]</option>";
    }
    
    
    ?>
    </select>
    </td>
    </tr>

    <tr>
    <td>Satuan</td>
    <td><select id="sat" name="sat" class="form-control">
    <option value="">--silakan pilih--</option>
    <?php 
    
    $kat = mysql_query("SELECT * FROM data_satuan");
    while($kate = mysql_fetch_assoc($kat)){
        echo "<option value='$kate[id_s]'>$kate[satuan]</option>";
    }
    
    
    ?>
    </select>
    </td>
    </tr>

<!--
    <tr>
    <td>Supplier</td>
    <td><select id="sup" name="sup" class="form-control">
    <option value="">--silakan pilih--</option>
    <?php 
    
    $kat = mysql_query("SELECT * FROM suplier");
    while($kate = mysql_fetch_assoc($kat)){
        echo "<option value='$kate[id_sup]'>$kate[nama_sup]</option>";
    }
    
    
    ?>
    </select>
    </td>
    </tr>

    <tr>
    <td>Harga Beli</td>
    <td><input type="text" id="beli" name="beli" class="form-control" /></td>
    </tr>

    <tr>
    <td>Harga Jual</td>
    <td><input type="text" id="jual" name="jual" class="form-control" /></td>
    </tr>

    <tr>
    <td>Tgl Diterima dari Pusat</td>
    <td><input type="text" id="tgl" name="tgl" class="form-control picker" value="<?php echo date("Y-m-d"); ?>" /></td>
    </tr> -->

    <input type="hidden" name="klinik" value="<?php echo $_SESSION[klinik]; ?>" />
    <input type="hidden" name="id" id="id_pr" />
    </table>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
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

<!-- select2 -->

<script src="<?php echo $url1; ?>bower_components/select2/dist/js/select2.full.min.js"></script>

<script>


function edits(id){
  $("#prd2").hide();
  $("#prd").show();
    $("#id_pr").val(id);
    $("#users").attr("action","<?php echo $url2."modul/prarilis/aksi.php?act=edit"; ?>");
    var k = $.ajax({

        url: "modul/prarilis/ajax.php",
        data: { "id" : id },
        dataType: "JSON",
        success: function(data){
            $("#kd").val(data.kd);
            $("#kat").val(data.kat);
            $("#sat").val(data.sat);
            $("#prd").val(data.prd);
            $("#jml").val(data.jml);
            $("#sup").val(data.sup);
            $("#tgl").val(data.tgl);
            $("#klinik").val(data.klinik);
            $("#beli").val(data.beli);
            $("#jual").val(data.jual);
            $("#msg").html("");
        }

    });

    if(k.readyState == '1'){
        $("#msg").html("<small>memuat data...</small>");
    }
}

$(document).ready(function(){

    $("#example1").dataTable({
      "order": [[1,"asc"]]
    });

$(".xbtn").click(function(){
  
  $("#prd2").show();
  $("#prd").hide();
    $("#users").attr("action","<?php echo $url2."modul/prarilis/aksi.php?act=add"; ?>");
    $("#users")[0].reset();

});
    
  $(".picker").datepicker({
        dateFormat: 'yy-mm-dd'
});
});
</script>