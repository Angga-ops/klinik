<?php

include "../../../config/koneksi.php";

$id = $_POST['id'];
$no_fak = $_POST['no_fak'];
$tgl_beli = $_POST['tgl_beli'];
$total = $_POST['total'];
$id_sup = $_POST['id_sup'];
$pembayaran = $_POST['pembayaran'];
$tgl_tempo = $_POST['tgl_tempo'];
//upload
$nama_file = $_FILES['file']['name'];
$ukuran_file = $_FILES['file']['size'];
$tipe_file = $_FILES['file']['type'];
$tmp_file = $_FILES['file']['tmp_name'];
// Set path folder tempat menyimpan gambarnya
$path = "../../../bukti_bayar/".$nama_file;
if($tipe_file == "image/jpeg" || $tipe_file == "image/png"){ // Cek apakah tipe file yang diupload adalah JPG / JPEG / PNG
  // Jika tipe file yang diupload JPG / JPEG / PNG, lakukan :
  if($ukuran_file <= 5000000){ // Cek apakah ukuran file yang diupload kurang dari sama dengan 1MB
    // Jika ukuran file kurang dari sama dengan 1MB, lakukan :
    // Proses upload
    if(move_uploaded_file($tmp_file, $path)){ // Cek apakah gambar berhasil diupload atau tidak
      // Jika gambar berhasil diupload, Lakukan :  
      // Proses simpan ke Database
      $query = "UPDATE beli_k SET no_fak='$no_fak' , tgl_beli='$tgl_beli', total='$total', id_sup='$id_sup', tgl_tempo='$tgl_tempo' , bukti_bayar='$nama_file' WHERE id='$id'";
      $sql = mysqli_query($con, $query); // Eksekusi/ Jalankan query dari variabel $query
      
      if($sql){ // Cek jika proses simpan ke database sukses atau tidak
        // Jika Sukses, Lakukan :
        header('location:../../media.php?module=pembayaran_kredit'); // Redirectke halaman index.php
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

header('location:../../media.php?module=pembayaran_kredit');



//mysql_close($host);
?>