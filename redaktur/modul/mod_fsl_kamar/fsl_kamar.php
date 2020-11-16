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
         <div class="callout callout-success">
               <a href="?module=fsl_kamar&act=tambah_dk"> <button type="button" class="btn btn-warning btn-sm">Tambah Fasilitas Ruangan</button></a>
                <a target="_blank" href="report/rpt_fsl_kmr.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Data Fasilitas</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Fasilitas Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
                 <th>Ruangan</th>
            <th>Keadaan</th>
            <th>Fasilitas</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
		$tampil		= mysqli_query($con, "Select * From kamar, detail_kamar Where detail_kamar.id_kamar=kamar.id_kamar");
		while($r	= mysqli_fetch_array($tampil)){
    ?>
			<tr class="gradeX">
                 <td>
                     
                     <a href="?module=fsl_kamar&act=edit_dk&id=<?php echo $r["id_dk"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_fsl_kamar/aksi_fsl_kamar.php?module=dk&act=hapus&id=<?php echo $r['id_dk']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
                <td><?php echo $r["nama_kamar"]; ?></td>
            <td><?php echo $r["keadaan"] ?></td>
            <td><?php echo $r["fasilitas"] ?></td>
               
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
	case "tambah_dk":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Fasilitas Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_fsl_kamar/aksi_fsl_kamar.php?module=dk&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kamar</label>
                <select name="kamar" class="form-control" required>
                  <option value="">-- Pilih --</option>
                 <?php $nama_kamar = mysqli_query($con, "Select * From kamar");
                while ($r = mysqli_fetch_array($nama_kamar)) {
                ?>
                <option value="<?php echo $r["id_kamar"]; ?>"><?php echo $r["nama_kamar"]; ?></option>
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
                <label>Keadaan</label>
               <input type="text" class="form-control" name="keadaan" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Fasilitas</label>
              <textarea name="fasilitas" required class="form-control"></textarea>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=fsl_kamar"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_dk":
	$id		= $_GET['id'];
	$edit 	= mysqli_fetch_array(mysqli_query($con, "Select * From detail_kamar Where id_dk='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Fasilitas Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_fsl_kamar/aksi_fsl_kamar.php?module=dk&act=update">
            	<input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kamar</label>
                <select name="kamar" class="form-control" required>
                 <?php
                    $jr	= mysqli_query($con, "Select * From kamar");
                    if ($edit['id_kamar'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr 		= mysqli_fetch_array($jr)) {
                    if ($edit['id_kamar']	== $edit_jr['id_kamar']) {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>" selected><?php echo $edit_jr['nama_kamar']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>"><?php echo $edit_jr['nama_kamar']; ?></option>
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
                <label>Keadaan</label>
               <input type="text" class="form-control" name="keadaan"  value="<?php echo $edit['keadaan']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Fasilitas</label>
              <textarea name="fasilitas" required class="form-control"><?php echo $edit['fasilitas']; ?></textarea>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=fsl_kamar"><button type="button" class="btn btn-danger">Batal</button></a>
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
        <h1>EDIT FASILITAS KAMAR</h1>
        </div>
    <div class="block-content">
    <form method="POST" enctype="multipart/form-data" action="modul/mod_fsl_kamar/aksi_fsl_kamar.php?module=dk&act=update">
		<input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
        <p class="inline-small-label">
            <label for="field4">Kamar</label>
            <select name="kamar">
				<?php
                    $jr	= mysqli_query($con, "Select * From kamar");
                    if ($edit['id_kamar'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr 		= mysqli_fetch_array($jr)) {
                    if ($edit['id_kamar']	== $edit_jr['id_kamar']) {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>" selected><?php echo $edit_jr['nama_kamar']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_jr['id_kamar']; ?>"><?php echo $edit_jr['nama_kamar']; ?></option>
                    <?php
                    }
                    }
                ?>
            </select>
        </p>        
        <p class="inline-small-label">
            <label for="field4">Keadaan</label>
            <input type="text" size="25" name="keadaan" value="<?php echo $edit['keadaan']; ?>" reuired />
        </p>        
        <p class="inline-small-label">
            <label for="field4">Fasilitas</label>
			<textarea name="fasilitas" reuired><?php echo $edit['fasilitas']; ?></textarea>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=fsl_kamar">Batal</a>
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