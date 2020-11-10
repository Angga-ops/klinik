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
              <h3 class="box-title">Data Dokter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                  <th>Foto</th>
                 <th>Cabang Klinik</th>
                 <th>Nama Dokter</th>
                 <th>Email</th>
                 <th>No Telepon</th>
                 <th>Status</th>
                 <!-- <th>Aksi</th> -->
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From user Where id_ju='JU-02' AND id_kk='$id_kk'");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                <td><center><?php
                        if ( $r['foto'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/file_user/foto_user/'.$r['foto'].'"><img src="'.$url.'/file_user/foto_user/'.$r['foto'].'" width="50px" height="50px"></a></center>';
                        }?></center></td>
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$r[id_kk]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k["nama_klinik"]; ?></td>
                <td><?php echo $r["nama_lengkap"]; ?></td>
                
                <td><?php echo $r["email"]; ?></td>
                <td><?php echo $r["no_telp"]; ?></td>
            <td>
                     <?php 
                     if ($r["blokir"]=="N") {
                      echo '
                       <a class="btn btn-xs btn-success col-md-12"> Aktif</a>';
                     }else{
                      echo '<a class="btn btn-xs btn-danger"> Tidak Aktif</a>';
                     }
                     ?>
                     
                  
                </td>
               
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