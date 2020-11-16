<section class="content">
    
    <div class="row">
    <div class="col-md-12">

        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Rujukan Pasien Rawat Inap</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                 <th>Aksi</th>
                 <th>Nama Pasien</th>
                 <th>ID Pasien</th>
                 <th>Poliklinik</th>
                 <th>Dokter Merujuk</th>
               
            </tr>
        </thead>
      <tbody>

<?php 

$j = mysqli_query($con,"SELECT * FROM rujuk_inap a JOIN antrian_pasien b ON a.antrian_pasien = b.id JOIN pasien c ON b.id_pasien = c.id_pasien JOIN user d ON b.id_dr = d.id_user JOIN poliklinik e ON b.poliklinik = e.id_poli");

while($ju = mysqli_fetch_assoc($j)){
    echo "<tr>";
    echo "<td><a href='#' data-target='#modal-default3' data-toggle='modal' onclick='pushit($ju[antrian_pasien])'><button class='btn btn-xs btn-success'>Tambah</button></a></td>";
    echo "<td>$ju[nama_pasien]</td>";
    echo "<td>$ju[id_pasien]</td>";
    echo "<td>$ju[poli]</td>";
    echo "<td>$ju[nama_lengkap]</td>";
    echo "</tr>";
}

?>




        </tbody>
                </table>
     </div></div></div></div>

     
<div class="modal fade" id="modal-default3">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Rujukan Pasien Rawat Inap</h4>
              </div>
              <div class="modal-body">

<form action="modul/rawat_inap/rujuk_inap.php" method="POST">
             
<input type="hidden" id="antrian" name="antrian"/>
              <div class="row">
<div class="col-md-12">
<label>Pilih Ruang Perawatan</label>
										<select class="form-control" id="ruang" name="ruang" style="width: 93%;">
											<option value="belum">Silahkan pilih ruang ..</option>
											<?php 
											$q1 = mysqli_query($con,"SELECT *FROM ruangan");
											while ($dok = mysqli_fetch_array($q1)) { 
												if(!is_null($dok['status'])){
													$status = "(Rusak)";
													$stat = "disabled";
												} else if($dok['kapasitas'] == $dok['terpakai']){
													$status = "(Penuh)";
													$stat = "disabled";
												} else {
													$status = "";
												}
												?>
												<option value="<?php echo $dok['id']; ?>" <?php echo $stat; ?>><?php echo $dok['nama_ruangan']." ".$status; ?></option>
											<?php } ?>
										</select>
										
</div>
</div>


              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-default pull-left" id="pulangkan">OK</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>

function pushit(id){
  $("#ruang").val("belum");
  $("#antrian").val(id);
}

$(document).ready(function(){
    $("#example1").DataTable();
   
});
</script>