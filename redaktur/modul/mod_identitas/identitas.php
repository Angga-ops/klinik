<?php    
	switch($_GET['act']){
	default:
?>

<section class="content-header">
    
<?php 
    
$bc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
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
    
   

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Identitas</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
               <th>Nama Organisasi</th> 
            <th>Nama Web</th> 
            <th>Alamat</th>
            <th>Informasi</th> 
            <th>Logo</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
	$tampil 	= mysqli_query($con, "Select * From identitas");
	while($data	= mysqli_fetch_array($tampil)){
?>
			<tr class="gradeX">
                 <td>
                     
                     <a href="?module=identitas&act=edit&id=<?php echo $data['id']; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
                     
                  
                </td>
                <td><?php echo $data['nama_organisasi']; ?></td>
        <td><?php echo $data['nama_web']; ?></td>
        <td><?php echo $data['alamat']; ?></td>
        <td><?php echo $data['informasi']; ?></td>
        <td><center><?php
                        if ( $data['logo'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/file_user/foto_identitas/'.$data['logo'].'"><img src="'.$url.'/file_user/foto_identitas/'.$data['logo'].'" width="50px" height="50px"></a></center>';
                        }?></center></td>
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
   case "edit":
   $id	= $_GET['id'];
   $edit	= mysqli_fetch_array(mysqli_query($con, "Select * From identitas Where id='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Identitas</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_identitas/aksi_identitas.php?module=iden&act=edit">
             <input type="hidden" name="id" size="25" value="<?php echo $id; ?>" required />
         
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Organisasi</label>
               <input type="text" class="form-control" name="nama_organisasi" size="25" value="<?php echo $edit['nama_organisasi']; ?>" required/>
              </div>
              </div>
            </div>
            
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Web</label>
               <input type="text" class="form-control" name="nama_web" size="25" value="<?php echo $edit['nama_web']; ?>" required/>
              </div>
              </div>
            </div>
            
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
              <textarea name="alamat" class="form-control" required><?php echo $edit['alamat']; ?></textarea>
              </div>
              </div>
            </div>
            
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Informasi</label>
              <textarea name="informasi" class="form-control" required><?php echo $edit['informasi']; ?></textarea>
              </div>
              </div>
            </div>
            
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Logo</label>
              <input type="file" name="fupload" />
              </div>
              </div>
            </div>
            
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=identitas"><button type="button" class="btn btn-danger">Batal</button></a>
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
        <h1>EDIT IDENTITAS</h1>
        </div>
    <div class="block-content">
    <form method="post" action="modul/mod_identitas/aksi_identitas.php?module=iden&act=edit" enctype="multipart/form-data">    
        <p class="inline-small-label"> 
            <label for="field4">Organisasi</label>
            <input type="hidden" name="id" size="25" value="<?php echo $id; ?>" required />
            <input type="text" name="nama_organisasi" size="25" value="<?php echo $edit['nama_organisasi']; ?>" required />
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">Nama Web</label>
            <input type="text" name="nama_web" size="25" value="<?php echo $edit['nama_web']; ?>" required />
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">Alamat</label>
			<textarea name="alamat" required><?php echo $edit['alamat']; ?></textarea>
        </p>     
        <p class="inline-small-label"> 
            <label for="field4">Informasi</label>
			<textarea name="informasi" required><?php echo $edit['informasi']; ?></textarea>
        </p>     
        <p class="inline-small-label"> 
            <span class="label">Upload Logo</span>
            <input type="file" name="fupload" />
        </p>	  
    <div class="block-actions"> 
        <ul class="actions-right"> 
            <li>
            <a class="button red" id="reset-validate-form" href="?module=user">Batal</a>
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