<?php
	session_start();
	include "../../../config/koneksi.php";
	include "../../../config/fungsi_seo.php";
	include "../mod_log/aksi_log.php";
	include "exelreader.php";
	$module	= $_GET['module'];
	$act	= $_GET['act'];
	// Hapus Data Dokter
	if ($module == 'data_karyawan' AND $act == 'hapus'){
		$id		= $_GET['id_karyawan'];
		$del	= mysqli_query($con, "Delete From karyawan Where id_karyawan='$id'");
		catat($con, $_SESSION['namauser'], 'Hapus Data Karyawan'.' ('.$id.')');
		header('location:../../media.php?module=data_karyawan');
	}
	// Input Data Karyawan Baru
	elseif ($module == 'data_karyawan' AND $act == 'input') {
		$klinik				= $_POST['klinik'];
		$nama_karyawan		= $_POST['nama_karyawan'];
		$jk				= $_POST['jk'];
		$tgl_lahir				= $_POST['tgl_lahir'];
		$no_telp				= $_POST['no_telp'];
		$bagian				= $_POST['bagian'];
		$tgl_masuk				= $_POST['tgl_masuk'];
		$awal = date_create($tgl_masuk);
		$akhir= date_create();
		$diff = date_diff($awal,$akhir);
		$lama = $diff->y.'tahun,'.$diff->m.'bulan,'.$diff->d.'hari';
		$alamat				= $_POST['alamat'];
		$lulusan				= $_POST['lulusan'];
		$status			= $_POST['status'];
		$username			= $_POST['username'];
		$password			= MD5($_POST['password']);
		$blokir			= $_POST['blokir'];
		

		//upload
		$nama_file = $_FILES['file']['name'];
		$ukuran_file = $_FILES['file']['size'];
		$tipe_file = $_FILES['file']['type'];
		$tmp_file = $_FILES['file']['tmp_name'];
		// Set path folder tempat menyimpan gambarnya
		$path = "../../../foto_karyawan/".$nama_file;
		if (!empty($nama_file)){
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
		  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
		  if($ukuran_file <= 5000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		    // Proses upload
		    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      // Jika gambar berhasil diupload, Lakukan :  
		      // Proses simpan ke Database
		      $query = "Insert Into karyawan(id_kk,nama_karyawan,jk,tgl_lahir,no_telp,id_ju,status,foto,tgl_masuk,alamat,lulusan,username,password,blokir)
			  Values('$klinik','$nama_karyawan','$jk','$tgl_lahir','$no_telp','$bagian','$status','$nama_file',
			  '$tgl_masuk','$alamat','$lulusan','$username','$password','$blokir')";
		      $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
		      
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
		        header('location:../../media.php?module=data_karyawan'); // Redirectke halaman index.php
		      }else{
		        // Jika Gagal, Lakukan :
		        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		        echo "<br><a href='form.php'>Kembali Ke Form</a>";
		      }
		    }else{
		      // Jika gambar gagal diupload, Lakukan :
		      echo "Maaf, Gambar gagal untuk diupload.";
		      echo "<br><a href='form.php'>Kembali Ke Form</a>";
		    }
		  }else{
		    // Jika ukuran file lebih dari 1MB, lakukan :
		    echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
		    echo "<br><a href='form.php'>Kembali Ke Form</a>";
		  }
		}else{
		  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		  echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
		  echo "<br><a href='form.php'>Kembali Ke Form</a>";
		}
		} else {
			$query = "Insert Into karyawan(id_kk,nama_karyawan,jk,tgl_lahir,no_telp,id_ju,status,tgl_masuk,alamat,lulusan,username,password,blokir)
			  Values('$klinik','$nama_karyawan','$jk','$tgl_lahir','$no_telp','$bagian','$status',
			  '$tgl_masuk','$alamat','$lulusan','$username','$password','$blokir')";
		      $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
		      
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
		        header('location:../../media.php?module=data_karyawan'); // Redirectke halaman index.php
		      }else{
		        // Jika Gagal, Lakukan :
		        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		        echo "<br><a href='form.php'>Kembali Ke Form</a>";
		      }
			
		}
		
			header('location:../../media.php?module=data_karyawan');
		
	}
	//Update Data Karyawan yang Ada
	elseif ($module == 'data_karyawan' AND $act == 'update') {
		$id_karyawan		= $_POST['id_karyawan'];
		$klinik				= $_POST['klinik'];
		$nama_karyawan		= $_POST['nama_karyawan'];
		$jk					= $_POST['jk'];
		$tgl_lahir			= $_POST['tgl_lahir'];
		$no_telp			= $_POST['no_telp'];
		$bagian				= $_POST['bagian'];
		$tgl_masuk				= $_POST['tgl_masuk'];
		$awal = date_create($tgl_masuk);
		$akhir= date_create();
		$diff = date_diff($awal,$akhir);
		$lama = $diff->y.'tahun,'.$diff->m.'bulan,'.$diff->d.'hari';
		$alamat				= $_POST['alamat'];
		$lulusan				= $_POST['lulusan'];
		$status				= $_POST['status'];
		$username			= $_POST['username'];
		$password			= MD5($_POST['password']);
		$blokir			= $_POST['blokir'];
		
		//upload
		$nama_file = $_FILES['file']['name'];
		$ukuran_file = $_FILES['file']['size'];
		$tipe_file = $_FILES['file']['type'];
		$tmp_file = $_FILES['file']['tmp_name'];
		// Set path folder tempat menyimpan gambarnya
		$path = "../../../foto_karyawan/".$nama_file;
		if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
		  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
		  if($ukuran_file <= 5000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
		    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
		    // Proses upload
		    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
		      // Jika gambar berhasil diupload, Lakukan :  
		      // Proses simpan ke Database
		      $query = "Update karyawan Set id_kk='$klinik', nama_karyawan='$nama_karyawan',
			  jk='$jk', tgl_lahir='$tgl_lahir', no_telp='$no_telp', id_ju='$bagian',
			  status='$status', foto='$nama_file',tgl_masuk='$tgl_masuk',alamat='$alamat',
			  lulusan='$lulusan',username='$username',
			  password='$password' Where id_karyawan='$id_karyawan'";
		      $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
		      
		      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
		        // Jika Sukses, Lakukan :
		        header('location:../../media.php?module=data_karyawan'); // Redirectke halaman index.php
		      }else{
		        // Jika Gagal, Lakukan :
		        echo "Maaf, Terjadi kesalahan saat mencoba untuk menyimpan data ke database.";
		        echo "<br><a href='form.php'>Kembali Ke Form</a>";
		      }
		    }else{
		      // Jika gambar gagal diupload, Lakukan :
		      echo "Maaf, Gambar gagal untuk diupload.";
		      echo "<br><a href='form.php'>Kembali Ke Form</a>";
		    }
		  }else{
		    // Jika ukuran file lebih dari 1MB, lakukan :
		    echo "Maaf, Ukuran gambar yang diupload tidak boleh lebih dari 1MB";
		    echo "<br><a href='form.php'>Kembali Ke Form</a>";
		  }
		}else{
		  // Jika tipe file yang diupload bukan JPG / JPEG / PNG, lakukan :
		  echo "Maaf, Tipe gambar yang diupload harus JPG / JPEG / PNG.";
		  echo "<br><a href='form.php'>Kembali Ke Form</a>";
		}
	}
	?>