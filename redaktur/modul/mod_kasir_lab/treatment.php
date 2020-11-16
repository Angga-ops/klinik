<?php
	$no_faktur= $_GET['nofak'];
	$pasien = $_GET['id'];
	$date_now = date("Y-m-d");
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title"> Tindakan Lab</h3>
		</div>
			
<hr/>
			<div class="row">
			    <div class="col-md-12">
				<div class="callout callout-info">
				<ul>
				<li>Silakan lengkapi dahulu data Tindakan Lab</li>
				<li>Jika sudah lengkap semua baru klik tombol Selesai</li>
			
				</ul>
				</div>
				</div>
			</div>

		<div class="box-body">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<?php
				
					$pem = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM antrian_pasien JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.no_faktur='$no_faktur'"));
					$check = mysqli_query($con,"SELECT *FROM antrian_pasien JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.no_faktur='$no_faktur'");
					if(mysqli_num_rows($check) > 0){
						$pem = $pem;
					}
					else{
						$pem = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE perawatan_pasien.no_faktur='$no_faktur'"));
					}
				
				
				//$id_pasien = $pem['id_pasien'];
				$mem = mysqli_fetch_assoc(mysqli_query($con,"SELECT a.* FROM kategori_pelanggan a JOIN pasien b ON a.kategori = b.klaster WHERE b.id_pasien = '$pasien'"));
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
									Tinggi Badan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['tb']; ?>	 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Suhu Badan
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['suhu']; ?>	 
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
									Penjamin
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php echo $pem['jenis_pasien']; ?> 
								</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Layanan Lab (Notice Dokter)
								</div>
								<div class="col-md-6" id="data_a">
								:&emsp;<?php 
								
								$r = mysqli_fetch_assoc(mysqli_query($con,"SELECT a.nama_t FROM treatment a JOIN noticelab b ON a.id = b.jasa WHERE b.no_faktur = '$pem[no_faktur]'"));

								echo $r['nama_t'];
								
								?> 
								</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<div class="col-md-12">

<h4>Tindakan Lab (data tersimpan otomatis)</h4>
			
			
						<div class="col-md-6">
						<h4>Silahkan pilih Tindakan Lab</h4>
						<select id="tataup2" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<?php 
							
							$u = mysqli_query($con,"SELECT * FROM kategori_biaya WHERE id = 2");
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
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pasien; ?>">
					 		<input type="hidden" class="form-control" name="id_dr" value="<?php echo $_SESSION['id_dr']; ?>">
					 		<input type="hidden" name="modal" id="modal">
					 		<input type="hidden" name="nofak" value="<?php echo $no_faktur; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Tindakan Lab</label>
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
<br/><br/>
<a href="modul/mod_kasir_lab/aksi_treatment.php?faktur=<?php echo $_GET['nofak']; ?>&pasien=<?php echo $_GET['id']; ?>"><button class="btn btn-success">Selesai</button></a>
		
			
			</div>
		</div>
	</div>
</section>

<script>



	$(document).ready(function(){


  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  var nofak = "<?php echo $_GET['nofak']; ?>";
  // datatable
  $('#tabel_tp').dataTable( {
	"bPaginate": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/mod_kasir_lab/data_tp.php?nofak="+nofak,
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
            url: 'modul/pasca_treatment/tambah_t.php?kat='+ $("#tataup2").val(),
            data: $('#form_px').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Tindakan Lab Sudah Ada");
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
            url: 'modul/pasca_treatment/tambah_p.php',
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
              url: 'modul/pasca_treatment/plus.php',
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
              url: 'modul/mod_kasir_lab/hapus.php',
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
              url: 'modul/pasca_treatment/minus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Reset Treatment
     $('body').on("click","#reset_t",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lab/reset.php',
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
     //          	alert("Pengisian data  Tindakan Lab selesai");
     //          	window.location.href = "media.php?module=home";
     //          }
     //        }
     //      });

     //    });

});
</script>