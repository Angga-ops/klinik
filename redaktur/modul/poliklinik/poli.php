

<section class="content">

<?php switch($_GET['act']){ 
    default:
    ?>
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
            	<a href="?module=poliklinik&act=tambah"> <button type="button" class="btn btn-warning btn-sm">Tambah Poliklinik</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Poliklinik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
              
               <th>Nama Poliklinik</th>
               <?php
                if ($_SESSION['jenis_u']=="JU-01") {
              ?>
               <th>Aksi</th>
               <?php } ?>
            </tr>
        </thead>
        <tbody>
                   <?php 
                   
                   $po = mysqli_query($con,"SELECT * FROM poliklinik");
                   while($li = mysqli_fetch_assoc($po)){
                       echo "<tr>";
                       echo "<td>$li[poli]</td>";
                      if ($_SESSION['jenis_u']=="JU-01") {
                         echo "<td><a href='media.php?module=poliklinik&id=$li[id_poli]&act=edit'><button class='btn btn-sm btn-info'>Edit</button></a>   <a href='modul/poliklinik/aksi.php?act=del&id=$li[id_poli]' onclick='return confirm(\"apakah akan menghapus?\")'><button class='btn btn-sm btn-danger'>Hapus</button></a></td>";
                         echo "</tr>";
                       }
                   }
                   
                   ?>
                </tbody>
                </table>
     </div></div></div></div>
<?php break;
      case "tambah": ?> 
      
      <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Poliklinik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="modul/poliklinik/aksi.php?act=add" method="POST">
            <table class="table">
            <tr>
            <td>Nama Poliklinik</td><td><input type="text" class="form-control" name="poli" required/></td>
            </tr>
            <tr>
            <td><a href="media.php?module=poliklinik"><button class="btn btn-danger" type="button">Batal</button></a> <button class="btn btn-success" type="submit">Simpan</button></td>
            </tr>
            </table>
            </form>
            </div>
</div>
</div>
</div>
      <?php break;
      case "edit": 
      $edit = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM poliklinik WHERE id_poli = '$_GET[id]'"));
      ?>
      
      <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Tambah Poliklinik</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <form action="modul/poliklinik/aksi.php?act=edit&id=<?php echo $_GET['id']; ?>" method="POST">
            <table class="table">
            <tr>
            <td>Nama Poliklinik</td><td><input type="text" class="form-control" name="poli" value="<?php echo $edit['poli']; ?>" required/></td>
            </tr>
            <tr>
            <td><a href="media.php?module=poliklinik"><button class="btn btn-danger" type="button">Batal</button></a> <button class="btn btn-success" type="submit">Simpan</button></td>
            </tr>
            </table>
            </form>
            </div>
</div>
</div>
</div>
      
       <?php break;
}
?>
</section>