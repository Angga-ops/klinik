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
               <a href="?module=jenis_ruangan&act=tambah_jr"> <button type="button" class="btn btn-warning btn-sm">Tambah Jenis Ruangan</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jenis Ruangan</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
                <th>Poli</th>
                <th>Jenis Ruangan</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php
            $tampil		= mysql_query("Select nama_poli, id_jenkamar, kelas From tujuan, kamar_jenis Where tujuan.id_poli=kamar_jenis.id_poli");
            while($r	= mysql_fetch_array($tampil)){
        ?>
			<tr class="gradeX">
                 <td>
                     
                     <a href="?module=jenis_ruangan&act=edit_jr&id=<?php echo $r["id_jenkamar"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_jenis_ruangan/aksi_jenis_ruangan.php?module=ruangan&act=hapus&id=<?php echo $r["id_jenkamar"]; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
                <td><?php echo $r['nama_poli']; ?></td>
                <td><?php echo $r['kelas']; ?></td>
               
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
	case "tambah_jr":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jenis Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_jenis_ruangan/aksi_jenis_ruangan.php?module=ruangan&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Poli</label>
                <select name="tujuan" class="form-control" required>
                  <option value="">--Pilih Poli--</option>
                <?php
                    $sql 		= mysql_query("Select * From tujuan Where aktif='Y' Order by id_poli");
                    $idbaru 	= sprintf("%03s", $nourut);
                    while ($w	= mysql_fetch_array($sql)) {
                ?>
                <option value=<?php echo $w['id_poli']; ?>><?php echo $w['nama_poli']; ?></option>
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
                <label>Jenis Ruangan</label>
               <input type="text" class="form-control" name="nama" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=jenis_ruangan"><button type="button" class="btn btn-danger">Batal</button></a>
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
   
</div> -->
<?php
	break;
    case "edit_jr":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From kamar_jenis Where id_jenkamar='$id'"));
?>


<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Jenis Ruangan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_jenis_ruangan/aksi_jenis_ruangan.php?module=ruangan&act=edit">
             <input type="hidden" name="id" value="<?php echo $id; ?>" readonly="readonly" />
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Poli</label>
                <select name="tujuan" class="form-control" required>
                <?php
                    $poli	= mysql_query("Select * From tujuan");
                    if ($edit['id_poli'] == '') {
                ?>
                    <option value="" selected>-- Pilih Poli --</option>
                <?php
                }
                    while ($edit_poli 		= mysql_fetch_array($poli)) {
                    if ($edit['id_poli']	== $edit_poli['id_poli']) {
                    ?>
                        <option value="<?php echo $edit_poli['id_poli']; ?>" selected><?php echo $edit_poli['nama_poli']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_poli['id_poli']; ?>"><?php echo $edit_poli['nama_poli']; ?></option>
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
                <label>Jenis Ruangan</label>
               <input type="text" class="form-control" name="nama" required value="<?php echo $edit['kelas']; ?>"/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=jenis_ruangan"><button type="button" class="btn btn-danger">Batal</button></a>
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