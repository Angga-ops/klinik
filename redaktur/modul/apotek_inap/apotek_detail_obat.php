
<?php 

$sql = "SELECT * FROM kasir_sementara WHERE id_pasien = '$_GET[pasien]' AND no_faktur = '$_GET[faktur]' AND jenis = 'Produk' ORDER BY tanggal DESC";

?>


<section class="content">

<div class="row">
<div class="col-md-12">
<div class="callout callout-info">
Silakan pilih obat yang akan diserahkan kepada perawat yang bertugas
<br/>
<button class="btn btn-warning" onclick="printresep()">Ambil Obat</button>
</div>
</div>
</div>

 <div class="row">

<div class="col-md-12">

<div class="box box-success">

        <div class="box-header">

          <h3 class="box-title">Data Obat untuk Pasien Rawat Inap</h3>
          <br/><br/>
         

        </div>

        <!-- /.box-header -->

        <div class="box-body">

            

          <table id="example1" class="table table-bordered table-striped">

              <thead>

        <tr>
             <th>Pilih</th>
             <th>Obat</th>
             <th>Jumlah</th>
             <th>Keterangan</th>
             <th>Dokter Pemberi Resep</th>  
        </tr>

    </thead>

  <tbody>
  <?php 
  
  $q = mysql_query($sql);
  while($qu = mysql_fetch_assoc($q)){
      echo "<tr>";
      echo "<td><input type='checkbox' class='chk' data-id='$qu[id]'/></td>";
      echo "<td>$qu[nama]</td>";
      echo "<td>$qu[jumlah]</td>";
      $dokter = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user='$qu[id_dr]'"));
      echo "<td>$qu[ket]</td>";
      echo "<td>$dokter[nama_lengkap]</td>";
      echo "</tr>";
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

function printresep(){
  var u = "";
  $(".chk").each(function(a,b){
    if($(this).is(":checked")){
      u += $(this).data("id") + ",";
    }
  });

  var k = u.substring(0,u.length - 1);

if(k == ""){
  alert("tidak ada data yang dipilih");
} else {
  window.open("modul/apotek_inap/resep_obat.php?data=" + k + "&pasien=<?php echo $_GET[pasien]; ?>&faktur=<?php echo $_GET[faktur]; ?>","_BLANK");
}

}


$(document).ready(function(){
    $("#example1").dataTable({
        "bPaginate" : false
    });
});
</script>