

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
            	<a href="?module=tambah_dr_ganti"> <button type="button" class="btn btn-warning btn-sm">Tambah Dokter Pengganti</button></a>

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Dokter Pengganti</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>              
               <th>Nama Dokter</th>
               <th>Poliklinik</th>
               <th>Tgl</th>
               <th>Jam</th>
               
            </tr>
        </thead>
        <tbody>
                   <?php 
                   
                   $d = mysqli_query($con, "SELECT * FROM dr_pengganti ORDER BY tgl ASC");

                   while($dr = mysqli_fetch_assoc($d)){
                  
                    $doc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap AS nama FROM user WHERE id_user = '$dr[id_dr]'"));
                    $poli = mysqli_fetch_assoc(mysqli_query($con, "SELECT poli FROM poliklinik WHERE id_poli = '$dr[id_poli]'"));

                       echo "<tr>";
                       echo "<td>$doc[nama]</td>";
                       echo "<td>$poli[poli]</td>";
                       echo "<td>$dr[tgl]</td>";
                       echo "<td>$dr[jam]</td>";
                       echo "</tr>";
                   }
                   
                   
                   ?>
                </tbody>
                </table>
     </div></div></div></div>

</section>