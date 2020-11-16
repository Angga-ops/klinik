<?php    
	switch($_GET['act']){
	default:
   $id_kk = $_SESSION['klinik'];
?>

<section class="content-header">
    
<?php 
    
$bc = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
    ?>    
    
      <h1>
        <?php echo $bc['crumb']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo $bc['crumb']; ?></li>
      </ol>
    </section>

<section class="content">
    
 <!--   <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=setuser_cabang&act=tambah_user"> <button type="button" class="btn btn-warning btn-sm">Tambah User</button></a>

    </div>
        </div>
    </div> -->

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
            <th>Jenis User</th>
            <th>Cabang Klinik</th> 
            <th>Nama Lengkap</th> 
            <th>Telpon</th>
            <th>Foto</th>
            <th>Blokir</th> 
            <th>Aksi</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
		if($_SESSION['jenis_u']=='JU-01'){
	$tampil 	= mysqli_query($con,"SELECT * From jenis_user JOIN user Where jenis_user.id_ju=user.id_ju ");
		}else {
			$tampil 	= mysqli_query($con,"SELECT * From jenis_user JOIN karyawan Where jenis_user.id_ju=karyawan.id_ju AND id_karyawan='$_SESSION[id_user]' ");
		}
	while($data	= mysqli_fetch_array($tampil)){
?>	
			<tr class="gradeX">
                      
        <td><?php echo $data['nama_ju']; ?></td>
        <?php $q1 = mysqli_query($con,"SELECT * FROM daftar_klinik WHERE id_kk='$data[id_kk]'"); 
                 $k = mysqli_fetch_array($q1); ?>
        <td><?php echo $k['nama_klinik']; ?></td>
        <td><?php echo $data['nama_karyawan']; ?></td>
        <td><?php echo $data['no_telp']; ?></td>
        <td><center><img src='../foto_karyawan/<?php echo $data['foto']; ?>' width="50"></center></td>
        <td align="center"><center><?php echo $data['blokir']; ?></center></td> 
        <td>
             <?php if ($data['id_ju']!="JU-01" && $data['id_ju']!=$id_kk) {
              echo '
              <a href="?module=setuser_cabang&act=edit_user&id='.$data['id_karyawan'].'" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a> ';
             }else{
              echo " ";
             }
             ?>
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
   case "tambah_user":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah User</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/setuser_cabang/aksi_user.php?module=setuser_cabang&act=input">
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Lengkap</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
                <select name="jenis_user" class="form-control" required>
                   <option value="">-- Pilih Jenis --</option>
			<?php
				$data			= mysqli_query($con,"Select * From jenis_user");            
            	while($hasil	= mysqli_fetch_array($data)){
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
            <div class="col-md-12">
              <div class="form-group">
                <label>Cabang Klinik</label>
                <select name="cabang" class="form-control" required>
                   <option value="">-- Pilih Cabang --</option>
      <?php
        $data     = mysqli_query($con,"Select * From daftar_klinik");            
              while($hasil  = mysqli_fetch_array($data)){
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
                <label>Username</label>
               <input type="text" class="form-control" name="username" required/>
              </div>
              </div>
            </div>
        
           
           
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
               <input type="password" class="form-control" name="password" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
               <input type="text" class="form-control" name="email" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No. Telp/HP</label>
               <input type="text" class="form-control" name="kontak" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload Foto</label>
                <input type="file" name="fupload" required />
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
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
               <a href="?module=setuser_cabang"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" name="submit" class="btn btn-success">Simpan</button>
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
	case "edit_user":
	$id		= $_GET['id'];
	$data	= mysqli_fetch_array(mysqli_query($con,"Select * From karyawan Where id_karyawan='$id'"));
?> 

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit User</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/setuser_cabang/aksi_user.php?module=setuser_cabang&act=edit">
              <input type="hidden" name="id" size="25" value="<?php echo $id; ?>" readonly="readonly" />
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Lengkap</label>
               <input type="text" class="form-control" name="nama" value="<?php echo $data['nama_karyawan']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
                <select name="jenis_user" class="form-control" readonly>
                 <?php
                    $ju		= mysqli_query($con,"Select * From jenis_user WHERE id_ju='$data[id_ju]'");
                    if ($data['id_ju'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_ju 	= mysqli_fetch_array($ju)) {
                    if ($data['id_ju']	== $edit_ju['id_ju']) {
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
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis Cabang</label>
                <select name="cabang" class="form-control" readonly>
                 <?php
                    $ca   = mysqli_query($con,"Select * From daftar_klinik WHERE id_kk='$data[id_kk]'");
                    if ($data['id_kk'] =='') {
                ?>
                    <option value="" selected>-- Pilih Cabang --</option>
                <?php
                }
                    while ($edit_ca   = mysqli_fetch_array($ca)) {
                    if ($edit_ca['id_kk']  == $data['id_kk']) {
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
                <label>Username</label>
               <input type="text" class="form-control" name="username"  value="<?php echo $data['username']; ?>" readonly/>
              </div>
              </div>
            </div>
        
           
           
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Password</label>
               <input type="password" class="form-control" name="password"  />
                  <small>Kosongkan jika tidak diubah</small>
              </div>
              </div>
            </div>
           <!--  <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
               <input type="text" class="form-control" name="email" value="<?php echo $data['email']; ?>" required/>
              </div>
              </div>
            </div>-->
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No. Telp/HP</label>
               <input type="text" class="form-control" name="kontak"  value="<?php echo $data['no_telp']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Upload Foto</label>
                   <img src="../foto_karyawan/<?php echo $data['foto']; ?>" width="100" />
                <input type="file" name="fupload"  />
                  <small>Kosongkan jika tidak diganti</small>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Status User</label>
               <select name="status" class="form-control" readonly>
            	<option value="">-- Pilih Status --</option>
                <option value="Y" <?php if ($data['blokir'] == 'Y') { echo "selected"; } ?>>Blokir</option>
                <option value="N" <?php if ($data['blokir'] == 'N') { echo "selected"; } ?>>Aktif</option>
            </select>  
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=setuser_cabang"><button type="button" class="btn btn-danger">Batal</button></a>
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
                    $ju		= mysqli_query($con,"Select * From jenis_user");
                    if ($data['id_ju'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_ju 	= mysqli_fetch_array($ju)) {
                    if ($data['id_ju']	== $edit_ju['id_ju']) {
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