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
               <a href="?module=produk_keluar&act=tambah_pk"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Pengiriman</button></a>
                <!-- <a target="_blank" href="report/rpt_alat_klinik.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Data Alat Klinik</button></a> -->

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pengiriman</h3>
            </div>
            
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Nomer</th>
                 <th>Kode Barang</th>
                 <th>Nama Produk</th>
                 <th>Satuan</th>
                 <th>Kategori</th>
                 <th>Jumlah</th>
                 <th>Harga Jual</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
    <?php
    $tampil   = mysql_query("Select * From pengiriman Where id_pengiriman");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                 
                <td><?php echo $r["nomer"]; ?></td>
                <td><?php echo $r["kode_barang"]; ?></td>
                <td><?php echo $r["nama_p"]; ?></td>
                <?php $q1 = mysql_query("SELECT *FROM data_satuan WHERE id_s='$r[id_s]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k['satuan']; ?></td>
                <?php $q1 = mysql_query("SELECT *FROM kategori WHERE id_kategori='$r[id_kategori]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k['kategori']; ?></td>
                <td><?php echo $r["jumlah"] ?></td>
                <td><?php echo rupiah ($r['harga_jual']);?></td>
            <td>
                     
                     <a href="?module=produk_keluar&act=edit_pk&id=<?php echo $r["id_pengiriman"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a target="_blank" href="report/rpt_produk_keluar.php"> <button type="button" class="btn btn-xs btn-primary"><i class="fa fa-print"></i> Cetak</button></a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/produk_keluar/aksi_produk_keluar.php?module=produk_keluar&act=hapus&id=<?php echo $r['id_pengiriman']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
});
</script>
<!--
   -->


<?php
  break;
  case "tambah_pk":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Pengiriman</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/produk_keluar/aksi_produk_keluar.php?module=produk_keluar&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nomer</label>
               <input type="text" class="form-control"  name="nomer" value="<?php echo $kode; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" class="form-control" name="kode_barang" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama_p" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan</label>
                <select type="text" name="id_s" class="form-control" required/ >
                   <option value="">Pilih Satuan...</option>
                       <?php $query = mysql_query("SELECT *FROM data_satuan");
                          while ($cb = mysql_fetch_array($query)) { ?>
                   <option value="<?php echo $cb['id_s']; ?>"><?php echo $cb['satuan']; ?></option>
                       <?php  } ?> 
               </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori</label>
                <select type="text" name="id_kategori" class="form-control" required/ >
                   <option value="">Pilih Kategori...</option>
                       <?php $query = mysql_query("SELECT *FROM kategori");
                          while ($cb = mysql_fetch_array($query)) { ?>
                   <option value="<?php echo $cb['id_kategori']; ?>"><?php echo $cb['kategori']; ?></option>
                       <?php  } ?> 
               </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="number" class="form-control" name="jumlah" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual</label>
                <input type="text" class="form-control" name="harga_jual" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Cabang Klinik</label>
                <select type="text" name="id_kk" class="form-control" required/ >
                   <option value="">Pilih Cabang...</option>
                       <?php $query = mysql_query("SELECT *FROM daftar_klinik");
                          while ($cb = mysql_fetch_array($query)) { ?>
                   <option value="<?php echo $cb['id_kk']; ?>"><?php echo $cb['nama_klinik']; ?></option>
                       <?php  } ?> 
               </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pengiriman</label>
                <input type="text" class="form-control" name="pengiriman" required/>
              </div>
              </div><div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" class="form-control datepicker" name="tgl" placeholder="yyyy-mm-dd" required/>
              </div>
              </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=suplier"><button type="button" class="btn btn-danger">Batal</button></a>
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
  case "edit_pk":
  $id   = $_GET['id'];
  $edit   = mysql_fetch_array(mysql_query("Select * From pengiriman Where id_pengiriman='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Pengiriman</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/produk_keluar/aksi_produk_keluar.php?module=produk_keluar&act=update">
              <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nomer</label>
                <input type="text" class="form-control" name="nomer"  value="<?php echo $edit['nomer']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Barang</label>
                <input type="text" class="form-control" name="kode_barang"  value="<?php echo $edit['kode_barang']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Produk</label>
              <textarea name="nama_p" required class="form-control"><?php echo $edit['nama_p']; ?></textarea>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan</label>
                <select type="text" name="id_s" required class="form-control"><?php echo $edit['satuan']; ?>
                   <option value="">Pilih Satuan...</option>
                       <?php $query = mysql_query("SELECT *FROM data_satuan");
                          while ($cb = mysql_fetch_array($query)) { ?>
                   <option value="<?php echo $cb['id_s']; ?>"><?php echo $cb['satuan']; ?></option>
                       <?php  } ?> 
               </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori</label>
                <select type="text" name="id_kategori" required class="form-control"><?php echo $edit['kategori']; ?>
                   <option value="">Pilih Kategori...</option>
                       <?php $query = mysql_query("SELECT *FROM kategori");
                          while ($cb = mysql_fetch_array($query)) { ?>
                   <option value="<?php echo $cb['id_kategori']; ?>"><?php echo $cb['kategori']; ?></option>
                       <?php  } ?> 
               </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jumlah</label>
                <input type="text" class="form-control" name="jumlah"  value="<?php echo $edit['jumlah']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual</label>
                <input type="text" class="form-control" name="harga_jual"  value="<?php echo $edit['harga_jual']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Klinik Cabang</label>
                <input type="text" class="form-control" name="id_kk"  value="<?php echo $edit['id_kk']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Pengiriman</label>
                <input type="text" class="form-control" name="pengiriman"  value="<?php echo $edit['pengiriman']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=suplier"><button type="button" class="btn btn-danger">Batal</button></a>
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
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">    
        <h1>EDIT FASILITAS KAMAR</h1>
        </div>
    <div class="block-content">
    <form method="POST" enctype="multipart/form-data" action="modul/mod_fsl_kamar/aksi_fsl_kamar.php?module=dk&act=update">
    <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
        <p class="inline-small-label">
            <label for="field4">Kamar</label>
            <select name="kamar">
        <?php
                    $jr = mysql_query("Select * From kamar");
                    if ($edit['id_kamar'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr     = mysql_fetch_array($jr)) {
                    if ($edit['id_kamar'] == $edit_jr['id_kamar']) {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>" selected><?php echo $edit_jr['nama_kamar']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>"><?php echo $edit_jr['nama_kamar']; ?></option>
                    <?php
                    }
                    }
                ?>
            </select>
        </p>        
        <p class="inline-small-label">
            <label for="field4">Keadaan</label>
            <input type="text" size="25" name="keadaan" value="<?php echo $edit['keadaan']; ?>" reuired />
        </p>        
        <p class="inline-small-label">
            <label for="field4">Fasilitas</label>
      <textarea name="fasilitas" reuired><?php echo $edit['fasilitas']; ?></textarea>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=fsl_kamar">Batal</a>
            </li> 
        </ul>
        <ul class="actions-left">
            <li>
            <input type="submit" name="upload" class="button" value="Update" />
            </li>
        </ul>
    </div>
    </form>
        </div>
      </div>
    </div>
  </div>
</div> -->
<?php
  break;
  }
?>