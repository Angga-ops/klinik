<?php
	$act = $_GET['act'];

switch ($act) {
	case 'detail':
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Detail History Pasca Treatment Pasien</h3>
		</div>
		<div class="box-body">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				<?php 
				$nama = $_GET['np'];
				$pem = mysql_fetch_array(mysql_query("SELECT *FROM pasien WHERE nama_pasien='$nama'"));

				?>
				<div class="row">
					<div class="col-md-6">
					<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No. RM
							</div>
							<div class="col-md-6" id="data_n">
								:&emsp;<?php echo $pem['id_pasien']; ?>
							</div>
						</div>
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
					</div>
				</div>
			</div>
			<hr>
			<h4>History SOA Pasien</h4>
			<div class="table-responsive">
				<table class="table-striped table table-bordered datatable">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Dokter</th>
							<th>Subjek</th>
							<th>Objek</th>
							<th>Assestment</th>
							<th>Produk</th>
							<th>Treatment</th>
							<th>Foto</th>
							<th>Pilihan</th>
						</tr>
					</thead>
					<tbody>
						<?php $q =  mysql_query("SELECT *FROM pasca_treatment WHERE id_pasien='$pem[id_pasien]' ORDER BY tanggal DESC"); 
							  while($pc = mysql_fetch_array($q)){ ?>
						<tr>
							<td><?php echo $pc['tanggal']; ?></td>
							<td>
								<?php 
								$d = mysql_fetch_array(mysql_query("SELECT *FROM user WHERE id_user='$pc[id_dr]'"));
								echo $d['nama_lengkap'];
								?>
							</td>
							<td><?php echo $pc['subjek']; ?></td>
							<td><?php echo $pc['objek']; ?></td>
							<td><?php echo $pc['assestment']; ?></td>
							<td>
								<?php $q1 = mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$pc[no_faktur]' AND jenis='Produk'"); 
								$cekp = mysql_num_rows($q1);
								if ($cekp>0) {
									echo "| ";
									while ($p=mysql_fetch_array($q1)) {
										echo $p['nama'];
										echo " | ";
									}
								}else{
									echo "Tidak Ada Produk ";
								}
								?>
							</td>
							<td>
								<?php $q2 = mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$pc[no_faktur]' AND jenis='Treatment'"); 
								$cekt = mysql_num_rows($q2);
								if ($cekt>0) {
									echo "| ";
									while ($t=mysql_fetch_array($q2)) {
										echo $t['nama'];
										echo " | ";
									}
								}else{
									echo "Tidak Ada Treatment";
								}
										
								?>
							</td>
							<td>
								<?php if ($pc['foto1']!=null) {
									?><img width="200" src="../file_user/foto_pasien/<?php echo $pc['foto1']; ?>"><?php
								}else if($pc['foto2']!=null){
									?><img width="200" src="../file_user/foto_pasien/<?php echo $pc['foto2']; ?>"><?php
								}else if ($pc['foto3']!=null){
									?><img width="200" src="../file_user/foto_pasien/<?php echo $pc['foto3']; ?>"><?php
								}else if($pc['foto4']!=null){
									?><img width="200" src="../file_user/foto_pasien/<?php echo $pc['foto4']; ?>"><?php
								} ?>
								
							</td>
							<td><a href="media.php?module=history_pc&act=detail&nofak=<?php echo $pc['no_faktur']; ?>" class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Detail</a></td>
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
	
	default:
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">History Pasca Treatment Pasien</h3>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<label>Masukan Nama Pasien</label><br>
					<input id="cari_pas" style="width: 75%;float: left;margin-right: 10px;" class="form-control" type="text" name="nama">
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
  $( "#cari_pas" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/history_pcp/cari.php",
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
       $('#cari_pas').val(ui.item.label);
       return false;
      }
     });
  // tampilkan data transaksi
  $("#tampilkan").click(function(){
  	 var nama = $("#cari_pas").val();
  	 window.location.href = "media.php?module=history_pcp&act=detail&np="+nama; 
  });
  // 
});
</script>