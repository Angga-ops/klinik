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
$no_faktur = $_GET['nofak'];
$diskon	= $_POST['dis'];
$ket	= $_POST['ket'];
$sub_total = $harga*$jumlah;
$sub_total -= ($diskon/100)*($harga*$jumlah); 
$id_dr = $_SESSION['id_dr'];
$kategori = $_GET['kat'];

	$q1 = mysqli_query($con,"SELECT *FROM history_kasir_lama WHERE nama='$nama' AND no_faktur='$no_faktur' AND id_kk='$id_kk'");
	$jum = mysqli_num_rows($q1);
	if($jum>0){
		$qq = mysqli_fetch_array($q1);
		$total = $qq['jumlah'];
		$total += $jumlah;
		$sub_total = ($total*$harga);
		$sub_total -= ($diskon/100)*($total*$harga);
		mysqli_query($con,"UPDATE history_kasir_lama SET jumlah='$total',status='Belum Lunas',sub_total='$sub_total' WHERE nama='$nama' AND no_faktur='$no_faktur'");
	}else{
		mysqli_query($con,"INSERT INTO history_kasir_lama (nama,jumlah,harga,id_kk,harga_beli,kode,jenis,id_pasien,status,no_urut,tanggal,penginput,no_faktur,diskon,sub_total,ket,id_dr,kategori) VALUES('$nama','$jumlah','$harga','$id_kk','$harga_b','$kode','Produk','$id','Belum Lunas','$no','$tgl','Dokter','$no_faktur','$diskon','$sub_total','$ket','$id_dr','$kategori')");
	}
	




exit();


?>