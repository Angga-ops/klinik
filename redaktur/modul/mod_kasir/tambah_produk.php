<?php 

include "../../../config/koneksi.php";


$nama    = $_POST['nama_p'];
$harga   = $_POST['harga_p'];
$id_kk   = $_POST['id_kk'];
$jumlah  = $_POST['jumlah'];
$harga_b = $_POST['harga_b'];
$kode	 = $_POST['kode_p'];
$id      = $_POST['id_pasien'];
$diskon  = $_POST['dis'];
$ket     = $_POST['ket'];


$sub_total  = $harga*$jumlah;
$sub_total -= ($diskon/100)*($harga*$jumlah);


	$q   = mysqli_query($con,"SELECT *FROM produk WHERE id_kk='$id_kk' AND nama_p='$nama'");
	$cek = mysqli_num_rows($q);
	if ($cek==0) {
	 	echo "tidak";
	 } 


	$q1 = mysqli_query($con,"SELECT *FROM kasir_sementara WHERE nama='$nama' AND id_kk='$id_kk' AND id_pasien='$id' AND status='sementara'");
	$jum = mysqli_num_rows($q1);
	if($jum>0){
		$qq = mysqli_fetch_array($q1);
		$total = $qq['jumlah'];
		$total += $jumlah;
		$sub_total = ($total*$harga);
		$sub_total -= ($diskon/100)*($total*$harga);
		mysqli_query($con,"UPDATE kasir_sementara SET jumlah='$total',sub_total='$sub_total' WHERE nama='$nama' AND id_kk='$id_kk' AND id_pasien='$id'");

	}else{
		mysqli_query($con,"INSERT INTO kasir_sementara(nama,jumlah,harga,id_kk,harga_beli,kode,jenis,id_pasien,status,diskon,ket,sub_total) VALUES('$nama','$jumlah','$harga','$id_kk','$harga_b','$kode','Produk','$id','sementara','$diskon','$ket','$sub_total')");
	}
	




exit();


?>