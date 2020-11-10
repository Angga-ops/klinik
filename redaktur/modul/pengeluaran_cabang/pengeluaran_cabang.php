<?php
  switch($_GET['act']){
  default:
  $nama = $_SESSION['namalengkap'];
  $klinik = $_SESSION['klinik'];
?>
<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <div class="callout callout-success">
            <a style="text-decoration: none;" href="media.php?module=pengeluaran_cabang&act=tambah" class="btn btn-warning btn-sm">Tambah Pengeluaran</a>

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
                <div class="table-responsive">
              <table class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
                <th>Cabang Klinik</th>
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
        $d = array();
        $qr = mysql_query("SELECT *FROM pengeluaran Where id_kk='$klinik' GROUP BY tanggal");
        while ($pr = mysql_fetch_array($qr)) {

          array_push($d,$pr[tanggal]);

         }

         foreach($d as $k => $v){
           
          $q = mysql_query("SELECT *FROM pengeluaran Where tanggal = '$v'");

          while ($p = mysql_fetch_array($q)) {

          ?>
        <tr>
          <?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$p[id_kk]'"); 
                 $k = mysql_fetch_array($q1); ?>
              <td><?php echo $k['nama_klinik']; ?></td>
          <td><?php echo $p['tanggal']; ?></td>
          <td><?php echo $p['kasir']; ?></td>
          <td><?php echo $p['biaya_p']; ?></td>
          <td><?php echo $p['kategori_p']; ?></td>
          <td><?php echo $p['ket']; ?></td>
          <td>
            <a class="btn btn-xs btn-info" href="media.php?module=pengeluaran_cabang&act=edit&id=<?php echo $p[id_p]; ?>"><i class="fa fa-edit"></i> Edit</a>
            <a class="btn btn-xs btn-danger" href="modul/pengeluaran_cabang/aksi_pengeluaran.php?act=hapus&id=<?php echo $p[id_p]; ?>"><i class="fa fa-trash"></i> Hapus</a>
          </td>
        </tr>
         
          <?php
          } ?> 
             <tr style="background: #00a65a"><td colspan=7>&nbsp;</td></tr>
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
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/pengeluaran_cabang/aksi_pengeluaran.php?act=input">
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
                <label>Pilih Klinik</label>
                <select class="form-control" name="id_kk" readonly>
                
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik Where id_kk='$_SESSION[klinik]'"); 
                      while($k = mysql_fetch_array($q1)){ ?>

                      <option value="<?php echo $k[id_kk]; ?>"><?php echo $k["nama_klinik"]; ?></option>
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
  $p   = mysql_fetch_array(mysql_query("SELECT * From pengeluaran Where id_p='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Produk</h3>

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
                <label>Pilih Klinik</label>
                <select class="form-control" name="id_kk" readonly>
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik Where id_kk='$p[id_kk]'"); 
                      while($k = mysql_fetch_array($q1)){ ?>
                        <?php echo $k['nama_klinik']?></option>
                      <option value="<?php echo $k[id_kk]; ?>"><?php echo $k["nama_klinik"]; ?></option>
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