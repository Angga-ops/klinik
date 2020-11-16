
<section class="content-header">
    
 

    <h1>
        Pasien dan Asuransi     </h1>
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
                <h3 class="box-title">Data Jenis Pasien</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
               
                 <th>Nama</th>
            </tr>
        </thead>
      <tbody>
        <tr>
          <td>Umum</td>
        </tr>
        <tr>
          <td>BPJS</td>
        </tr>
        <tr>
          <td>Asuransi Lain</td>
        </tr>
        </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

<div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Asuransi</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
               
                 <th>Nama</th>
            </tr>
        </thead>
      <tbody>
         <?php 
      
      $j = mysqli_query($con, "SELECT * FROM asuransi");
      while($jo = mysqli_fetch_assoc($j)){
        ?>
        <tr>
          <td><?php echo $jo['nama'];?></td>
        </tr>
      <?php } ?>
        </tbody>
  </table>
</div>
</div>
</div>
</div>
</div>

</section>