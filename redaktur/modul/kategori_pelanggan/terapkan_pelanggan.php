<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Terapkan Klaster Pelanggan</h3>
        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
        <form method="post" enctype="multipart/form-data" action="modul/kategori_pelanggan/update_pelanggan.php">
           <div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label for="field4">Jenis Klaster</label>
                <select name="klaster" class="form-control"  required>
                    <option value="">-- Pilih Jenis Klaster --</option>
                    <?php
                      $sel  = mysql_query("Select * From kategori_pelanggan");
                      while($data = mysql_fetch_array($sel)){ ?>
                    <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?> (<?php echo $data['keterangan']; ?>)</option>            
                <?php } ?>
                </select>
                  </div>
                </div>
                </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
            <table id="example1" class="table table-bordered table-striped">
                  <thead>
            <tr>
                <th>Check</th>
                 <th>Nama Pelanggan</th>
                 <th>No.RM</th>
                 <th>Umur</th>
                 <th>Alamat</th>
                 <th>Nomor Telepon</th>
                 <th>Pekerjaan</th>
                 <th>Total Kunjungan</th>
                 <th>Klaster</th>
                 <!-- <th>Aksi</th> -->
               
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From pasien");
    $no = 1;
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                <td><input type="checkbox" name="checkbox[]" value="<?php echo $r["id"]; ?>"></td>
                <td><?php echo $r["nama_pasien"]; ?></td>
                <td><?php echo $r["id_pasien"]; ?></td>
                <td><?php 
                $tanggal = new DateTime($r["tgl_lahir"]);
                $today = new DateTime();
                $y = $today->diff($tanggal)->y;
                echo $y; ?> Tahun</td>
                <td><?php echo $r["alamat"]; ?></td>
                <td><?php echo $r["no_telp"]; ?></td>
                <td><?php echo $r["pekerjaan"]; ?></td>
                <td><?php echo $r["total_kunjungan"]; ?></td>
                <td><a class="btn btn-success"><?php echo $r["klaster"]; ?></a></td>
               
      </tr>
    <?php
            }
        ?>
    </tbody>
                </table>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <button type="submit" name="submit" id="submit" class="btn btn-success">Simpan Perubahan</button>
                  <a href="?module=sortir_pekerjaan" name="submit" id="submit" class="btn btn-info">Sortir Pekerjaan</a>
                  <a href="?module=sortir_tgllahir" name="submit" id="submit" class="btn btn-info">Sortir Tanggal Lahir</a>
              </div>
            </div>
            </div>    
            </form>

            <!-- <script>
              $(document).ready(function(){

                function fetch_data(){
                  $.ajax({
                    url:"select.php",
                    method:"POST",
                    dataType:"json",
                    success:function(data){
                      var html = '';
                      for(var count = 0; count < data.length; count++){
                        html += '<tr>';
                        html += '<td><input type="checkbox" id_pasien="'+data[count].id+'" data-klaster="'+data[count].klaster+'" class="check_box" /></td>';
                        html += '<td>'+data[count].klaster'</td>';
                      }
                      $(tbody).html(html);
                    }
                  });
                }
                fetch_data();
              });
            </script> -->
              </div>
        </div>
        </div>
    </div>

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