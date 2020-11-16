
<?php 

$sql = "SELECT * FROM kasir_sementara WHERE id_pasien = '$_GET[id]' AND no_faktur = '$_GET[faktur]' AND jenis = 'Produk'";

?>


<section class="content">

<div class="row">
<div class="col-md-12">
<div class="callout callout-info">
Silakan pilih obat yang akan diprint dan klik tombol print
<br/>
<button class="btn btn-warning" onclick="printresep()">Print Resep</button>
</div>
</div>
</div>

 <div class="row">

<div class="col-md-12">

<div class="box box-success">

        <div class="box-header">

          <h3 class="box-title">Data Obat untuk Pasien Rawat Jalan</h3>
          <br/><br/>
         

        </div>

        <!-- /.box-header -->

        <div class="box-body">

            

          <table id="example1" class="table table-bordered table-striped">

              <thead>

        <tr>
             <th>Pilih Dosis Penuh</th>
             <th>Pilih Dosis Setengah</th>
             <th>Obat</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Dokter Pemberi Resep</th>  
        </tr>

    </thead>

  <tbody>
  <?php 
  
  $q = mysqli_query($con,$sql);
  $x = 1;
  while($qu = mysqli_fetch_assoc($q)){
      echo "<tr>";
      echo "<td><input type='checkbox' class='chk' id='chk-$x' data-id='$qu[id]' onclick='checkIt(this.id)'/></td>";
      echo "<td><input type='checkbox' class='chk2' id='chk2-$x' data-id='$qu[id]'  onclick='checkIt(this.id)'/></td>";
      echo "<td>$qu[nama]</td>";
      echo "<td>$qu[jumlah]</td>";
      echo "<td>$qu[ket]</td>";
      echo "<td>$qu[id_dr]</td>";
      echo "</tr>";
      $x++;
  }
  
  
  ?>
</tbody>
</table>

</div>
</div>
</div>
</div>



</section>


<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/typeahead.css">
<script src="<?php echo $url2; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

function checkIt(id){

    var n = id.split("-");
    var o = "chk-" + n[1];
    var p = "chk2-" + n[1];

   if(id == o){
    $("#" + p).prop("checked",false);
    $("#" + o).prop("checked",true);
   } else {
    $("#" + o).prop("checked",false);  
    $("#" + p).prop("checked",true); 
   }

}

function printresep(){
  var u = "";
  $(".chk").each(function(a,b){
    if($(this).is(":checked")){
      u += $(this).data("id") + ",";
    }
  });

  var k = u.substring(0,u.length - 1);

  var u2 = "";
  $(".chk2").each(function(a,b){
    if($(this).is(":checked")){
      u2 += $(this).data("id") + ",";
    }
  });

  var k2 = u2.substring(0,u2.length - 1);

  var js = '{"full":"' + k + '","half":"' + k2 + '"}';

if(js == ""){
  alert("tidak ada data yang dipilih");
} else {
  location.href = "media.php?module=bayar_obat&layan=jalan&data=" + js + "&pasien=<?php echo $_GET['pasien']; ?>&faktur=<?php echo $_GET['faktur']; ?>";
}

}


$(document).ready(function(){


    $("#example1").dataTable({
        "bPaginate" : false
    });
});
</script>