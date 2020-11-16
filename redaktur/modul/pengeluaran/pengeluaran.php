<?php
  switch($_GET['act']){
  default:
  $nama = $_SESSION['namalengkap'];
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a style="text-decoration: none;" href="media.php?module=pengeluaran&act=tambah" class="btn btn-warning btn-sm">Tambah Pengeluaran</a>

         </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Pengeluaran</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
                
                 <th>Tanggal</th>
                 <th>Nama Kasir</th>
                 <th>Biaya Pengeluaran</th>
                 <th>Kategori Pengeluaran</th>
                 <th>Keterangan</th>
                 <th>Aksi</th>               
            </tr>
        </thead>
      <tbody>
        <?php 
        $q = mysqli_query($con, "SELECT *FROM pengeluaran");
        while ($p = mysqli_fetch_array($q)) {
          ?>
        <tr>
         
          <td><?php echo $p['tanggal']; ?></td>
          <td><?php echo $p['kasir']; ?></td>
          <td><?php echo $p['biaya_p']; ?></td>
          <td><?php echo $p['kategori_p']; ?></td>
          <td><?php echo $p['ket']; ?></td>
          <td>
            <a class="btn btn-xs btn-info" href="media.php?module=pengeluaran&act=edit&id=<?php echo $p['id_p']; ?>"><i class="fa fa-edit"></i> Edit</a>
            <a class="btn btn-xs btn-danger" href="modul/pengeluaran/aksi_pengeluaran.php?act=hapus&id=<?php echo $p['id_p']; ?>"><i class="fa fa-trash"></i> Hapus</a>
          </td>
        </tr>

          <?php
        }
        ?>
    </tbody>
                </table>
     </div></div></div></div>

</section>
<?php
  break;
  case "tambah":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Pengeluaran</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/pengeluaran/aksi_pengeluaran.php?act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" class="form-control" name="tanggal" value="<?php echo date("Y-m-d"); ?>" required/>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Kasir</label>
                <input type="text" class="form-control" name="kasir" value="<?php echo $_SESSION['namalengkap'];?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jumlah Pengeluaran</label>
                <input type="number" class="form-control" name="biaya" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Pengeluaran</label>
                <input type="text" class="form-control" name="kategori" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" name="keterangan" required/>
                <!-- <input type="hidden" class="form-control" name="id_kk" value="<?php echo $_SESSION['klinik']?>" required/> -->
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label>Klinik</label>
                <select class="form-control" name="id_kk" required>
               
                <?php $q1 = mysqli_query($con,"SELECT *FROM daftar_klinik"); 
                      while($k = mysqli_fetch_array($q1)){ ?>

                      <option value="<?php echo $k['id_kk']; ?>"><?php echo $k["nama_klinik"]; ?></option>
                      <?php 
                    }
                ?>
              </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=pengeluaran"><button type="button" class="btn btn-danger">Batal</button></a>
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

<!--
     -->
<?php
  break;
  case "edit":
  $id   = $_GET['id'];
  $p   = mysqli_fetch_array(mysqli_query($con,"SELECT * From pengeluaran Where id_p='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Pengeluaran</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/pengeluaran/aksi_pengeluaran.php?act=update">
         <input class="form-control" type="hidden" value="<?php echo $id; ?>" name="id" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Tanggal</label>
                <input type="text" class="form-control" name="tanggal" value="<?php echo $p['tanggal']; ?>" required/>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Kasir</label>
                <input type="text" class="form-control" name="kasir" value="<?php echo $p['kasir']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Biaya Pengeluaran</label>
                <input type="number" class="form-control" name="biaya" value="<?php echo $p['biaya_p']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Pengeluaran</label>
                <input type="text" class="form-control" name="kategori" value="<?php echo $p['kategori_p']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Keterangan</label>
                <input type="text" class="form-control" value="<?php echo $p['ket']; ?>" name="keterangan" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                <label>Klinik</label>
                <select class="form-control" name="id_kk" required>
                <option value="<?php echo $p['id_kk']?>">
                <?php $q1 = mysqli_query($con,"SELECT *FROM daftar_klinik"); 
                      while($k = mysqli_fetch_array($q1)){ ?>
                        <?php echo $k['nama_klinik']?></option>
                      <option value="<?php echo $k['id_kk']; ?>"><?php echo $k["nama_klinik"]; ?></option>
                      <?php 
                    }
                ?>
              </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=pengeluaran"><button type="button" class="btn btn-danger">Batal</button></a>
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