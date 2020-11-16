<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=produk&act=tambah_produk"> <button type="button" class="btn btn-warning btn-sm">Tambah Produk Apotik</button></a>

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
              <h3 class="box-title">Data Produk Apotik</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" action="">
            <div class="row">
              <div class="col-md-8" style="margin-left: 10px;">
                <div class="input-group input-group-sm">
                <input type="text" class="form-control" name="cari" placeholder="cari nama obat...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" name="submitbutton" value="submit"><span class="fa fa-search"></span>Cari!</button>
                    </span>
              </div>
              </div>
            </div>
            </form>
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table class="table table-bordered table-striped" id="cssTable">
                  <thead>
            <tr>
                  <th>Gambar Produk</th>
                 <th>Kode Produk</th>
                 <th>Nama Produk</th>
                 <th>Harga Beli</th>
                 <th>Harga Umum</th>
				 <th>Harga BPJS</th>
				 <th>Harga Asuransi Lainnya</th>
                 <th>Kategori</th>
                 <th>Satuan</th>
                 <th>Aksi</th>
                 <!-- <th>Aksi</th> -->
               
            </tr>
        </thead>
      <tbody>
    <?php
  
    
      if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
      } else {
          $pageno = 1;
      }
      $no_of_records_per_page = 10;
      $offset = ($pageno-1) * $no_of_records_per_page;

      $cari = $_POST['cari'];
      $total_pages_sql  = mysqli_query($con, "SELECT * FROM produk_master WHERE nama_produk LIKE '%$cari%'");

      //$result = mysql_query($total_pages_sql);
      $total_rows = mysqli_num_rows($total_pages_sql);
      $total_pages = ceil($total_rows / $no_of_records_per_page);

        $data  = mysqli_query($con, "SELECT * FROM produk_master WHERE nama_produk LIKE '%$cari%' ORDER BY nama_produk ASC LIMIT $offset, $no_of_records_per_page");
        if(mysqli_num_rows($data) > 0){
    while($r  = mysqli_fetch_array($data)){
    ?>
      <tr class="gradeX">
                <td><?php
                        if ( $r['gambar'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/gambar_produk/'.$r['gambar'].'"><img src="'.$url.'/gambar_produk/'.$r['gambar'].'" width="50px" height="50px"></a></center>';
                        }?></td>
                <td><?php echo $r["kd_produk"]; ?></td>
                <td><?php echo $r["nama_produk"]; ?></td>
                <td><?php echo rupiah ($r['harga_beli']);?></td>
                <td><?php echo rupiah ($r['jual_umum']);?></td>  
 <td><?php echo rupiah ($r['jual_bpjs']);?></td> 
 <td><?php echo rupiah ($r['jual_lain']);?></td>   
                <?php $q1 = mysqli_query($con, "SELECT *FROM kategori WHERE id_kategori='$r[id_kategori]'"); 
                 $k = mysqli_fetch_array($q1); ?>
                <td><?php echo $k['kategori']; ?></td>
                <?php $q2 = mysqli_query($con, "SELECT *FROM data_satuan WHERE id_s='$r[id_satuan]'"); 
                 $j = mysqli_fetch_array($q2); ?>
                <td><?php echo $j['satuan']; ?></td>
            <td>
                     
                     <a href="?module=produk&act=edit_produk&id_produk=<?php echo $r["kd_produk"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/produk/aksi_produk.php?module=produk&act=hapus&kd_produk=<?php echo $r['kd_produk']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
               
      </tr>
    <?php
            }
          }
          else{
        ?>
        <tr class="gradeX">
          <td colspan="10" align="center">Data Tidak ditemukan</td>
        </tr>
        <?php
          }
        ?>
    </tbody>
                </table>
     </div>
     <div class="row" style="float: right;margin-right: 0px;">
              <ul class="pagination">
                <li class="paginate_button">
                        <a class="page-link" href="?module=produk&pageno=<?php echo 1; ?>">First</a>
                    </li>
                <?php
                  $brake = $pageno+2;
                  if($pageno <= 3){
                    $start = 1;
                  }
                  else{
                    $start = $pageno-2;
                    ?>
                <li class="paginate_button">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?module=produk&pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                    <li class="paginate_button disabled"><a class="page-link">...</a></li>
                    <?php
                  }
                  for ($i=$start; $i <= $brake ; $i++) {
                    if($pageno >= $total_pages){
                        $brake = $total_pages;
                      }
                      else{
                        $brake = $pageno+2;
                      }
                      ?>
                    <li class="paginate_button <?php if($i == $pageno){echo"active";} ?>"><a class="page-link" href="?module=produk&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                  }
                  if($pageno > 3) {
                 ?>
                 <li class="paginate_button disabled"><a class="page-link">...</a></li>
                 <li><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?module=produk&pageno=".($pageno + 1); } ?>">Next</a></li>
               <?php } ?>
                 <li class="paginate_button">
                        <a class="page-link" href="?module=produk&pageno=<?php echo $total_pages; ?>">Last</a>
                    </li>
                </ul>
            </div>
   </div></div></div>

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
  case "tambah_produk":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Produk Apotik</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/produk/aksi_produk.php?module=produk&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Produk</label>
                <input type="text" class="form-control" name="kd_produk" required/>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk" required/>
              </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan Produk</label>
                <select type="text" name="satuan" id="satuan" style="width: 90%;" class="form-control" >
                     <option value="">Satuan</option>
                      <?php $query = mysqli_query($con, "SELECT *FROM data_satuan");
                         while ($cb = mysqli_fetch_array($query)) { ?>
                           <option value="<?php echo $cb['id_s']; ?>"><?php echo $cb['satuan']; ?></option>
                        <?php  } ?> 
                    </select>
              </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Produk</label>
                <select type="text" name="kategori" id="kategori" style="width: 90%;" class="form-control"  >
                     <option value="">Kategori</option>
                      <?php $query = mysqli_query($con, "SELECT *FROM kategori");
                         while ($cb = mysqli_fetch_array($query)) { ?>
                           <option value="<?php echo $cb['id_kategori']; ?>"><?php echo $cb['kategori']; ?></option>
                        <?php  } ?> 
                    </select>
              </div>
              </div>
            </div>
            
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Beli</label>
                <input type="number" class="form-control" name="harga_beli" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual Umum</label>
                <input type="number" class="form-control" name="harga_jual" required/>
              </div>
              </div>
			   <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual BPJS</label>
                <input type="number" class="form-control" name="harga_bpjs" required/>
              </div>
              </div>
			   <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual Asuransi Lainnya</label>
                <input type="number" class="form-control" name="harga_asuransilainnya" required/>
              </div>
              </div>
            </div>
            <div class="form-group">
                <label>Upload Gambar</label>
                <input class="form-control"  type="file" name="file" value="<?php echo $edit['gambar'];?>">
              </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=produk"><button type="button" class="btn btn-danger">Batal</button></a>
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
  case "edit_produk":
  $id_produk   = $_GET['id_produk'];
  $edit   = mysqli_fetch_array(mysqli_query($con, "Select * From produk_master Where kd_produk='$id_produk'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Produk</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/produk/aksi_produk.php?module=produk&act=update">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Produk</label>
                <input type="hidden" class="form-control" name="id_produk"  value="<?php echo $edit['id_produk']; ?>" />
                <input type="text" class="form-control" name="kd_produk"  value="<?php echo $edit['kd_produk']; ?>" />
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Produk</label>
                <input type="text" class="form-control" name="nama_produk"  value="<?php echo $edit['nama_produk']; ?>" required/>
              </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan Produk</label>
                <select type="text" name="satuan" id="satuan" style="width: 90%;" class="form-control">
                <option value="">--silakan pilih--</option>
                  
                      <?php $query = mysqli_query($con, "SELECT *FROM data_satuan");
                         while ($cb = mysqli_fetch_array($query)) { ?>
                         <?php $sel = $edit['id_satuan'] == $cb['id_s']? "selected" : ""; ?>
                           <option value="<?php echo $cb['id_s']; ?>" <?php echo $sel; ?>><?php echo $cb['satuan']; ?></option>
                        <?php  } ?> 
                    </select>
              </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kategori Produk</label>
                <select type="text" name="kategori" id="kategori" style="width: 90%;" class="form-control">
                <option value="">--silakan pilih--</option>
                      <?php $query = mysqli_query($con, "SELECT *FROM kategori");
                         while ($cb = mysqli_fetch_array($query)) { ?>
                          <?php $sel = $edit['id_kategori'] == $cb['id_kategori']? "selected" : ""; ?>
                           <option value="<?php echo $cb['id_kategori']; ?>" <?php echo $sel; ?>><?php echo $cb['kategori']; ?></option>
                        <?php  } ?> 
                    </select>
              </div>
              </div>
            </div>

            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Beli</label>
                <input type="text" class="form-control" name="harga_beli"  value="<?php echo $edit['harga_beli']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual Umum</label>
                <input type="text" class="form-control" name="harga_jual"  value="<?php echo $edit['jual_umum']; ?>" />
              </div>
              </div>
            </div>
			  <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual BPJS</label>
                <input type="number" class="form-control" name="harga_bpjs" value="<?php echo $edit['jual_bpjs']; ?>" />
              </div>
              </div>
			   <div class="col-md-12">
              <div class="form-group">
                <label>Harga Jual Asuransi Lainnya</label>
                <input type="number" class="form-control" name="harga_asuransilainnya" value="<?php echo $edit['jual_lain']; ?>" />
              </div>
              </div>
            <div class="form-group">
                <label>Upload Gambar</label>
                <input class="form-control"  type="file" name="file" value="<?php echo $edit['gambar'];?>">
              </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=produk"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" name="submit" class="btn btn-success">Simpan</button>
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
<style type="text/css">
  #cssTable th 
  {
    text-align: center; 
    vertical-align: middle;
  }
</style>