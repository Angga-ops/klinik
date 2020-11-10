<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_komentar/aksi_komentar.php";
switch($_GET[act]){
  // Tampil Komentar
  default:
    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Managemen Komentar</strong>
				</li>
			</ol>
				<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Managemen Komentar</div>
					</div>
          <table class='table table-bordered table-responsive' id='mytable'>
          <thead><tr><th>Nama</th><th>Komentar</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></thead><tbody>";
    $tampil=mysql_query("SELECT * FROM komentar ORDER BY id_komentar DESC");

    $no = $posisi+1;
    while ($r=mysql_fetch_array($tampil)){
	$isi_kom = htmlentities(strip_tags($r['isi_komentar']));
	$isi = substr($isi_kom,0,100);
	$isi = substr($isi_kom,0,strrpos($isi," "));
      echo "<tr>
                <td >$r[nama_komentar]</td>
                <td >$isi</td>
                <td align=center>$r[tgl] - $r[jam_komentar] WIB</td>
				<td align=center width='5%'>$r[aktif]</td> 

<td width='5%'>
			 <div class='btn-group drodown pull-right'>
  <button class='btn btn-xs btn-primary dropdown-toggle' data-toggle='dropdown'>
    <i class='entypo-pencil'></i>
  </button>
  <ul class='dropdown-menu'>
  	<li><a href=?module=komentar&act=editkomentar&id=$r[id_komentar]><i class='entypo-export'></i> Edit</a></li>
    <li><a href=\"$aksi?module=komentar&act=hapus&id=$r[id_komentar]\" onClick=\"return confirm('Apakah Anda benar-benar mau menghapusnya?')\"><i class='entypo-cancel-squared'></i> Hapus</li>
  </ul>
</div>
             </td>				
		        </tr>";
      $no++;
    }
    echo "</tbody><tfoot><tr><th>Nama</th><th>Komentar</th><th>Tanggal</th><th>Aktif</th><th>Aksi</th></tr></tfoot></table></div></div></div>";
    break;
  
  case "editkomentar":
    $edit = mysql_query("SELECT * FROM komentar WHERE id_komentar='$_GET[id]'");
    $r    = mysql_fetch_array($edit);

    echo "<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li>
				<a href='?module=komentar'>Managemen Komentar</a>
				</li>
				<li class='active'>
							<strong>Edit Komentar</strong>
				</li>
			</ol>
			<div class='col-sm-12'>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Edit Komentar</div>
						<div class='panel-options'>
						</div>
					</div>
         <div class='panel-body'>
          <form method=POST action=$aksi?module=komentar&act=update role='form' enctype='multipart/form-data' class='validate'>
		  <input type=hidden name=id value=$r[id_komentar]>
		 <div class='form-group'>
		 <label class='control-label'>Nama Pengomentar</label>
			<div class='col-sm-12'>
			<input type=text name='nama_komentar' value='$r[nama_komentar]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Komentar'>	
			</div>
		  </div>
		  <div class='form-group'>
		 <label class='control-label'>Url</label>
			<div class='col-sm-12'>
			<input type=text name='url' value='$r[url]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Url'>	
			</div>
		  </div>
		  <label class='control-label'>Isi Komentar</label>
			<div class='col-sm-12'>
			 <textarea class='form-control' style='resize: none; width:100%; height: 350px;' name='isi_komentar' id='loko' >$r[isi_komentar]</textarea><p></p>
		  </div>
		 ";
if ($r[aktif]=='Y'){
      echo "<div class='form-group'>
	  <label class='control-label'>Aktif</label>
			<div class='col-sm-12'> <input type=radio name='aktif' value='Y' checked> Y  
                                      <input type=radio name='aktif' value='N'> N </div>
		  </div>";
    }
    else{
      echo "<div class='form-group'>
	  <label class='control-label'>Aktif</label>
			<div class='col-sm-12'> <input type=radio name='aktif' value='Y'> Y  
                                      <input type=radio name='aktif' value='N' checked> N </div>
		  </div>";
    }
		  
		  echo"</div> </div>
		   <div class='form-group'><input type=submit value=Update class='btn btn-primary'> <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'></div>
         
		  </div>
          
          </form></div>";

    break;  
}
}
?>
