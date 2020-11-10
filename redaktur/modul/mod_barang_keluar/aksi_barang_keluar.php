<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	include("../../../config/koneksi.php");
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
  	/*Input Obat Expired*/ 
	if ($module	=='barang_keluar' AND $act=='barang_keluar'){
		$fbk	= $_POST['no_fbk'];
		$jam	= date("H:i:s");
		$tgl	= $_POST['tgl_bk'];
		
				if(isset($_POST["gudang"]))
					{
						$gdg	= $_POST["gudang"];
						reset($gdg);
						while (list($key, $value) = each($gdg)) 
							{
								$gdg		= $_POST["gudang"][$key];
								$jum		= $_POST["jumlah"][$key];
								//Trigger Insert Stok Obat
								$trg_stok	= mysql_query('Create Trigger barang_keluar After Insert On barang_keluar
								For Each Row Begin
								Update obat_stok Set 
								jumlah 			= jumlah - New.jumlah
								Where id_brg	= New.id_brg;
								End');							
								$brg_keluar	= mysql_query("Insert Into barang_keluar(no_fbk,id_bk,jumlah,jam_bk,tgl_bk)
											  VALUES('$fbk','$gdg','$jum','$jam','$tgl')");  
							}
						}		
		catat($_SESSION['namauser'], 'Data Barang Keluar Baru'.' ('.$fbk.')');
		if($brg_keluar){
		?>
		<script type="text/javascript" language="javascript">
		window.location.href="../../media.php?module=barang_keluar";
        </script>	
        <?php
		} else {
		?>
		<script type="text/javascript" language="javascript">
		alert("Pemeriksaan Gagal Diinput!");
		window.location.href="../../media.php?module=barang_keluar";
        </script>	
        <?php		
		}
	}
	/*Input Obat Expired*/ 
	if ($module	=='barang_keluar' AND $act=='del'){
		$id			= $_GET['id'];
		$delete		= mysql_query("Delete From barang_keluar Where no_fbk='$id'");
		$trg_stok	= mysql_query("Create Trigger del_bk After Delete On barang_keluar
		For Each Row Begin
		Update barang_stok Set 
		jumlah 			= jumlah + OLD.jumlah
		Where id_obat	= OLD.id_obat;
		End");							
		catat($_SESSION['namauser'], 'Hapus Data Barang Keluar'.' ('.$id.')');
		header('location:../../media.php?module=barang_keluar');
	}
?>