<?php 
$bc = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM modul WHERE link = '?module=".$_GET["module"]."'"));
?>
<!-- typeahead -->
<link rel="stylesheet" href="bower_components/typeahead.css">
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
<div class="col-md-6" id="totals">
Total Piutang 
</div>
<div class="col-md-6">
<table><form action="" method="POST">
<?php $now = date("Y-m-d"); ?>
  <tr>
  <td><input type="text" name="tgl1" class="picker form-control" placeholder="dari tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td><input type="text" name="tgl2" class="picker form-control" placeholder="sampai tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td><select name="cabang" class="form-control">
  <option value="">--silakan pilih cabang--</option>
  <?php 
  $c = mysqli_query($conn,"SELECT * FROM cabang");
  while($cx = mysqli_fetch_assoc($c)){
    echo "<option value='$cx[id_cb]'>$cx[nama_cb]</option>";
  }
  ?>
  </select></td>
  <td>&nbsp;&nbsp;</td>
  <td><button class='btn btn-info' type="submit">Cari</button></td>
  </tr></form>
  </table>
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
            <table class="table table-striped table-bordered table-hover">
             <thead>
                <tr> 
               
                <th>Status</th>
								<th>Nota</th>
                <th>Cabang</th>
                <th>Nama Petugas</th>
								<th>Nama Pelanggan</th>
                <th>Tagihan</th>
								<th>Detail</th>   
								<th>Tgl Mulai</th>
								<th>Tgl Selesai</th>
                <th>Harga Layanan</th>  
								<th>Total</th>
                <th>Diskon</th> 
                   </tr>
              </thead>
              <tbody id="user_example">
               <?php 
               
             $cb = (empty($_POST["cabang"]))? "" : "AND id_cb = ".$_POST["cabang"];

             $nama = (empty($_POST["nama"]))? "" : "AND id_cus IN (SELECT id_cus FROM customer WHERE nama_m LIKE '%".$_POST["nama"]."%')";

             //pencarian tanggal
             $tgl = (empty($_POST["tgl1"]))? " tgl_mulai <= '$now'" : " tgl_mulai >= '".$_POST["tgl1"]."' AND tgl_mulai <= '".$_POST["tgl2"]."'"; 

             $qlau = mysqli_query($conn,"SELECT * FROM nota WHERE $tgl AND stts_pss NOT IN ('Share Pelunasan') AND stts_byr IS NULL $nama $cb ORDER BY no_nota DESC, id_cb ASC LIMIT 20");

             $json = "";
             $baris = 0;
             while($hasil = mysqli_fetch_assoc($qlau)){

              
              $emp = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_ky FROM karyawan WHERE id_ky = (SELECT id_ky FROM users WHERE id_prim = '".$hasil["id_kasir"]."')"));

               $cus = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_m AS nama, telp_m AS hp FROM customer WHERE id_cus = '".$hasil['id_cus']."'"));

               $det = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id_mode,qty,pcs,hrg_sub FROM nota_detail WHERE id_nota = '".$hasil['id_nota']."'"));

               $mode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mode WHERE id_mode = '".$det['id_mode']."'"));

               $cb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_cb FROM cabang WHERE id_cb = '".$hasil['id_cb']."'"));

               $detail = mysqli_fetch_array(mysqli_query($conn,"SELECT nota.*, SUM(nota_detail.qty) AS berat, SUM(nota_detail.pcs) AS potong, 
								SUM(nota_detail.dis_plus) AS potongan, mode.kode_mode, mode.mode, mode.satuan_mode, mode.hrg_mode FROM nota 
                INNER JOIN nota_detail ON nota.id_nota = nota_detail.id_nota INNER JOIN mode ON nota_detail.id_mode = mode.id_mode WHERE nota.id_nota = '".$hasil['id_nota']."'"));
                
                $tot = ($det['hrg_sub']);
                $dsk = $tot * ($hasil['diskon_member']/100);
                $tagihan = number_format($tot - $dsk,0,",",".");

                $status = ($hasil["stts_pss"] == "Pelunasan" || $hasil["stts_pss"] == "Share Pelunasan")? "Lunas" : "Belum Lunas";

               echo "
               <tr>
               <td>".$status."</td>
               <td>".$hasil['no_nota']."</td>
               <td>".$cb['nama_cb']."</td>
               <td>".$emp['nama_ky']."</td>
               <td>".$cus['nama']." (".$cus['hp'].")</td>
               <td>Rp ".$tagihan."</td>
               <td>".$mode['mode']." <br/> ".$det['qty']." kg / ".$det['pcs']." Pcs </td>
               <td>".(strftime("%d %B %Y",strtotime($hasil['tgl_mulai'])))."</td>
               <td>".(strftime("%d %B %Y",strtotime($hasil['tgl_selesai'])))."</td>
               <td>Rp ".number_format($mode['hrg_mode'],0,",",".")."</td>
               <td>Rp ".number_format($tot,0,",",".")."</td>
               <td>Rp ".number_format($dsk,0,",",".")."</td>
               </tr>
               ";

              $total = $total + $tot;
              $baris++;
             }
               
           
               
               ?>
              <tr style="display: none"><td><input type="text" class="tagihan" value = "<?php echo $total; ?>" /><input type="text" class="baris" value = "<?php echo $baris; ?>" /></td></tr>
               </tbody>
             </table>
              <br/><br/>
              <center><div id="loadmore"></div>
              <button class="btn btn-warning xbtn" onclick="loadmore()">Muat Lainnya</button></center>
          </div>
          <!-- /.box-body -->
        </div></div></div>
    

      
      </section>
        <!-- User defined -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script src="bower_components/typeahead.bundle.min.js"></script>


<script>





 
 var u = 40;
 function loadmore(){

  
 var c = "<?php $a = (empty($_POST["cabang"]))? "" : $_POST["cabang"]; echo $a; ?>";

var nama = "<?php $b = (empty($_POST["nama"]))? "" : $_POST["nama"]; echo $b; ?>";

var tgl1 = "<?php $c = (empty($_POST["tgl1"]))? "" : $_POST["tgl1"]; echo $c; ?>";

var tgl2 = "<?php $d = (empty($_POST["tgl2"]))? "" : $_POST["tgl2"]; echo $d; ?>";


  var w = u - 19;
  var k = "<i class='fa fa-spinner fa-pulse fa-2x fa-fw'></i> memuat data...</div>";
  var xhr = $.ajax({
    url: "modul_admin/mod_piutang/ajax_rkppiut2.php",
    type: "POST",
    data: {"limit": w,"cabang": c,"nama": nama,"tgl1": tgl1,"tgl2" : tgl2},
    success: function(data){

      $("#user_example").append(data);
      $("#loadmore").html("");


var tagihan = 0;      
var baris = 0;

var tgh = document.getElementsByClassName("tagihan");
for(j = 0; j < tgh.length; j++){
 tagihan += parseInt(tgh[j].value);
}

var brs = document.getElementsByClassName("baris");
for(j = 0; j < brs.length; j++){
 baris += parseInt(brs[j].value);
}

var tagih = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(tagihan); 

$("#totals").html("Total Piutang " + tagih + " dari tarikan " + baris + " data");
      
    }
  });
  if(xhr.readyState == "1"){
    $("#loadmore").html(k);
  }
  u += 20;



 }


$(document).ready(function(){

  var tagihan = parseInt($(".tagihan").val());

var baris = parseInt($(".baris").val());

var tagih = new Intl.NumberFormat('id-ID', { style: 'currency', currency: 'IDR' }).format(tagihan); 

$("#totals").html("Total Piutang " + tagih + " dari tarikan " + baris + " data");

  
   //typeahead
        
   var namaCus = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: 'cust.json?v=<?php echo rand(100,900); ?>',
  cache: false
  
});

var hpCus = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nohp'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch:  'nohp.json?v=<?php echo rand(100,900); ?>',
  cache: false
  
});

console.log(namaCus);

$('#acs').typeahead({
    hint: true,
  highlight: true,
minLength: 3
}, {
  name: 'nama-cus',
  display: 'nama',
  source: namaCus
}, {
  name: 'hp-cus',
  display: 'nama',
  source: hpCus
});
        
        $('#acs').bind('typeahead:select', function(ev, suggestion) {    
                $("#cus").val(suggestion.id); 
               
});
      
        
        //end of typeahead

 

    $(".picker").datepicker({
    autoclose: true,
        format: "yyyy-mm-dd"
});




              

});



</script>