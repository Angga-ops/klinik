<?php 

unlink("modul/mod_kasir/error_log");
$id_kk = $_SESSION['klinik']; ?>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="accordion" >
				<div class="box box-success" id="boxbos">
					<div class="box-header" id="tabone">
						<h3>Data Pelayanan</h3>
						<ul class="nav nav-tabs box-header-tabs">
					      
					      <li class="nav-item active" id="pb">	
					        <a class="nav-link" type="button" href="#" id="konsultasi">Pendaftaran POLI UMUM</a>
					      </li>
						  <li class="nav-item" id="pb2">	
					        <a class="nav-link" type="button" href="#" id="inap">Pendaftaran Rawat Inap</a>
					      </li>
						  <li class="nav-item" id="pb3">	
					        <a class="nav-link" type="button" href="#" id="UGD">Pendaftaran UGD</a>
					      </li>
						  
						  <li class="nav-item" id="pb4">	
					        <a class="nav-link" type="button" href="#" id="lab">Pendaftaran LAB</a>
					      </li>
					    </ul>
					    <input type="hidden" id="awal" value="konsultasi">
					</div>
					<div class="box-body">
					<!-- Collapse 1 Pasien Lama-->
					<form id="form_tam" class="collapse">
						<div class="row">
							<div class="col-md-6">
								<label>Cari Pelanggan</label>
									<div class="row">
										<div class="col-md-2">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio1" value="nama" checked>
							                      Nama
							                    </label>
							                  </div>
										</div>
										<div class="col-md-3">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio2" value="kode">
							                      No.RM
							                    </label>
							                  </div>
										</div>
										<div class="col-md-6">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio3" value="tgl">
							                      Tanggal Lahir (yyyy-mm-dd)
							                    </label>
							                  </div>
										</div>
									</div>

								
								<input class="form-control" type="text" id="nama_k" name="nama_kode" style="width:93%;" required>
								<input class="form-control" type="hidden" name="nama" id="nama_hidden">
								<input type="hidden" id="cara2">
								<input type="hidden" id="cek_tampil">
								<button style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-sm btn-info">Tampilkan</button>
							</div>
						</div>
					</form>
							<form id="form_k" class="collapse">
								<?php $nofak = date("YmdHis"); 
								$ran = rand(1,9);
								$nofak .= $ran;
								?>
								<input class="form-control" type="hidden" id="nama_kon" name="nama" style="width:93%;" required>
								<input type="hidden" name="nofak" value="<?php echo $nofak; ?>">
								<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
									<h4>Data Pasien</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Rekam Medis
												</div>
												<div class="col-md-6" id="data_id">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Nama 
												</div>
												<div class="col-md-6" id="data_n">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													No Telp
												</div>
												<div class="col-md-6" id="data_nt">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Alamat
												</div>
												<div class="col-md-6" id="data_a">
													 
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Tanggal Lahir
												</div>
												<div class="col-md-6" id="data_tl">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Jenis Kelamin
												</div>
												<div class="col-md-6" id="data_jk">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Total Kunjungan
												</div>
												<div class="col-md-6" id="data_tk">
													 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="collapse" id="pilih_dok">
								<div class="row">
								<div class="col-md-6">
										<label>Pilih Poliklinik</label>
										<select class="form-control" id="poli" name="poli" style="width: 93%;" onchange="changedoc()">
											<option value="belum">Silahkan pilih poliklinik ..</option>
											<?php 
											$q1 = mysqli_query($con, "SELECT *FROM poliklinik");
											while ($dok = mysqli_fetch_array($q1)) { ?>
												<option value="<?php echo $dok['id_poli']; ?>"><?php echo $dok['poli'] ?></option>
											<?php } ?>
										</select>
										
									</div>
									<div class="col-md-6" id="doct">
										<label>Dokter</label>
										<select class="form-control" style="width: 93%;" disabled>
											<option value="belum">Silahkan pilih dokter ..</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Berat Badan</label>
										<input type="text" name="bb" class="form-control" />
										
									</div>
									<div class="col-md-6">
										<label>Keluhan</label>
										<textarea class="form-control" style="height: 150px" name="sakit" ></textarea>
										
									</div>
									<div class="col-md-6">
										<label>Jenis Pasien</label>
										<select class="form-control" style="width: 93%;" name="pas">
										<option value="">--silakan pilih--</option>
											<option value="umum">Umum</option>
											<option value="bpjs">BPJS</option>
											<option value="lain">Asuransi Lain</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Asuransi</label>
										<select class="form-control" style="width: 93%;" name="ass">
											<option value="">--abaikan--</option>
											<?php 
											
											$asur = mysqli_query($con, "SELECT * FROM asuransi");
											while($asuri = mysqli_fetch_assoc($asur)){
												echo "<option value='$asuri[id]'>$asuri[nama]</option>";
											}
											
											?>
										</select>
										(abaikan jika tidak ada)
									</div>
									<div class="col-md-6"><br>
										<button style="margin-top: 5px;" type="submit" id="tambah_k" class="btn btn-sm btn-success">Simpan</button>
										<button style="margin-top: 5px;" type="button" class="btn btn-sm btn-danger data_batal">Batal</button>
									</div>
								</div>
								</div>
							</form>

<script>
function changedoc(){
	var poli = $("#poli").val();
	var hari = <?php echo date("N"); ?>;
	var x = $.ajax({
		url: "modul/mod_kasir/doct.php?poli=" + poli + "&hari=" + hari,
		success: function(data){
			$("#doct").html(data);
		}
	});
	if(x.readyState == "1"){
		$("#doct").html("mencari dokter");
	}
}
</script>

<!------------------------------------------------------------------------------------------------> 

<form id="form_s" class="collapse">
								<?php $nofak = date("YmdHis"); 
								$ran = rand(1,9);
								$nofak .= $ran;
								?>
								<input class="form-control" type="hidden" id="nama_kon" name="nama" style="width:93%;" required>
								<input type="hidden" name="nofak" value="<?php echo $nofak; ?>">
								<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
									<h4>Data Pasien</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Rekam Medis
												</div>
												<div class="col-md-6" id="data_id">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Nama 
												</div>
												<div class="col-md-6" id="data_n">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													No Telp
												</div>
												<div class="col-md-6" id="data_nt">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Alamat
												</div>
												<div class="col-md-6" id="data_a">
													 
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Tanggal Lahir
												</div>
												<div class="col-md-6" id="data_tl">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Jenis Kelamin
												</div>
												<div class="col-md-6" id="data_jk">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Total Kunjungan
												</div>
												<div class="col-md-6" id="data_tk">
													 
												</div>
											</div>
										</div>
									</div>
								</div>
								<div class="collapse" id="pilih_kamar">
								<div class="row">
								<div class="col-md-6">
										<label>Pilih Kamar</label>
										<select class="form-control" id="poli" name="poli" style="width: 93%;" onchange="changedoc()">
											<option value="belum">Silahkan pilih poliklinik ..</option>
											<?php 
											$q1 = mysqli_query($con, "SELECT *FROM poliklinik");
											while ($dok = mysqli_fetch_array($q1)) { ?>
												<option value="<?php echo $dok['id_poli']; ?>"><?php echo $dok['poli'] ?></option>
											<?php } ?>
										</select>
										
									</div>
									<div class="col-md-6" id="doct">
										<label>Dokter</label>
										<select class="form-control" style="width: 93%;" disabled>
											<option value="belum">Silahkan pilih dokter ..</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Berat Badan</label>
										<input type="text" name="bb" class="form-control" />
										
									</div>
									<div class="col-md-6">
										<label>Keluhan</label>
										<textarea class="form-control" style="height: 150px" name="sakit" ></textarea>
										
									</div>
									<div class="col-md-6">
										<label>Jenis Pasien</label>
										<select class="form-control" style="width: 93%;" name="pas">
										<option value="">--silakan pilih--</option>
											<option value="umum">Umum</option>
											<option value="bpjs">BPJS</option>
											<option value="lain">Asuransi Lain</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Asuransi</label>
										<select class="form-control" style="width: 93%;" name="ass">
											<option value="">--abaikan--</option>
											<?php 
											
											$asur = mysqli_query($con, "SELECT * FROM asuransi");
											while($asuri = mysqli_fetch_assoc($asur)){
												echo "<option value='$asuri[id]'>$asuri[nama]</option>";
											}
											
											?>
										</select>
										(abaikan jika tidak ada)
									</div>
									<div class="col-md-6"><br>
										<button style="margin-top: 5px;" type="submit" id="tambah_k" class="btn btn-sm btn-success">Simpan</button>
										<button style="margin-top: 5px;" type="button" class="btn btn-sm btn-danger data_batal">Batal</button>
									</div>
								</div>
								</div>
							</form>


<!------------------------------------------------------------------------------------------------>
				

					 	<!-- ### -->
					</div>
				</div>
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
  // cari pelanggan
  	// berdasarrkan nama
     $( "#nama_k" ).autocomplete({
      source: function( request, response ) {
      	var cara = $("#cara2").val();
       // Fetch data
       $.ajax({
        url: "modul/mod_kasir/source_p.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,cara:cara
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#nama_k').val(ui.item.label);
       $('#alamat_k').val(ui.item.alamat);
       $('#tgl_k').val(ui.item.tgl_lahir);
       $('#umur_k').val(ui.item.umur);
       $('#nohp_k').val(ui.item.no_telp);
       $('#jk_k').val(ui.item.jk);
       $("#nama_hidden").val(ui.item.id);
       tampilkan();
       return false;
      }
     });
     // Enter 
     $("#nama_k").keyup(function(event) {
	    if (event.keyCode === 13) {
	        $("#nama_hidden").val("");
	    }
	}); 

  // tampilkan
  $(' #form_tam').on('submit', function (e) {
          e.preventDefault();
          $("#nama_hidden").val("");
          tampilkan();
        });
  // fungsi tampilkan
  function tampilkan(){
  	var awal = $("#awal").val();
  	$.ajax({
            type: 'post',
            url: 'modul/mod_kasir/tampilkan.php',
            data: $('#form_tam').serialize(),
            success: function (data) {
            	if (data=="Kosong") {
            		alert("Pasien Tidak Ditemukan");
            	}else{
            		var obj = JSON.parse(data);
            		 $('#form_tam').trigger("reset");
            		 $('#form_p').collapse('hide');
            		 $("#data_id").html(obj.nid);
            		 $("#data_n").html(obj.np);
		             $("#nama_kk").val(obj.id);
		             $("#nama_kon").val(obj.id);
		             $("#data_tk").html(obj.tk);
		             $("#data_jk").html(obj.jk);
		             $("#data_tl").html(obj.tl);
		             $("#data_a").html(obj.a);
		             $("#data_nt").html(obj.nt);
		             $("#diskon_tr").val(obj.dtr);
		             $("#diskon_pr").val(obj.dpr);
		             $(".id_pasien").val(obj.id);
		             $("#cek_tampil").val("Sudah");
            		 if (awal=="konsultasi") {
            		 	$('#form_k').collapse('show');
            		 	$('#pilih_dok').collapse('show');
            		 	$('#form_tam').collapse('hide');
            		 }else{
            		 	
			            $('#form_tam').collapse('hide');
						$('#pilih_kam').collapse('show');
			            $('#form_s').collapse('show');
			           
            		 }
            	}                        
            }
          });
  } 

  // Tabel kasir
  $('#tabel_kasir').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/mod_kasir/data_kasir.php?v=<?php echo rand(1000,9000); ?>",
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
          var a = '<button id="hapus_kasir" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          if(row[5]=="produk"){
          	  var b = '<button id="minus_kasir" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>';
	          var c = '<button id="plus_kasir" data-id="'+data+'" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
	          return a+' '+b+' '+c;
          }else{
          	  return a;
          }
          }
        }
      ]
    } );
  // Batal
  $(".data_batal").click(function(e){
  	  e.preventDefault();
  	  $.ajax({
          url: 'modul/mod_kasir/batal.php',
          success:function(data){
           	  $('#cekbok').collapse('hide');
			  $("#cek_tampil").val("");
			  $('#tap').collapse('hide');
			  $('#form_k').collapse('hide');
			  $('#form_tam').collapse('show');
			  $('#form_tam').trigger("reset");
          }
        });
});
  // plus
  $('body').on("click","#plus_kasir",function(){

          var id = $(this).data("id");

          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir/plus.php',
              data:{
                id:id
              },
              success:function(data){
              	total();
                  var oTable = $('#tabel_kasir').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

  // Hapus Perawatan
     $('body').on("click","#hapus_kasir",function(){

          var id = $(this).data("id");


          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir/hapus.php',
              data:{
                id:id
              },
              success:function(data){
              	total();
                  var ttable = $('#tabel_kasir').dataTable();
                  ttable.fnDraw(false);
              }
          });
     });
     // Reset
     $("#reset_t").click(function(){
        $.ajax({
          url: 'modul/mod_kasir/reset_t.php',
          success:function(){
          	total();
            var oTable = $('#tabel_kasir').dataTable(); 
            oTable.fnDraw(false);
          }
        });
     });
     // Minus Produk
     $('body').on("click","#minus_kasir",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir/minus.php',
              data:{
                id:id
              },
              success:function(data){
              	 total();
                  var oTable = $('#tabel_kasir').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Tambah Perawatan
     $('#form_p').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir/tambah_p.php',
            data: $('#form_p').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Treatment Sudah Ada");
              }else{
              	 total();
                var ttable = $('#tabel_kasir').dataTable();
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
            url: 'modul/mod_kasir/tambah_produk.php',
            data: $('#form_produk').serialize(),
            success: function (data) {
              if (data=='tidak') {
              	  alert("produk tidak ada di gudang");
              }else{
              	  total();
	              var oTable = $('#tabel_kasir').dataTable(); 
	              oTable.fnDraw(false);
	              $('#form_produk').trigger("reset");
              }
              
            }
          });
        });
     // no rek
     // Onchange tunai or kredit
  $("#metode").change(function(){
  	  var select = $(this).val();
	  if(select=="Tunai"){
	    $('#no_rek').collapse('hide');
	    $('#uang_tu').collapse('show');
	    $('#uang_tr').collapse('hide');
	  }else if(select=="Transfer"){
	    $('#no_rek').collapse('show');
	    $('#uang_tr').collapse('show');
	    $('#uang_tu').collapse('hide');
	  }else{
	  	$('#no_rek').collapse('show');
	  	$('#uang_tu').collapse('show');
	  	$('#uang_tr').collapse('show');
	  }
});
  // Kembalian
     $('#uang_k').on('input',function(){
            kembalians();
         });
     $('#uang_t').on('input',function(){
            kembalians();
         });
     $('#ongkir').on('change',function(){
     		total();
            kembalians();
         });
     // fungsi kembalian
     function kembalians(){ 
     /*
     var uang = parseFloat($("#uang_k").val());
     	var uang_tr = parseFloat($("#uang_t").val());
		var tots  = $("#total").val();
		var tot = parseFloat(tots.replace(/[A-Za-z\.,-]/gi,""));
		if(uang >= tot || uang_tr >= tot){
			$.ajax({
              type:"post",
              url:"modul/mod_kasir/kembalian.php?v=<?php echo rand(1000,9000); ?>",
              data:{
                uang:uang,
                tot:tot,
                uang_tr:uang_tr
              },
              success:function(data){
                $('#kembalian').val(data);
              }
            }); 
		}
     
     
     
     	var uang = $("#uang_k").val();
     	var uang_tr = $("#uang_t").val();
        var tot  = $("#total").val();
            $.ajax({
              type:"post",
              url:"modul/mod_kasir/kembalian.php",
              data:{
                uang:uang,
                tot:tot,
                uang_tr:uang_tr
              },
              success:function(data){
                $('#kembalian').val(data);
              }
            });
    */ }
     // tambah
     $('#form_kasir').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/mod_kasir/tambah_k.php',
            data: $('#form_kasir').serialize(),
            success: function (data) { /*
              if (data=="Yes") {
                alert("Berhasil menambahkan pasien ke dalam antrian");
                window.location.href = "media.php?module=home";
              }else if(data=="No"){
                alert("Tidak ada perawatan atau Produk yang dipilih!\nSilahkan pilih produk atau perawatan terlebih dahulu!!");
              }else if(data=="D"){
                alert("Silahkan Pilih Dokter Terlebih Dahulu!!");
              }else if(data=="kurang"){
                alert("Uang Yang Dimasukan Kurang!!");
              }else if(data=="nama"){
                alert("Silahkan Masukan Nama Pasien Terlebih Dahulu!!");
              }else if(data=="pasien"){
                alert("Nama Pasien Belum Terdaftar! Silahkan Daftarkan Pasien Terlebih Dahulu");
              }else{
              	//alert("Transaksi Berhasil!");
             	$('#form_kasir').trigger("reset");
             	 window.open("modul/mod_kasir/print_kasir.php?nofak="+data,"_BLANK");
              	 location.reload();
              //	window.location.href = "media.php?module=history_transaksi";
              }	 */
            } 
          });

        });
     // cara cari pelanggan
     $('#radio1').click(function () {
        if (this.checked) {
	     	$("#cara2").val("nama");
        }
    });

    $('#radio2').click(function () {
        if (this.checked) {
	        $("#cara2").val("kode");
        }
    });

    $('#radio3').click(function () {
        if (this.checked) {
	        $("#cara2").val("tanggal");
        }
    });
  //total
  function total(){
  	var ongkir = $("#ongkir").val();
  	$.ajax({
  		type: "POST",
  		data:{
  			ongkir:ongkir
  		},
  		url: 'modul/mod_kasir/total.php',
  		success:function(data){
  			var obj = JSON.parse(data);
  			$("#table_total").html(obj.rupiah1);
  			$("#total").val(obj.rupiah)
  			kembalians();
  			var oTable = $('#tabel_kasir').dataTable(); 
            oTable.fnDraw(false);
  		}
  	});
  }
  // collap form produk
  $('#form_tam').on('show.bs.collapse', function () {
  		$("#uang_tu").collapse("show");
	});
  // onload
  window.onload=total();
  // before unload
  window.onbeforeunload = function (){
  	$.ajax({
          url: 'modul/mod_kasir/batal.php',
          success:function(data){
          }
        });
  };

});
</script>