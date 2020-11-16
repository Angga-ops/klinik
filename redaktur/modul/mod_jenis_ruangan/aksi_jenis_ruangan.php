<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];

	// Hapus data_gtm
	if ($module == 'ruangan' AND $act == 'hapus'){
		$id		= $_GET['id'];		
		$del	= mysqli_query($con, "Delete From kamar_jenis Where id_jenkamar='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Jenis Ruangan'.' ('.$id.')');
		?>
		<script type="text/javascript">
		window.location.href="../../media.php?module=jenis_ruangan";        
		</script>
		<?php		
	}
	// Input data_gtm Baru
	elseif ($module == 'ruangan' AND $act ==  'input') {
		$poli		= $_POST['tujuan'];
		$nm			= $_POST['nama'];
		$simpan		= mysqli_query($con, "Insert Into kamar_jenis(id_poli,kelas) Values('$poli','$nm')") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Data Jenis Ruangan Baru'.' ('.$nm.')');
		if($simpan){
		?>
		<script type="text/javascript">
		window.location.href="../../media.php?module=jenis_ruangan";        
		</script>
		<?php
		} else {
		?>
		<script type="text/javascript">
		alert("Data Gaga Disimpan!");
		window.location.href="../../media.php?module=jenis_ruangan";        
		</script>
		<?php		
		}
	}
	//Update data_gtm yang Ada
	elseif ($module == 'ruangan' AND $act ==  'edit') {
		$poli	= $_POST['tujuan'];
		$id		= $_POST['id'];
		$nm		= $_POST['nama'];
		$edit	= mysqli_query($con, "Update kamar_jenis Set id_poli='$poli', kelas='$nm' Where id_jenkamar='$id'") or die(mysqli_error($con));
		catat($con, $_SESSION['namauser'], 'Edit Data Jenis Ruangan'.' ('.$id.')');
		if($edit){
		?>
		<script type="text/javascript">
		window.location.href="../../media.php?module=jenis_ruangan";        
		</script>
		<?php
		} else {
		?>
		<script type="text/javascript">
		alert("Data Gaga Diupdate!");
		window.location.href="../../media.php?module=jenis_ruangan";        
		</script>
		<?php		
		}
	}