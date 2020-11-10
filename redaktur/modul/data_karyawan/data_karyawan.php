<?php
    switch($_GET['act']){
    default:
?>




<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
            <?php
if ($_SESSION['jenis_u'] == 'JU-01'){?>
	<a href="?module=data_karyawan&act=tambah_karyawan"> <button type="button" class="btn btn-warning btn-sm">Tambah Karyawan</button></a>
<?php } Else { ?>
Note : Untuk menambahkan data atau pindah kerja cabang karyawan silahkan hubungi admin/owner
<?php } ?>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Karyawan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
              <th>Foto</th>
              
               <th>Nama Karyawan</th>
               <th>JK</th>
               <th>No Telepon</th>
               <th>Tgl Masuk</th>
               <th>Lama Kerja</th>
               <th>Bagian</th>
               <th>Status</th>
               <th>Aksi</th>
               
            </tr>
        </thead>
        <tbody>
        <?php
		if ($_SESSION['jenis_u'] == 'JU-01'){
            $tampil     = mysql_query("Select * From karyawan");
		} else if (($_SESSION['jenis_u'] != 'JU-01') OR ($_SESSION['jenis_u'] != 'JU-02') ){
			$tampil     = mysql_query("Select * From karyawan");
		}
            while($data = mysql_fetch_array($tampil)){
        ?>
            <tr class="gradeX">
              <td><?php
                        if ( $data['foto'] == '') {
                            echo "Tidak Ada Foto";
                        }else{
                            echo '<a href="'.$url.'/foto_karyawan/'.$data['foto'].'"><img src="'.$url.'/foto_karyawan/'.$data['foto'].'" width="80px" height="80px"></a>';
                        }?></td>
              <?php $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$data[id_kk]'"); 
                 $k = mysql_fetch_array($q1);
                   $bg=mysql_fetch_array(mysql_query("SELECT * FROM jenis_user WHERE id_ju='$data[id_ju]'"));
				 ?>
              
             <td><?php echo $data['nama_karyawan']; ?></td>
             <td><?php echo $data['jk']; ?></td>
             <td><?php echo $data['no_telp']; ?></td>
             <td><?php echo $data['tgl_masuk']; ?></td>
             <td><?php $awal = date_create($data['tgl_masuk']);
                $akhir= date_create();
                $diff = date_diff($awal,$akhir);
                $lama = $diff->y.'tahun,'.$diff->m.'bulan,'.$diff->d.'hari';
                echo $lama; ?>
                </td>
            
             <td><?php echo $bg['nama_ju']; ?></td>
             <td>
              <?php if ($data['status'] == "Aktif") {
                echo ' <a href="#" class="btn btn-success btn-xs col-md-12"> Aktif</a></td>';
              }else{
                echo ' <a href="#" class="btn btn-danger btn-xs col-md-12"> Tidak Aktif</a></td>';
              }
             ?>
             <td>
              <?php
				if ($_SESSION['id_user']==$data['id_karyawan']){?>
			  <a href="?module=data_karyawan&act=edit_karyawan&id_karyawan=<?php echo $data["id_karyawan"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;
				<?php } ?>
				<?php if($_SESSION['jenis_u']=='JU-01'){ ?>
				 <a href="?module=data_karyawan&act=edit_karyawan&id_karyawan=<?php echo $data["id_karyawan"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;
			  <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/data_karyawan/aksi_data_karyawan.php?module=data_karyawan&act=hapus&id_karyawan=<?php echo $data['id_karyawan']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
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
    case "tambah_karyawan":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Karyawan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/data_karyawan/aksi_data_karyawan.php?module=data_karyawan&act=input">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Klinik</label>
                <select class="form-control" name="klinik" required>
               
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik"); 
                      while($k = mysql_fetch_array($q1)){ ?>

                      <option value="<?php echo $k[id_kk]; ?>"><?php echo $k["nama_klinik"]; ?></option>
                      <?php 
                    }
                ?>
              </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Nama Karyawan </label>
               <input type="text" class="form-control" name="nama_karyawan" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Jenis Kelamin </label>
               <select class="form-control" name="jk" required="">
                 <option>Jenis Kelamin</option>
                 <option value="L">Laki Laki</option>
                 <option value="P">Perempuan</option>
               </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Tgl Lahir </label>
               <input type="date" class="form-control" name="tgl_lahir" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Jenis User</label>
                <select name="bagian" class="form-control" required>
                   <option value="">-- Pilih Jenis --</option>
      <?php
        $data     = mysql_query("Select * From jenis_user WHERE (id_ju!='JU-01') AND (id_ju!='JU-02')");            
              while($hasil  = mysql_fetch_array($data)){
      ?>
        <option value="<?php echo $hasil['id_ju']; ?>"><?php echo $hasil['nama_ju']; ?></option>            
            <?php
        }
      ?>
                </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Tanggal Masuk </label>
               <input type="date" class="form-control" name="tgl_masuk" value="<?php echo date('Y-m-d');?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Alamat </label>
               <input type="text" class="form-control" name="alamat" required/>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Lulusan </label>
               <input type="text" class="form-control" name="lulusan" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Status</label>
               <select class="form-control" name="status" required="">
                 <option value="Aktif">Aktif</option>
                 <option value="Nonaktif">Nonaktif</option>
               </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Username </label>
               <input type="text" class="form-control" name="username" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Password </label>
               <input type="text" class="form-control" name="password" required/>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Blokir</label>
               <select class="form-control" name="blokir" required="">
                 <option value="N" checked>N</option>
                 <option value="Y">Y</option>
               </select>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>No. Telp </label>
               <input type="number" class="form-control" name="no_telp" required/>
              </div>
              </div>
              <div class="col-md-6">
              <div class="form-group">
                <label>Upload Foto</label>
                <input  type="file" name="file">
              </div>
              </div>
            </div>
              <div class="form-group">
               <a href="?module=data_karyawan"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
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
    case "edit_karyawan":
    $id     = $_GET["id_karyawan"];
    $edit   =  mysql_fetch_array(mysql_query("Select * From karyawan Where id_karyawan='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Karyawan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/data_karyawan/aksi_data_karyawan.php?module=data_karyawan&act=update">
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label> Klinik</label>
                <select class="form-control" name="klinik" required>
                <option value="<?php echo $edit['id_kk']?>">
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik"); 
                      while($k = mysql_fetch_array($q1)){ ?>
                        <?php echo $k['nama_klinik']?></option>
                      <option value="<?php echo $k[id_kk]; ?>"><?php echo $k["nama_klinik"]; ?></option>
                      <?php 
                    }
                ?>
              </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Nama Karyawan </label>
                <input type="hidden" class="form-control" name="id_karyawan" value="<?php echo $edit['id_karyawan']?>" required/>
               <input type="text" class="form-control" name="nama_karyawan" value="<?php echo $edit['nama_karyawan']?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Jenis Kelamin </label>
               <select class="form-control" name="jk" required="">
                 
                 <?php 
                 if ($edit['jk'] == "L") {
                   echo '<option value="L">Laki Laki</option>';
                 }else{
                  echo '<option value="P">Perempuan</option>';
                 }?>
                 <option value="L">Laki Laki</option>
                 <option value="P">Perempuan</option>
               </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Tgl Lahir </label>
               <input type="date" class="form-control" name="tgl_lahir" value="<?php echo $edit['tgl_lahir']?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>No. Telp </label>
               <input type="number" class="form-control" name="no_telp" value="<?php echo $edit['no_telp']?>" required/>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Jenis User</label>
                <select name="bagian" class="form-control" required>
                  
      <?php
        $data     = mysql_query("Select * From jenis_user WHERE (id_ju!='JU-01') AND (id_ju!='JU-02')");            
              while($hasil  = mysql_fetch_array($data)){
          if($hasil['id_ju']==$edit['id_ju']){
      ?>
        <option value="<?php echo $hasil['id_ju']; ?>" checked><?php echo $hasil['nama_ju']; ?></option>            
          <?php }else { ?>
          <option value="">-- Pilih Jenis --</option>
          <option value="<?php echo $hasil['id_ju']; ?>" ><?php echo $hasil['nama_ju']; ?></option>  
      <?php }
        }
      ?>
                </select>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Tanggal Masuk </label>
               <input type="date" class="form-control" name="tgl_masuk" value="<?php echo $edit['tgl_masuk']?>" required/>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Alamat </label>
               <input type="text" class="form-control" name="alamat" value="<?php echo $edit['alamat']?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Lulusan </label>
               <input type="text" class="form-control" name="lulusan" value="<?php echo $edit['lulusan']?>" required/>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Status</label>
               <select class="form-control" name="status" value="<?php echo $edit['status']?>" required="">
                <?php 
                 if ($edit['jk'] == "L") {
                   echo '<option value="Aktif">Aktif</option>';
                 }else{
                  echo '<option value="Nonaktif">Nonaktif</option>';
                 }?>
                 <option value="Aktif">Aktif</option>
                 <option value="Nonaktif">Nonaktif</option>
               </select>
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Username </label>
               <input type="text" class="form-control" name="username" value="<?php echo $edit['username']?>" />
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Password </label>
               <input type="text" class="form-control" name="password" />
              </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-6">
                <div class="form-group">
                <label>Blokir</label>
               <select class="form-control" name="blokir" >
                <?php 
                 if ($edit['blokir'] == "N") {
                   echo '<option value="N" cheked>N</option>';
            echo '<option value="Y">Y</option>';
                 }else{
            echo '<option value="N">N</option>';
                  echo '<option value="Y" cheked>Y</option>';
                 }?>
                 <option value="Aktif">Aktif</option>
                 <option value="Nonaktif">Nonaktif</option>
               </select>
              </div>
              </div>
              <div class="col-md-6">
                <div class="form-group">
                <label>Upload Foto</label>

                <input type="file" name="file"  value="<?php echo $edit['foto']?>">
              </div>
              </div>
            </div>
              <div class="form-group">
               <a href="?module=data_karyawan"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" name="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
              </div>
        </div>
        </div>
    </div>
</section>
<script>
  function jenis(){
    $("#jeniss").val($("#jenis").val());
  }
  window.onload=jenis();
</script>
<?php
    break;
    }
?>