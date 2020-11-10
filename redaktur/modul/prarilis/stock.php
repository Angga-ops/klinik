
<?php setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID"); ?>
<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

<ul>
<li>Untuk melihat detail produk per cabang klik nama cabang di kolom Klinik Cabang</li>
<li>Untuk memproses produk per cabang klik tombol Proses di baris yang sesuai</li>
<li>Proses akan menambahkan data baru di Gudang Cabang dan Master Produk, jika produk yang diinputkan di cabang melalui menu Data Produk Prarilis belum ada di data Gudang Cabang dan Master Produk</li>
</ul>
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

            <th>Aksi</th>
            <th>Klinik Cabang</th>
                 <th>Banyaknya Item</th>
               
               

            </tr>

        </thead>

      <tbody>

<?php 

$pr = mysql_query("SELECT prarilis.*, COUNT(id) jmlh FROM prarilis GROUP BY klinik");
while($pra = mysql_fetch_assoc($pr)){

  $klinik = mysql_fetch_assoc(mysql_query("SELECT nama_klinik FROM daftar_klinik WHERE id_kk = '$pra[klinik]'"));

  $aksi = "<a href='modul/prarilis/proses.php?klinik=$pra[klinik]'><button class='btn btn-sm btn-info'>Proses</button></a>";


    echo "<tr>";
    echo "<td>$aksi</td>";
    echo "<td><a href='media.php?module=prstock_detail&klinik=$pra[klinik]'>$klinik[nama_klinik]</a></td>";
    echo "<td>$pra[jmlh]</td>";
}

?>
    
    </tbody>

                </table>


<style>
.tbl {border-collpase: collapse; width: 100%}
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