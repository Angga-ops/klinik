<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
$aksi="modul/mod_antrian/aksi_antrian.php";
$pinjam            = date("d-m-Y");
$tujuh_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
$kembali        = date("Y-m-d", $tujuh_hari);
$filter = date("N",$tujuh_hari);
switch($_GET[act]){
  // Tampil Kategori
  default:
    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>History Data Kunjungan Pasien</strong>
				</li>
			</ol>
			
			
		
		
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>List Data Kunjungan Pemeriksaan</div>
						<div class='panel-options'>
							
						</div>
					</div>
          <table class='table table-bordered table-responsive' id='mytable' >
         <thead> <tr>
		 <th>Kode Booking</th><th>No URUT</th><th>POLI</th>
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
    
	?>
	<script src="assets/js/chained.js"></script>
	<script>
	$(document).ready(function(){
		$("#poli").chained("#wkt");
		$("#dokter").chained("#poli");
	});
	</script>
	
	<?php
	
	break;
  
  // Form Tambah Kategori
  
  // Form Edit Kategori  
  case "editantrian":
    $edit=mysql_query("SELECT * FROM antrian WHERE id_antrian='$_GET[id]'");
    $r=mysql_fetch_array($edit);

	 echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Managemen Kategori</strong>
				</li>
			</ol>
			<div class='col-sm-6'>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Edit Kategori</div>
						<div class='panel-options'>
						<a href='#' data-rel='collapse'><i class='entypo-down-open'></i></a>
						</div>
					</div>
         <div class='panel-body'>
		 <form method=POST role='form' enctype='multipart/form-data' action='$aksi?module=antrian&act=update' class='validate'>
		  <div class='form-group'>
		  <label class='control-label'>Kategori</label>
						<div class='col-sm-12'>
			<input type=hidden value='$r[id_antrian]' name='id'>
			<input type=text name='nama_antrian' class='form-control' value='$r[nama_antrian]' data-validate='required' data-message-required='Wajib di isi.' placeholder='Kategori'>	<p></p>
			<select name='antrian' class='selectboxit'>
            <option value='produk'>Produk</option>
            <option value='portofolio'>Portofolio</option>
            </select>
			</div>
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
			echo"
		  <div class='form-group'>
		  <input type=submit value=Update class='btn btn-primary ' id='simpan'>
		  </div>
							</form>
		 </div>
			</div>
			</div>
			</div>
			<div class='col-sm-6'>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Managemen Kategori</div>
						<div class='panel-options'>
							<a href='?module=antrian' data-toggle='tooltip' data-placement='top' data-original-title='Tambah Kategori'><i class='entypo-plus-squared'></i></a>
						</div>
					</div>
          <table class='table table-bordered table-responsive' id='mytable'>
         <thead> <tr><th>No</th><th>Nama antrian</th><th>Status</th><th>Aksi</th></tr></thead><tbody>"; 
    $tampil=mysql_query("SELECT * FROM antrian ORDER BY id_antrian DESC");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		 if ($r[WAKTUDR]=='P'){
		  $wktu = "PAGI";
	  }else{
		  $wktu = "SORE";
	  }
       echo "<tr><td>$no</td>
             <td width=80%>$r[nama_antrian]</td>
             <td>$r[aktif]</td>
             <td><a href=?module=antrian&act=editantrian&id=$r[id_antrian] data-toggle='tooltip' data-placement='top' data-original-title='Edit Kategori'><i class='entypo-export'></i></a>
             </td></tr>";
      $no++;
    }
    echo "</tbody></table></div></div></div>";
     break; 
}
}
?>
