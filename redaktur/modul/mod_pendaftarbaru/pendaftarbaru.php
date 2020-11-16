<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Pasien Baru</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/mod_pendaftarbaru/aksi_pendaftarbaru.php?module=pendaftarbaru&act=input">
          <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>No RM</label>
                  <?php
                $tgl = date('d');
                $bln = date('m');
                $thn = date('Y');
                $thn2		= substr($thn,2,2);
                $sekarang   = "".$thn2."".$bln."".$tgl;
                $Kode2		= "PAS-".$sekarang;
                $kode  		= buatKode("pasien",$Kode2);
                                    
            ?>   <input type="text" class="form-control"  name="no_id" value="<?php echo $kode; ?>" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Pasien</label>
               <input type="text" class="form-control"  name="nama_pasien" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Ayah</label>
               <input type="text" class="form-control" name="nama_ayah" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Nama Ibu</label>
               <input type="text" class="form-control" name="nama_ibu" required/>
              </div>
              </div>
            </div>
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Golongan Darah</label>
              <select name="darah" class="form-control" required>
                <option value="">--- Pilih Golongan ---</option>
                <option value="A">A</option>
                <option value="B">B</option>
                <option value="AB">AB</option>
                <option value="O">O</option>
            </select>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Agama</label>
              <select name="agama" class="form-control" required>
                 <option value="">--- Pilih Agama ---</option>
                <option value="Islam">Islam</option>
                <option value="Kristen">Kristen</option>
                <option value="Katolik">Katolik</option>
                <option value="Hindu">Hindu</option>
                <option value="Budha">Budha</option>
                <option value="Khonghuchu">Khonghuchu</option>
            </select>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Suku</label>
               <input type="text" class="form-control" name="suku" required/>
              </div>
              </div>
            </div>
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kwarganegaraan</label>
              <select name="kewarganegaraan" class="form-control" required>
                <option value="">--- Pilih ---</option>
                <option value="WNI">WNI</option>
                <option value="WNA">WNA</option>
            </select>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Alamat Lengkap</label>
               <input type="text" class="form-control" name="alamat" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Jenis Kelamin</label>
               <select name="jk" class="form-control" required>
                <option value="">--- Pilih ---</option>
                <option value="L">Laki-laki</option>
                <option value="P">Perempuan</option>
            </select>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label for="field4">Tgl Lahir</label>
            <input type="text" name="tgl_lahir" class="form-control" id="tgl_lahir" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
               <label for="field4">Umur</label>
            <input type=text name="umur" id="umur" readonly="readonly" class="form-control" required/>
              </div>
              </div>
            </div>
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Pendidikan</label>
            <select name="pendidikan" class="form-control" required>
                <option value="">--- Pilih ---</option>
                <option value="Belum Sekolah">Belum Sekolah</option>
                <option value="PAUD">PAUD</option>
                <option value="TK">TK</option>
                <option value="SD">SD</option>
                <option value="SLTP">SLTP</option>
                <option value="SLTA">SLTA</option>
                <option value="Akademi Universitas">Akademi Universitas</option>
                <option value="Tidak Lulus SD">Tidak Lulus SD</option>
                <option value="Tidak Sekolah">Tidak Sekolah</option>
            </select>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan" required/>
              </div>
              </div>
            </div>
            
                <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">Status Pernikahan</label>
            <select name="pernikahan" class="form-control" required>
                <option value="">Pilih</option>
                <option value="Lajang">Lajang</option>
                <option value="Menikah">Menikah</option>
                <option value="Duda">Duda</option>
                <option value="Janda">Janda</option>
            </select>
              </div>
              </div>
            </div>
            
                <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">No. Telp</label>
            <input type="text" class="form-control" name="no_telp" required/>
              </div>
              </div>
            </div>
            
                <div class="row">
            <div class="col-md-12">
              <div class="form-group">
             <label for="field4">No. HP #1</label>
            <input type="text" class="form-control" name="no_hp1" required/>
              </div>
              </div>
            </div>
            
                <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">No. HP #2</label>
            <input type="text" class="form-control" name="no_hp2" required/>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">Jenis Pasien</label>
            <select name="jenis_pasien" class="form-control" id="jenis_pasien" required>
                <option value="">-- Pilih Jenis --</option>
			<?php
				$sel	= mysqli_query($con, "Select * From jenis_pembayaran");
				while($data	= mysqli_fetch_array($sel)){
			?>
                <option value="<?php echo $data['id_jenispem']; ?>"><?php echo $data['nama_jenispem']; ?></option>            
            <?php
				}
			?>
            </select>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">Mitra</label>
                  <select type="text" class="form-control" name="mitra" id="mitra" required></select>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
           <label for="field4">Riwayat Penyakit</label>
            <textarea class="form-control" name="riwayat_penyakit" required></textarea>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Alergi Obat</label>
            <textarea class="form-control" name="alergi_obat" required></textarea>
              </div>
              </div>
            </div>
            
              <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Tgl Daftar *</label>
            <input type="text" class="form-control" id="tgl_daftar" name="tgl_daftar" readonly="readonly" value="<?php echo date('Y-m-d'); ?>" required/>
              </div>
              </div>
            </div>
                      
             <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
              </div>
            </div></form>
              </div>
        </div>
        </div>
    </div>
</section>


<!--    -->
<script type="text/javascript">
	$(document).ready(function() {
	
	$('#tgl_lahir').on('change', function() {
	var dob = new Date(this.value);
	var today = new Date();
	var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	$('#umur').val(age);
	});
	
    
    $("#tgl_lahir").datepicker();
    
	});
</script>
<script type="text/javascript">
	$(document).ready(function(){
	$(".flip").click(function(){
	$(".pesan").slideToggle("slow");
	});
      //Combobox Ruangan
      $("#jenis_pasien").change(function() {
        var jenis_pasien = $("#jenis_pasien").val();
        $.ajax({
          url: "modul/mod_pendaftarbaru/aksi_pendaftarbaru.php?module=pendaftarbaru&act=mitra",
          data: "jenis_pasien="+jenis_pasien,
          success: function(data) {
            $("#mitra").html(data);
          }
        });
      });
	  //	
	});
</script>