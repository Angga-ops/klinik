<?php    
  switch($_GET['act']){
  default:
?>


<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=data_dokter&act=tambah_dokter"> <button type="button" class="btn btn-warning btn-sm">Tambah Dokter</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                <th>Foto</th>
            <th>Cabang Klinik</th> 
            <th>Nama Lengkap</th>
            <th>Tanggal Masuk</th>
            <th>Lama Pengadian</th>
            <th>Lulusan</th>
            <th>Alamat</th> 
            <th>Email</th>
            <th>Blokir</th>
            <?php
              if ($_SESSION['jenis_u']=="JU-01") {
            ?>
            <th>Aksi</th>
          <?php } ?>
               
            </tr>
        </thead>
      <tbody>
    <?php
    $id_kk = $_SESSION["klinik"];
    if ($_SESSION['jenis_u']!="JU-01") {
      $tampil   = mysql_query("Select * From  user Where id_ju='JU-02' AND id_kk='$id_kk'");
    }else{
      $tampil   = mysql_query("Select * From  user Where id_ju='JU-02'");
    }
  

  while($data = mysql_fetch_array($tampil)){
?>  
      <tr class="gradeX">
                      <td><?php
                        if ( $data['foto'] == '') {
                            echo "Belum Ada Foto";
                        }else{
                            echo '<center><a href="'.$url.'/file_user/foto_user/'.$data['foto'].'"><img src="'.$url.'/file_user/foto_user/'.$data['foto'].'" width="50px" height="50px"></a></center>';
                        }?></td>
        <?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$data[id_kk]'"); 
                 $k = mysql_fetch_array($q1); ?>
        <td><?php echo $k['nama_klinik']; ?></td>
        <td><?php echo $data['nama_lengkap']; ?></td>
        <td><?php echo $data['tgl_masuk']; ?></td>
        <td><?php $awal = date_create($data['tgl_masuk']);
                $akhir= date_create();
                $diff = date_diff($awal,$akhir);
                $lama = $diff->y.'tahun,'.$diff->m.'bulan,'.$diff->d.'hari';
                echo $lama; ?>
                </td>
                <td><?php echo $data['lulusan']; ?></td>
                <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['email']; ?></td>
        
        <td align="center"><center><?php echo $data['blokir']; ?></center></td> 
        <td>
                     <?php
                     if ($_SESSION['jenis_u'] =="JU-01") { ?>
                     <a href="?module=data_dokter&act=edit_dokter&id=<?php echo $data['id_user']; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/data_dokter/aksi_data_dokter.php?module=user&act=hapus&id=<?php echo $data['id_user']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     <?php } ?>
                  
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
   case "tambah_dokter":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Dokter</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/data_dokter/aksi_data_dokter.php?module=dokter&act=input">
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Nama Lengkap</label>
                 <input type="text" class="form-control" name="nama" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Cabang Klinik</label>
                  <select name="cabang" class="form-control" required>
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
              <div class="row" style="display: none;">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
                <select name="jenis_user" class="form-control" required>
                   <option value="JU-02"> Dokter</option>
      <?php
        $data     = mysql_query("Select * From jenis_user Where id_ju='JU-02'");            
              while($hasil  = mysql_fetch_array($data)){
      ?>
        <option value="<?php echo $hasil['id_ju']; ?>"><?php echo $hasil['nama_ju']; ?></option>            
            <?php
        }
      ?>
                </select>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
               <input type="text" class="form-control" name="username" required/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
               <input type="password" class="form-control" name="password" required/>
              </div>
            </div>
          </div>
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Email</label>
                 <input type="email" class="form-control" name="email" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Tanggal Masuk</label>
                 <input type="text" class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d');?>" required/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Lulusan</label>
                 <input type="text" class="form-control" name="lulusan" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Alamat</label>
                 <input type="text" class="form-control" name="alamat" required/>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>No. Telp/HP</label>
                 <input type="number" class="form-control" name="kontak" required/>
                </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                  <label>Upload Foto</label>
                  <input type="file" name="fupload" required />
                </div>
              </div>
            </div>
             <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                  <label>Status User</label>
                  <select name="status" class="form-control" required>
                  <option value="">-- Pilih Status --</option>
                  <option value="N">Aktif</option>
                  <option value="Y">Blokir</option>
                  </select>  
                </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=user"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              </div>
            </div></form>
              </div>
        </div>
        </div>
    </div>
</section>

<!-- -->
<?php  
  break;
  case "edit_dokter":
  $id   = $_GET['id'];
  $data = mysql_fetch_array(mysql_query("Select * From user Where id_user='$id'"));
?> 

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Dokter</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/data_dokter/aksi_data_dokter.php?module=dokter&act=edit">
              <input type="hidden" name="id" size="25" value="<?php echo $id; ?>" readonly="readonly" />
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Nama Lengkap</label>
               <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_lengkap']; ?>" required/>
              </div>
            </div>
            <div class="col-md-6">
              <div class="form-group">
                <label>Jenis Cabang</label>
                <select name="id_kk" class="form-control" required>
                 <?php
                    $ca   = mysql_query("Select * From daftar_klinik");
                    if ($data['id_kk'] == '') {
                ?>
                    <option value="" selected>-- Pilih Cabang --</option>
                <?php
                }
                    while ($edit_ca   = mysql_fetch_array($ca)) {
                    if ($data['id_kk']  == $edit_ca['id_kk']) {
                    ?>
                        <option value="<?php echo $edit_kk['id_kk']; ?>" selected><?php echo $edit_kk['nama_klinik']; ?></option>
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
                <div class="col-md-12" style="display: none;">
                  <div class="form-group">
                    <label>Jenis User</label>
                    <select name="jenis_user" class="form-control" required>
                      <option value="<?php echo $data['id_ju']; ?>"><?php if($data['id_ju']){
                        echo'Dokter';
                      } ?></option>
                    </select>
                  </div>
                </div>
              </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Username</label>
               <input type="text" class="form-control" name="username"  value="<?php echo $data['username']; ?>" required/>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Password</label>
               <input type="password" class="form-control" name="password"  />
                  <small>Kosongkan jika tidak diubah</small>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Email</label>
               <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>" required/>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>No. Telp/HP</label>
               <input type="number" class="form-control" name="kontak"  value="<?php echo $data['no_telp']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Tanggal Masuk</label>
               <input type="text" class="form-control" name="tgl_masuk"  value="<?php echo $data['tgl_masuk']; ?>" required/>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Lulusan</label>
               <input type="text" class="form-control" name="lulusan"  value="<?php echo $data['lulusan']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Alamat</label>
               <input type="text" class="form-control" name="alamat"  value="<?php echo $data['alamat']; ?>" required/>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Status User</label>
               <select name="status" class="form-control" required>
              <option value="">-- Pilih Status --</option>
                <option value="Y" <?php if ($data['blokir'] == 'Y') { echo "selected"; } ?>>Blokir</option>
                <option value="N" <?php if ($data['blokir'] == 'N') { echo "selected"; } ?>>Aktif</option>
            </select>  
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-6">
              <div class="form-group">
                <label>Upload Foto</label>
                   <img src="../file_user/foto_user/<?php echo $data['foto']; ?>" width="100" />
                <input type="file" name="fupload"  />
                  <small>Kosongkan jika tidak diganti</small>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=user"><button type="button" class="btn btn-danger">Batal</button></a>
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
    <div class='grid_12'>
    <div class="block-border">
        <div class="block-header">    
        <h1>EDIT USER</h1>
        </div>
    <div class="block-content">     
    <form method="post" action="modul/mod_user/aksi_user.php?module=user&act=edit" enctype="multipart/form-data">   
        <p class="inline-small-label"> 
            <label for="field4">Jenis User</label>
            <select name="jenis_user" required>
        <?php
                    $ju   = mysql_query("Select * From jenis_user");
                    if ($data['id_ju'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_ju   = mysql_fetch_array($ju)) {
                    if ($data['id_ju']  == $edit_ju['id_ju']) {
                    ?>
                        <option value="<?php echo $edit_ju['id_ju']; ?>" selected><?php echo $edit_ju['nama_ju']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_ju['id_ju']; ?>"><?php echo $edit_ju['nama_ju']; ?></option>
                    <?php
                    }
                    }
                ?>
      </select>
    </p>
        <p class="inline-small-label"> 
            <label for="field4">Username</label>
            <input type="hidden" name="id" size="25" value="<?php echo $id; ?>" readonly="readonly" />
            <input type="text" name="username" size="25" value="<?php echo $data['username']; ?>" required />
        </p> 
        <p class="inline-small-label"> 
            <label for="field4">Password</label>
            <input type="password" name="password" size="25" /> <br> Password diisi jika ingin diganti
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">Nama Lengkap</label>
            <input type="text" name="nama" size="25"  value="<?php echo $data['nama_lengkap']; ?>" required />
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">E-mail</label>
            <input type="email" name="email" size="25" value="<?php echo $data['email']; ?>" required />
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">No. Telp/HP</label>
            <input type="text" name="kontak" size="25" value="<?php echo $data['no_telp']; ?>" required />
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">Status User</label>
            <select name="status" required>
              <option value="">-- Pilih Status --</option>
                <option value="Y" <?php if ($data['blokir'] == 'Y') { echo "selected"; } ?>>Blokir</option>
                <option value="N" <?php if ($data['blokir'] == 'N') { echo "selected"; } ?>>Aktif</option>
            </select>
        </p>    
        <p class="inline-small-label"> 
            <label for="field4">Foto</label>
            <img src="../foto_user/<?php echo $data['foto']; ?>" width="100" />
        </p>       
        <p class="inline-small-label"> 
        <span class="label">Ganti Foto</span>
        <input type="file" name="fupload" />
        </p>
    <div class="block-actions"> 
        <ul class="actions-right"> 
            <li>
            <a class="button red" id="reset-validate-form" href="?module=users">Batal</a>
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