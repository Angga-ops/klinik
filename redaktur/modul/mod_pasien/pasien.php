<?php
	switch($_GET['act']){
	default:
?>
    <section class="content">
     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
                <h1>MANAJEMEN PASIEN</h1>
    <span></span>
    </div>
        <div class="box-body">
              <table id="example1" class="table table-bordered table-striped">
                  <thead>
        <tr>
            <th>No.RM</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Telp.</th>
            <th>Tgl. Lahir</th>
            <th>Tgl. Daftar</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$tampil = mysqli_query($con,"Select * From pasien Order by id_pasien Desc");
		while($r	= mysqli_fetch_array($tampil)){
		$tgl_lahir  = tgl_indo($r['tgl_lahir']);
		$tgl_daftar = tgl_indo($r['tgl_pendaftaran']);
    ?>
        <tr class="gradeX">
            <td><?php echo $r['id_pasien']; ?></td>
            <td><?php echo $r['nama_pasien']; ?></td>
            <td><?php echo $r['alamat']; ?></td>
            <td><?php echo $r['no_telp']; ?></td>
            <td><?php echo $tgl_lahir; ?></td>
            <td><?php echo $tgl_daftar; ?></td>
            <td>
                <a href="?module=pasien&act=editpasien&id=<?php echo $r['id_pasien']; ?>" title='Edit' class='with-tip'>
                <center><img src='img/edit.png'></a>
                <a href="report/rpt_pasien.php?id=<?php echo $r['id_pasien']; ?>" target="_blank" title="ID Card" class="with-tip">
                <img src='img/id-card.png'></a>    
                <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_pasien/aksi_pasien.php?module=pasien&act=hapus&id=<?php echo $r['id_pasien']; ?>" title='Hapus' class='with-tip'>
                <img src='img/hapus.png'></center></a>


            </td>
        </tr>
	<?php
	    }
    ?>
	</tbody>
	</table>
	            </div>   
            </div>   
        </div>   
    </div>   
</div>   
<?php
	break;  
	case "editpasien":
	$id		= $_GET['id'];
	$edit	= mysqli_query($con,"SELECT * FROM pasien WHERE id_pasien='$id'");
	$r		= mysqli_fetch_array($edit);
?>
    <section class="content">
     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
        <h1>EDIT PASIEN</h1>
        </div>
    <div class="box-body">
    <form method="post" enctype="multipart/form-data" action="<?php echo "$aksi?module=pasien&act=update"; ?>" enctype="multipart/form-data">
    <input type="hidden" size="25" name="id" value="<?php echo $r['id_pasien']; ?>" readonly="readonly" />    
        
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Id. Pasien</label>
            <input type="text" class="form-control" name="no_rm" value="<?php echo $r['id_pasien']; ?>" readonly="readonly" />
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Nama Pasien</label>
            <input type="text" class="form-control" name="nama_pasien" value="<?php echo $r['nama_pasien']; ?>" required />
        </div>        
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Nama Ayah</label>
            <input type="text" class="form-control" name="nama_ayah" value="<?php echo $r['nama_ayah']; ?>" required />
        </div>        
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Nama Ibu</label>
            <input type="text" class="form-control" name="nama_ibu" value="<?php echo $r['nama_ibu']; ?>" required />
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Gol. Darah</label>
            <select class="form-control" name="darah" required>
                <option value="">-- Pilih Golongan --</option>
                <option value="A" <?php if ($r['gol_darah'] == 'A') { echo "selected"; } ?>>A</option>
                <option value="B" <?php if ($r['gol_darah'] == 'B') { echo "selected"; } ?>>B</option>
                <option value="AB" <?php if ($r['gol_darah'] == 'AB') { echo "selected"; } ?>>AB</option>
                <option value="O" <?php if ($r['gol_darah'] == 'O') { echo "selected"; } ?>>O</option>
            </select>
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Agama</label>
            <select class="form-control" name="agama" required>
                <option value="">-- Pilih Agama --</option>
                <option value="Islam" <?php if ($r['agama'] == 'Islam') { echo "selected"; } ?>>Islam</option>
                <option value="Kristen" <?php if ($r['agama'] == 'Kristen') { echo "selected"; } ?>>Kristen</option>
                <option value="Katolik" <?php if ($r['agama'] == 'Katolik') { echo "selected"; } ?>>Katolik</option>
                <option value="Hindu" <?php if ($r['agama'] == 'Hindu') { echo "selected"; } ?>>Hindu</option>
                <option value="Budha" <?php if ($r['agama'] == 'Budha') { echo "selected"; } ?>>Budha</option>
                <option value="Khonghuchu" <?php if ($r['agama'] == 'Khonghuchu') { echo "selected"; } ?>>Khonghuchu</option>
            </select>
        </div>      
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Kewarganegaraan</label>
            <input type="text" class="form-control" name="kewarganegaraan" value="<?php echo $r['kewarganegaraan'] ?>" required />
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Alamat Lengkap</label>
            <input type="text" class="form-control" name="alamat" value="<?php echo $r['alamat']; ?>" required />
        </div>        
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Jenis Kelamin</label>
            <select class="form-control" name="jk" required>
            	<option value="">-- Pilih Jenis --</option>
                <option value="L" <?php if ($r['jk']=="L") { echo "selected=\"selected\""; } ?>>Laki-laki</option>
                <option value="P" <?php if ($r['jk']=="P") { echo "selected=\"selected\""; } ?>>Perempuan</option>
	        </select>
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Tgl Lahir</label>
            <?php
				$get_tgl	= substr("$r[tgl_lahir]",8,2);
				combotgl(1,31,'tgl_lahir',$get_tgl);
				$get_bln	= substr("$r[tgl_lahir]",5,2);
				combonamabln(1,12,'bln_lahir',$get_bln);
				$get_thn	= substr("$r[tgl_lahir]",0,4);
				$thn_skrg	= date("Y");
				combothn($thn_sekarang-30,$thn_sekarang,'thn_lahir',$get_thn);
            ?>
        </div>
       <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Umur</label>
            <input type="text" class="form-control" name="umur" value="<?php echo $r['umur']; ?>" required />
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Pendidikan</label>
            <input type="text" class="form-control" name="pendidikan" value="<?php echo $r['pendidikan']; ?>" required />
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Pekerjaan</label>
            <input type="text" class="form-control" name="pekerjaan" value="<?php echo $r['pekerjaan']; ?>" required />
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Status Pernikahan</label>
            <select class="form-control" name="pernikahan" required>
            <option value="">-- Pilih Status --</option>
            <option value="Lajang" <?php if ($r['status_pernikahan'] == 'Lajang') { echo "selected"; } ?>>Lajang</option>
            <option value="Menikah" <?php if ($r['status_pernikahan'] == 'Menikah') { echo "selected"; } ?>>Menikah</option>
            <option value="Duda" <?php if ($r['status_pernikahan'] == 'Duda') { echo "selected"; } ?>>Duda</option>
            <option value="Janda" <?php if ($r['status_pernikahan'] == 'Janda') { echo "selected"; } ?>>Janda</option>
            </select>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">No. Telp</label>
            <input type="text" class="form-control" name='no_telp' value='<?php echo $r['no_telp']; ?>'>
        </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">No. HP #1</label>
            <input type="text" class="form-control" name='no_hp1' value='<?php echo $r['no_hp1']; ?>'>
        </p>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">No. HP #2</label>
            <input type="text" class="form-control" name='no_hp2' value='<?php echo $r['no_hp2']; ?>'>
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Jenis Pasien</label>
            <select class="form-control" name="jenis_pasien" id="jenis_pasien">
				<?php
                    $jr	= mysqli_query($con,"Select * From jenis_pembayaran");
                    if ($r['id_jenispem'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr 		= mysqli_fetch_array($jr)) {
                    if ($r['id_jenispem']	== $edit_jr['id_jenispem']) {
                    ?>
                        <option value="<?php echo $edit_jr['id_jenispem']; ?>" selected><?php echo $edit_jr['nama_jenispem']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_jr['id_jenispem']; ?>"><?php echo $edit_jr['nama_jenispem']; ?></option>
                    <?php
                    }
                    }
                ?>
            </select>
        </div>             
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Riwayat Penyakit</label>
            <!-- <input type="text" name='riwayat_penyakit' value='<?php echo $r['riwayat_penyakit']; ?>'> -->
            <textarea class="form-control" name="riwayat_penyakit"><?php echo $r['riwayat_penyakit']; ?></textarea>
        </div>    
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
            <label for="field4">Alergi Obat</label>
            <!-- <input type="text" name='alergi_obat' value='<?php echo $r['alergi_obat']; ?>'> -->
            <textarea class="form-control" name="alergi_obat"><?php echo $r['alergi_obat']; ?></textarea>
        </div>    
    <div class="row">
        <div class="col-md-12">
            <div class="form-group">
            <a href="?module=pasien"><button type="button" class="btn btn-danger" id="reset-validate-form" >Batal</button></a>
            <button type="submit" class="btn btn-success" name="upload">Simpan</button>
        </div>
    </div>
</div>
</div>
</div>
</div>
</div>
</div>
    </form>
    
                </div>
            </div>
        </div>
    </div>
</div>
<?php
	break;
	}
?>
<script src="js/libs/jquery-1.10.2.min.js"></script>
<script src="js/libs/jquery-ui-1.9.2.custom.min.js"></script>
<script src="js/jquery.ui.core.js"></script>
<script src="js/jquery.ui.datepicker.js"></script>
<script src="js/ui.datepicker-id.js"></script>
<script type="text/javascript">
	$(document).ready(function() {
	$("#tgl_lahir").datepicker({
	altFormat : "yy MM dd",
	changeMonth : true,
	changeYear : true
	});
	$("#tgl_lahir").change(function() {
	$("#tgl_lahir").datepicker( "option", "dateFormat", "yy-mm-dd" );
	});
	});
</script>
<script type="text/javascript">
	$(document).ready(function() {
	window.onload=function(){
	$('#tgl_lahir').on('change', function() {
	var dob = new Date(this.value);
	var today = new Date();
	var age = Math.floor((today-dob) / (365.25 * 24 * 60 * 60 * 1000));
	$('#umur').val(age);
	});
	}
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
          url: "modul/mod_pasien/aksi_pasien.php?module=pasien&act=mitra",
          data: "jenis_pasien="+jenis_pasien,
          success: function(data) {
            $("#mitra").html(data);
          }
        });
      });
	  //	
	});
</script>