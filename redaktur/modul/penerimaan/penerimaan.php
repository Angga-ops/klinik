<?php
$act = $_GET['act'];
$id_kk = $_SESSION['klinik']; 
switch ($act) {
	case 'reture':
	$nop = $_GET['nop'];
	?>
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Reture Barang</li>
</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Reture Barang</h3>
		</div>
		<div class="box-body">
			<h4>Daftar Barang Yang Sampai</h4>
			<div class="table-responsive">
		        <table class="table table-striped table-bordered" id="dbsampai">
		          <thead>
		            <tr>
		              <th>No</th>
		              <th>Kode Barang</th>
		              <th>Nama Barang</th>
		              <th>Kategori</th>
		              <th>Satuan</th>
		              <th>Harga Jual</th>
		              <th>Jumlah</th>
		              <th>Pilihan</th>
		            </tr>
		          </thead>
		          <tbody>
		          </tbody>
		        </table>
		      </div>
		      <button data-id="<?php echo $nop; ?>" class="btn btn-sm btn-info" id="batal_reture">Batal</button>
		      <button class="btn btn-sm btn-success" data-id="<?php echo $nop; ?>" id="selesai">Selesai</button>
		      <input type="hidden" id="nopeng" value="<?php echo $nop; ?>">
			<hr>
			<h4>Daftar Barang Yang Akan Dikembalikan</h4>
			<div class="table-responsive">
		        <table class="table table-striped table-bordered" id="tbreture">
		          <thead>
		            <tr>
		              <th>No</th>
		              <th>Kode Barang</th>
		              <th>Nama Barang</th>
		              <th>Kategori</th>
		              <th>Satuan</th>
		              <th>Jumlah</th>
		              <th>Keterangan</th>
		              <th>Pilihan</th>
		            </tr>
		          </thead>
		          <tbody>
		          </tbody>
		        </table>
		      </div>
		</div>
	</div>
</section>
	<?php
	break;
	case 'detail':
	$nop = $_GET['nop'];
?>
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Detail Pengiriman</li>
</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Detail Pengiriman</h3>
		</div>
		<div class="box-body">
			<?php $q2 = mysql_query("SELECT *FROM pengiriman WHERE no_pengiriman='$nop'");
        $p = mysql_fetch_array($q2);
      ?>

      <div class="row">
        <div class="col-md-2">
          Nomer Pengiriman 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['no_pengiriman'] ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Tujuan Cabang    
        </div>
        <div class="col-md-5">
          :&emsp; <?php $k = mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$p[cabang]'")); echo $k['nama_klinik']; ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Pengirim 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['pengirim']; ?>
        </div>
      </div>
      <?php if ($p['keterangan']=="Telah Diterima") {?>
        <input type="hidden" id="keterangan" value="<?php echo $p[keterangan]; ?>">
        <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Keterangan 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['keterangan']; ?>
        </div>
      </div>
        <?php
      } ?><br>
      <button class="btn btn-info btn-sm" onclick="window.history.back()">Kembali</button>
      <?php if ($p['keterangan']!="Telah Diterima") {?>
        <button class="btn btn-success btn-sm" id="terima">Selesai</button>
      <a class="btn btn-warning btn-sm" href="media.php?module=penerimaan&act=reture&nop=<?php echo $nop; ?>">Reture</a>
        <?php
      } ?>
      
      
      <input type="hidden" id="nopeng" value="<?php echo $nop; ?>">
      <hr>
      <h4>Daftar Produk Yang Dikirim</h4>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="penerimaan">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Kategori</th>
              <th>Satuan</th>
              <th>Harga Jual</th>
              <th>Jumlah</th>
              <th>Jumlah Yang Diterima</th>
              <th>Ket</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
		</div>
	</div>
</section>

<?php
		break;	
	default:
?>
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Penerimaan Barang</li>
</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Penerimaan Barang</h3>
		</div>
		<div class="box-body">
			<div class="table-responsive">
				<table class="table table-bordered table-striped datatable">
					<thead>
						<tr>
							<th>No Pengiriman</th>
							<th>Tanggal</th>
							<th>Pengirim</th>
							<th>Jumlah Jenis Barang</th>
							<th>Jumlah Total Barang</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php $qpb = mysql_query("SELECT *FROM pengiriman WHERE cabang='$id_kk' ORDER BY tanggal DESC"); 
						while($pb = mysql_fetch_array($qpb)){
							?>
						<tr>
							<td><?php echo $pb['no_pengiriman']; ?></td>
							<td><?php echo $pb['tanggal']; ?></td>
							<td><?php echo $pb['pengirim']; ?></td>
							<td>
								<?php $j = mysql_num_rows(mysql_query("SELECT *FROM produk_pengiriman WHERE no_pengiriman='$pb[no_pengiriman]'")); echo $j; ?>
							</td>
							<td>
								<?php $tb = mysql_fetch_array(mysql_query("SELECT SUM(Jumlah) AS total FROM produk_pengiriman WHERE no_pengiriman='$pb[no_pengiriman]'"));
									echo $tb['total'];
								?>
							</td>
							<td>
                <?php 

                  if ($pb['keterangan']=='Telah Diterima') { ?>
                <a href="media.php?module=penerimaan&act=detail&nop=<?php echo $pb[no_pengiriman]; ?>" class="btn btn-xs btn-primary"><i class="fa fa-list"></i> Detail</a>
                <a href="modul/penerimaan/cetak_penerimaan.php?nop=<?php echo $pb[no_pengiriman]; ?>" class="btn btn-xs btn-success"><i class="fa fa-print"></i> Cetak</a>
                 <?php }else{ ?>
                <a href="media.php?module=penerimaan&act=detail&nop=<?php echo $pb[no_pengiriman]; ?>" class="btn btn-xs btn-info"><i class="fa fa-check"></i>Cek</a>
                  <?php
                  }

                ?>
                
              </td>
						</tr>
							<?php
						} ?>
						
					</tbody>
				</table>
			</div>
		</div>
	</div>
</section>
<?php
		break;
}
?>
<div  class="modal fade" id="modal_reture">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Reture Barang</h4>
              </div>
              <div class="modal-body">
                <form method="POST" id="form_reture">
                  <input class="form-control" type="hidden" name="id" id="mnop">
                  <input type="hidden" name="act" id="src">
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input class="form-control" type="text" name="kb" id="kb" required readonly>
                  </div>
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input class="form-control" type="text" name="nb" id="nb" required readonly>
                  </div>
                  <div class="form-group">
                    <label>Jumlah Barang Yang Dikembalikan</label>
                    <input class="form-control" type="number" name="jum" id="jumlah_bk" min="1" required>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <textarea class="form-control" type="text" name="ket" id="mket" required></textarea>
                  </div>
                  <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
                  <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">Selesai</button>
                </form>
              </div>
             
            </div>
          </div>
</div>

<div  class="modal fade" id="modal_penerimaan">
  <div class="modal-dialog">
    <div class="modal-content" style="width: 100%;">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
        <span aria-hidden="true">&times;</span></button>
        <h4 class="modal-title">Cek Barang</h4>
      </div>
        <div class="modal-body">
          <form method="POST" id="form_cek">
            <input class="form-control" type="hidden" name="id" id="pnop">
              <div class="form-group">
                <label>Jumlah Barang Yang Diterima</label>
                <input class="form-control" type="number" name="jumlah" id="jumlah_dt" min="1" required>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <select class="form-control" name="ket" id="pket" required>
                  <option value="Sesuai">Sesuai</option>
                  <option value="Tidak Sesuai">Tidak Sesuai</option>
                </select>
             </div>
            <button type="button" class="btn btn-sm btn-default pull-left" data-dismiss="modal">Batal</button>
            <button type="submit" class="btn btn-sm btn-primary" style="margin-left: 5px;">Selesai</button>
          </form>
        </div>           
      </div>
  </div>
</div>

<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  var nop = $("#nopeng").val();
  var ket = $("#keterangan").val();
  // Terima pengiriman
  $("#terima").click(function(){
  	var nop = $("#nopeng").val();
  	$.ajax({
  		  type : "POST",
  		  data : {nop:nop},
          url: 'modul/penerimaan/aksi_penerimaan.php',
          success:function(data){
            if (data=='belum semua') {
              alert("Terdapat Produk Yang Belum Dicek!");
            }else{
              alert("Pengiriman Berhasil Diterima");
              window.location.href = "media.php?module=penerimaan";
            }
          }
        });
  	});
    // Table penerimaan
    $('#penerimaan').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/penerimaan/data_penerimaan.php?nop="+nop,
      "columnDefs": [{
        "orderable": false
    }],
      "fnRowCallback": function (nRow, aData, iDisplayIndex) {
           var info = $(this).DataTable().page.info();
           $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
           return nRow;
       },
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [8] }],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
            if (ket=="Telah Diterima") {
              return '-';
            }else{
              if (row[8]==null) {
                return '<button id="cek" data-id="'+data+'" class="btn btn-primary btn-xs"><i class="fa fa-check"></i> Cek</button>';
              }else{
                return '<button id="cek" data-id="'+data+'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button>';
              }
            }
          }
        }
      ]
    });
  	// Datatable produk yang sampai di retur
  	$('#dbsampai').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/penerimaan/produk_sampai.php?nop="+nop,
      "columnDefs": [{
        "orderable": false
    }],
      "fnRowCallback": function (nRow, aData, iDisplayIndex) {
           var info = $(this).DataTable().page.info();
           $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
           return nRow;
       },
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, full ) {
          return '<button id="reture" data-id="'+data+'" class="btn btn-warning btn-xs">Reture</button>';
          }
        }
      ]
    });
  	// Table reture
  	$('#tbreture').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/penerimaan/produk_reture.php?nop="+nop,
      "columnDefs": [{
        "orderable": false
      }],
      "fnRowCallback": function (nRow, aData, iDisplayIndex) {
           var info = $(this).DataTable().page.info();
           $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
           return nRow;
       },
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, full ) {
          return '<button id="edit_r" data-id="'+data+'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button> <button id="batal" data-id="'+data+'" class="btn btn-success btn-xs">Batal</button>';
          }
        }
      ]
    });
    // tombol reture
    $('body').on("click","#reture",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/penerimaan/reture.php',
              data:{
                id:id
              },
              success:function(data){

                 var obj = JSON.parse(data);
                
                $("#src").val("input");
                $("#nb").val(obj.nama);
                $("#kb").val(obj.kode);
                $("#mnop").val(obj.nop);
                $("#jumlah_bk").attr({
      			       "max" : obj.jumlah     
      			    });

                $("#modal_reture").modal("show");

              }
          });
     });
    // Cek barang
    $('#form_cek').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/penerimaan/cek_produk.php',
            data: $('#form_cek').serialize(),
            success: function (data) {
              alert("Barang Telah Diperiksa");
              $("#modal_penerimaan").modal("hide");
              var otable = $('#penerimaan').dataTable();
              otable.fnDraw(false);
               $('#form_cek').trigger("reset");
            }
          });

        });
    // Tambah produk yang dikembalikan
    $('#form_reture').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/penerimaan/tambah_preture.php',
            data: $('#form_reture').serialize(),
            success: function (data) {
              if(data=="edit"){
              	alert("Berhasil Mengedit");
              }else{
              	alert("Berhasil menambahkan");
              }
              $("#modal_reture").modal("hide");
              var otable = $('#tbreture').dataTable();
              otable.fnDraw(false);
               $('#form_reture').trigger("reset");
            }
          });

        });
    // cek barang
    $('body').on("click","#cek",function(){

          var id  = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/penerimaan/cek.php',
              data:{
                id:id
              },
              success:function(data){

                 var obj = JSON.parse(data);
                
                $("#pnop").val(obj.nop);
                $("#jumlah_dt").val(obj.jumlah);
                $("#pket").val(obj.ket);
                $("#jumlah_dt").attr({
             "max" : obj.jumlah     
          });

                $("#modal_penerimaan").modal("show");

              }
          });
     });
    // Edit barang yang reture
  	$('body').on("click","#edit_r",function(){

          var id  = $(this).data("id");
          var src = "rs"; 
          $.ajax({
              type:'POST',
              url: 'modul/penerimaan/reture.php',
              data:{
                id:id,src:src
              },
              success:function(data){

                 var obj = JSON.parse(data);
                
                $("#nb").val(obj.nama)
                $("#src").val("edit");
                $("#kb").val(obj.kode);
                $("#mnop").val(obj.nop);
                $("#jumlah_bk").val(obj.jumlah);
                $("#mket").val(obj.ket);
                $("#jumlah_bk").attr({
			       "max" : obj.limit     
			    });

                $("#modal_reture").modal("show");

              }
          });
     });
  	// Batal
  	$('body').on("click","#batal",function(){

          var id  = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/penerimaan/batal.php',
              data:{
                id:id
              },
              success:function(data){
              	alert("Berhasil Membatalkan");
              	var otable = $('#tbreture').dataTable();
              	otable.fnDraw(false);
              }
          });
     });
  	// Batal Reture
  	$("#batal_reture").click(function(){
  		var nop  = $(this).data("id");
  		$.ajax({
              type:'POST',
              url: 'modul/penerimaan/batal_reture.php',
              data:{
                nop:nop
              },
              success:function(data){
              	window.history.back();
              }
          });

  	});
  	// Selesai
  	$("#selesai").click(function(){
  		var nop  = $(this).data("id");
  		$.ajax({
  			  type:'POST',
              url: 'modul/penerimaan/aksi_reture.php',
              data:{
                nop:nop
              },
              success:function(data){
              	window.location.href = "media.php?module=penerimaan";
              }
          });

  	});
});
</script>