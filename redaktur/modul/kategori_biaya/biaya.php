
<section class="content-header">
    
 

    <h1>
        Kategori Biaya     </h1>
    </section>



    <section class="content">
      <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=kategori_biaya_add"> <button type="button" class="btn btn-warning btn-sm">Tambah Kategori Biaya</button></a>

    </div>
        </div>
    </div>

   
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Kategori Biaya</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
               
                 <th>Kategori Biaya</th>
                 <th>Aksi</th>
            </tr>
        </thead>
      <tbody>
      <?php 
      
      $j = mysqli_query($con, "SELECT * FROM kategori_biaya WHERE id != 2");
      while($jo = mysqli_fetch_assoc($j)){
        echo "<tr>";
        echo "<td>$jo[kategori]</td>";
        echo "<td><a href='?module=kategori_biaya_edit&id=$jo[id]'><button class='btn btn-info btn-sm'>Edit</button></a>&nbsp;&nbsp;<a href='modul/kategori_biaya/aksi.php?act=del&id=$jo[id]' onclick='return confirm(\"apakah yakin menghapus?\")'><button class='btn btn-danger btn-sm'>Hapus</button></a></td>";
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