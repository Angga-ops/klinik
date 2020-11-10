<?php
include "../config/koneksi.php";
include "../config/library.php";
include "../config/fungsi_indotgl.php";
include "../config/fungsi_combobox.php";
include "../config/class_paging.php";
date_default_timezone_set('Asia/Jakarta');
// Bagian Home
if ($_GET['module']=='home'){
  if ($_SESSION['leveluser']=='user'){
	  echo "<div class='well'><h3>Selamat Datang</h3>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Pendaftaran Pasien Secara Online.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri atau icon dibawah. </p>
		<p>&nbsp;</p>
		</div>";
   echo '<div class="row">
	<div class="col-sm-3">
		<a href=?module=antrian>
		<div class="tile-stats tile-red">
			<div class="icon"><i class="entypo-pencil"></i></div>';
			$mysql=mysql_fetch_array(mysql_query("select count(berita.id_berita) as jumlah from berita"));
		
	/*		<div class="num" data-start="0" data-end="0" data-postfix="" data-duration="2000" data-delay="0"></div> */
			echo'
			
			<h3>Buat Antrian</h3>
			<p>klik disini untuk mendaftar antrian</p>
		</div></a>
		
	</div>
	
	<div class="col-sm-3">
	<a href=?module=jadwal>
		<div class="tile-stats tile-green">
			<div class="icon"><i class="entypo-calendar"></i></div>';
			$mysql=mysql_fetch_array(mysql_query("select count(agenda.id_agenda) as jumlah from agenda"));
		
	/*		<div class="num" data-start="0" data-end="0" data-postfix="" data-duration="2000" data-delay="0"></div> */
			echo'
			
			<h3>Jadwal Dokter</h3>
			<p>yang aktif esok hari.</p>
		</div>
		</a>
	</div>
	
	<div class="col-sm-3">
	<a href=?module=user>
		<div class="tile-stats tile-aqua">
			<div class="icon"><i class="entypo-mail"></i></div>';
			$count = mysql_fetch_array(mysql_query("select count(hubungi.id_hubungi) as jumlah from hubungi"));
			
	/*		<div class="num" data-start="0" data-end="0" data-postfix="" data-duration="2000" data-delay="0"></div> */
			echo'
			
			<h3>Data Pribadi</h3>
			<p>profil data pribadi anda.</p>
		</div>
		</a>
		
	</div>
	
	<div class="col-sm-3">
	<a href=?module=history>
		<div class="tile-stats tile-blue">
			<div class="icon"><i class="entypo-users"></i></div>';
			
	/*		<div class="num" data-start="0" data-end="0" data-postfix="" data-duration="2000" data-delay="0"></div> */
			echo'
			<h3>History Kunjungan</h3>
			<p>data list kunjungan yang telah lewat.</p>
		</div>
		</a>
	</div>
</div>
';

  echo '
	<div class="row">
	<div class="col-sm-12">';
	
 
		echo'</div>';
		echo'</div> ';
  echo"<div class='row' >
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'><b><font color=green>Data Antrian Aktif</font></b></div>
						<div class='panel-options'>
							
						</div>
					</div>
          <table class='table table-bordered table-responsive' >
         <thead> <tr><th>Kode Booking</th><th>No URUT</th><th>POLI</th>
		 <th>Nama Dokter</th><th>Tgl. Antrian</th>
		 <th>Waktu</th><th>Aksi</th></tr></thead><tbody>"; 
    $tampil=mysql_query("SELECT * FROM antrian_pasien WHERE id_pasien='$_SESSION[namauser]' ");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$pol = mysql_fetch_array(mysql_query("SELECT * FROM poliklinik WHERE id_poli='$r[poliklinik]'"));
		$dok = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user='$r[id_dr]'"));
    $hari = date("w",strtotime($r[tanggal_pendaftaran]));

    $wkt = mysql_fetch_assoc(mysql_query("SELECT jam FROM dr_praktek WHERE id_poli='$r[poliklinik]' AND id_dr='$r[id_dr]' AND hari='$hari'"));
      $wktu = $wkt[jam];
       echo "<tr>
	    <td>".$r[no_faktur]."</td>
	  <td>$r[no_urut]</td>
             <td >".$pol[poli]."</td>
             <td>$dok[nama_lengkap]</td>
			 <td>".tgl_indo($r[tanggal_pendaftaran])."</td>
			 <td>$wktu</td>
             <td><a href=modul/mod_antrian/cetak.php?&nobooking=$r[no_faktur]  data-toggle='tooltip' data-placement='top' data-original-title='Cetak Antrian' target='_blank'><i class='entypo-print'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody></table></div></div></div></div>";
	
	
  echo'
	<footer class="main">
		<div class="pull-right"> <strong>'.$hari_ini.', ';
		  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo ' WIB</strong></div>
  &copy; '.date('Y').' Neon Admin Theme by Laborator
  </footer>';
  }
  elseif (!empty($_SESSION[namauser])){
  echo "<div class='well'><h3>Selamat Datang</h3>
          <p>Hai <b>$_SESSION[namalengkap]</b>, selamat datang di halaman Pendaftaran Pasien Secara Online.<br> 
          Silahkan klik menu pilihan yang berada di sebelah kiri atau icon dibawah. </p>
		<p>&nbsp;</p>
		<p>&nbsp;</p></div>";
		  echo'
	<footer class="main">
		<div class="pull-right"> <strong>'.$hari_ini.', ';
		  echo tgl_indo(date("Y m d")); 
  echo " | "; 
  echo date("H:i:s");
  echo ' WIB</strong></div>
  &copy; '.date('Y').' Neon Admin Theme by Laborator
  </footer>';
 	}
}

// Bagian User
elseif ($_GET['module']=='profil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_profil/profil.php";
  }
}

// Bagian User
elseif ($_GET['module']=='user'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_users/users.php";
  }
}
// Bagian History Antrian
elseif ($_GET['module']=='history'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_history/history.php";
  }
}
// Bagian User
elseif ($_GET['module']=='antrian'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION[leveluser]=='user'){
    include "modul/mod_antrian/antrian.php";
  }
}
// Bagian Modul
elseif ($_GET['module']=='modul'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_modul/modul.php";
  }
}

// Bagian Kategori
elseif ($_GET['module']=='kategori'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kategori/kategori.php";
  }
}

// Bagian Berita
elseif ($_GET['module']=='berita'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_berita/berita.php";                            
  }
}

// Bagian Komentar Berita
elseif ($_GET['module']=='komentar'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_komentar/komentar.php";
  }
}

// Bagian Tag
elseif ($_GET['module']=='tag'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_tag/tag.php";
  }
}

// Bagian Agenda
elseif ($_GET['module']=='jadwal'){
  if ($_SESSION['leveluser']=='admin' OR $_SESSION['leveluser']=='user'){
    include "modul/mod_agenda/agenda.php";
  }
}

// Bagian Banner
elseif ($_GET['module']=='banner'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_banner/banner.php";
  }
}

// Bagian Poling
elseif ($_GET['module']=='poling'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_poling/poling.php";
  }
}

// Bagian Download
elseif ($_GET['module']=='download'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_download/download.php";
  }
}

// Bagian Artikel
elseif ($_GET['module']=='artikel'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_artikel/artikel.php";
  }
}

// Bagian Hubungi Kami
elseif ($_GET['module']=='hubungi'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_hubungi/hubungi.php";
  }
}

// Bagian Templates
elseif ($_GET['module']=='templates'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_templates/templates.php";
  }
}

// Bagian Shoutbox
elseif ($_GET['module']=='shoutbox'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_shoutbox/shoutbox.php";
  }
}

// Bagian Album
elseif ($_GET['module']=='album'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_album/album.php";
  }
}

// Bagian Galeri Foto
elseif ($_GET['module']=='galerifoto'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_galerifoto/galerifoto.php";
  }
}

// Bagian Kata Jelek
elseif ($_GET['module']=='katajelek'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_katajelek/katajelek.php";
  }
}

// Bagian Sekilas Info
elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_sekilasinfo/sekilasinfo.php";
  }
}

// Bagian Menu Utama
elseif ($_GET['module']=='menuutama'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menuutama/menuutama.php";
  }
}

// Bagian Sub Menu
elseif ($_GET['module']=='submenu'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_submenu/submenu.php";
  }
}

// Bagian Halaman Statis
elseif ($_GET['module']=='halamanstatis'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_halamanstatis/halamanstatis.php";
  }
}

// Bagian Sekilas Info
elseif ($_GET['module']=='sekilasinfo'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_sekilasinfo/sekilasinfo.php";
  }
}

// Bagian Identitas Website
elseif ($_GET['module']=='identitas'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_identitas/identitas.php";
  }
}

//Bagian Ketegori Mobil
elseif ($_GET['module']=='mobil'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_mobil/mobil.php";
  }
}

//Bagian Jenis Biaya
elseif ($_GET['module']=='biaya'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_biaya/biaya.php";
  }
}

//Bagian Jenis Booking
elseif ($_GET['module']=='booking'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_booking/booking.php";
  }
}

//Bagian kota
elseif ($_GET['module']=='kota'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_kota/kota.php";
  }
}
elseif ($_GET['module']=='portofolio'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_portofolio/portofolio.php";
  }
}
elseif ($_GET['module']=='slide'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_slide/slide.php";
  }
}
elseif ($_GET['module']=='menu_tengah'){
  if ($_SESSION['leveluser']=='admin'){
    include "modul/mod_menu_tengah/menu_tengah.php";
  }
}

// Apabila modul tidak ditemukan
else{
  echo "<p><b>MODUL BELUM ADA ATAU BELUM LENGKAP</b></p>";
}
?>
