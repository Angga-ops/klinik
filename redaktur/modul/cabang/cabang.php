<?php
	switch($_GET['act']){
	default:
?>




<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=cabang&act=tambah_ca"> <button type="button" class="btn btn-warning btn-sm">Tambah Cabang Klinik</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Cabang Klinik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
               <th>Nama Cabang</th>
               <th>Alamat </th>
               <th>Jenis</th>
               <th>Telpon</th>
               <th>Penanggung Jawab</th>
               <th>Aksi</th>
            </tr>
        </thead>
    	<tbody>
		<?php
            $tampil		= mysql_query("Select * From daftar_klinik");
            while($data	= mysql_fetch_array($tampil)){
        ?>
			<tr class="gradeX">
                 
             <td><?php echo $data['nama_klinik']; ?></td>
             <td><?php echo $data['alamat']; ?></td>
             <td><?php echo $data['jenis']; ?></td>
             <td><?php echo $data['telepon']; ?></td>
             <td><?php echo $data['penanggung_jawab']; ?></td>
             <td>
                     
                     <a href="?module=cabang&act=edit_ca&id=<?php echo $data["id_kk"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/cabang/aksi_cabang.php?module=ca&act=hapus&id=<?php echo $data["id_kk"]; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
	case "tambah_ca":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Klinik</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/cabang/aksi_cabang.php?module=ca&act=input">
              <div class="form-group">
                <label>Nama Klinik</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              <div class="form-group">
                <label>Alamat </label>
               <input type="text" class="form-control" name="alamat" required/>
              </div>
              <div class="form-group">
                <label>Jenis </label>
               <select class="form-control" name="jenis">
                 <option value="Cabang">Cabang</option>
               </select>
              </div>
              <div class="form-group">
                <label>Telepon </label>
               <input type="text" class="form-control" name="tlp" required/>
              </div>
              <div class="form-group">
                <label>Penanggung Jawab </label>
               <input type="text" class="form-control" name="penanggung_jwb" required/>
              </div>
              <div class="form-group">
               <a href="?module=cabang"><button type="button" class="btn btn-danger">Batal</button></a>
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
    case "edit_ca":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From daftar_klinik Where id_kk='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Cabang Klinik</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/cabang/aksi_cabang.php?module=ca&act=edit">
             <input type="hidden" name="id" value="<?php echo $id; ?>" readonly="readonly" />
             <input type="hidden" id="jenis" value="<?php echo $edit['jenis']; ?>" readonly="readonly" />
             
              <div class="form-group">
                <label>Nama Klinik</label>
               <input type="text" class="form-control" name="nama"  value="<?php echo $edit['nama_klinik']; ?>" required/>
              </div>
              <div class="form-group">
                <label>Alamat </label>
               <input type="text" class="form-control" name="alamat"  value="<?php echo $edit['alamat']; ?>" required/>
              </div>
              <div class="form-group">
                <label>Jenis</label>
               <select id="jeniss" name="jenis" class="form-control">
                 <option value="Pusat">Pusat</option>
                 <option value="Cabang Pusat">Cabang Pusat</option>
                 <option value="Cabang">Cabang</option>
               </select>
              </div>
              <div class="form-group">
                <label>Telepon </label>
               <input type="text" class="form-control" name="tlp"  value="<?php echo $edit['telepon']; ?>" required/>
              </div>
              <div class="form-group">
                <label>Penanggung Jawab </label>
               <input type="text" class="form-control" name="penanggung_jwb"  value="<?php echo $edit['penanggung_jawab']; ?>" required/>
              </div>
              <div class="form-group">
               <a href="?module=cabang"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div></form>
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