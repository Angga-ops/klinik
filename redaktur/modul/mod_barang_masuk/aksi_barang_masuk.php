<?php
	session_start();
	date_default_timezone_set('Asia/Jakarta');
	include("../../../config/koneksi.php");
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
  	
	/*Input Pemeriksaan*/ 
	if ($act    =='input'){
		$fak	= $_POST['no_faktur'];
		$spl	= $_POST['id_supplier'];
		$brg    = $_POST['id_brg'];
		$jml    = $_POST['jumlah'];
		$hrg    = $_POST['harga_beli'];
		$total  = $jml*$hrg;
		$jam    = $_POST['jam_datang'];
		$tgl	= $_POST['tgl_datang'];
		$pembm	= mysqli_query($con, "Insert Into pembayaran_bm(no_faktur,id_supplier,id_brg,jumlah,harga_beli,total_harga, jam_datang, tgl_datang) Values('$fak','$spl','$brg','$jml','$hrg','$total','$jam','$tgl')");

		
								
		catat($con, $_SESSION['namauser'], 'Data Barang Masuk Baru'.' ('.$fak.')');
		if($pembm){
		?>
		<script type="text/javascript" language="javascript">
		window.location.href="../../media.php?module=barang_masuk";
        </script>	
        <?php
		} else {
		?>
		<script type="text/javascript" language="javascript">
		alert("Penambahan Barang Masuk Gagal Diinput!");
		window.location.href="../../media.php?module=barang_masuk";
        </script>	
        <?php		
		}
	}
?>