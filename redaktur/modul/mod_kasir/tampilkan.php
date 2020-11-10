<?php

include "../../../config/koneksi.php";


$nama      = $_POST['nama'];
$nama_kode = $_POST['nama_kode']; 


if($nama!=""){

   $q1 = mysql_query("SELECT *FROM pasien WHERE id_pasien='$nama'");

   $cek = mysql_num_rows($q1);

   if ($cek==0) {
      echo "Kosong";
      exit();
   }

   $response = array();

   $row = mysql_fetch_array($q1);

   $kl = mysql_fetch_array(mysql_query("SELECT *FROM kategori_pelanggan WHERE kategori='$row[klaster]'"));

   $diskon_pr = $kl['diskon_p']; 
   $diskon_tr = $kl['diskon_t'];

   $np = ":&emsp;".$row['nama_pasien'];
   $nt = ":&emsp;".$row['no_telp'];
   $jk = ":&emsp;".$row['jk'];
   $a  = ":&emsp;".$row['alamat'];
   $tk = ":&emsp;".$row['total_kunjungan'];
   $tl = ":&emsp;".$row['tgl_lahir'];
   $nid= ":&emsp;".$row['id_pasien'];

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
      $qn=mysql_query("SELECT *FROM pasien WHERE nama_pasien ='$nama_kode'");
      $qk=mysql_query("SELECT *FROM pasien WHERE id_pasien   ='$nama_kode'");
      $qt=mysql_query("SELECT *FROM pasien WHERE tgl_lahir   ='$nama_kode'");

      $cn = mysql_num_rows($qn);
      $ck = mysql_num_rows($qk);
      $ct = mysql_num_rows($qt);

      if ($cn>0) {
         $row = mysql_fetch_array($qn);
      }elseif($ck>0){
         $row = mysql_fetch_array($qk);
      }elseif($ct>0){
         $row = mysql_fetch_array($qt);
      }else{
         echo "Kosong";
         exit();
      } 


      $kl = mysql_fetch_array(mysql_query("SELECT *FROM kategori_pelanggan WHERE kategori='$row[klaster]'"));

      $diskon_pr = $kl['diskon_p']; 
      $diskon_tr = $kl['diskon_t'];


      

      $response = array();

      $np = ":&emsp;".$row['nama_pasien'];
      $nt = ":&emsp;".$row['no_telp'];
      $jk = ":&emsp;".$row['jk'];
      $a  = ":&emsp;".$row['alamat'];
      $tk = ":&emsp;".$row['total_kunjungan'];
      $tl = ":&emsp;".$row['tgl_lahir'];
      $nid= ":&emsp;".$row['id_pasien'];

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