<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=rekening&act=tambah_rekening"> <button type="button" class="btn btn-warning btn-sm">Tambah Rekening</button></a>

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
              <h3 class="box-title">Data Rekening</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                  <th>Klinik</th>
                 <th>Nama Bank</th>
                 <th>No rekening</th>
                 <th>Atas Nama</th>
                 <th>Aksi</th>
                 <!-- <th>Aksi</th> -->
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From rekening");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$r[id_kk]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k['nama_klinik']; ?></td>
                <td><?php echo $r['nama_bank']; ?></td>
                <td><?php echo $r['no_rek']; ?></td>
                <td><?php echo $r['atas_nama']; ?></td>
            <td>
                     
                     <a href="?module=rekening&act=edit_rekening&id_rekening=<?php echo $r["id_rekening"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/rekening/aksi_rekening.php?module=rekening&act=hapus&id_rekening=<?php echo $r['id_rekening']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
  case "tambah_rekening":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kategori Produk</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/rekening/aksi_rekening.php?module=rekening&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Cabang Klinik</label>
                <select name="klinik" class="form-control" required>
                   <option value="">-- Pilih Cabang --</option>
      <?php
        $data     = mysql_query("Select * From daftar_klinik");            
              while($hasil  = mysql_fetch_array($data)){
      ?>
        <option value="<?php echo $hasil['id_kk']; ?>"><?php echo $hasil['nama_klinik']; ?></option>            
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
                <label>Nama Bank</label>
                <input type="text" class="form-control" name="nama_bank" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No Rekening</label>
                <input type="number" class="form-control" name="no_rek" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Atas Nama</label>
                <input type="text" class="form-control" name="atas_nama" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=rekening"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" name="submits" class="btn btn-success">Simpan</button>
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
  case "edit_rekening":
  $id   = $_GET['id_rekening'];
  $edit   = mysql_fetch_array(mysql_query("Select * From rekening Where id_rekening='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Kategori Produk</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/rekening/aksi_rekening.php?module=rekening&act=update">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis Cabang</label>
                <select name="klinik" class="form-control" required>
                 <?php
                    $ca   = mysql_query("Select * From daftar_klinik");
                    if ($edit['id_kk'] =='') {
                ?>
                    <option value="" selected>-- Pilih Cabang --</option>
                <?php
                }
                    while ($edit_ca   = mysql_fetch_array($ca)) {
                    if ($edit_ca['id_kk']  == $edit['id_kk']) {
                    ?>
                        <option value="<?php echo $edit_ca['id_kk']; ?>" selected><?php echo $edit_ca['nama_klinik']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_ca['id_kk']; ?>"><?php echo $edit_ca['nama_klinik']; ?></option>
                    <?php
                    }
                    }
                ?>
                </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Bank</label>
                <input type="text" class="form-control" name="nama_bank" value="<?php echo $edit['nama_bank']?>" required/>
                <input type="hidden" class="form-control" name="id_rekening" value="<?php echo $edit['id_rekening']?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No Rekening</label>
                <input type="number" class="form-control" name="no_rek" value="<?php echo $edit['no_rek']?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Atas Nama</label>
                <input type="text" class="form-control" name="atas_nama" value="<?php echo $edit['atas_nama']?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=rekening"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" name="submits" class="btn btn-success">Simpan</button>
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