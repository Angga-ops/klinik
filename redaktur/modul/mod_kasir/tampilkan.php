<?php

include "../../../config/koneksi.php";


$nama      = $_POST['nama'];
$nama_kode = $_POST['nama_kode']; 


if($nama!=""){

   $q1 = mysqli_query($con,"SELECT *FROM pasien WHERE id_pasien='$nama'");

   $cek = mysqli_num_rows($q1);

   if ($cek==0) {
      echo "Kosong";
      exit();
   }

   $response = array();

   $row = mysqli_fetch_array($q1);

   $kl = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM kategori_pelanggan WHERE kategori='$row[klaster]'"));

   $diskon_pr = $kl['diskon_p']; 
   $diskon_tr = $kl['diskon_t'];

   $np = ": ".$row['nama_pasien'];
   $nt = ": ".$row['no_telp'];
   $jk = ": ".$row['jk'];
   $a  = ": ".$row['alamat'];
   $tk = ": ".$row['total_kunjungan'];
   $tl = ": ".$row['tgl_lahir'];
   $nid= ": ".$row['id_pasien'];

      $response = array(
      "dpr"=>$diskon_pr,
      "dtr"=>$diskon_tr,
      "np"=>$np,
      "nt"=>$nt,
      "jk"=>$jk,
      "a"=>$a,
      "tk"=>$tk,
      "tl"=>$tl,
      "id"=>$row["id_pasien"],
      "nkk"=>$row["nama_pasien"],
      "nid"=>$nid,
      "klas"=>$row['klaster'],
      );
   }else{
      $qn=mysqli_query($con,"SELECT *FROM pasien WHERE nama_pasien ='$nama_kode'");
      $qk=mysqli_query($con,"SELECT *FROM pasien WHERE id_pasien   ='$nama_kode'");
      $qt=mysqli_query($con,"SELECT *FROM pasien WHERE tgl_lahir   ='$nama_kode'");

      $cn = mysqli_num_rows($qn);
      $ck = mysqli_num_rows($qk);
      $ct = mysqli_num_rows($qt);

      if ($cn>0) {
         $row = mysqli_fetch_array($qn);
      }elseif($ck>0){
         $row = mysqli_fetch_array($qk);
      }elseif($ct>0){
         $row = mysqli_fetch_array($qt);
      }else{
         echo "Kosong";
         exit();
      } 


      $kl = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM kategori_pelanggan WHERE kategori='$row[klaster]'"));

      $diskon_pr = $kl['diskon_p']; 
      $diskon_tr = $kl['diskon_t'];


      

      $response = array();

      $np = ": ".$row['nama_pasien'];
      $nt = ": ".$row['no_telp'];
      $jk = ": ".$row['jk'];
      $a  = ": ".$row['alamat'];
      $tk = ": ".$row['total_kunjungan'];
      $tl = ": ".$row['tgl_lahir'];
      $nid= ": ".$row['id_pasien'];

      $response = array(
      "dpr"=>$diskon_pr,
      "dtr"=>$diskon_tr,
      "np"=>$np,
      "nt"=>$nt,
      "jk"=>$jk,
      "a"=>$a,
      "tk"=>$tk,
      "tl"=>$tl,
      "klas"=>$row['klaster'],
      "id"=>$row["id_pasien"],
      "nkk"=>$row["nama_pasien"],
      "nid"=>$nid
      );


   }



  echo json_encode($response);



?>