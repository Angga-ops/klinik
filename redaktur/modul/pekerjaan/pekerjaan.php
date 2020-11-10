<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=pekerjaan&act=tambah_pekerjaan"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Pekerjaan</button></a>

                <!--<select type="text" name="id_kk" class="form-control" id="pk">
                  <option value="a">Pilih Klinik...</option>
                      <?php 

                      $query = mysql_query("SELECT *FROM daftar_klinik");

                      while ($cb = mysql_fetch_array($query)) { 

                        ?>
                      <option value="<?php echo $cb['id_kk']?>"><?php echo $cb['nama_klinik']; ?></option>
                      <?php  } ?> 
                 </select>-->


         </div>


        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Kategori</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Pekerjaan</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From pekerjaan");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                <td><?php echo $r["pekerjaan"]; ?></td>
                <!--<?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$r[id_kk]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k['nama_klinik']; ?></td>-->
            <td>
                     
                     <a href="?module=pekerjaan&act=edit_pekerjaan&id_pekerjaan=<?php echo $r["id_pekerjaan"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/pekerjaan/aksi_pekerjaan.php?module=pekerjaan&act=hapus&id_pekerjaan=<?php echo $r['id_pekerjaan']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
  case "tambah_pekerjaan":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Pekerjaan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/pekerjaan/aksi_pekerjaan.php?module=pekerjaan&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" class="form-control" name="pekerjaan" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=pekerjaan"><button type="button" class="btn btn-danger">Batal</button></a>
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
  case "edit_pekerjaan":
  $id   = $_GET['id_pekerjaan'];
  $edit   = mysql_fetch_array(mysql_query("Select * From pekerjaan Where id_pekerjaan='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit pekerjaan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/pekerjaan/aksi_pekerjaan.php?module=pekerjaan&act=update">
              <input type="hidden" size="25" value="<?php echo $edit['id_pekerjaan']; ?>" name="id_pekerjaan" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pekerjaan</label>
                <input type="text" class="form-control" name="pekerjaan"  value="<?php echo $edit['pekerjaan']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=pekerjaan"><button type="button" class="btn btn-danger">Batal</button></a>
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