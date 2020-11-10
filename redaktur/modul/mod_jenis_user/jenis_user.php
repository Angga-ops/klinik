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
               <a href="?module=jenis_user&act=tambah_ju"> <button type="button" class="btn btn-warning btn-sm">Tambah Jenis User</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jenis User</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
               <th>Id. Jenis</th>
                <th>Jenis User</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
            $tampil		= mysql_query("Select * From jenis_user order by id_ju ASC");
            while($data	= mysql_fetch_array($tampil)){
        ?>
			<tr class="gradeX">
                 <td>
                   <?php if(($data['id_ju']!= 'JU-01') AND ($data['id_ju']!='JU-02') AND ($data['id_ju']!='JU-06')){ ?>  
                     <a href="?module=jenis_user&act=edit_ju&id=<?php echo $data["id_ju"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_jenis_user/aksi_jenis_user.php?module=ju&act=hapus&id=<?php echo $data["id_ju"]; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                   <?php } else {
                   echo "Tidak Boleh di Hapus dan Edit";
                   
				   }					   ?>  
                  
                </td>
             <td><?php echo $data['id_ju']; ?></td>
                <td><?php echo $data['nama_ju']; ?></td>
               
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
	case "tambah_ju":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis User</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_jenis_user/aksi_jenis_user.php?module=ju&act=input">
            <?php
				$kode  	= buatKode('jenis_user','JU-');
			?>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Id Jenis</label>
               <input type="text" class="form-control" name="id" value="<?php echo $kode; ?>" readonly="readonly" required/>
              </div>
              </div>
            </div>
             
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              </div>
            </div>
        
           
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=jenis_user"><button type="button" class="btn btn-danger">Batal</button></a>
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
    case "edit_ju":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From jenis_user Where id_ju='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Jenis User</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_jenis_user/aksi_jenis_user.php?module=ju&act=edit">
             <input type="hidden" name="id" value="<?php echo $id; ?>" readonly="readonly" />
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Id Jenis</label>
               <input type="text" class="form-control" name="id"  value="<?php echo $id; ?>" readonly="readonly" required/>
              </div>
              </div>
            </div>
             
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis User</label>
               <input type="text" class="form-control" name="nama"  value="<?php echo $edit['nama_ju']; ?>" required/>
              </div>
              </div>
            </div>
        
           
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=jenis_user"><button type="button" class="btn btn-danger">Batal</button></a>
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
        <h1>EDIT JENIS USER</h1>
        </div>
    <div class="block-content">
	<form method="POST" enctype="multipart/form-data" action="modul/mod_jenis_user/aksi_jenis_user.php?module=ju&act=edit">
        <p class="inline-small-label">
            <label for="field4">Id. Jenis</label>
            <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $id; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Nama Jenis</label>
         
            <input type="text" size="25" style="text-align:center;" name="nama" value="<?php echo $edit['nama_ju']; ?>" required />
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=jenis_user">Batal</a>
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