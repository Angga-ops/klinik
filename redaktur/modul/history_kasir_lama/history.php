<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">History Billing Lama</h4>
		</div>
		<div class="box-body">
						<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-12">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Dar Tanggal</label></td>
								<td><input id="tanggal_h" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" style="float: left;text-align: center;"></td>
								<td><label>Sampai Tanggal</label></td>
								<td><input id="tanggal_j" class="form-control datepicker" value="<?php echo date("Y-m-d"); ?>" style="float: left;text-align: center;"></td>
								<td><button class="btn btn-info" onclick="cari_h()">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="table-responsive">
			<table class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						<th>No Billing</th>
						<th>ID Pasien</th>
						<th>Nama Pasien</th>
						<th>Poliklinik</th>
						<th>Penjamin</th>
						<th>Jenis Layanan</th>
						<th>Status</th>
						<th>Aksi</th>
					</tr>
				</thead>
				<tbody>
                        <?php
                        $tgl = isset($_GET[tgl1])? "WHERE tanggal_pendaftaran >= '$_GET[tgl1]' AND tanggal_pendaftaran <= '$_GET[tgl2]'" : "";
						$k = mysql_query("SELECT * FROM antrian_pasien_lama $tgl ORDER BY tanggal_pendaftaran DESC");
				

                        while($ku = mysql_fetch_assoc($k)){
                            $pas = mysql_fetch_assoc(mysql_query("SELECT * FROM pasien WHERE id_pasien = '$ku[id_pasien]'"));
							$poli = mysql_fetch_assoc(mysql_query("SELECT * FROM poliklinik WHERE id_poli = '$ku[poliklinik]'"));
							echo "<tr>";
							echo "<td>$ku[no_faktur]</td>";
							echo "<td>$ku[id_pasien]</td>";
                            echo "<td>$pas[nama_pasien]</td>";
							echo "<td>$poli[poli]</td>";
							echo "<td>$ku[jenis_pasien]</td>";
							echo "<td>$ku[jenis_layanan]</td>";
							echo "<td>$ku[status]</td>";
                            echo "<td><a href='?module=detail_kasir_lama&faktur=$ku[no_faktur]'><button class='btn btn-sm btn-info'>Detail</button></a> &nbsp; <a href=''><button class='btn btn-sm btn-danger'>Hapus</button></a></td>";
                            echo "</tr>";
                        }
                        
                        ?>			
				</tbody>
			</table>
			</div>
			<!-- End -->
							</div>
	</div>
</section>
<script>
function cari_h(){
	location.href = "?module=history_kasir_lama&tgl1=" + $("#tanggal_h").val() + "&tgl2=" + $("#tanggal_j").val();
}
</script>