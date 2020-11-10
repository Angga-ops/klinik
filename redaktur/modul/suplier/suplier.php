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
               <a href="?module=suplier&act=tambah_sup"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Suplier</button></a>
                <!-- <a target="_blank" href="report/rpt_alat_klinik.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Data Alat Klinik</button></a> -->

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Suplier</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Nama Perusahaan</th>
                 <th>Alamat</th>
                 <th>Telpon</th>
                 <th>Email</th>
                 <th>Penanggung Jawab</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
		$tampil		= mysql_query("Select * From suplier Where id_sup");
		while($r	= mysql_fetch_array($tampil)){
    ?>
			<tr class="gradeX">
                 
                <td><?php echo $r["nama_sup"]; ?></td>
                <td><?php echo $r["alamat"]; ?></td>
                <td><?php echo $r["tlp"] ?></td>
                <td><?php echo $r["email"] ?></td>
                <td><?php echo $r["penanggung_jwb"] ?></td>
            <td>
                     
                     <a href="?module=suplier&act=edit_sup&id=<?php echo $r["id_sup"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/suplier/aksi_suplier.php?module=sup&act=hapus&id=<?php echo $r['id_sup']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
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
	case "tambah_sup":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Suplier</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/suplier/aksi_suplier.php?module=sup&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" name="nama_sup" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
              <textarea name="alamat" required class="form-control"></textarea>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="tlp" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Penanggung Jawab</label>
                <input type="text" class="form-control" name="penanggung_jwb" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=suplier"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_sup":
	$id		= $_GET['id'];
	$edit 	= mysql_fetch_array(mysql_query("Select * From suplier Where id_sup='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Suplier</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/suplier/aksi_suplier.php?module=sup&act=update">
            	<input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Perusahaan</label>
                <input type="text" class="form-control" name="nama_sup"  value="<?php echo $edit['nama_sup']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat</label>
              <textarea name="alamat" required class="form-control"><?php echo $edit['alamat']; ?></textarea>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Telepon</label>
                <input type="text" class="form-control" name="tlp"  value="<?php echo $edit['tlp']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" name="email"  value="<?php echo $edit['email']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Penanggung Jawab</label>
                <input type="text" class="form-control" name="penanggung_jwb"  value="<?php echo $edit['penanggung_jwb']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=suplier"><button type="button" class="btn btn-danger">Batal</button></a>
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
                    $jr	= mysql_query("Select * From kamar");
                    if ($edit['id_kamar'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr 		= mysql_fetch_array($jr)) {
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