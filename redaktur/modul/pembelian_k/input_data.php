<?php


include "../../../config/koneksi.php";

$kd_brg 		= $_POST['kd_brg'];
		$nama_brg 		= $_POST['nama_brg'];
		$satuan		    = $_POST['id_satuan'];
		$kategori		= $_POST['id_kategori'];
		$jumlah			= $_POST['jumlah'];
		$hrg 			= $_POST['hrg'];
		$hrg_tot		= $jumlah*$hrg;
		$diskon			= $_POST['diskon'];
		$hrg_jual			= $_POST['harga_jual'];
		$batas_cabang			= $_POST['batas_cabang'];
		$batas_minim			= $_POST['batas_minim'];
		//$id_sup			= $_POST['id_sup'];
		$diskon_harga   = $hrg_tot*($diskon/100);
		$sub_tot		= $hrg_tot-$diskon_harga;
		//$no_fak			= $_POST['no_fak'];
		$tgl_beli		= $_POST['tgl_beli'];
		//$suplier		= $_POST['suplier'];
		//$total			= $_POST['total'];
		$pembayaran		= $_POST['pembayaran'];
		$ket			= $_POST['ket'];

/*		if ($kategori=="") {
			echo "kategori";
			exit();
		}
		if ($satuan=="") {
			echo "satuan";
			exit();
		} */

		$jumlahkan 		= "SELECT SUM(sub_tot) AS total FROM pembelian_k";

		$q = mysqli_query($con,"SELECT * FROM pembelian_k");
		$k = mysqli_num_rows($q);

		if ($k >0) {
		/*	while ($cek = mysql_fetch_array($q)) {
			if ($cek['nama_brg']==$nama_brg) {
				$jum=1;
			} */
			$cek = mysqli_fetch_array($q);
			if ($cek['nama_brg']==$nama_brg) {
				$jum=1;
			}

			if ($jum>0) {
				$jumlah = $cek['jumlah']+$jumlah;
				mysqli_query($con,"UPDATE pembelian_k SET jumlah='$jumlah' where nama_brg='$nama_brg'");
			}else{
				mysqli_query($con,"INSERT INTO pembelian_k(kd_brg,nama_brg,satuan_k,kategori_k,hrg,hrg_jual,batas_cabang,batas_minim,jumlah,diskon,sub_tot,tgl_beli) VALUES('$kd_brg','$nama_brg','$satuan','$kategori', '$hrg','$hrg_jual','$batas_cabang','$batas_minim','$jumlah', '$diskon', '$sub_tot', '$tgl_beli')");
			}
			
		}else{
			mysqli_query($con,"INSERT INTO pembelian_k(kd_brg,nama_brg,satuan_k,kategori_K,hrg,hrg_jual,batas_cabang,batas_minim,jumlah,diskon,sub_tot,tgl_beli) VALUES('$kd_brg','$nama_brg','$satuan','$kategori', '$hrg','$hrg_jual','$batas_cabang','$batas_minim','$jumlah', '$diskon', '$sub_tot', '$tgl_beli')");
			}
		
exit();
?>