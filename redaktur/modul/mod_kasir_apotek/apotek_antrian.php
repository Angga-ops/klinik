 
    <!-- Main content -->
    <section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <div class="callout callout-success">
         
        </div>
      </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Data Antrian Apotek</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-striped datatable">
                  <thead>
            <tr>
                 <th>Tanggal</th>
                 <th>No Faktur</th>
                 <th>Nama Pasien</th>
                 <th>Aksi</th>               
            </tr>
        </thead>
      <tbody>
        <?php 
        $today = DATE('Y-m-d');
        $j = mysqli_query($con,"SELECT * FROM antrian_pasien WHERE jenis_layanan = 'apotek' ORDER BY tanggal_pendaftaran ASC");
        while($ji = mysqli_fetch_assoc($j)){
            $pas = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_pasien FROM pasien WHERE id_pasien = '$ji[id_pasien]'"));


            $aksi = is_null($ji['status'])? "<a href='?module=resep&faktur=$ji[no_faktur]'><button class='btn btn-sm btn-info'>Tambah Obat</button></a>" : "<span class='label label-success'> Lunas</span>";


            echo "<tr>";
            echo "<td>".strftime("%d %B %Y",strtotime($ji['tanggal_pendaftaran']))."</td>";
            echo "<td>$ji[no_faktur]</td>";
            echo "<td>$pas[nama_pasien]</td>";
            echo "<td>$aksi</td>";
            echo "</tr>";
        }
        
        ?>
    </tbody>
                </table>
     </div></div></div></div>

</section>