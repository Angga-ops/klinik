<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Produk
	if ($module == 'produk' AND $act == 'hapus'){
		$id		= $_GET['kd_produk'];
		$del	= mysqli_query($con, "Delete From produk_master Where kd_produk='$id'");
		header('location:../../media.php?module=produk');
	}
	// Input Produk Baru
	elseif ($module == 'produk' AND $act == 'input') {
		$kode_barang	= $_POST['kd_produk'];
		$nama_p 		= $_POST['nama_produk'];
		// $id_s			= $_POST['id_s'];
		// $id_kategori	= $_POST['id_kategori'];
		// $jumlah			= $_POST['jumlah'];
		// $batas_minim	= $_POST['batas_minim'];
		// $batas_percabang= $_POST['batas_percabang'];
		$harga_beli		= $_POST['harga_beli'];
		$harga_jual		= $_POST['harga_jual'];
		$harga_bpjs		= $_POST['harga_bpjs'];
		$harga_asuransilainnya		= $_POST['harga_asuransilainnya'];
		$kategori		= $_POST['kategori'];
		$satuan		= $_POST['satuan'];
		// $id_sup 		= $_POST['id_sup'];
		// $id_kk			= $_POST['id_kk'];

		$nama_file = $_FILES['file']['name'];
		$ukuran_file = $_FILES['file']['size'];
		$tipe_file = $_FILES['file']['type'];
		$tmp_file = $_FILES['file']['tmp_name'];
		// Set path folder tempat menyimpan gambarnya
		$path = "../../../gambar_produk/".$nama_file;
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
		  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
		  if($ukuran_file <= 5000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		    // Proses upload
		    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      // Jika gambar berhasil diupload, Lakukan :  
		      // Proses simpan ke Database
		      $query = "INSERT Into produk_master(kd_produk,nama_produk,harga_beli,jual_umum,gambar,id_kategori,id_satuan,jual_bpjs,
			   jual_lain)VALUES('$kode_barang','$nama_p','$harga_beli','$harga_jual','$nama_file',
			   '$kategori','$satuan','$harga_bpjs','$harga_asuransilainnya')";
			  $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
		        header('location:../../media.php?module=produk'); // Redirectke halaman index.php
		      }else{
		        // Jika Gagal, Lakukan :
		       echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database');";
		        echo "location.href='../../media.php?module=produk';</script>";
		      }
		    }else{
		       // Proses simpan ke Database
			 $query = "INSERT Into produk_master(kd_produk,nama_produk,harga_beli,jual_umum,gambar,id_kategori,id_satuan,jual_bpjs,
			   jual_lain)VALUES('$kode_barang','$nama_p','$harga_beli','$harga_jual','$nama_file',
			   '$kategori','$satuan','$harga_bpjs','$harga_asuransilainnya')";
			   $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
			   
			   if($sql){ // Cek jika proses simpan ke database sukses atau tidak
				 // Jika Sukses, Lakukan :
				 header('location:../../media.php?module=produk');
			   }
		    }
		  }else{
		    // Jika ukuran file lebih dari 1MB, lakukan :
		   echo "<script>alert('Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB');";
		    echo "location.href='../../media.php?module=produk';</script>";
		  }
		}else{
		  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		 echo "<script>alert('Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG');";
		  echo "location.href='../../media.php?module=produk';</script>";
		}
		
	 	
			header('location:../../media.php?module=produk');
		
	}
	//Update Produk yang Ada
	elseif ($module == 'produk' AND $act == 'update') {
		$id_produk				= $_POST['id_produk'];
		$kd_produk	= $_POST['kd_produk'];
		$nama_produk 		= $_POST['nama_produk'];
		$satuan			= $_POST['satuan'];
		$kategori		= $_POST['kategori'];
		$jumlah			= $_POST['jumlah'];
		$batas_minim	= $_POST['batas_minim'];
		$batas_percabang= $_POST['batas_percabang'];
		$harga_beli		= $_POST['harga_beli'];
		$harga_jual		= $_POST['harga_jual'];
		$harga_bpjs		= $_POST['harga_bpjs'];
		$harga_asuransilainnya		= $_POST['harga_asuransilainnya'];
		$id_sup		= $_POST['id_sup'];
		$id_kk			= $_POST['id_kk'];

		//upload
		$nama_file = $_FILES['file']['name'];
		$ukuran_file = $_FILES['file']['size'];
		$tipe_file = $_FILES['file']['type'];
		$tmp_file = $_FILES['file']['tmp_name'];
		// Set path folder tempat menyimpan gambarnya
		$path = "../../../gambar_produk/".$nama_file;
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png" || $_FILES['file']['error'] == UPLOAD_ERR_NO_FILE){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
		  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
		  if($ukuran_file <= 5000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		    // Proses upload
		    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      // Jika gambar berhasil diupload, Lakukan :  
		      // Proses simpan ke Database
		      $query = "Update produk_master Set kd_produk='$kd_produk', nama_produk='$nama_produk',harga_beli='$harga_beli',jual_umum ='$harga_jual',
			  jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya',
			  gambar='$nama_file',id_kategori='$kategori',id_satuan='$satuan' Where kd_produk='$kd_produk'";
			  $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
			    //update produk dan produk_pusat
			/*	mysql_query("UPDATE produk SET jual_umum='$harga_jual',jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya', harga_beli='$harga_beli' WHERE kode_barang='$kd_produk'");
			  
				mysql_query("UPDATE produk_pusat SET jual_umum='$harga_jual', jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya', harga_beli='$harga_beli' WHERE kode_produk='$kd_produk'");

				 */
		      
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
		        header('location:../../media.php?module=produk'); // Redirectke halaman index.php
		      }else{
		        // Jika Gagal, Lakukan :
		       echo "<script>alert('Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database');";
		        echo "location.href='../../media.php?module=produk';</script>";
		      }
		    }else{
		      // Proses simpan ke Database
		      $query = "Update produk_master Set kd_produk='$kd_produk', nama_produk='$nama_produk',harga_beli='$harga_beli',jual_umum='$harga_jual',
			  jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya',id_kategori='$kategori',id_satuan='$satuan' Where kd_produk='$kd_produk'";
			  $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
			  
			   //update produk dan produk_pusat
			/*	mysql_query("UPDATE produk SET jual_umum='$harga_jual',jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya', harga_beli='$harga_beli' WHERE kode_barang='$kd_produk'");
			  
				mysql_query("UPDATE produk_pusat SET jual_umum='$harga_jual',jual_bpjs='$harga_bpjs',jual_lain='$harga_asuransilainnya', harga_beli='$harga_beli' WHERE kode_produk='$kd_produk'"); */
		      
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
				header('location:../../media.php?module=produk');
			  }
		    }
		  }else{
		    // Jika ukuran file lebih dari 1MB, lakukan :
		   echo "<script>alert('Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB');";
		    echo "location.href='../../media.php?module=produk';</script>";
		  }
		}else{
		  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		 echo "<script>alert('Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG');";
		  echo "location.href='../../media.php?module=produk';</script>";
		}

			header('location:../../media.php?module=produk');
		
	}