<?php 
$act = $_GET['act'];
    switch ($act) {
        case 'edit':
    $id     = $_GET["id"];
    $edit   =  mysqli_fetch_array(mysqli_query($con,"SELECT * From daftar_klinik Where id_kk='$id'"));
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Menu</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
        <form method="post" enctype="multipart/form-data" action="modul/set_print/aksi.php?act=edit">
            <input type="hidden" name="id" value="<?php echo $edit['id_kk']; ?>">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Printer</label>
               <input type="text" class="form-control"  name="nama" value="<?php echo $edit['printer_kasir']; ?>" required/>
              </div>
              </div>
            </div>
            <button type="button" class="btn btn-danger btn-sm" onclick="window.history.back();">Batal</button>
            <button type="submit" class="btn btn-sm btn-success">Simpan</button>
     </form>
              </div>
        </div>
        </div>
    </div>
</section>
<?php
            break;
        
        default:
?>
<section class="content">

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Setting Printer</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table class="table table-bordered table-striped datatable2">
                  <thead>
            <tr>
                <th>Pilihan</th>
                <th>Nama Printer</th>
            </tr>
        </thead>
        <tbody>
        <?php
            $q      = mysqli_query($con,"SELECT * FROM daftar_klinik WHERE id_kk='$_SESSION[klinik]'");
            while($data = mysqli_fetch_array($q)){
        ?>
            <tr class="gradeX">
        <td>
          <a href="?module=set_print&act=edit&id=<?php echo $data['id_kk']; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>
        </td>
        <td><?php echo $data['printer_kasir']; ?></td>    
            </tr>  
        <?php
            }
        ?>
        </tbody>
                </table>
     </div>
 </div>
</div>
</div>
</section>
<?php
            break;
    }
?>
