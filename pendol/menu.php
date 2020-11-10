<?php
include "../config/koneksi.php";
if ($_SESSION['leveluser']=='admin'){
  $sql=mysql_query("select * from modul m, icon i where aktif='Y' and m.id_icon = i.id_icon order by id_modul");
  while ($m=mysql_fetch_array($sql)){
    echo "<li><a href='$m[link]'><i class='$m[icon]'></i><span>$m[nama_modul]</span></a></li>";
  }
  //echo "tess";
}
elseif ($_SESSION['leveluser']=='user'){
  /*$sql=mysql_query("select * from modul m, icon i where status='user' and aktif='Y' and m.id_icon = i.id_icon order by id_modul"); 
  while ($m=mysql_fetch_array($sql)){  
    echo "<li><a href='$m[link]'><i class='$m[icon]'></i><span>$m[nama_modul]</span></a></li>";
  }*/
  
  echo "<li><a href='?module=home'><i class='entypo-home'></i><span>Halaman Utama</span></a></li>
  <li><a href='?module=user'><i class='entypo-user'></i><span>Data Pasien</span></a></li>
  <li><a href='?module=jadwal'><i class='entypo-book-open'></i><span>Jadwal Dokter</span></a></li>
   <li><a href='?module=antrian'><i class='entypo-pencil'></i><span>Buat Antrian</span></a></li>
   <li><a href='?module=history'><i class='entypo-list'></i><span>History Kunjungan</span></a></li>
    <li><a href='logout.php'><i class='entypo-logout'></i><span>Logout</span></a></li>
   
  
  
  ";
 // echo "tesseeeee";
}

?>
