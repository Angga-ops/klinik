<?php $id_kk = $_GET['id']; ?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="box-title">Laporan Stok Klinik</h1>
		</div>
		<div class="box-body">
			<div class="row">
				<div class="col-md-6">
					<select class="form-control" id="select_klinik">
						<?php if(empty($_GET['id'])){    ?>
						<option>Pilih Klinik ..</option>
						<?php } 
						 $q1 = mysql_query("SELECT *FROM daftar_klinik"); while ($dk = mysql_fetch_array($q1)) {
							?>
								<option <?php if($dk['id_kk']==$id_kk){ echo 'selected'; } ?> value="<?php echo $dk[id_kk]; ?>"><?php echo $dk['nama_klinik']; ?></option>
							<?php
						} ?>
					</select>
				</div>
				<div class="col-md-6">
					<div class="pull-right">
					<a href="modul/laporan_stok/cetak_stok.php?id_kk=<?php echo $id_kk?>" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Stock</a>
				</div>
				</div>
			</div><br>
			<div class="table-responsive">
				<table class="table table-striped table-bordered datatable">
					<thead>
						<tr>
							<th>Nama Klinik</th>
							<th>Nama Barang</th>
							<th>Stok Produk</th>
						</tr>
					</thead>
					<tbody>
						<?php 
						if(empty($_GET['id'])){
							$q2 =  mysql_query("SELECT *FROM produk");
						}else {
							$q2 =  mysql_query("SELECT *FROM produk WHERE id_kk='$id_kk'");
						}

						 	while ($p=mysql_fetch_array($q2)) { ?>
						 		<tr>
						 			<td><?php $k =  mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$p[id_kk]'")); echo $k['nama_klinik']; ?></td>
									<td><?php echo $p['nama_p']; ?></td>
									<td><?php echo $p['jumlah']; ?></td>
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
<script>
	$("#select_klinik").change(function() {
		var id = $(this).val();
		window.location.href = "media.php?module=lap_stock&id="+id;
	})
</script>