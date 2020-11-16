<?php
	$no_faktur= $_GET['nofak'];
	$date_now = date("Y-m-d");
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title"> Tindakan Dokter</h3>
		</div>
			
<hr/>
			<div class="row">
			    <div class="col-md-12">
				<div class="callout callout-info">
				<ul>
				<li>Silakan lengkapi dahulu data Tindakan Dokter pasien dan pilih Resep Obat atau Tindakan Dokter jika diperlukan</li>
				<li>Jika sudah lengkap semua baru klik tombol Simpan</li>
			
				</ul>
				</div>
				</div>
			</div>

		<div class="box-body">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<?php 
				$pem = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE perawatan_pasien.no_faktur='$no_faktur'"));
				$id_pasien = $pem['id_pasien'];
				$mem = mysqli_fetch_assoc(mysqli_query($con,"SELECT a.* FROM kategori_pelanggan a JOIN pasien b ON a.kategori = b.klaster WHERE b.id_pasien = '$id_pasien'"));
				?>



				<div class="row">
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama 
							</div>
							<div class="col-md-6" id="data_n">
								:&emsp;<?php echo $pem['nama_pasien']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No Telp
							</div>
							<div class="col-md-6" id="data_nt">
								:&emsp;<?php echo $pem['no_telp']; ?>	 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Alamat
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['alamat']; ?>	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Keluhan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['keluhan']; ?>	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Berat Badan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['bb']; ?> kg	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Suhu Badan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['suhu']; ?>	 <sup><small>o</small></sup>C
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Tekanan Darah
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['tensi']; ?>	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Respirasi
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['respirasi']; ?> per menit	 
								</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Tanggal Lahir
								</div>
								<div class="col-md-6" id="data_tl">
								:&emsp;<?php echo $pem['tgl_lahir']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Pekerjaan
								</div>
								<div class="col-md-6" id="data_jk">
								:&emsp;<?php echo $pem['pekerjaan']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Total Kunjungan
								</div>
								<div class="col-md-6" id="data_tk">
								:&emsp;<?php echo $pem['total_kunjungan']; ?>				 
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Jenis Member
								</div>
								<div class="col-md-6" id="data_tk">
								:&emsp;<?php echo $mem['kategori']; ?>				 
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Tinggi Badan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['tb']; ?> cm	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Denyut Nadi
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['nadi']; ?> per menit 	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Penjamin
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['jenis_pasien']; ?> 	 
								</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="col-md-12">

<h4>Resep Obat & Tindakan Dokter (data tersimpan otomatis)</h4>
			
			<div class="col-md-6">
			<h4>Silahkan pilih Resep Obat</h4>
						<select id="tataup" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<option value="produk">Resep Obat</option>
						</select>
						</div>
						<div class="col-md-6">
						<h4>Silahkan pilih Tindakan Dokter</h4>
						<select id="tataup2" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<?php 
							
							$u = mysqli_query($con,"SELECT * FROM kategori_biaya WHERE id = 1");
							while($ux = mysqli_fetch_assoc($u)){
								echo "<option value='$ux[id]'>$ux[kategori]</option>";
							}
							
							?>
						</select>
						</div>
						<br/><br/>	<br/><br/>
							<form style="margin-bottom: 20px;" id="form_px" class="collapse">
							<input class="form-control" type="hidden" name="id_kk" value="<?php echo $_SESSION['klinik'] ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
					 		<input type="hidden" class="form-control" name="id_dr" value="<?php echo $_SESSION['id_dr']; ?>">
					 		<input type="hidden" name="modal" id="modal">
					 		<input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Tindakan Dokter</label>
						 			</td>
						 			<td>
						 				<label>Harga</label>
						 			</td>
									 <td>
					 					<label>Keterangan</label>
					 				</td>
					 				<td>
					 					<label>Diskon (%) </label>
					 				</td>
									 <td>
					 					<label>Tanggal </label>
					 				</td>
					 				<td>
					 					<label>Dokter Visit </label>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="nama_t" id="nama_t" style="width: 90%;" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="text" name="harga_t" id="harga" style="width: 90%;" readonly>
					 				</td>
					 		
					 				<td>
					 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_t" value="0" required>
					 				</td>
					 			
					 				<td>
					 					<input class="form-control datepicker" type="text" name="tgl_visit" style="width: 90%;" >
					 				</td>
					 				<td>
					 					<select class="form-control" name="dr_visit">
										 <option value="">--silakan pilih--</option>
										 <?php $do = mysqli_query($con,"SELECT * FROM user WHERE id_ju = 'JU-02'");
											while($doc = mysqli_fetch_assoc($do)){
												echo "<option value='$doc[id_user]'>$doc[nama_lengkap]</option>";
											}
											?>
										 <?php
while($ko = mysqli_fetch_assoc($c)){
   
   $dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

 
} ?>
</select>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<button type="submit" style="margin-top: 20px;" class="btn btn-sm btn-success">Tambah</button>
					 					<button type="button" id="reset_t" data-id="<?php echo $_GET['nofak']; ?>" style="margin-top: 20px;" class="btn btn-sm btn-danger">Reset Tabel</button>
					 				</td>
					 			</tr>
					 		</table>
</form>
							<form style="margin-bottom: 20px;" id="form_produk" class="collapse">
							
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
					 		<input type="hidden" name="kode_p" id="kode_p">
				 			<input type="hidden" name="harga_b" id="harga_b">
				 			<input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
					 			<td>
					 				<label>Nama Resep Obat</label>
					 			</td>
					 			<td>
					 				<label>Harga</label>
					 			</td>
								 <td>
					 				<label>Keterangan</label>
					 			</td>
					 			<td>
					 				<label>Diskon</label>
					 			</td>
								 <td>
				 					<label>Jumlah</label>
				 				</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<input class="form-control" type="text" name="nama_p" id="nama_p" style="width: 90%;" required>
				 				</td>
				 				<td>
				 					<input class="form-control" type="text" name="harga_p" id="harga_p" style="width: 90%;" readonly>
				 				</td>
				 			
				 				<td>
				 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-">
				 				</td>
				 				<td>
				 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_p" value="0">
				 				</td>
				 		
				 				<td>
				 					<input class="form-control" min="1" type="number" name="jumlah" id="jumlah_p" style="width: 90%;" value="1" required>
				 				</td>
				 				</tr><tr><td>
				 					<button type="submit" style="margin-top: 15px;" class="btn btn-sm btn-success">Tambah</button>
				 					<button type="button" data-id="<?php echo $_GET['nofak']; ?>" style="margin-top: 15px;" class="btn btn-sm btn-danger" id="reset_t">Reset Tabel</button>
				 				</td>
				 			</tr>
					 		</table>
					 	</form>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" width="100%" id="tabel_tp">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Jumlah Beli</th>
						<th>Harga</th>
						<th>Jenis</th>
						<th>Ket</th>
						<th>Pilihan</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

		
			<hr>
			<h4>Keterangan Tindakan Dokter</h4>
			<form  enctype="multipart/form-data" id="form_pc" method="POST" action="modul/visit_treatment/pc_selesai.php">
				<input type="hidden" name="nofak" id="nofak" value="<?php echo $no_faktur; ?>">
				<input type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
				<div class="row">
					<div class="col-md-12">
						<label>Tanggal</label>
						<input class="form-control" type="text" name="tanggal" value="<?php echo $date_now; ?>">
						<label>Subject</label>
						<textarea style="height: 40px;" name="subjek" class="form-control"  required>-</textarea>
						
						
						
					</div>
					<div class="col-md-12">
						<label>Object</label>
						<textarea name="objek" style="height: 40px;" class="form-control"  required>-</textarea>
						</div><div class="col-md-12">
						<label>Assestment</label>
						<textarea style="height: 150px;" name="assest" class="form-control"  required>-</textarea>
						
						
					</div>
				</div>

<br/><br/>

				<input class="form-control" style="display: none" type="file" name="foto1" id="fototes1" onchange="previewFile(this.id)">
				<input class="form-control" style="display: none" type="file" name="foto2" id="fototes2" onchange="previewFile(this.id)">
				<input class="form-control" style="display: none" type="file" name="foto3" id="fototes3" onchange="previewFile(this.id)">
				<input class="form-control" style="display: none" type="file" name="foto4" id="fototes4" onchange="previewFile(this.id)">

<div class="row">
<div class="col-md-3">
<div class="box box-default box-solid">
<img class="foto"  id="img-fototes1" style="width: 100%" />
</div>
<br/>
<center><label for="fototes1" class="btn btn-sm btn-info">Tambah Foto</label></center>
</div>
<div class="col-md-3">
<div class="box box-default box-solid">
<img class="foto"  id="img-fototes2" style="width: 100%" />
</div>
<br/>
<center><label for="fototes2" class="btn btn-sm btn-info">Tambah Foto</label></center>
</div>
<div class="col-md-3">
<div class="box box-default box-solid">
<img class="foto"  id="img-fototes3" style="width: 100%" />
</div>
<br/>
<center><label for="fototes3" class="btn btn-sm btn-info">Tambah Foto</label></center>
</div>
<div class="col-md-3">
<div class="box box-default box-solid">
<img class="foto"  id="img-fototes4" style="width: 100%" />
</div>
<br/>
<center><label for="fototes4" class="btn btn-sm btn-info">Tambah Foto</label></center>
</div>
</div>


<br>
						<button class="btn btn-success btn-sm">Simpan</button>

			</form>

			

			<hr>
			<h4>History  Tindakan Dokter Pasien</h4>
			<div class="table-responsive">
				<table class="table-striped table table-bordered datatable">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Subjek</th>
							<th>Objek</th>
							<th>Assestment</th>
							<th>Resep Obat</th>
							<th>Tindakan Dokter</th>
							<th>Foto (klik utk zoom)</th>
						</tr>
					</thead>
					<tbody>
						<?php $q =  mysqli_query($con,"SELECT *FROM pasca_treatment WHERE id_pasien='$id_pasien' ORDER BY tanggal DESC"); 
						$no = 1;
							  while($pc = mysqli_fetch_array($q)){ ?>
						<tr>
							<td><?php echo $pc['tanggal']; ?></td>
							<td><?php echo $pc['subjek']; ?></td>
							<td><?php echo $pc['objek']; ?></td>
							<td><?php echo $pc['assestment']; ?></td>
							<td>
								<?php $q1 = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$pc[no_faktur]' AND kategori = 0"); 
								$cekp = mysqli_num_rows($q1);
								if ($cekp>0) {
									echo "| ";
									while ($p=mysqli_fetch_array($q1)) {
										echo $p['nama'];
										echo " | ";
									}
								}else{
									echo "Tidak Ada Resep Obat ";
								}
								?>
							</td>
							<td>
								<?php $q2 = mysqli_query($con,"SELECT *FROM history_kasir WHERE no_faktur='$pc[no_faktur]' AND kategori != 0"); 
								
								$cekt = mysqli_num_rows($q2);
								if ($cekt>0) {
									echo "| ";
									while ($t=mysqli_fetch_array($q2)) {
										echo $t['nama'];
										echo " | ";
									}
								}else{
									echo "Tidak Ada Tindakan Dokter";
								}
										
								?>
							</td>
							<td>
								<?php if ($pc['foto1']!=null) {
									?><img width="50" src="../file_user/foto_pasien/<?php echo $pc['foto1']; ?>" id="foto1<?php echo $no; ?>" data-uri="../file_user/foto_pasien/<?php echo $pc['foto1']; ?>" onclick="zoom(this.id)"><?php
								}if($pc['foto2']!=null){
									?><img width="50" src="../file_user/foto_pasien/<?php echo $pc['foto2']; ?>" id="foto2<?php echo $no; ?>" data-uri="../file_user/foto_pasien/<?php echo $pc['foto2']; ?>" onclick="zoom(this.id)"><?php
								}if ($pc['foto3']!=null){
									?><img width="50" src="../file_user/foto_pasien/<?php echo $pc['foto3']; ?>" id="foto3<?php echo $no; ?>" data-uri="../file_user/foto_pasien/<?php echo $pc['foto3']; ?>" onclick="zoom(this.id)"><?php
								}if($pc['foto4']!=null){
									?><img width="50" src="../file_user/foto_pasien/<?php echo $pc['foto4']; ?>" id="foto4<?php echo $no; ?>" data-uri="../file_user/foto_pasien/<?php echo $pc['foto4']; ?>" onclick="zoom(this.id)"><?php
								} ?>
								
							</td>
						</tr>
						<?php
						$no++;
							}
						?>
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>

<script>

function zoom(id){
	var url = $("#" + id).data("uri");
	var k = window.open("", "_BLANK",
    "modal=yes,alwaysRaised=yes,scrollbars=yes");
	k.document.write("<img src='" + url + "'/>");
	k.document.write("");
}

function previewFile(id) {
  
  var file    = document.getElementById(id).files[0];
  var reader  = new FileReader();

  reader.addEventListener("load", function () {
    $("#img-" + id).attr("src",reader.result);
	$("#img-" + id).attr("data-uri",reader.result);
	$("#img-" + id).attr("onclick","zoom(this.id)");
	$("#img-" + id).css("cursor","pointer");
	$("#img-" + id).attr("title","klik untuk zoom");
  }, false);

  if (file) {
    reader.readAsDataURL(file);
  }
}



	$(document).ready(function(){


		$(".foto").attr("src","modul/pasca_treatment/dummy.png");

  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  var nofak = $("#nofak").val();
  // datatable
  $('#tabel_tp').dataTable( {
	"bPaginate": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/visit_treatment/data_tp.php?nofak="+nofak,
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
        	console.log(data)
          var a = '<button id="hapus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          var b = '<button id="minus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>';
		  var c = '<button id="plus_p" data-id="'+data+'" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
		  var d = '<button class="btn btn-xs btn-success">Lunas</button>';
	          if(row[5]=="Lunas"){
		          return d;
	          }else if(row[4]=="Resep Obat") {
	          	  return a+' '+b+' '+c;
	          } else{
	          	  return a;
	          }
          
          }
        }
      ]
    } );
  // Tambah Perawatan
     $('#form_px').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/visit_treatment/tambah_t.php?kat=' + $("#tataup2").val(),
            data: $('#form_px').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Tindakan Dokter Sudah Ada");
              }else{
                var ttable = $('#tabel_tp').dataTable();
                ttable.fnDraw(false);
                 $('#form_px').trigger("reset");
              }
            }
          });

        });
     // Tambah Resep Obat
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/visit_treatment/tambah_p.php',
            data: $('#form_produk').serialize(),
            success: function () {
              var oTable = $('#tabel_tp').dataTable(); 
              oTable.fnDraw(false);
              $('#form_produk').trigger("reset");
          	}
          });
        });
     // plus
  $('body').on("click","#plus_p",function(){

          var id = $(this).data("id");

          $.ajax({
              type:'POST',
              url: 'modul/visit_treatment/plus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

  // Hapus Perawatan
     $('body').on("click","#hapus_p",function(){

          var id = $(this).data("id");


          $.ajax({
              type:'POST',
              url: 'modul/visit_treatment/hapus.php',
              data:{
                id:id
              },
              success:function(data){
                  alert("Berhasil dihapus");
                  var ttable = $('#tabel_tp').dataTable();
                  ttable.fnDraw(false);
              }
          });
     });
     // Minus Resep Obat
     $('body').on("click","#minus_p",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/visit_treatment/minus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Reset Tabel
     $('body').on("click","#reset_t",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/visit_treatment/reset.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Tambah Perawatan
     // $('#form_pc').on('submit', function (e) {

     //      e.preventDefault();

     //      $.ajax({
     //      	cache: false,
     //   		contentType: false,
     //   	    processData: false,
     //        type: 'POST',
     //        url: 'modul/pasca_treatment/pc_selesai.php',
     //        data: $('#form_pc').serialize(),
     //        success: function (data) {
     //          if (data=="fkosong") {
     //          	alert("Silahkan Isi Minimal 1 foto");
     //          }else{
     //          	alert("Pengisian data  Tindakan Dokter selesai");
     //          	window.location.href = "media.php?module=home";
     //          }
     //        }
     //      });

     //    });

});
</script>