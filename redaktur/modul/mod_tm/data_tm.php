<?php
	switch($_GET["act"]){
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
               <a href="?module=tenaga_medis&act=tambah_tm"> <button type="button" class="btn btn-warning btn-sm">Tambah Tenaga Medis</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Tenaga Medis</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
                <th>Golongan</th>
            <th>No. Induk</th>
            <th>Tenaga Medis</th>
            <th>Alamat</th>
            <th>Telepon</th>
            <th>Biaya Praktik</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
	$tampil		= mysql_query("Select nama_goltm, no_idk, nama_tm, alamat, kontak, biaya_praktik From medis, gol_tm Where gol_tm.id_goltm=medis.id_goltm");
    while($edit	= mysql_fetch_array($tampil)){
    ?>
			<tr class="gradeX">
                 <td>
                     
                     <a href="?module=tenaga_medis&act=edit_tm&id=<?php echo $edit["no_idk"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_tm/aksi_tm.php?module=tm&act=hapus&id=<?php echo $edit["no_idk"]; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
               <td><?php echo $edit['nama_goltm']; ?></td>
            <td><?php echo $edit['no_idk']; ?></td>
            <td><?php echo $edit['nama_tm']; ?></td>
            <td><?php echo $edit['alamat']; ?></td>
            <td><?php echo $edit['kontak']; ?></td>
            <td><?php echo rupiah($edit['biaya_praktik']); ?></td>
               
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
	case "tambah_tm":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Tenaga Medis</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_tm/aksi_tm.php?module=tm&act=input">
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No. Induk</label>
               <input type="text" class="form-control" name="no_idk" required/>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Gol T.M.</label>
                <select name="gol_tm" class="form-control" required>
                   <option value="">-- Pilih Golongan --</option>
                <?php 
                 $kategor 	= mysql_query("SELECT * FROM gol_tm");
                 while	($k	= mysql_fetch_array($kategor)) {
                ?>
                <option value="<?php echo $k["id_goltm"] ?>"><?php echo $k["nama_goltm"] ?></option>
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
                <label>Nama</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              </div>
            </div>
           
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
               <input type="text" class="form-control" name="alamat" required/>
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
                <label>Biaya Praktik</label>
               <input type="text" class="form-control" name="biaya" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=tenaga_medis"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_tm":
	$idk	= $_GET["id"];
	$edit	= mysql_fetch_array(mysql_query("Select * From medis Where no_idk='$idk'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Tenaga Medis</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_tm/aksi_tm.php?module=tm&act=edit">
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No. Induk</label>
               <input type="text" class="form-control" name="no_idk" value="<?php echo $idk; ?>" required/>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Gol T.M.</label>
                <select name="gol_tm" class="form-control" required>
                <?php
                    $goltm	= mysql_query("Select * From gol_tm");
                    if ($edit['id_goltm'] == '') {
                ?>
                    <option value="" selected>-- Pilih Golongan --</option>
                <?php
                }
                    while ($edit_goltm 		= mysql_fetch_array($goltm)) {
                    if ($edit['id_goltm']	== $edit_goltm['id_goltm']) {
                    ?>
                        <option value="<?php echo $edit_goltm['id_goltm']; ?>" selected><?php echo $edit_goltm['nama_goltm']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_goltm['id_goltm']; ?>"><?php echo $edit_goltm['nama_goltm']; ?></option>
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
                <label>Nama</label>
               <input type="text" class="form-control" name="nama" value="<?php echo $edit["nama_tm"]; ?>" required/>
              </div>
              </div>
            </div>
           
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
               <input type="text" class="form-control" name="alamat"  value="<?php echo $edit["alamat"]; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No. Telp/HP</label>
               <input type="text" class="form-control" name="kontak"  value="<?php echo $edit["kontak"]; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Biaya Praktik</label>
               <input type="text" class="form-control" name="biaya"  value="<?php echo $edit['biaya_praktik']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=tenaga_medis"><button type="button" class="btn btn-danger">Batal</button></a>
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
        <h1>EDIT TENAGA MEDIS</h1>
        </div>
    <div class="block-content">
    <form method="post" action="modul/mod_tm/aksi_tm.php?module=tm&act=edit" enctype="multipart/form-data">    
        <p class="inline-small-label">
            <label for="field4">No. Induk</label>
            <input type="text" name="no_idk" size="25" style="text-align:center;" value="<?php echo $idk; ?>" readonly="readonly">
        </p>
        <p class="inline-small-label">
            <label for="field4">Golongan T.M.</label>
            <select name="gol_tm" required>
				<?php
                    $goltm	= mysql_query("Select * From gol_tm");
                    if ($edit['id_goltm'] == '') {
                ?>
                    <option value="" selected>-- Pilih Golongan --</option>
                <?php
                }
                    while ($edit_goltm 		= mysql_fetch_array($goltm)) {
                    if ($edit['id_goltm']	== $edit_goltm['id_goltm']) {
                    ?>
                        <option value="<?php echo $edit_goltm['id_goltm']; ?>" selected><?php echo $edit_goltm['nama_goltm']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_goltm['id_goltm']; ?>"><?php echo $edit_goltm['nama_goltm']; ?></option>
                    <?php
                    }
                    }
                ?>
            </select>
        </p>
        <p class="inline-small-label">
            <label for="field4">Nama</label>
            <input type="text" name="nama" size="25" style="text-align:center;" value="<?php echo $edit["nama_tm"]; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Alamat</label>
            <input type="text" name="alamat" size="25" style="text-align:center;" value="<?php echo $edit["alamat"]; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">No.Telp/HP</label>
            <input type="text" name="kontak" size="25" style="text-align:center;" value="<?php echo $edit["kontak"]; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Biaya Praktik</label>
            <input type="text" name="biaya" size="25" style="text-align:center;" value="<?php echo $edit['biaya_praktik']; ?>" required />
        </p>
	<div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=tenaga_medis">Batal</a>
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