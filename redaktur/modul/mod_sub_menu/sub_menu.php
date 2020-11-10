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
               <a href="?module=sub_menu&act=tambah_sbm"> <button type="button" class="btn btn-warning btn-sm">Tambah Sub Menu</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Sub Menu</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
               <th>Menu</th>
                <th>Sub Menu</th>
                <th>Link/Page</th>
                <th>Status</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
            $menu		= mysql_query("Select * From sub_menu, menu Where sub_menu.id_sm=menu.id_sm");
            while($data	= mysql_fetch_array($menu)){
        ?>
			<tr class="gradeX">
                 <td>
                     
                     <a href="?module=sub_menu&act=edit_sbm&id=<?php echo $data['id_menu']; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_sub_menu/aksi_sub_menu.php?module=sbm&act=hapus&id=<?php echo $data['id_menu']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
            <td><?php echo $data['nama_sm']; ?></td>
                <td><?php echo $data['nama_menu']; ?></td>
                <td><?php echo $data['page_menu']; ?></td>
                <td><?php echo $data['sts_menu']; ?></td>
               
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
	case "tambah_sbm":
?>

 <section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Sub Menu</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_sub_menu/aksi_sub_menu.php?module=sbm&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Menu</label>
                <select name="menu" class="form-control" required>
                  <option value="">-- Pilih --</option>
                 <?php
					$selectidmax 	= mysql_query("Select max(id_menu) as id From menu Where id_menu Like '%MN-%'");
					$hsilidmax		= mysql_fetch_array($selectidmax);
					$idmax 			= $hsilidmax['id'];
					$nourut 		= (int) substr($idmax, 3,2);
					$nourut++;
					$kode			= "MN-".sprintf("%02s", $nourut);
                    $sql 			= mysql_query("SELECT * From sub_menu where page_sm IN ('#','') Order by nama_sm Asc");
                    while($data		= mysql_fetch_array($sql)) {
               ?>
                <option value=<?php echo $data['id_sm']; ?>><?php echo $data['nama_sm']; ?></option>
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
                <label>Id Sub Menu</label>
               <input type="text" class="form-control"  name="id" value="<?php echo $kode; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Sub Menu</label>
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
                <label>Status Sub Menu</label>
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
               <a href="?module=sub_menu"><button type="button" class="btn btn-danger">Batal</button></a>
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
    case "edit_sbm":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From menu Where id_menu='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Sub Menu</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_sub_menu/aksi_sub_menu.php?module=sbm&act=edit">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Menu</label>
                <select name="menu" class="form-control" required>
                <?php
                    $sm		= mysql_query("Select * From sub_menu Order by nama_sm Asc");
                    if ($edit['id_sm'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_sm 	= mysql_fetch_array($sm)) {
                    if ($edit['id_sm']	== $edit_sm['id_sm']) {
                    ?>
                        <option value="<?php echo $edit_sm['id_sm']; ?>" selected><?php echo $edit_sm['nama_sm']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_sm['id_sm']; ?>"><?php echo $edit_sm['nama_sm']; ?></option>
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
                <label>Id Sub Menu</label>
               <input type="text" class="form-control"  name="id" value="<?php echo $edit['id_menu']; ?>"  required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Sub Menu</label>
               <input type="text" class="form-control" name="nama"  value="<?php echo $edit['nama_menu']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Link Page</label>
               <input type="text" class="form-control" name="page"  value="<?php echo $edit['page_menu']; ?>" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Status Sub Menu</label>
              <select name="status" class="form-control" required>
            	<option value="">-- Pilih Status --</option>
                <option value="Aktif" <?php if ($edit['sts_menu'] == 'Aktif') { echo "selected"; } ?>>Aktif</option>
                <option value="Non Aktif" <?php if ($edit['sts_menu'] == 'Non Aktif') { echo "selected"; } ?>>Non Aktif</option>
            </select>  
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=sub_menu"><button type="button" class="btn btn-danger">Batal</button></a>
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
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>EDIT SUB MENU</h1>
        </div>
    <div class="block-content">
	<form method="POST" enctype="multipart/form-data" action="modul/mod_sub_menu/aksi_sub_menu.php?module=sbm&act=edit">
        <p class="inline-small-label">
            <label for="field4">Menu</label>
            <select name="menu" required>
				<?php
                    $sm		= mysql_query("Select * From sub_menu Order by nama_sm Asc");
                    if ($edit['id_sm'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_sm 	= mysql_fetch_array($sm)) {
                    if ($edit['id_sm']	== $edit_sm['id_sm']) {
                    ?>
                        <option value="<?php echo $edit_sm['id_sm']; ?>" selected><?php echo $edit_sm['nama_sm']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_sm['id_sm']; ?>"><?php echo $edit_sm['nama_sm']; ?></option>
                    <?php
                    }
                    }
                ?>
			</select>
		</p>
        <p class="inline-small-label">
            <label for="field4">Id. Sub Menu</label>
            <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $edit['id_menu']; ?>" readonly="readonly" />
        </p>
        <p class="inline-small-label">
            <label for="field4">Sub Menu</label>
            <input type="text" size="25" style="text-align:center;" name="nama" value="<?php echo $edit['nama_menu']; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Link/Page</label>
            <input type="text" size="25" style="text-align:center;" name="page" value="<?php echo $edit['page_menu']; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Status Sub Menu</label>
            <select name="status" required>
            	<option value="">-- Pilih Status --</option>
                <option value="Aktif" <?php if ($edit['sts_menu'] == 'Aktif') { echo "selected"; } ?>>Aktif</option>
                <option value="Non Aktif" <?php if ($edit['sts_menu'] == 'Non Aktif') { echo "selected"; } ?>>Non Aktif</option>
            </select>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=sub_menu">Batal</a>
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