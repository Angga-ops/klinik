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
$kembali        = date("Y-m-d H:i:s", $tujuh_hari);
$kembali2 = date("Y-m-d",$tujuh_hari);
function setkodehari($ymd){
	$h = array("Sunday" => 0,"Monday" => 1,"Tuesday" => 2,"Wednesday" => 3,"Thursday" => 4,"Friday" => 5,"Saturday" => 6);
	foreach($h as $k => $v){
		$dt = date("l",$ymd);
		if($dt == $k){
			return $v;
			break;
		}
	}
}

$filter = setkodehari($tujuh_hari);
$cekantri = mysql_num_rows(mysql_query("SELECT * FROM antrian_pasien WHERE 
    tanggal_pendaftaran='$kembali2' AND id_pasien='$_SESSION[namauser]'"));
	
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
			
							<strong>Data Antrian</strong>
				</li>
			</ol>";
			echo "<div class='well'><h3><font color='red'>Perhatian!!!</font></h3>
          <p>* Pendaftaran antrian hanya bisa untuk esok hari saat registrasi.<br>
* Pendaftaran POLI Rawat Jalan hanya bisa 1 kali untuk hari esok melalui online.<br>
* Pastikan pilihan data sudah benar sebelum klik simpan.</p>
		</div>";
			
			echo"<div class='col-sm-6'>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'><b>Tambah Antrian</b></div>
						<div class='panel-options'>
						<a href='#' data-rel='collapse'><i class='entypo-down-open'></i></a>
						</div>
					</div>
         <div class='panel-body'>
		  <div class='form-group'>
						
						";
						if(!empty($cekantri)){
							   
		echo "<blink><div class='well'><h4><font color='red'>Mohon maaf Anda sudah memiliki antrian untuk besok.</font></h4>
         
		</div></blink>";
			
		  }else{	
			  
		 $nofak = date("YmdHis",strtotime($kembali)); 
								$ran = rand(1,9);
								$nofak .= $ran;
								

						echo"<div class='col-sm-12'>
						<div class='form-group'>
<form method=POST role='form' enctype='multipart/form-data' action='$aksi?module=antrian&act=input' class='validate'>						
							 
			NO FAKTUR : <input type='text' name='nofaktur' class='form-control' value='$nofak' readonly/>
			NO PASIEN : <input type=text name='nopasien' class='form-control' data-validate='required'  value='".$_SESSION[namauser]."' readonly><p></p>
			TANGGAL ANTRIAN : <input type=text name='tglantri' class='form-control' data-validate='required'  value='".$kembali."' readonly><p></p>
			
		
			WAKTU KUNJUNGAN : <select name='kunjungan' id='wkt' class='form-control'  onchange='pilihdr()'>
			<option value=''>--Pilih Waktu Kunjungan--</option>";

			$w = 0;
			while($w < 24){
				$x = ($w < 10)? "0".$w : $w;
				echo "<option value='".$x.":00:00'>".$x.":00:00</option>";
				$w++;
			}
			
			
			
			echo"</select>	<br>
			POLIKLINIK : <select name='poli' id='poli' class='form-control' onchange='pilihdr()'>
			<option value=''>--Pilih Poliklinik--</option>";
			$bagian = mysql_query("SELECT * FROM poliklinik");
			while($b=mysql_fetch_array($bagian)){
			echo"
			<option value='$b[id_poli]'>$b[poli]</option>
			";
			}
			echo"</select><br>
              DOKTER : <div id='praktek'><select class='form-control' disabled><option value=''>---</option></select></div>";
			echo"	<br/>	
			PILIH PENJAMIN : <select name='penjamin' class='selectboxit''>
			<option value=''>--pilih--</option>
			<option value='umum'>Umum</option>
			<option value='bpjs'>BPJS</option>
			<option value='asuransi'>Asuransi</option>
			</select>	
			</div>
		  </div>
		  <div class='form-group'>
		  <input type=submit value=Simpan class='btn btn-primary ' id='simpan'>
		  </div>	</form>
		  ";
		 }
		  
		  echo"						
		 </div>";
		 
		 echo"
			</div>
			</div>
			</div>
		
			<div class='col-sm-6'>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'><b>List Data Antrian Aktif</b></div>
						
					</div>
          <table class='table table-bordered table-responsive' >
         <thead> <tr><th>No URUT</th><th>POLI</th>
		 <th>Nama Dokter</th><th>Tgl. Antrian</th>
		 <th>Waktu</th><th>Aksi</th></tr></thead><tbody>"; 

    $tampil=mysql_query("SELECT * FROM antrian_pasien WHERE id_pasien='$_SESSION[namauser]' AND tanggal_pendaftaran = '$kembali2'");
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$pol = mysql_fetch_array(mysql_query("SELECT * FROM poliklinik WHERE id_poli='$r[poliklinik]'"));
		$dok = mysql_fetch_array(mysql_query("SELECT * FROM user WHERE id_user='$r[id_dr]'"));
		
		$hari = date("w",strtotime($r[tanggal_pendaftaran]));
		$wkt = mysql_fetch_assoc(mysql_query("SELECT jam FROM dr_praktek WHERE id_poli='$r[poliklinik]' AND id_dr='$r[id_dr]' AND hari='$hari'"));
		$wktu = $wkt[jam];
		 echo "<tr>
		 
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

	function pilihdr(){
		var wkt = $("#wkt").val();
		var poli = $("#poli").val();
		var d = new Date("<?php echo $kembali; ?>");
		if(wkt == ""){
			alert("Anda belum memilih waktu kunjungan");
			$("#poli").val("");
		} else if(poli == ""){} else {
			$.ajax({
				url: "modul/mod_antrian/pilihdr.php",
				data: {"wkt": wkt, "hari": (d.getDay()), "poli": poli},
				success: function(data){
					$("#praktek").html(data);
				}
			});
		}
	}

	$(document).ready(function(){
	});
	</script>
	
	<?php
	
	break;
  
 }
}
?>
