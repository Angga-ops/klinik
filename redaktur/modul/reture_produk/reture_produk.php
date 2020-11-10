<?php 
$act = $_GET['act'];
$nor = $_GET['nor'];
$id_kk = $_SESSION["klinik"];
switch ($act) {
	case 'tambah':
?>
<section class="content-header"> 
<h1>
  Resepsionis
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Tambah Reture Produk</li>
</ol>
</section>

<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Tambah Reture</h3>
		</div>
		<div class="box-body">
			<h4>Pilih Produk Yang Akan Direture</h4>
			<form method="post" id="produk_reture">
	        <div class="row">
	          <div class="col-md-2">
	            <label>Kode Produk</label>
	            <input class="form-control" type="text" name="kd_brg" id="kode_brg" required>
	          </div>
	          <div class="col-md-2">
	            <label>Nama Produk</label>
	            <input class="form-control" type="text" name="nama_brg" id="nama_brg" required>
	          </div>
	          <div class="col-md-2">
	            <label>Jumlah</label>
	            <input class="form-control" type="number" name="jumlah" value="1">
	          </div>
	          <div class="col-md-4">
	            <label>Keterangan</label>
	            <input class="form-control" type="text" name="ket">
	          </div>
	        </div>
	        <div class="form-group">
	          <br>
	          <button class="btn btn-success btn-sm" type="submit"><i class="fa fa-plus"></i> Tambah Produk</button>
	          <input type="button" class="btn btn-sm btn-danger" onclick="this.form.reset();" value="Reset Form">
	          <button class="btn btn-warning btn-sm" type="button" id="reset_table">Reset Table</button>
	        </div>
	      </form>
	      	<h4>Daftar Produk Yang Akan Direture</h4>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" id="tabel_r">
					<thead>
						<tr>
							<th>No</th>
							<th>Kode Produk</th>
							<th>Nama Produk</th>
							<th>Jumlah Reture</th>
							<th>Keterangan</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<hr>
			<h4>Data Reture</h4>
			<?php 
			$q = mysql_query("SELECT *FROM reture WHERE asal_cabang='$_SESSION[klinik]'");
			$k = mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$_SESSION[klinik]'"));
			$cek =mysql_num_rows($q);
			if ($cek>0) {
				$nor ="R";
				$nor .= inisial2($k['nama_klinik']);
				$isi = array();
				while ($r=mysql_fetch_array($q)) {
					$isi[] = substr($r['no_retur'], 3);
				}
				$max = max($isi);
				if ($max==null) {
					$max = 1;
				}
				$nor .="-".$max;
			}else{
				$nor ="R";
				$nor .= inisial2($k['nama_klinik']);
				$nor .= "-1";
			}
			$tgl = date("Y-m-d");
			?>
			<form id="form_reture">
				<div class="row">
					<div class="col-md-4">
						<label>Nomor Reture</label>
						<input class="form-control" type="text" name="no_reture" value="<?php echo $nor; ?>">
					</div>
					<div class="col-md-4">
						<label>Tanggal</label>
						<input class="form-control datepicker" type="text" name="tgl" value="<?php echo $tgl; ?>">
					</div>
				</div>
				<div class="row" style="margin-top: 10px;">
					<div class="col-md-4">
						<button type="submit" class="btn btn-success btn-sm">Simpan</button>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>
<?php
		break;
	case 'detail':
?>
<!-- Start Detail -->
<section class="content-header"> 
<h1>
  Resepsionis
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Detail Reture Produk</li>
</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Detail Reture</h3>
		</div>
		<div class="box-body">
			<?php $p = mysql_fetch_array(mysql_query("SELECT *FROM reture WHERE no_reture='$nor'")); ?>
		  <div class="row">
	        <div class="col-md-2">
	          Nomer Reture 
	        </div>
	        <div class="col-md-5">
	          :&emsp; <?php echo $p['no_reture'] ?>
	        </div>
	      </div>
	      <div class="row" style="margin-top: 5px;">
	        <div class="col-md-2">
	          Asal Cabang    
	        </div>
	        <div class="col-md-5">
	          :&emsp; <?php $k = mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$p[asal_cabang]'")); echo $k['nama_klinik']; ?>
	        </div>
	      </div>
	      <div class="row" style="margin-top: 5px;">
	        <div class="col-md-2">
	          Tanggal 
	        </div>
	        <div class="col-md-5">
	          :&emsp; <?php echo $p['tanggal']; ?>
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
	      <div class="row" style="margin-top: 5px;">
	        <div class="col-md-2">
	          Keterangan 
	        </div>
	        <div class="col-md-5">
	          :&emsp; <?php echo $p['keterangan']; ?>
	        </div>
	      </div><br>
	      <button class="btn btn-info btn-sm" onclick="window.history.back()">Kembali</button>
	      <hr>
	      	<h4>Daftar Barang Yang Dikembalikan</h4>
			<table class="table table-striped table-bordered datatable">
				<thead>
					<tr>
						<th>Kode Barang</th>
						<th>Nama Barang</th>
						<th>Jumlah</th>
						<th>Keterangan</th>
					</tr>
				</thead>
				<tbody>
					<?php $q = mysql_query("SELECT *FROM produk_reture WHERE no_reture='$nor'"); 
						 while($r = mysql_fetch_array($q)){
						 	?>
					<tr>
						<td><?php echo $r['kode_produk']; ?></td>
						<td><?php echo $r['nama_produk']; ?></td>
						<td><?php echo $r['jumlah']; ?></td>
						<td><?php echo $r['keterangan']; ?></td>
					</tr>
						 	<?php
						 }
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<!-- End Detail -->
<?php
		break;
	
	default: ?>
<section class="content-header"> 
<h1>
  Resepsionis
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Reture Produk</li>
</ol>
</section>



<section class="content">
	<div class="row">
      <div class="col-md-12">
        <div class="callout callout-success">
            <a style="text-decoration: none;" href="media.php?module=reture_produk&act=tambah" class="btn btn-warning btn-sm">Tambah Reture</a>

        </div>
      </div>
    </div>

	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Daftar Reture</h3>
		</div>
		<div class="box-body">
      <div class="table-responsive">
			<table class="table table-striped table-bordered datatable">
				<thead>
					<tr>
						<th>No Reture</th>
						<th>No Pengiriman</th>
						<th>Tanggal</th>
						<th>Pengirim</th>
						<th>Keterangan</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php $q = mysql_query("SELECT *FROM reture WHERE asal_cabang='$id_kk' ORDER BY tanggal DESC"); 
						 while($r = mysql_fetch_array($q)){
						 	?>
					<tr>
						<td><?php echo $r['no_reture']; ?></td>
						<td>
							<?php 
								if ($r['no_pengiriman']==null) {
									echo "-";
								}else{
									echo $r['no_pengiriman']; 
								}
							?>	
						</td>
						<td><?php echo $r['tanggal']; ?></td>
						<td><?php echo $r['pengirim']; ?></td>
						<td><?php echo $r['keterangan']; ?></td>
						<td><a href="media.php?module=reture_produk&act=detail&nor=<?php echo $r[no_reture]; ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Detail</a></td>
					</tr>
						 	<?php
						 }
					?>
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
 <div  class="modal fade" id="modal_edit">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Produk Reture</h4>
              </div>
              <div class="modal-body">
                <form method="POST" id="form_edit">
                  <input class="form-control" type="hidden" id="id_brg" name="id">
                  <div class="form-group">
                    <label>Kode Produk</label>
                    <input class="form-control" type="text" name="kb" id="kb">
                  </div>
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input class="form-control" type="text" name="nb" id="nb">
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input class="form-control" type="number" name="jum" id="j">
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input class="form-control" type="text" name="ket" id="ket">
                  </div>
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="edit_s">Edit</button>
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
  // aw
  $('#tabel_r').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/reture_produk/tbl_reture.php",
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
        {
        "mData": "0",
        "mRender": function ( data, type, full ) {
          return '<button id="edit_brg" data-id="'+data+'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button> <button id="hapus_brg" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          }
        }
      ]
    } );
  // terima baranG  reture
  $("#terima").click(function(){
  		var nor  = $(this).data("id");
  		$.ajax({
  			  type:'POST',
              url: 'modul/reture/terima_reture.php',
              data:{
                nor:nor
              },
              success:function(data){
              	window.location.href = "media.php?module=reture";
              }
          });

  	});
  // 
  // Auto complete
  $( "#kode_brg" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/reture_produk/cari.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kode_brg').val(ui.item.label);
       $('#nama_brg').val(ui.item.nama);
       
       return false;
      }
     });
  // Nama BRG
  $( "#nama_brg" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/reture_produk/cari.php?src=nama",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kode_brg').val(ui.item.kode);
       $('#nama_brg').val(ui.item.label);

       return false;
      }
     });
  // Tambah Produk
  $('#produk_reture').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/reture_produk/tambah_produk.php',
            data: $('#produk_reture').serialize(),
            success: function (data) {
              var otable = $('#tabel_r').dataTable();
              otable.fnDraw(false);
               $('#produk_reture').trigger("reset");
            }
          });

        });
  // // Hapus barang
    $('body').on("click","#hapus_brg",function(){

          var id_p = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/reture_produk/hapus.php',
              data:{
                id_p:id_p
              },
              success:function(data){
                  var oTable = $('#tabel_r').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
    // EDIT
    $('body').on("click","#edit_brg",function(){

          var id_p = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/reture_produk/edit.php',
              data:{
                id_p:id_p
              },
              success:function(data){

                 var obj = JSON.parse(data);
                
                $("#nb").val(obj.nama);
                $("#kb").val(obj.kode);
                $("#j").val(obj.jum);
                $("#ket").val(obj.ket);
                $("#id_brg").val(obj.id);

                $("#modal_edit").modal("show");

              }
          });
     });
    // Edit
    $("#form_edit").on("submit",function(e){
      e.preventDefault();
      $.ajax({
              type:'POST',
              url: 'modul/reture_produk/aksi_edit.php',
              data: $('#form_edit').serialize(),
              success:function(data){
                  alert("Berhasil mengedit");
                  $('#form_edit').trigger("reset");
                  $("#modal_edit").modal("hide");
                  var oTable = $('#tabel_r').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
    });
    // reture
    $("#form_reture").on("submit",function(e){
      e.preventDefault();
      $.ajax({
              type:'POST',
              url: 'modul/reture_produk/aksi_reture.php',
              data: $('#form_reture').serialize(),
              success:function(data){
                  if (data=="No") {
                    alert("Produk Yang Akan Direture Belum Ada!!")
                  }else{
                    alert("Reture Berhasil");
                    window.location.href = "media.php?module=reture_produk";
                }
              }
          });
    });
});
 </script>