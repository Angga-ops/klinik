
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Dokter Pengganti</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/dr_praktek/aksi_ganti.php?act=input">
              <div class="form-group">
                <label>Poliklinik</label>
                <select class="form-control" name="klinik" required>
               
                
                      <option value="">--silakan pilih--</option>

<?php

$kl = mysqli_query($con, "SELECT * FROM poliklinik");
while($kli = mysqli_fetch_assoc($kl)){
    echo "<option value='$kli[id_poli]'>$kli[poli]</option>";
}

?>

                                    </select>
              </div>
              <div class="form-group">
                <label>Nama Dokter </label>
                <select class="form-control" name="dokter" required>
               
                
               <option value="">--silakan pilih--</option>

<?php

$kl = mysqli_query($con, "SELECT * FROM user WHERE id_ju = 'JU-02'");
while($kli = mysqli_fetch_assoc($kl)){
echo "<option value='$kli[id_user]'>$kli[nama_lengkap]</option>";
}

?>

                             </select>
              </div>
              <div class="form-group">
                <label>Hari Piket</label>
               <select class="form-control" name="hari" required="">
                 <option>--silakan pilih</option>
                 <option value="1">Senin</option>
                 <option value="2">Selasa</option>
                 <option value="3">Rabu</option>
                 <option value="4">Kamis</option>
                 <option value="5">Jumat</option>
                 <option value="6">Sabtu</option>
                 <option value="7">Minggu</option>
               </select>
              </div>

              <div class="form-group">
                <label>Jam Piket</label>
               <input type="time" class="form-control" name="jam" required/>
              </div>
              
              <div class="form-group">
               <a href="?module=dr_ganti"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
              </div>
        </div>
        </div>
    </div>
</section>