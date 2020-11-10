<?php
  switch($_GET['act']){
  default:
  $id_kk = $_SESSION['klinik'];
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
              <h3 class="box-title">Laporan Pendapatan Netto Bruto Cabang</h3>
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
                <th>tanggal</th>
                <th>Pendapatan (Bruto)</th>
                <th>Pengeluaran (Kredit)</th>
                <th>Bersih (Netto)</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $bulan = isset($_POST['bulan'])? $_POST['bulan'] : date("m");
    $tahun = isset($_POST['tahun'])? $_POST['tahun'] : date("Y");
    $q1   = mysql_query("SELECT tanggal, SUM(sub_total) as subt FROM history_kasir WHERE month(tanggal) = '$bulan' AND year(tanggal) = '$tahun' AND id_kk='$id_kk' group by tanggal");

    while($r  = mysql_fetch_array($q1)){

      $ong = mysql_fetch_assoc(mysql_query("SELECT SUM(uang_ongkir) AS kir FROM pembayaran WHERE tgl = '$r[tanggal]'"));
      $ret = mysql_fetch_assoc(mysql_query("SELECT SUM(a.harga*b.jml) ur FROM history_kasir a JOIN retur_jual b ON a.id = b.history WHERE b.retur = 3 AND b.tgl = '$r[tanggal]' AND a.id_kk = '$_SESSION[klinik]'"));


$total = ($r["subt"] + $ong["kir"]) - $ret["ur"];

    ?>
      <tr class="gradeX">
                <td><?php echo $r["tanggal"]; ?></td>
                <td><?php echo rupiah($total);?></td>
        <?php $q2   = mysql_query("SELECT SUM(biaya_p) as luar FROM pengeluaran where tanggal='$r[tanggal]' AND id_kk='$id_kk' order by tanggal");
            $k = mysql_fetch_array($q2) ?>
                <td><?php echo rupiah($k["luar"]); ?></td>
                <td><?php echo rupiah(($total)-$k["luar"]); ?></td>
               
      </tr>
    <?php
            }
        ?>
    </tbody>
    <tfoot>
      <td>
              <a href="modul/lap_netbrutcab/cetak_laporan.php?bulan=<?php echo $bulan;?>&tahun=<?php echo $tahun;?>" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Laporan</a>
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
  $edit   = mysql_fetch_array(mysql_query("Select * From kategori Where id_kategori='$id'"));
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