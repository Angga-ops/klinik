<?php
	switch($_GET['act']){
	default:
?>



<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=druangan&act=tambah_dr"> <button type="button" class="btn btn-warning btn-sm">Tambah Daftar Ruangan</button></a>
                <a target="_blank" href="report/rpt_druangan.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Daftar Ruangan</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Klinik</th>
                 <th>Nama Ruangan</th>
                 <th>Status</th>
                 <th>Kapasitas</th>
                 <th>Terpakai</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
		$tampil		= mysqli_query($con, "SELECT * From ruangan");
		while($r	= mysqli_fetch_array($tampil)){
    ?>
			<tr class="gradeX">
            <td><?php $k = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$r[id_kk]'")); echo $k['nama_klinik']; ?></td>
            <td><?php echo $r["nama_ruangan"]; ?></td>
            <td><?php echo $r["status"] ?></td>
            <td><?php echo $r["kapasitas"]; ?></td>
            <td><?php echo $r["terpakai"] ?></td>
            <td>
                     
                     <a href="?module=druangan&act=edit_dr&id=<?php echo $r["id"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/druangan/aksi_druangan.php?module=dr&act=hapus&id=<?php echo $r['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
	case "tambah_dr":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Daftar Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/druangan/aksi_druangan.php?module=dr&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Ruangan</label>
                <input type="text" class="form-control" name="nama_ruangan" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kapasitas</label>
              <input name="kapasitas" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label>Klinik</label>
              <select name="cabang" class="form-control">
                <option value="">Pillih Klinik</option>
                <?php $q1 = mysqli_query($con, "SELECT *FROM daftar_klinik"); 
                      while($dat = mysqli_fetch_array($q1)){ ?>
                        <option value="<?php echo $dat['id_kk']; ?>"><?php echo $dat['nama_klinik']; ?></option>
                        <?php
                      }
                ?> 
              </select>
            </div>
              <input type="hidden" name="terpakai" value="0" class="form-control"/>
              <input type="hidden" name="status" value="Kosong" class="form-control"/>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=druangan"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_dr":
	$id		= $_GET['id'];
	$edit 	= mysqli_fetch_array(mysqli_query($con, "Select * From ruangan Where id='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Daftar Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/druangan/aksi_druangan.php?module=dr&act=update">
            	<input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Ruangan</label>
                <input type="text" class="form-control" name="nama_ruangan"  value="<?php echo $edit['nama_ruangan']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kapasitas</label>
                <input type="text" class="form-control" name="kapasitas"  value="<?php echo $edit['kapasitas']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="form-group">
              <label>Klinik</label>
              <select name="cabang" class="form-control">
                <?php $q1 = mysqli_query($con, "SELECT *FROM daftar_klinik"); 
                      while($dat = mysqli_fetch_array($q1)){ 
                        if($edit['id_kk']==$dat['id_kk']){ ?>
                          <option selected value="<?php echo $dat['id_kk']; ?>"><?php echo $dat['nama_klinik']; ?></option>
                          <?php
                        }else{ ?>
                          <option value="<?php echo $dat['id_kk']; ?>"><?php echo $dat['nama_klinik']; ?></option>
                        <?php
                        }
                      }
                ?> 
              </select>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=druangan"><button type="button" class="btn btn-danger">Batal</button></a>
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