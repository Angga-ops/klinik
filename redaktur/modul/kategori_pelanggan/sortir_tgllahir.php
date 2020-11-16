
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Sortir Berdasarkan Tahun Lahir</h3>
		</div>

		<div class="box-body">
			<form action="" method="POST">
			<div class="row">
				<div class="col-md-6">
					<div class="form-group">
					<label>Pilih Tahun Lahir</label><br>
					<select name="tahun" class="form-control">
                          <?php
                          $mulai= date('Y') - 50;
                          for($i = $mulai;$i<$mulai + 100;$i++){
                              $sel = $i == date('Y') ? ' selected="selected"' : '';
                              echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                          }
                          ?>
                          </select>
					</div>
				</div>
			</div>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-info"><i class="fa fa-search"></i> Tampilkan</button>
				</div>
			</div>
		</form>
	</div>

	<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Pelanggan Berdasarkan Tahun Lahir : <?php echo $_POST['tahun']?></h3>
		</div>

		<div class="box-body">
			<form method="post" enctype="multipart/form-data" action="modul/kategori_pelanggan/update_pelanggan.php">
			<div class="row">
            <div class="col-md-6">
              <div class="form-group">
               <label for="field4">Jenis Klaster</label>
                <select name="klaster" class="form-control"  required>
                    <option value="">-- Pilih Jenis Klaster --</option>
                    <?php
                      $sel  = mysqli_query($con, "Select * From kategori_pelanggan");
                      while($data = mysqli_fetch_array($sel)){ ?>
                    <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?> (<?php echo $data['keterangan']; ?>)</option>            
                <?php } ?>
                </select>
                  </div>
                </div>
                </div>
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
			<table class="table table-bordered table-striped">
            <thead>
            <tr>
                <th><input type="checkbox" id="check-all"/></th>
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
			    $tahun = $_POST['tahun'];
			    $tampil   = mysqli_query($con, "Select * From pasien where year(tgl_lahir) = '$tahun'");
			    $no = 1;
			    while($r  = mysqli_fetch_array($tampil)){
			    ?>
			      <tr class="gradeX">
			                <td><input type="checkbox" name="checkbox[]" class='check-item' value="<?php echo $r["id"]; ?>"></td>
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
                <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
	                  <button type="submit" name="submit" id="submit" class="btn btn-success">Simpan Perubahan</button>
	                  <a href="?module=sortir_pekerjaan" name="submit" id="submit" class="btn btn-info">Sortir Pekerjaan</a>
	              </div>
	            </div>
	            </div>
	        </form>
		</div>
	</div>
</section>
<link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
    $("#pk").change(function(){
      var select = $(this).val();
      window.location.href = "http://localhost/klinik-kecantikan/redaktur/media.php?module=produk&id="+select;
    })
});
</script>
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
  });
  </script>
	