<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h1 class="box-title">GUDANG</h1>
		</div>
		<div class="box-body">
			<a href="media.php?module=pengiriman&act=tambah" class="btn btn-primary btn-sm">Pengiriman Baru <i class="fa fa-plus"></i></a>
			<br><br>
			<div class="table-responsive">
			<table class="table table-striped table-bordered datatable">
				<thead>
					<tr>
						<th>Kode Produk</th>
						<th>Nama Produk</th>
						<th>Stok</th>
						<th>Harga Beli</th>
					</tr>
				</thead>
				<tbody>
					<?php $q1 = mysql_query("SELECT * FROM produk_pusat");
						  while($pp = mysql_fetch_array($q1)){ 
							  $be = mysql_fetch_array(mysql_query("SELECT harga FROM "))
							  ?>
					<tr>
						<td><?php echo $pp["kode_barang"]; ?></td>
						<td><?php echo $pp["nama_p"]; ?></td>


						<td><?php echo $pp["jumlah"]; ?></td>
						<td><?php echo $pp["harga_beli"]; ?></td>
							</tr>
						  	<?php
						  }
					 ?>
					
				</tbody>
			</table>
		</div>
	</div>
</section>