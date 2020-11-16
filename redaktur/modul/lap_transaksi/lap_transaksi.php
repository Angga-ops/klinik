<?php
$nama = $_GET['np'];
$act  = $_GET['act'];
switch ($act) {
	case 'detail':
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Transaksi</h3>
		</div>
		<div class="box-body">
			<?php 
			
			$q = mysqli_query($con, "SELECT *FROM pasien WHERE nama_pasien='$nama'"); 
			$p = mysqli_fetch_array($q);

			?>
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<div class="row">
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama 
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['nama_pasien']; ?>	
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No Telp
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['no_telp']; ?> 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Alamat
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['alamat']; ?>		 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Total Transaksi
							</div>
							<div class="col-md-6">
								:&emsp;
								<?php 
								$id_kk = $_SESSION['klinik'];
								if ($_SESSION['jenis_u']=="JU-06") {
									$tt = mysqli_num_rows(mysqli_query($con, "SELECT *FROM pembayaran WHERE id_pasien='$p[id_pasien]' AND id_kk='$id_kk' ")); 
								}else{
									$tt = mysqli_num_rows(mysqli_query($con, "SELECT *FROM pembayaran WHERE id_pasien='$p[id_pasien]'")); 
								}
								
								echo $tt; 
								?>	 
							</div>
						</div>
					</div>
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Tanggal Lahir
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['tgl_lahir']; ?>	 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Jenis Kelamin
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['jk']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Total Kunjungan
							</div>
							<div class="col-md-6">
								:&emsp;<?php echo $p['total_kunjungan']; ?>		 
							</div>
						</div>
					</div>
				</div>
			</div>
			<hr>
			<h4 class="pull-left">Daftar Transaksi</h4><br>
			<a  href="modul/lap_transaksi/cetak_lap.php?id=<?php echo $p['id_pasien']; ?>" class="btn btn-sm btn-success pull-right"><i class="fa fa-print"></i> Cetak Laporan</a>
			<br><br>
			<div class="table-responsive">
				<table class="table table-bordered table-striped datatable2" width="100%">
					<thead>
						<tr>
							<th>No Faktur</th>
							<th>Produk</th>
							<th>Treatment</th>
							<th>Total</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						$id_kk = $_SESSION['klinik'];
								if ($_SESSION['jenis_u']=="JU-06") {
									$qt = mysqli_query($con, "SELECT *FROM pembayaran WHERE id_pasien='$p[id_pasien]' AND id_kk='$id_kk'"); 
								}else{
									$qt = mysqli_query($con, "SELECT *FROM pembayaran WHERE id_pasien='$p[id_pasien]'"); 
								}
						

						while($t = mysqli_fetch_array($qt)){ ?>
						<tr>
							<td><?php echo $t['no_faktur']; ?></td>
							<td>
							<?php 
								$qp = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS produk FROM history_kasir WHERE no_faktur='$t[no_faktur]' AND jenis='Produk'"));
								if($qp['produk']==null){
									echo "-";
								}else{
									echo $qp['produk']; 
								}  
							?>
							</td>
							<td>
								<?php
								$qq = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS treatment FROM history_kasir WHERE jenis='Treatment' AND no_faktur='$t[no_faktur]'"));
								if($qq['treatment']==null){
									echo "-";
								}else{
									echo $qq['treatment']; 
								}
								?>
							</td>
							<td><?php echo rupiah($t['total']); ?></td>
							<td>
								<a href="media.php?module=history_transaksi&act=detail&nofak=<?php echo $t['no_faktur'] ?>" class="btn btn-xs btn-info"><i class="fa fa-list"></i> Detail</a>
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
</section>
<?php
		break;
	
	default:
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Transaksi</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<label>Masukan Nama Pelanggan</label><br>
					<input id="cari_pel" style="width: 75%;float: left;margin-right: 10px;" class="form-control" type="text" name="nama">
					<button id="tampilkan" style="margin-top: 3px;" class="btn btn-info btn-sm"><i class="fa fa-search"></i> Cari</button>
				</div>
			</div>
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
  // cari
  $( "#cari_pel" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/lap_transaksi/cari.php",
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
       $('#cari_pel').val(ui.item.label);
       return false;
      }
     });
  // tampilkan data transaksi
  $("#tampilkan").click(function(){
  	 var nama = $("#cari_pel").val();
  	 window.location.href = "media.php?module=lap_transaksi&act=detail&np="+nama; 
  });
  // 
});
</script>