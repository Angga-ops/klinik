<?php
	session_start();
	require ('aksi_log.php');
	cek_user();
	sambung();
	$log		= new db();
	if(isset($_GET['reset']) && isset($_SESSION['leveluser'])){
	$log->sql("TRUNCATE log");
	catat($_SESSION['namauser'],"Menghapus Log/Aktivitas");
	}
	$lihat		= mysql_real_escape_string($_GET['item']);
	$tambah		= $lihat + 90000000000;
	if($lihat	== ''){
	$lihat	= '100';
	}
	$log->sql("SELECT * FROM log ORDER BY id ASC LIMIT 0, $lihat");
	?>
	<script type="text/javascript">
	function reset() {
	var tanya = confirm('Yakin Reset Semua Aktivitas??');
	if(tanya) {
	location='media.php?module=log&reset';
	}
	}
	</script>
		<div id='main-content'>
			<div class='container_12'>
				<div class='grid_12'>
                   <br/>
                   <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_log/del_log.php?module=hapus" class="button">
                   <span>Hapus Log Aktivitas</span>
                   </a>
				<div class='grid_12'>
					<div class='block-border'>
						<div class='block-header'>
							<h1>Log / Aktivitas</h1>
							<span></span>
						</div>
						<div class='block-content'>
							<table class='table table-bordered table-stripped datatable'>
							   <thead>
							   <tr>
								   <th>User</th>
								   <th>Waktu</th>
								   <th>Tindakan/Aktivitas</th>
							   </tr>
							   </thead>
							   <tbody>
							   		<?php
								      $tampil = mysql_query("SELECT * FROM log");
									    while($r=mysql_fetch_array($tampil)){
							   		?>
									<tr class=gradeX>
									   <td><?php echo $r['username']; ?></td>
									   <td><?php echo $r['tanggal']; ?></td>
									   <td><?php echo $r['aksi']; ?></td>
									</tr>
									<?php
									}
									?>
							   </tbody>
							</table>
						</div>
					</div>
				</div>
			<div class='clear height-fix'></div>
			</div>
		</div>