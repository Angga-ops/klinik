<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_hubungi/aksi_hubungi.php";
switch($_GET[act]){
  // Tampil Hubungi Kami
  default:
    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Managemen Kontak</strong>
				</li>
			</ol>
				<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Managemen Kontak</div>
					</div>
          <table class='table table-bordered table-responsive' id='mytable'>
          <thead><tr><th>No</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th>Aksi</th></tr></thead><tbody>";

    $tampil=mysql_query("SELECT * FROM hubungi ORDER BY id_hubungi DESC");

    $no = 1;
    while ($r=mysql_fetch_array($tampil)){
      $tgl=tgl_indo($r[tanggal]);
      echo "<tr><td>$no</td>
                <td width=40%>$r[nama]</td>
                <td><a href=?module=hubungi&act=balasemail&id=$r[id_hubungi]>$r[email]</a></td>
                <td>$r[subjek]</td>
                <td>$tgl</a></td>
                <td width='5%'><center><a href=\"$aksi?module=hubungi&act=hapus&id=$r[id_hubungi]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><i class='entypo-trash'></i></a></center>
                </td></tr>";
    $no++;
    }
    echo "</tbody><tfoot><tr><th>No</th><th>Nama</th><th>Email</th><th>Subjek</th><th>Tanggal</th><th>Aksi</th></tr></tfoot></table></div></div></div>";
    break;

  case "balasemail":
    $tampil = mysql_query("SELECT * FROM hubungi WHERE id_hubungi='$_GET[id]'");
    $r      = mysql_fetch_array($tampil);

    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Email</strong>
				</li>
			</ol>
			<div class='col-sm-12'>
				<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Balas Email</div>
					</div>
					<div class='panel-body'>
          <form method=POST action='?module=hubungi&act=kirimemail' class='validate' role='form' enctype='multipart/form-data'>
		  <div class='form-group'>
		  <label class='control-label'>Kepada</label>
							 						<div class='col-sm-12'>
			<input type=text name='email' value='$r[email]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Web'>	
			</div>
		  </div>
		  <div class='form-group'>
		  <label class='control-label'>Subjek</label>
							 						<div class='col-sm-12'>
			<input type=text name='subjek' value='Re: $r[subjek]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Web'>	
			</div>
		  </div>
		   <div class='form-group'>
		  <label class='control-label'>Pesan</label>
							 						<div class='col-sm-12'>
													<textarea name='pesan' id='loko'><br><br><br><br>     
  ---------------------------------------------------------------------------------------------------------------------
  $r[pesan]</textarea>
			</div>
		  </div>
		   
		
<div class='form-group'><input type=submit value=Simpan class='btn btn-primary'> <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'></div>
         </div></form></div></div></div></div>";
     break;
    
  case "kirimemail":
    mail($_POST[email],$_POST[subjek],$_POST[pesan],"From: info@creativegamastudio.com");
    echo "<h2>Status Email</h2>
          <p>Email telah sukses terkirim ke tujuan</p>
          <p>[ <a href=javascript:history.go(-2)>Kembali</a> ]</p>";	 		  
    break;  
}
}
?>
