<?php 

session_start();

include "../../../config/koneksi.php";



$nama    = $_POST['nama_p'];
$harga   = $_POST['harga_p'];
$id_kk   = $_SESSION['klinik'];
$jumlah  = $_POST['jumlah'];
$harga_b = $_POST['harga_b'];
$kode	 = $_POST['kode_p'];
$id      = $_POST['id_pasien'];
$no      = $_POST['no_urut'];
$tgl     = date("Y-m-d");
$no_faktur = $_POST['nofak'];

	$qp     = mysql_query("SELECT *FROM produk WHERE id_kk='$_SESSION[klinik]' AND nama_p='$nama'");
	
	$p      = mysql_fetch_array($qp);

	$jumlah = $p['jumlah']-$jumlah;

	mysql_query("UPDATE produk SET jumlah='$jumlah' WHERE id_kk='$_SESSION[klinik]' AND nama_p='$nama'"); 


	$q1 = mysql_query("SELECT *FROM history_kasir WHERE nama='$nama' AND no_faktur='$no_faktur' AND id_kk='$id_kk'");
	$jum = mysql_num_rows($q1);
	if($jum>0){
		$qq = mysql_fetch_array($q1);
		$total = $qq['jumlah'];
		$total += $jumlah;
		mysql_query("UPDATE history_kasir SET jumlah='$total',status='Belum Lunas' WHERE nama='$nama' AND no_faktur='$no_faktur'");
	}else{
		mysql_query("INSERT INTO history_kasir(nama,jumlah,harga,id_kk,harga_beli,kode,jenis,id_pasien,status,no_urut,tanggal,ket,no_faktur) VALUES('$nama','$jumlah','$harga','$id_kk','$harga_b','$kode','Produk','$id','Belum Lunas','$no','$tgl','input dokter','$no_faktur')");
	}
	




exit();


?>