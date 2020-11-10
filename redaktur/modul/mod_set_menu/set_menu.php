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
               <a href="?module=set_menu&act=tambah_sm"> <button type="button" class="btn btn-warning btn-sm">Tambah Menu</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                <th>Aksi</th>
                <th>Jenis User</th>
                <th>Nama Menu</th>
                <th>Link/Page</th>
                <th>Status</th>
                <th>Icon</th>
                <th>Urutan</th>
            </tr>
        </thead>
    	<tbody>
		<?php
            $menu		= mysql_query("Select * From sub_menu, jenis_user Where jenis_user.id_ju=sub_menu.id_ju");
            while($data	= mysql_fetch_array($menu)){
        ?>
			<tr class="gradeX">
        <td>
          <a href="?module=set_menu&act=edit_sm&id=<?php echo $data['id_sm']; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_set_menu/aksi_set_menu.php?module=sm&act=hapus&id=<?php echo $data['id_sm']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
        </td>
        <td><?php echo $data['nama_ju']; ?></td>
        <td><?php echo $data['nama_sm']; ?></td>
        <td><?php echo $data['page_sm']; ?></td>
        <td><?php echo $data['sts_sm']; ?></td>
        <td><?php echo $data['icon_fa']; ?></td>  
        <td><?php echo $data['urutan']; ?></td>       
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
	case "tambah_sm":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Menu</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_set_menu/aksi_set_menu.php?module=sm&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
                <select name="jenis_user" class="form-control" required>
                  <option value="">-- Pilih --</option>
                 <?php
					$selectidmax 	= mysql_query("Select max(id_sm) as id From sub_menu Where id_sm Like '%SM-%'");
					$hsilidmax		= mysql_fetch_array($selectidmax);
					$idmax 			= $hsilidmax['id'];
					$nourut 		= (int) substr($idmax, 3,2);
					$nourut++;
					$kode			= "SM-".sprintf("%02s", $nourut);
                    $sql 		= mysql_query("Select * From jenis_user Order by nama_ju Asc");
                    while($data	= mysql_fetch_array($sql)){
               ?>
                <option value=<?php echo $data['id_ju']; ?>><?php echo $data['nama_ju']; ?></option>
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
                <label>Id Menu</label>
               <input type="text" class="form-control"  name="id" value="<?php echo $kode; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Menu</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Link Page</label>
               <input type="text" class="form-control" name="page" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Status Menu</label>
              <select name="status" class="form-control" required>
            	<option value="">-- Pilih Status --</option>
            	<option value="Aktif">Aktif</option>
            	<option value="Non Aktif">Non Aktif</option>
            </select>  
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Icon (Fa)</label>
               <input type="text" class="form-control" name="icon" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Urutan</label>
               <input type="number" class="form-control" name="urutan" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=set_menu"><button type="button" class="btn btn-danger">Batal</button></a>
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
    case "edit_sm":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From sub_menu Where id_sm='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Menu</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_set_menu/aksi_set_menu.php?module=sm&act=edit">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
                <select name="jenis_user" class="form-control" required>
                <?php
                    $ju		= mysql_query("Select * From jenis_user Order by nama_ju Asc");
                    if ($edit['sub_menu'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_ju 		= mysql_fetch_array($ju)) {
                    if ($edit['id_ju']	== $edit_ju['id_ju']) {
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
                <label>Id Menu</label>
               <input type="text" class="form-control"  name="id" value="<?php echo $edit['id_sm']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Menu</label>
               <input type="text" class="form-control" name="nama"  value="<?php echo $edit['nama_sm']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Link Page</label>
               <input type="text" class="form-control" name="page"  value="<?php echo $edit['page_sm']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Status Menu</label>
              <select name="status" class="form-control" required>
            	<option value="">-- Pilih Status --</option>
                <option value="Aktif" <?php if ($edit['sts_sm'] == 'Aktif') { echo "selected"; } ?>>Aktif</option>
                <option value="Non Aktif" <?php if ($edit['sts_sm'] == 'Non Aktif') { echo "selected"; } ?>>Non Aktif</option>
            </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Icon (Fa)</label>
               <input type="text" class="form-control" name="icon" value="<?php echo $edit['icon_fa']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Urutan</label>
               <input type="number" class="form-control" name="urutan" value="<?php echo $edit['urutan']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=set_menu"><button type="button" class="btn btn-danger">Batal</button></a>
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
	}
?>