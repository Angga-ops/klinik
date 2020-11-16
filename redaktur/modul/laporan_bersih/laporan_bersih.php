<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Laporan Pendapatan Bersih</h3>
              <form method="POST">
              
            </div>
            <div class="box-body">
            <div class="row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              
                <table class="table">
                  <tbody>
                    <tr>
                      <td><label>Bulan/Tahun</label></td>
                      <td><select name="bulan" class="form-control">
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                          </select>
                          <select name="tahun" class="form-control">
                          <?php
                          $mulai= date('Y') - 50;
                          for($i = $mulai;$i<$mulai + 100;$i++){
                              $sel = $i == date('Y') ? ' selected="selected"' : '';
                              echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                          }
                          ?>
                          </select>
                      </td>
                      <td><button type="submit" name="submit" class="btn btn-info">Cari</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
           
            
            <table id="example1" class="table table-bordered table-striped">
            <thead>
            <tr>
              <th>Cabang klinik</th>
                <th>Tanggal</th>
                <th>Pendapatan</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $bulan = $_POST['bulan'];
    $tahun = $_POST['tahun'];
    $q1   = mysqli_query($con, "SELECT *  FROM history_kasir WHERE month(tanggal) = '$bulan' AND year(tanggal) = '$tahun'");
    while($r  = mysqli_fetch_array($q1)){
    ?>
      <tr class="gradeX">
       <?php $q2 = mysqli_query($con, "SELECT * FROM daftar_klinik WHERE id_kk='$r[id_kk]'"); 
                 $k = mysqli_fetch_array($q2) ?>
                <td><?php echo $k["nama_klinik"]; ?></td>
                <td><?php echo $r["tanggal"]; ?></td>
                <td><?php echo rupiah($r["harga"]*$r["jumlah"]); ?></td>
       
               
      </tr>
    <?php
            }
        ?>
    </tbody>
    <tfoot>
      <td>
              <a href="modul/lap_netbrut/cetak_laporan.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Laporan</a>
              </td>
    </tfoot>
                </table>
     </div></div></div></div>

</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
    $("#pk").change(function(){
      var select = $(this).val();
      window.location.href = "http://localhost/klinik-kecantikan/redaktur/media.php?module=produk&id="+select;
    })
});
</script>
<!--
   -->


<?php
  break;
  case "tambah_kategori":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kategori Produk</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/kategori/aksi_kategori.php?module=kategori&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Barang</label>
                <input type="text" class="form-control" name="kategori" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=kategori"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              </div>
            </div></form>
              </div>
        </div>
        </div>
    </div>
</section>

<!--
     -->
<?php
  break;
  case "edit_kategori":
  $id   = $_GET['id'];
  $edit   = mysqli_fetch_array(mysqli_query($con, "Select * From kategori Where id_kategori='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Kategori</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/kategori/aksi_kategori.php?module=kategori&act=update">
              <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Barang</label>
                <input type="text" class="form-control" name="kategori"  value="<?php echo $edit['kategori']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=kategori"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              </div>
            </div></form>
              </div>
        </div>
        </div>
    </div>
</section>
<?php
  break;
  }
?>