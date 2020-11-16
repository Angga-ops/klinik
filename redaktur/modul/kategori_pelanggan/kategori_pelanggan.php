<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=kategori_pelanggan&act=tambah_katpel"> <button type="button" class="btn btn-warning btn-sm">Tambah Kategori Pelanggan</button></a>
               <a href="?module=terapkan_pelanggan"> <button type="button" class="btn btn-info btn-sm">Terapkan Kategori Pelanggan</button></a>

                <!--<select type="text" name="id_kk" class="form-control" id="pk">
                  <option value="a">Pilih Klinik...</option>
                      <?php 

                      $query = mysqli_query($con, "SELECT *FROM daftar_klinik");

                      while ($cb = mysqli_fetch_array($query)) { 

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
              <h3 class="box-title">Data Kategori Pelanggan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                <th>No</th>
                 <th>Kategori Pelanggan</th>
                 <th>Diskon Produk</th>
                 <th>Diskon Treatment</th>
                 <th>Keterangan</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysqli_query($con, "Select * From kategori_pelanggan");
    $no = 1;
    while($r  = mysqli_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                <td><?php echo $no++; ?></td>
                <td><?php echo $r["kategori"]; ?></td>
                <td><?php echo $r["diskon_p"]; ?> %</td>
                <td><?php echo $r["diskon_t"]; ?> %</td>
                <td><?php echo $r["keterangan"]; ?></td>
            <td>
                     
                     <a href="?module=kategori_pelanggan&act=edit_katpel&id_katpel=<?php echo $r["id_katpel"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/kategori_pelanggan/aksi_kategori_pelanggan.php?module=katpel&act=hapus&id_katpel=<?php echo $r['id_katpel']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
  case "tambah_katpel":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kategori Pelanggan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/kategori_pelanggan/aksi_kategori_pelanggan.php?module=katpel&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Pelanggan</label>
                <input type="text" class="form-control" name="kategori" placeholder="Misal A/B/C/etc" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Diskon Produk</label>
                <input type="text" class="form-control" name="diskon_p" placeholder="Dalam %" value="0" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Diskon Treatment</label>
                <input type="text" class="form-control" name="diskon_t" placeholder="Dalam %" value="0" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=kategori_pelanggan"><button type="button" class="btn btn-danger">Batal</button></a>
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
  case "edit_katpel":
  $id   = $_GET['id_katpel'];
  $edit   = mysqli_fetch_array(mysqli_query($con, "Select * From kategori_pelanggan Where id_katpel='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Kategori</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/kategori_pelanggan/aksi_kategori_pelanggan.php?module=katpel&act=update">
              <input type="hidden" size="25" value="<?php echo $id; ?>" name="id_katpel" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Pelanggan</label>
                <input type="text" class="form-control" name="kategori"  value="<?php echo $edit['kategori']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Diskon Produk</label>
                <input type="text" class="form-control" name="diskon_p" placeholder="Dalam %" value="<?php echo $edit['diskon_p']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Diskon Treatment</label>
                <input type="text" class="form-control" name="diskon_t" placeholder="Dalam %" value="<?php echo $edit['diskon_t']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan"  value="<?php echo $edit['keterangan']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=kategori_pelanggan"><button type="button" class="btn btn-danger">Batal</button></a>
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