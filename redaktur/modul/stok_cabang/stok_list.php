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
              <h3 class="box-title">Data Stok Produk</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>  <th>Gambar</th>
                 <th>Kode Barang</th>
                 <th>Nama barang</th>
                 <th>Kategori</th>
                 <th>Harga Jual</th>
                 <th>Stok Produk</th>
                 <th>Batas Minim</th>
                 <th>Keterangan</th>
                 <th>Aksi</th>
                 <!-- <th>Aksi</th> -->
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysqli_query($con,"Select * From produk Where id_kk='$id_kk'");
    while($r  = mysqli_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
        <?php $q1 = mysqli_query($con,"SELECT *FROM produk_master WHERE nama_produk='$r[nama_p]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                 <td><?php
                        if ( $k['gambar'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/gambar_produk/'.$k['gambar'].'"><img src="'.$url.'/gambar_produk/'.$k['gambar'].'" width="40px" height="40px"></a></center>';
                        }?>
                <td><?php echo $r["kode_barang"]; ?></td>
                <td><?php echo $r["nama_p"]; ?></td>
                <?php $q1 = mysqli_query($con,"SELECT *FROM kategori WHERE id_kategori='$r[id_kategori]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                <td><?php echo $k["kategori"]; ?></td>
                <td width='120px' ><?php echo rupiah($r["harga_jual"]); ?></td>
                <td><?php echo $r["jumlah"]; ?></td>
                <td><?php echo $r["batas_minim"]; ?></td>
            <td>
                     <?php 
                     if ($r["jumlah"] < $r["batas_minim"]) {
                      echo '
                       <a class="btn btn-xs btn-danger col-md-12"> Stok Hampir Habis</a>';
                     }else{
                      echo '<a class="btn btn-xs btn-success col-md-12"> Stok Tersedia</a>';
                     }
                     ?>
                     
                  
                </td>
                <td><a href="?module=stok_cabang&act=edit_stok&id_p=<?php echo $r["id_p"]; ?>" class="btn btn-xs btn-warning"><i class="fa fa-edit"></i> Ubah Stok Minimal</a></td>
               
      </tr>
    <?php
            }
        ?>
    </tbody>
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
      window.location.href = "http://ks-beautyclinic.com/apps/redaktur/media.php?module=produk&id="+select;
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
  case "edit_stok":
  $id   = $_GET['id_p'];
  $edit   = mysqli_fetch_array(mysqli_query($con,"Select * From produk Where id_p='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Stok Minimal cabang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/stok_cabang/aksi_stok.php?module=stok&act=update">
              <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Barang</label>
                <input type="text" class="form-control" name="kategori"  value="<?php echo $edit['nama_p']; ?>" readonly/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Stok Minimal Cabang</label>
                <input type="text" class="form-control" name="batas_minim"  value="<?php echo $edit['batas_minim']; ?>" />
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=stok_cabang"><button type="button" class="btn btn-danger">Batal</button></a>
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