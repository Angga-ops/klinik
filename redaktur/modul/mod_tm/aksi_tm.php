<?php

	session_start();
	include ("../../../config/koneksi.php");	
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Tag
	if ($module == 'tm' AND $act == 'hapus'){
		$noidk		= $_GET['id'];
		$del		= mysql_query("Delete From medis Where no_idk='$noidk'");
		catat($_SESSION['namauser'], 'Hapus Data Tenaga Medis'.' ('.$noidk.')');
		?>
		<script type="text/javascript">
		window.location.href="../../media.php?module=tenaga_medis";        
		</script>
		<?php
	}
	// Input medis
	elseif ($module == 'tm' AND $act == 'input'){
		$goltm		= $_POST['gol_tm'];
		$noidk		= $_POST['no_idk'];
		$nm			= $_POST['nama'];
		$almt		= $_POST['alamat'];
		$kntk		= $_POST['kontak'];
		$biaya		= $_POST['biaya'];
		$simpan		= mysql_query("Insert Into medis(id_goltm,no_idk,nama_tm,alamat,kontak,biaya_praktik) Values('$goltm','$noidk','$nm','$almt','$kntk','$biaya')");
		catat($_SESSION['namauser'], 'Data Tenaga Medis Baru'.' ('.$noidk.')');
			if($simpan){
			?>
				<script type="text/javascript">
				window.location.href="../../media.php?module=tenaga_medis";        
				</script>
			<?php
				} else {
			?>
				<script type="text/javascript">
				alert("Data Gaga Disimpan!");
				window.location.href="../../media.php?module=tenaga_medis";        
				</script>
			<?php		
			}
	}
	// Update medis
	elseif ($module == 'tm' AND $act == 'edit'){
		$goltm		= $_POST['gol_tm'];
		$noidk		= $_POST['no_idk'];
		$nm			= $_POST['nama'];
		$almt		= $_POST['alamat'];
		$kntk		= $_POST['kontak'];
		$biaya		= $_POST['biaya'];
		$edit		= mysql_query("Update medis Set id_goltm='$goltm', nama_tm='$nm', alamat='$almt', kontak='$kntk', biaya_praktik='$biaya' Where no_idk='$noidk'");
		catat($_SESSION['namauser'], 'Edit Data Tenaga Medis'.' ('.$noidk.')');
			if($edit){
			?>
				<script type="text/javascript">
				window.location.href="../../media.php?module=tenaga_medis";        
				</script>
			<?php
				} else {
			?>
				<script type="text/javascript">
				alert("Data Gaga Diupdate!");
				window.location.href="../../media.php?module=tenaga_medis";        
				</script>
			<?php		
			}
	}
?>
