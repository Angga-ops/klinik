<?php 

if(empty($_GET['nofak'])){ ?>
	<script>
	alert("Tidak ada pasien yang di pilih,\n Silahkan pilih pasien terlebih dahulu!");
	window.location.href = "media.php?module=home";
	</script>
<?php }

$nofak = $_GET['nofak'];
$id_kk = $_SESSION['klinik'];
$id_dr = $_SESSION['id_user'];


mysqli_query($con,"UPDATE antrian_pasien SET status='Sedang Menjalani Perawatan' WHERE no_faktur='$nofak' AND id_kk='$id_kk'");

 $p = mysqli_query($con,"SELECT *,antrian_pasien.tanggal_pendaftaran AS tgl FROM antrian_pasien 
 	JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE no_faktur='$nofak' AND antrian_pasien.id_kk='$id_kk'");
 $pas = mysqli_fetch_array($p);

?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h2 class="box-title">Data Pasien</h2>
		</div>
		<div class="box-body">
			<form method="POST" id="form_perawatan">
			<div class="row">
				<div class="col-md-6">
					<table class="table">
						<tbody>
							
								<tr>
									<td><label>Nama</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
									<input class="form-control" type="hidden" name="id_ruangan" id="id_ruangan" value="<?php echo $_GET['id_r']; ?>">
									<input class="form-control" type="hidden" name="no_urut" id="no_urut" value="<?php echo $nu; ?>">
									<input type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
									<input type="hidden" name="id_dr" value="<?php echo $id_dr; ?>">
									<input type="hidden" name="nofak" value="<?php echo $pas['no_faktur']; ?>">
								</tr>
								<tr>
									<td><label>Alamat</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['alamat']; ?>"></td>
								</tr>
								<tr>
									<td>
										<div class="checkbox">
											<label>
											<input <?php if ($pas["konsultasi"]=="Yes"): ?>
												checked="TRUE"								
											<?php endif ?> type="checkbox" name="konsultasi" value="Yes">
											Konsultasi</label>
										</div>
									</td>
								</tr>
							
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal Lahir</label></td>
								<td><input class="form-control" type="text" name="nama" readonly value="<?php echo tgl_indo($pas['tgl_lahir']); ?>"></td>
							</tr>
							<tr>
								<?php $id = $pas['id_pasien']; ?>
								<?php $t = mysqli_query($con,"SELECT *FROM history_ap WHERE id_pasien='$id'"); 
								$j = mysqli_num_rows($t);
								if($j==0){
									$j="1";
								} ?>
								<td><label>Kunjungan Ke</label></td>
								<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $j; ?>"></td>
							</tr>
							<tr>
								<td>
									<button type="submit" id="selesai" class="btn btn-success btn-sm">SELESAI</button>
								</td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			</form>
		</div>
	</div>
			
					<div class="box box-success">
						<div class="box-header">
							<h4 class="box-title">Produk Dan Treatment Yang Dibeli</h4>
						</div>
						<div class="box-body">
							<h3>Silahkan pilih treatment atau produk</h3>
						<select id="tataup" class="form-control" style="width: 40%;">
							<option value="produk">Produk</option>
							<option value="treatment">Treatment</option>
						</select>
							<form style="margin-bottom: 20px;" id="form_p" class="collapse">
					 		<input class="form-control" type="hidden" name="id_kk" value="<?php echo $id_kk ?>">
					 		<input class="form-control" type="hidden" id="src" name="src" value="<?php echo "dokter" ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $nu; ?>">
					 		<input class="form-control" type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
					 		<input type="hidden" class="form-control" name="id_dr" value="<?php echo $id_dr; ?>">
					 		<input type="hidden" name="modal" id="modal">
					 		<input type="hidden" name="nofak" value="<?php echo $pas['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Treatment</label>
						 			</td>
						 			<td>
						 				<label>Harga</label>
						 			</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="nama_t" id="nama_t" style="width: 90%;" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="text" name="harga_t" id="harga" style="width: 90%;" readonly>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<button  style="margin-top: 20px;" class="btn btn-sm btn-success">Tambah</button>
					 					<button id="reset_t" style="margin-top: 20px;" class="btn btn-sm btn-danger">Reset Tabel</button>
					 				</td>
					 			</tr>
					 		</table>
					 	</form>
							<form style="margin-bottom: 20px;" id="form_produk" class="collapse">
					 		<input class="form-control" type="hidden" name="id_kk" value="<?php echo $id_kk ?>">
					 		<input class="form-control" type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
					 		<input class="form-control" type="hidden" id="src" name="src" value="<?php echo "dokter" ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $nu; ?>">
					 		<input type="hidden" name="kode_p" id="kode_p">
				 			<input type="hidden" name="harga_b" id="harga_b">
				 			<input type="hidden" name="nofak" value="<?php echo $pas['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Produk</label>
						 			</td>
						 			<td>
						 				<label>Harga</label>
						 			</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="nama_p" id="nama_p" style="width: 80%;" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="text" name="harga_p" id="harga_p" style="width: 80%;" readonly>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<label>Jumlah</label>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="jumlah" id="jumlah_p" style="width: 80%;" value="1" required>
					 				</td>
					 				<td>
					 					<button class="btn btn-sm btn-success">Tambah</button>
					 					<button class="btn btn-sm btn-danger" id="reset_p">Reset Tabel</button>
					 				</td>
					 			</tr>
					 		</table>
					 	</form>
								<div class="table-responsive">
									<table class="table table-bordered table-striped" width="100%" id="tabel_perawatan">
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

  var nou = $("#nou").val();

  // perawatan
  $('#tabel_perawatan').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/perawatan/data_pt.php?nou="+nou,
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] },{ "bVisible": false, "aTargets": [5] }],
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
	          }else if(row[4]=="Produk") {
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
            url: 'modul/perawatan/tambah_t.php',
            data: $('#form_p').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Treatment Sudah Ada");
              }else{
                var ttable = $('#tabel_perawatan').dataTable();
                ttable.fnDraw(false);
                 $('#form_p').trigger("reset");
              }
            }
          });

        });
     // Tambah Produk
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/perawatan/tambah_p.php',
            data: $('#form_produk').serialize(),
            success: function () {
              var oTable = $('#tabel_perawatan').dataTable(); 
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
              url: 'modul/perawatan/plus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_perawatan').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

  // Hapus Perawatan
     $('body').on("click","#hapus_p",function(){

          var id = $(this).data("id");


          $.ajax({
              type:'POST',
              url: 'modul/perawatan/hapus.php',
              data:{
                id:id
              },
              success:function(data){
                  alert("Berhasil dihapus");
                  var ttable = $('#tabel_perawatan').dataTable();
                  ttable.fnDraw(false);
              }
          });
     });
     // Minus Produk
     $('body').on("click","#minus_p",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/perawatan/minus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_perawatan').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Pasien selesai perawtan
     $('#form_perawatan').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/perawatan/perawatan_selesai.php',
            data: $('#form_perawatan').serialize(),
            success: function (data) {
              alert("Pasien telah menjalani perawatan");
              window.location.href = "media.php?module=pasca_treatment&nofak="+data;
            }
          });

        });

});

	window.onbeforeunload = function(){
		var no_urut = $("#no_urut").val();
		var id_r    = $("#id_ruangan").val();
	  $.ajax({
              type:'POST',
              url: 'modul/perawatan/unload.php',
              data:{
              	no_urut:no_urut,
              	id_r:id_r
              },
              success:function(data){
                  
             }
        });
	};
</script>