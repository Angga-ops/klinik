
<?php setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID"); ?>
<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">



         <a href="media.php?module=prarilis_stock"><button type="button" class="btn btn-info">Kembali</button></a>
         </div>





        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Data Produk Prarilis</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                

              <table id="example1" class="table table-bordered table-striped">

                  <thead>

            <tr>

                 <th>Klinik Cabang</th>
                 <th>Produk</th>
                 <th>Satuan</th>
                 <th>Kategori</th>
                 <th>Jumlah</th>
                 <th>Tgl Diterima</th>
               
               

            </tr>

        </thead>

      <tbody>

<?php 

$pr = mysqli_query($con,"SELECT * FROM prarilis WHERE klinik = '$_GET[klinik]'");
while($pra = mysqli_fetch_assoc($pr)){

    $klinik = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$pra[klinik]'"));

$sat = mysqli_fetch_assoc(mysqli_query($con,"SELECT satuan AS uan FROM data_satuan WHERE id_s = $pra[id_satuan]"));

$kat = mysqli_fetch_assoc(mysqli_query($con,"SELECT kategori AS egori FROM kategori WHERE id_kategori = $pra[id_kategori]"));

    echo "<tr>";
    echo "<td>$klinik[nama_klinik]</td>";
    echo "<td>$pra[nama_produk]</td>";
    echo "<td>$sat[uan]</td>";
    echo "<td>$kat[egori]</td>";
    echo "<td>$pra[jml]</td>";
    echo "<td>".strftime("%d %B %Y",strtotime($pra['tgl_terima']))."</td>";
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


</section>

<link rel="stylesheet" href="<?php echo $url1; ?>bower_components/typeahead.css">
<script src="<?php echo $url1; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

  <link rel="stylesheet" href="<?php echo $url1; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url1; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url1; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>


$(document).ready(function(){

    $("#example1").dataTable();
    
});
</script>