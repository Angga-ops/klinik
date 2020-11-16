
<section class="content-header">
    
 

    <h1>
        Biaya Administrasi Rumah Sakit     </h1>
    </section>



    <section class="content">
      <?php
              if ($_SESSION['jenis_u']=="JU-01") {
            ?>
      <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
         <button type="button" class="btn btn-info" data-toggle="modal" data-target="#modal-default" onclick="setdata(0)">
                Tambah Data
              </button>

    </div>
        </div>
    </div>
  <?php } ?>

   
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Biaya Administrasi Rumah Sakit</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
               
                 <th>Nama</th>
                 <th>Tarif</th>
                 <?php
                    if ($_SESSION['jenis_u']=="JU-01") {
                  ?>
                 <th>Aksi</th>
               <?php } ?>
            </tr>
        </thead>
      <tbody>
      <?php 
      
      $j = mysqli_query($con, "SELECT * FROM biaya_administrasi");
      while($jo = mysqli_fetch_assoc($j)){
        echo "<tr>";
        echo "<td>$jo[nama]</td>";
        echo "<td>Rp $jo[biaya]</td>";
        if ($_SESSION['jenis_u']=="JU-01") {
          echo "<td>"; ?>
          
          <button type="button" class="btn btn-warning" data-toggle="modal" data-target="#modal-default" onclick="setdata(this.id)" id="<?php echo $jo['id']; ?>">
                  Edit
                </button>&nbsp; <button type="button" class="btn btn-danger" onclick="deldata(this.id)" id="<?php echo $jo['id']; ?>">
                 Hapus
                </button>

          <?php
          echo "</td>";
        }
        echo "</tr>";
      }
      
      ?>
        </tbody>
  </table>
</div>
</div>
</div>
</div>

</section>

<div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Data Biaya Administrasi RS</h4>
              </div>
              <form method="POST" id="frm">
              <div class="modal-body">
               <input type="hidden" name="id" id="dataid" />
               <table class="table">
               <tr><td>Nama</td><td><input type="text" class="form-control" name="nama" id="nama" /></td></tr>
               <tr><td>Tarif</td><td><input type="text" class="form-control" name="biaya" id="biaya" /></td></tr>
               </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
              </div>
              </form>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <script>

      function deldata(id){
          var u = confirm("apakah yakin akan menghapus");
          if(u){
              location.href = "modul/mod_adminrs/aksi.php?act=del&id=" + id;
          }
      }

        function setdata(id){
            $("#frm")[0].reset();
            if(id == 0){
                $("#frm").attr("action","modul/mod_adminrs/aksi.php?act=input");
            } else {
                $("#frm").attr("action","modul/mod_adminrs/aksi.php?act=edit");
                $("#dataid").val(id);
                $.ajax({
                    url: "modul/mod_adminrs/data.php?id=" + id,
                    dataType: "JSON",
                    success: function(data){
                        $("#nama").val(data.nama);
                        $("#biaya").val(data.biaya);
                    }
                });
            }
        }
        </script>