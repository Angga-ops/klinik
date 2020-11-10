<?php
	switch($_GET['act']){
	default:
?>

<section class="content-header">
    
<?php 
    
$bc = mysql_fetch_assoc(mysql_query("SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
    ?> 

    <h1>
        <?php echo $bc[crumb]; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo $bc[crumb]; ?></li>
      </ol>
    </section>



    <section class="content">

      <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=stok_barang&act=tambah_barang"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Stok Barang</button></a>
                <a target="_blank" href="report/rpt_data_barang.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Data Stok Barang</button></a>

    </div>
        </div>
    </div>

   
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Stok Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
                 <th>Id Barang</th>
                 <th>Nama Barang</th>
                 <th>Jumlah Barang</th>
                 <th>Harga Barang</th>
                 <th>Aksi</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From gudang");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                 
                <td><?php echo $r["id_brg"]; ?></td>
                <td><?php echo $r["nama_brg"]; ?></td>
                <td><?php echo $r["jumlah_brg"]; ?></td>
                <td><div align="left"><?php echo rupiah($r['harga_brg']); ?></td>

               <td>
                     
                     <a href="?module=stok_barang&act=edit_brg&id=<?php echo $r["id_brg"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;

                     <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_gudang/aksi_stok_barang.php?act=hapus&id=<?php echo $hasil['id_brg']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
  
                </td>
      </tr>
    <?php
            }
        ?>
    </tbody>
  </table>
</div>
</div>
</div>
</div>

</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
});
</script>


<!-- Tambah data barang -->


<?php
  break;
  case "tambah_barang":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_gudang/aksi_stok_barang.php?act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Id Barang</label>
                <input type="text" class="form-control" name="id_brg" required/>
              </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Barang</label>
                  <input type="text" class="form-control" name="nama_brg" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                <label>Jumlah Barang</label>
                <input type="text" class="form-control" name="jumlah_brg" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Barang</label>
                  <input type="text" class="form-control" name="harga_brg" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=stok_barang">
                    <button type="button" class="btn btn-danger">Batal</button></a>
                    <button type="submit" class="btn btn-success">Simpan</button>
                </div>
              </div>
            </div>

          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<!-- Edit data barang -->
<?php
  break;
  case "edit_brg":
  $id   = $_GET['id'];
  $edit   = mysql_fetch_array(mysql_query("Select * From gudang Where id_brg='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_gudang/aksi_stok_barang.php?module=brg&act=update">
              <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Nama Barang</label>
                   <input type="text" class="form-control" name="nama_brg"  value="<?php echo $edit['nama_brg']; ?>" required/>
                  </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Jumlah Barang</label>
                  <input type="text" class="form-control" name="jumlah_brg" value="<?php echo $edit['jumlah_brg']; ?>" required/>
                  </div>
                  </div>
                </div>
                <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                    <label>Harga Barang</label>
                  <input type="text" class="form-control" name="harga_brg" value="<?php echo $edit['harga_brg']; ?>" required/>
                  </div>
                  </div>
                </div>
                 <div class="row">
                <div class="col-md-12">
                  <div class="form-group">
                   <a href="?module=stok_barang"><button type="button" class="btn btn-danger">Batal</button></a>
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