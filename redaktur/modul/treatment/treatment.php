<?php
	switch($_GET['act']){
	default:
?>
<section class="content">
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=treatment&act=tambah_dt"> <button type="button" class="btn btn-warning btn-sm">Tambah Biaya Tindakan</button></a>
                

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Daftar Tindakan</h3>
            </div>
            <!-- /.box-header -->
            <form method="POST" action="">
            <div class="row">
              <div class="col-md-8" style="margin-left: 10px;">
                <div class="input-group input-group-sm">
                <input type="text" class="form-control" name="cari" placeholder="cari tindakan...">
                    <span class="input-group-btn">
                      <button type="submit" class="btn btn-info btn-flat" name="submitbutton" value="submit"><span class="fa fa-search"></span> Cari</button>
                    </span>
              </div>
              </div>
            </div>
            </form>
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table class="table table-bordered table-striped" id="cssTable">
                  <thead>
            <tr>
            <th>Kategori</th>
                 <th>Nama Tindakan</th>
                 <th>Manfaat</th>
                 <th>Modal</th>
                 <th>Harga Umum</th>
                 <th>Harga BPJS</th>
                 <th>Harga Asuransi Lain</th>
                 <th>Jasa Dokter</th>
                 <th>Aksi</th>
               
            </tr>
        </thead>
    	<tbody>
		<?php

      if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
      } else {
          $pageno = 1;
      }
      $no_of_records_per_page = 10;
      $offset = ($pageno-1) * $no_of_records_per_page;

      $cari = $_POST['cari'];
      $total_pages_sql  = mysqli_query($con,"SELECT * FROM treatment WHERE nama_t LIKE '%$cari%'");

      //$result = mysql_query($total_pages_sql);
      $total_rows = mysqli_num_rows($total_pages_sql);
      $total_pages = ceil($total_rows / $no_of_records_per_page);

        $data  = mysqli_query($con,"SELECT * FROM treatment WHERE nama_t LIKE '%$cari%' ORDER BY nama_t ASC LIMIT $offset, $no_of_records_per_page");

        if(mysqli_num_rows($data) > 0){
		while($r	= mysqli_fetch_array($data)){
      $kat = mysqli_fetch_assoc(mysqli_query($con,"SELECT kategori FROM kategori_biaya WHERE id = '$r[kategori]'"));
    ?>
			<tr class="gradeX">
      <td><?php echo $kat["kategori"]; ?></td>     
            <td><?php echo $r["nama_t"]; ?></td>
            <td><?php echo $r["manfaat"] ?></td>
            <td><?php echo $r["modal"] ?></td>
            <td><?php echo rupiah($r["harga"]); ?></td>
            <td><?php echo rupiah($r["bpjs"]); ?></td>
            <td><?php echo rupiah($r["lain"]); ?></td>
            <td><?php echo rupiah($r["jasa_dokter"]); ?></td>
            <td>
                     
                     <a href="?module=treatment&act=edit_dt&id=<?php echo $r["id"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/treatment/aksi_treatment.php?module=dt&act=hapus&id=<?php echo $r['id']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>
                     
                  
                </td>
               
			</tr>
		<?php
            }
          }
          else{ ?>
            <tr class="gradeX">
              <td colspan="10" align="center">Data Tidak ditemukan</td>
            </tr>
          <?php }
        ?>
		</tbody>
                </table>
     </div>
     <div class="row" style="float: right;margin-right: 0px;">
          <ul class="pagination">
            <li class="paginate_button">
                    <a class="page-link" href="?module=treatment&pageno=<?php echo 1; ?>">First</a>
                </li>
            <?php
              $brake = $pageno+2;
              if($pageno <= 3){
                $start = 1;
              }
              else{
                $start = $pageno-2;
                ?>
                <li class="paginate_button">
                    <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "?module=treatment&pageno=".($pageno - 1); } ?>">Prev</a>
                </li>
                <li class="paginate_button disabled"><a class="page-link">...</a></li>
                <?php
              }
              for ($i=$start; $i <= $brake ; $i++) {
                if($pageno >= $total_pages){
                    $brake = $total_pages;
                  }
                  else{
                    $brake = $pageno+2;
                  }
                  ?>
                <li class="paginate_button <?php if($i == $pageno){echo"active";} ?>"><a class="page-link" href="?module=treatment&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                <?php
              }
              if($pageno > 3){
             ?>
             <li class="paginate_button disabled"><a class="page-link">...</a></li>
             <li><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "?module=treatment&pageno=".($pageno + 1); } ?>">Next</a></li>
           <?php } ?> 
             <li class="paginate_button">
                    <a class="page-link" href="?module=treatment&pageno=<?php echo $total_pages; ?>">Last</a>
                </li>
            </ul>
        </div>
   </div></div></div>

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
	case "tambah_dt":
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Daftar Tindakan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/treatment/aksi_treatment.php?module=dt&act=input">
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Kategori</label>
               <select class="form-control" name="kategori" required>
               <option value="">--silakan pilih--</option>
               <?php 
               
               $j = mysqli_query($con,"SELECT * FROM kategori_biaya");
               while($jo = mysqli_fetch_assoc($j)){
                 echo "<option value='$jo[id]'>$jo[kategori]</option>";
               }
               
               ?>
               </select>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Tindakan</label>
                <input type="text" class="form-control" name="nama_t" required/>
              </div>
              </div>
            </div>
             <div class="row">
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
                <label>Modal</label>
              <input type="number" name="modal" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien Umum</label>
              <input type="number" name="umum" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien BPJS</label>
              <input type="number" name="bpjs" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien Asuransi Lain</label>
              <input type="number" name="lain" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jasa Dokter</label>
              <input type="number" name="jasa" required class="form-control"/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=treatment"><button type="button" class="btn btn-danger">Batal</button></a>
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
	case "edit_dt":
	$id		= $_GET['id'];
	$edit 	= mysqli_fetch_array(mysqli_query($con,"Select * From treatment Where id='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Daftar Tindakan</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/treatment/aksi_treatment.php?module=dt&act=update">
            	<input type="hidden" size="25" value="<?php echo $id; ?>" name="id" readonly="readonly" />
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Kategori</label>
               <select class="form-control" name="kategori" required>
               <option value="">--silakan pilih--</option>
               <?php 
               
               $j = mysqli_query($con,"SELECT * FROM kategori_biaya");
               while($jo = mysqli_fetch_assoc($j)){
                 $sel = ($edit['kategori'] == $jo['id'])? "selected" : "";
                 echo "<option value='$jo[id]' $sel>$jo[kategori]</option>";
               }
               
               ?>
               </select>
              </div>
              </div>
            </div>
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Tindakan</label>
                <input type="text" class="form-control" name="nama_t"  value="<?php echo $edit['nama_t']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Manfaat</label>
                <input type="text" class="form-control" name="manfaat"  value="<?php echo $edit['manfaat']; ?>" required>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Modal</label>
              <input name="modal" type="number" value="<?php echo $edit['modal']; ?>" required class="form-control"/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien Umum</label>
                <input type="number" class="form-control" name="umum"  value="<?php echo $edit['harga']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien BPJS</label>
                <input type="number" class="form-control" name="bpjs"  value="<?php echo $edit['bpjs']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Harga Pasien Asuransi Lain</label>
                <input type="number" class="form-control" name="lain"  value="<?php echo $edit['lain']; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jasa Dokter</label>
                <input type="number" class="form-control" name="jasa"  value="<?php echo $edit['jasa_dokter']; ?>" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <a href="?module=treatment"><button type="button" class="btn btn-danger">Batal</button></a>
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
                    $jr	= mysqli_query($con,"Select * From kamar");
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
<style type="text/css">
  #cssTable th 
  {
    text-align: center; 
    vertical-align: middle;
  }
</style>