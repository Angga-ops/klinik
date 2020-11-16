<?php
  switch($_GET['act']){
  default:
?>



<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Pasien</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Nama User</th>
                 <th>Email</th>
                 <th>No Hp</th>
                 <th>Status</th>
                 <th>Foto</th>
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysqli_query($con, "Select * From user");
    while($r  = mysqli_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                 
            <td><?php echo $r["nama_lengkap"]; ?></td>
            <td><?php echo $r["email"] ?></td>
            <td><?php echo $r["no_telp"] ?></td>
            <td><?php echo $r["blokir"] ?></td>
            <td><?php echo $r["foto"] ?></td>
               
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

<?php
  break;
  }
?>


