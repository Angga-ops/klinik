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
$diskon	= $_POST['dis'];
$ket	= $_POST['ket'];
$sub_total = $harga*$jumlah;
$sub_total -= ($diskon/100)*($harga*$jumlah); 
$id_dr = $_SESSION['id_dr'];



	$q1 = mysql_query("SELECT *FROM kasir_sementara WHERE nama='$nama' AND no_faktur='$no_faktur' AND id_kk='$id_kk'");
	$jum = mysql_num_rows($q1);
	if($jum>0){
		
		$qq = mysql_fetch_array($q1);
		$total = $qq['jumlah'];
		$total += $jumlah;
		$sub_total = ($total*$harga);
		$sub_total -= ($diskon/100)*($total*$harga);
		mysql_query("UPDATE kasir_sementara SET jumlah='$total',status='Belum Lunas',sub_total='$sub_total' WHERE nama='$nama' AND no_faktur='$no_faktur'");
	}else{
		
		mysql_query("INSERT INTO kasir_sementara(nama,jumlah,harga,id_kk,harga_beli,kode,jenis,id_pasien,status,no_urut,tanggal,penginput,no_faktur,diskon,sub_total,ket,id_dr,kategori) VALUES('$nama','$jumlah','$harga','$id_kk','$harga_b','$kode','Produk','$id','Belum Lunas','$no','$tgl','Dokter','$no_faktur','$diskon','$sub_total','$ket','$id_dr','0')");
	}
	




exit();


?>