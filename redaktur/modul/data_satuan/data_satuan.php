<?php
	switch($_GET['act']){
	default:
?>
<section class="content">
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=data_satuan&act=tambah_ds"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Satuan</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Satuan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Satuan</th>
                 <!-- <th>Manfaat</th>
                 <th>Harga</th>
                 <th>Aksi</th> -->
               
            </tr>
        </thead>
    	<tbody>
		<?php
		$tampil		= mysqli_query($con, "Select * From data_satuan Where id_s");
		while($r	= mysqli_fetch_array($tampil)){
    ?>
			<tr class="gradeX">
                 
            <td><?php echo $r["satuan"]; ?></td>
            <!-- <td><?php echo $r["manfaat"] ?></td>
            <td><?php echo $r["harga"]; ?></td> -->
            <td>
                     
                     <a href="?module=data_satuan&act=edit_ds&id=<?php echo $r["id_s"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/data_satuan/aksi_data_satuan.php?module=ds&act=hapus&id=<?php echo $r['id_s']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
	case "tambah_ds":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Satuan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/data_satuan/aksi_data_satuan.php?module=ds&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan" required/>
              </div>
              </div>
            </div>
             <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Manfaat</label>
              <textarea name="manfaat" required class="form-control"></textarea>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga</label>
              <input name="kapasitas" required class="form-control"/>
              </div>
              </div>
            </div> -->
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=data_satuan"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_ds":
	$id		= $_GET['id'];
	$edit 	= mysqli_fetch_array(mysqli_query($con, "Select * From data_satuan Where id_s='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Satuan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/data_satuan/aksi_data_satuan.php?module=ds&act=update">
          <input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Satuan</label>
                <input type="text" class="form-control" name="satuan"  value="<?php echo $edit['satuan']; ?>" required/>
              </div>
              </div>
            </div>
            <!-- <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Manfaat</label>
                <textarea type="text" class="form-control" name="manfaat"  value="<?php echo $edit['manfaat']; ?>" required></textarea>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga</label>
                <input type="text" class="form-control" name="harga"  value="<?php echo $edit['harga']; ?>" required/>
              </div>
              </div>
            </div> -->
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=data_satuan"><button type="button" class="btn btn-danger">Batal</button></a>
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