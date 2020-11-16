
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Jadwal</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/dr_praktek/aksi.php?act=input">
          <div class="form-group" id="lblexpired">
              </div>
              <input type="hidden" name="expired" id="expired"/>
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
               <input type="text" class="form-control" name="jam" placeholder="misal 23:30" required/>
              </div>
              
              <div class="form-group">
               <a href="?module=jadwal_dokter"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
              </div>
        </div>
        </div>
    </div>
</section>
<script>
$(document).ready(function(){
  var date = new Date();
  var bln = (date.getMonth() + 1);
  var bln2 = (bln < 10)? "0" + bln : bln;
  var bln3 = ((bln + 1) < 10)? "0" + (bln + 1) : (bln + 1);
  var tgl = date.getDate();
  var now = "";
  
  if(tgl <= 24){
    now = date.getFullYear() + "-" + bln2 + "-24";
  } else {
    now = date.getFullYear() + "-" + bln3 + "-24";
  }
  
  $("#expired").val(now);
  var dt = new Date(now);
  var k = new Intl.DateTimeFormat("id-ID",{year: 'numeric', day: '2-digit', month: 'long'}).format(dt);
  $("#lblexpired").html("<label>Berlaku s/d </label><br/>" + k);
});
</script>