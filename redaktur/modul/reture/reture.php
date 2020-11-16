<?php 
$act = $_GET['act'];
$nor = $_GET['nor'];
switch ($act) {
	case 'detail':
?>
<!-- Start Detail -->
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Detail Reture Barang</li>
</ol>
</section>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Detail Reture</h3>
		</div>
		<div class="box-body">
			<?php $p = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM reture WHERE no_reture='$nor'")); ?>
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
	          :&emsp; <?php $k = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$p[asal_cabang]'")); echo $k['nama_klinik']; ?>
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
	      <?php if($p['keterangan']!='Selesai'){ ?>
	      	<button id="terima" data-id="<?php echo $p['no_reture']; ?>" class="btn btn-success btn-sm">Terima</button>
	      	<?php
	      } ?>
	      <hr>
	      	<h4>Daftar Barang Yang Dikembalikan</h4>
	      	<div class="table-responsive">
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
					<?php $q = mysqli_query($con,"SELECT *FROM produk_reture WHERE no_reture='$nor'"); 
						 while($r = mysqli_fetch_array($q)){
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
	</div>
</section>
<!-- End Detail -->
<?php
		break;
	
	default: ?>
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
			<h3 class="box-title">Daftar Reture</h3>
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered datatable">
				<thead>
					<tr>
						<th>No Reture</th>
						<th>No Pengiriman</th>
						<th>Tanggal</th>
						<th>Pengirim</th>
						<th>Asal Cabang</th>
						<th>Keterangan</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php $q = mysqli_query($con,"SELECT *FROM reture ORDER BY tanggal DESC"); 
						 while($r = mysqli_fetch_array($q)){
						 	?>
					<tr>
						<td><?php echo $r['no_reture']; ?></td>
						<td><?php echo $r['no_pengiriman']; ?></td>
						<td><?php echo $r['tanggal']; ?></td>
						<td><?php echo $r['pengirim']; ?></td>
						<td><?php $k = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$r[asal_cabang];'")); echo $k['nama_klinik']; ?></td>
						<td><?php echo $r['keterangan']; ?></td>
						<td><a href="media.php?module=reture&act=detail&nor=<?php echo $r['no_reture']; ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Detail</a></td>
					</tr>
						 	<?php
						 }
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
<?php
		break;
}

 ?>
 <script>
 	$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
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

});
 </script>