<?php
	$id= $_GET['faktur'];
	$date_now = date("Y-m-d");
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title"> Tambah Resep</h3>
		</div>
			
<hr/>
			<div class="row">
			    <div class="col-md-12">
				<div class="callout callout-info">
				<ul>
				<li>Silakan lengkapi dahulu Resep Obat </li>
				<li>Data obat yang ditambahkan akan tersimpan otomatis</li>
				<li>Silakan tekan tombol F5 atau klik tombol Refresh di browser jika koneksi melambat</li>	
				<li>Klik menu Data Pendaftaran Apotek untuk kembali</li>
				<li>Jika sudah selesai klik tombol Bayar</li>		
				</ul>
				</div>
				</div>
			</div>

		<div class="box-body">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<?php 
                $pem = mysql_fetch_array(mysql_query("SELECT *FROM antrian_pasien JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.no_faktur='$id'"));
           
				$id_pasien = $pem['id_pasien'];
				$mem = mysql_fetch_assoc(mysql_query("SELECT a.* FROM kategori_pelanggan a JOIN pasien b ON a.kategori = b.klaster WHERE b.id_pasien = '$id_pasien'"));
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
					</div>
				</div>
			</div>
			<br/>
			<a href="?module=bayar_obat&faktur=<?php echo $_GET[faktur]; ?>"><button class="btn btn-success">Bayar</button></a>
			<br/>
			<hr>
			<h4>Resep Obat</h4>
		
						<select id="tataup" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<option value="produk">Resep Obat</option>
						
						</select>
						
							<form style="margin-bottom: 20px;" id="form_produk" class="collapse">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
					 		<input type="hidden" name="kode_p" id="kode_p">
				 			<input type="hidden" name="harga_b" id="harga_b">
				 			<input type="hidden" name="nofak" id="faktur" value="<?php echo $pem['no_faktur']; ?>">
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
				 					<input class="form-control" type="text" name="nama_p" id="nama_p_apotek" style="width: 90%;" required>
				 				</td>
				 				<td>
				 					<input class="form-control" type="text" name="harga_p" id="harga_p" style="width: 90%;" readonly>
				 				</td>
				 			
				 				<td>
				 					<input class="form-control" type="text" name="ket" style="width: 90%;">
				 				</td>
				 				<td>
				 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_p" value="<?php echo $mem['diskon_p']; ?>">
				 				</td>
				 			
				 				<td>
				 					<input class="form-control" min="1" type="number" name="jumlah" id="jumlah_p" style="width: 90%;" value="1" required>
				 				</td></tr><tr>
				 				<td>
				 					<button style="margin-top: 15px;" class="btn btn-sm btn-success">Tambah</button>
				 					<button type="button" style="margin-top: 15px;" class="btn btn-sm btn-danger" id="reset_t">Reset Tabel</button>
				 				</td>
				 			</tr>
					 		</table>
					 	</form>
                         <br/><br/>
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
  var nofak = $("#faktur").val();
  // datatable
  $('#tabel_tp').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/mod_kasir_apotek/data_tp.php?id="+nofak,
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
     $('#form_p').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir_apotek/tambah_t.php',
            data: $('#form_p').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Tindakan Dokter Sudah Ada");
              }else{
                var ttable = $('#tabel_tp').dataTable();
                ttable.fnDraw(false);
                 $('#form_p').trigger("reset");
              }
            }
          });

        });
     // Tambah Resep Obat
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir_apotek/tambah_p.php',
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

          var id =  $("#plus_p").data("id");

          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_apotek/plus.php',
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
              url: 'modul/mod_kasir_apotek/hapus.php',
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

          var id =  $("#minus_p").data("id");
          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_apotek/minus.php',
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
     //        url: 'modul/mod_kasir_apotek/pc_selesai.php',
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