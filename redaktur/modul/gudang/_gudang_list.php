<?php
	switch($_GET['act']){
	default:
?>

<section class="content-header">
    
<?php 
    
$bc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
    ?> 

    <h1>
        <?php echo $bc['crumb']; ?>
      </h1>
    </section>



    <section class="content">
      <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=gudang&act=tambah_stok"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Stok Barang</button></a>

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
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
                <th>Gambar</th>
                 <th>Kode Produk</th>
                 <th>Nama Produk</th>
                 <th>Kategori Produk</th>
                 <th>Stok Produk</th>
                 <th>Harga Beli</th>
                 <th>Harga Jual</th>
                 <th>Batas Minim</th>
                 <th>Aksi</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysqli_query($con, "Select * From produk_pusat");
    while($r  = mysqli_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                 
                   <?php $q1 = mysqli_query($con, "SELECT *FROM produk_master WHERE nama_produk='$r[nama_produk]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                 <td><?php
                        if ( $k['gambar'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/gambar_produk/'.$k['gambar'].'"><img src="'.$url.'/gambar_produk/'.$k['gambar'].'" width="40px" height="40px"></a></center>';
                        }?></td>
                 
                <td><?php echo $r["kode_produk"]; ?></td>
                <td><?php echo $r["nama_produk"]; ?></td>
                <?php $q1 = mysqli_query($con, "SELECT *FROM kategori WHERE id_kategori='$r[id_kategori]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                <td><?php echo $k['kategori']; ?></td>
                <td><?php echo $r["jumlah"]; ?></td>
                <td><?php echo rupiah($r["harga_beli"]); ?></td>
                <td><?php echo rupiah($r["harga_jual"]); ?></td>
                <td><?php echo $r["batas_minim"]; ?></td>

               <td>
                     
                     <a href="?module=gudang&act=edit_brg&id_pp=<?php echo $r["id_pp"]; ?>" class="btn btn-xs btn-success col-md-12"><i class="fa fa-edit"></i> Edit</a>

                     <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/gudang/aksi_stok.php?module=pembelian_t&act=hapus&id_pp=<?php echo $r['id_pp']; ?>" class="btn btn-xs btn-danger col-md-12"><i class="fa fa-trash-o"></i> Hapus</a>
                     
  
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
  case "tambah_stok":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/gudang/aksi_stok.php?act=input">
          <div class="col-md-6">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Produk</label>
                <input type="text" class="form-control" name="kd_produk" placeholder="Kode produk" required/>
              </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" placeholder="Nama Produk" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                <label>Kategori Produk</label>
                <select name="kategori_produk" class="form-control" required>
                <option >Pilih Kategori</option>
                <?php
                  $data = mysqli_query($con, "Select * From kategori");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_kategori']; ?>"><?php echo $hasil['kategori']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Stock Awal</label>
                  <input type="number" class="form-control" name="stok_produk" placeholder="Stok Awal" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" class="form-control" required>
                <option >Pilih Satuan</option>
                <?php
                  $data = mysqli_query($con, "Select * From data_satuan");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_s']; ?>"><?php echo $hasil['satuan']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=gudang">
                    <button type="button" class="btn btn-danger col-md-6">Batal</button></a>
                    <button type="submit" class="btn btn-success col-md-6">Simpan</button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Beli</label>
                  <input type="number" class="form-control" name="harga_beli" placeholder="Harga Beli" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Jual</label>
                  <input type="number" class="form-control" name="harga_jual" placeholder="Harga jual" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Suplier</label>
                  <select name="suplier" class="form-control" required>
                <option >Pilih Suplier</option>
                <?php
                  $data = mysqli_query($con, "Select * From suplier");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_sup']; ?>"><?php echo $hasil['nama_sup']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Cabang</label>
                  <input type="number" class="form-control" name="batas_cabang" placeholder="Batas Cabang" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Minim</label>
                  <input type="number" class="form-control" name="batas_minim" placeholder="Batas Minim" required/>
                </div>
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
  $id   = $_GET['id_pp'];
  $edit   = mysqli_fetch_array(mysqli_query($con, "Select * From produk_pusat Where id_pp='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/gudang/aksi_stok.php?act=update">
          <div class="col-md-6">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Produk</label>
                <input type="hidden" class="form-control" name="id_pp" value="<?php echo $edit['id_pp'];?>" required/>
                <input type="text" class="form-control" name="kd_produk" value="<?php echo $edit['kode_produk'];?>" required/>
              </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" value="<?php echo $edit['nama_produk'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                <label>Kategori Produk</label>
                <select name="kategori_produk" class="form-control" required>
                  <option value="<?php echo $edit['id_kategori']; ?>">
                <?php
                  $data = mysqli_query($con, "Select * From kategori");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <?php echo $hasil['kategori']; ?></option>
                <option value="<?php echo $hasil['id_kategori']; ?>"><?php echo $hasil['kategori']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Jumlah Stok</label>
                  <input type="number" class="form-control" name="stok_produk" value="<?php echo $edit['jumlah'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" class="form-control" required>
                <?php
                  $data = mysqli_query($con, "Select * From data_satuan where id_s='$edit[id_sat]'");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_s']; ?>"><?php echo $hasil['satuan']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=gudang">
                    <button type="button" class="btn btn-danger col-md-6">Batal</button></a>
                    <button type="submit" class="btn btn-success col-md-6">Simpan</button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Beli</label>
                  <input type="number" class="form-control" name="harga_beli" value="<?php echo $edit['harga_beli'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Jual</label>
                  <input type="number" class="form-control" name="harga_jual" value="<?php echo $edit['harga_jual'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Suplier</label>
                  <select name="suplier" class="form-control">
                <option value="<?php echo $edit['id_sup']?>">
                <?php
                  $data = mysqli_query($con, "Select * From suplier ");            
                  while($hasil  = mysqli_fetch_array($data)){
                ?>
                <?php echo $hasil['nama_sup'];?></option>
                <option value="<?php echo $hasil['id_sup']; ?>"><?php echo $hasil['nama_sup']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Cabang</label>
                  <input type="number" class="form-control" name="batas_cabang" value="<?php echo $edit['batas_cabang'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Minim</label>
                  <input type="number" class="form-control" name="batas_minim" value="<?php echo $edit['batas_minim'];?>" required/>
                </div>
              </div>
            </div>
          </div>

            

          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
  break;
  }
?>