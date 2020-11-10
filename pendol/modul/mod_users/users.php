<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{

$aksi="modul/mod_users/aksi_users.php";
switch($_GET[act]){
  // Tampil User
  default:
    
      $tampil = mysql_query("SELECT * FROM pasien WHERE id_pasien='$_SESSION[namauser]'");
      echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Data Pasien</strong>
				</li>
			</ol>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Data Pasien</div>
						<div class='panel-options'>
							
							<a href='?module=user' ><i class='entypo-arrows-ccw'></i></a>
						</div>
					</div>";
					    echo "<table class='table table-bordered table-responsive' id='mytable'>
          <thead><tr><th>No</th>
		  <th>ID Member </th>
		  <th>Nama </th>
		  <th>Alamat</th>
		  
		  <th>Jenis Kelamin</th>
		  
		  <th>Tanggal Lahir</th>
		  </tr></thead><tbody>"; 
    $no=1;
    while ($r=mysql_fetch_array($tampil)){
		$tanggal_lahir = strftime("%d %B %Y",strtotime($r['tgl_lahir']));
		
       echo "<tr><td>$no</td>
              <td>$r[id_pasien]</td>
             <td>$r[nama_pasien]</td>
			  <td>$r[alamat]</td>
			 
			  <td>$r[jk]</td>
			 
			
			  <td> $tanggal_lahir</td>
		        
             </tr>";
      $no++;
    }
    echo "</tbody></table></div></div></div>";
   
    
    
    
   break;
  
  case "tambahuser":
    if ($_SESSION[leveluser]=='admin'){
    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li>
				<a href='?module=user'>Managemen Pengguna</a>
				</li>
				<li class='active'>
							<strong>Tambah Pengguna</strong>
				</li>
			</ol>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Tambah Pengguna</div>
						<div class='panel-options'>
						</div>
					</div>
			<div class='panel-body'>
          <form method=POST role='form' enctype='multipart/form-data' action='$aksi?module=user&act=input' class='validate'>";
		  if(!empty($_GET['msg'])){
					if($_GET['msg']=='1'){
						echo '<div class="alert alert-danger" ><strong>Nama pengguna</strong> sudah terdaftar.<a href="media.php?module=user&act=tambahuser" data-rel="close" class="pull-right"><i class="entypo-cancel"></i></a></div>';
					}	
				}
		echo"<div class='form-group'>
			<label class='control-label'>Nama Pengguna</label>
			<div class='col-sm-12'>
			<input type=text name='username' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Pengguna'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class=control-label'>Kata Sandi</label>
			<div class='col-sm-12'>
			<input type=password name='password' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Kata Sandi'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Nama Lengkap</label>
			<div class='col-sm-12'>
			<input type=text name='nama_lengkap' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Lengkap'>	
			</div>
		  </div>
		     <div class='form-group'>
			<label class='control-label'>Tempat lahir</label>
			<div class='col-sm-12'>
			<input type='text' name='tempat' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Tempat lahir'>						
		  </div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Tanggal lahir</label>
			<div class='col-sm-12'>
			<div class='input-group'>
			<input type='text' name='tanggal' data-validate='required' data-message-required='Wajib di isi.' class='form-control datepicker' placeholder='Tanggal lahir' data-format='yyyy-mm-dd'>					
			<div class='input-group-addon'>
			<a href='#'><i class='entypo-calendar'></i></a>
			</div>	
			</div>
		  </div>
		  </div>
		  <div class='form-group'>
						<label class='control-label'>Unggah Gambar</label>
						
						<div class='col-sm-12'>	
							<div class='fileinput fileinput-new' data-provides='fileinput'>
								<div class='fileinput-new thumbnail' style='width: 100px; height: 100px;' data-trigger='fileinput'>
									<img src='assets/images/login.png' alt='...'>
								</div>
								<div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 100px; max-height: 100px'></div>
								<div>
									<span class='btn btn-white btn-file'>
										<span class='fileinput-new'>Select image</span>
										<span class='fileinput-exists'>Change</span>
										<input type='file' class='btn btn-white' name='fupload' accept='image/*'>
									</span>
									<a href='#' class='btn btn-orange fileinput-exists' data-dismiss='fileinput'>Remove</a>
								</div>
							</div>
						</div>
					</div>
		   <div class='form-group'>
			<label class='control-label' >Email</label>
			<div class='col-sm-12'>
			<input type=text name='email' class='form-control' data-validate='email' placeholder='Email'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Telepon</label>
			<div class='col-sm-12'>
			<input type=text name='no_telp' data-validate='number' class='form-control' placeholder='Telepon'>	
			</div>
		  </div>
		  <div class='form-group'>
						<label class='control-label'>Level</label>
						
						<div class='col-sm-12'>
							
							<select name='level' class='selectboxit'>
								<optgroup label='Level Pengguna'>
									<option value='user'>Pengguna</option>
									<option value='admin'>Administrator</option>
								</optgroup>
							</select>
							
						</div>
					</div>
		  <div class='form-group'>
			 <input type=submit value=Simpan class='btn btn-primary'> <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
		  </div>
		  </div>
		  </form></div></div></div></div>";
    }
    else{
      echo "Anda tidak berhak mengakses halaman ini.";
    }
     break;
    
  case "edituser":
    $edit=mysql_query("SELECT * FROM users WHERE id_session='$_GET[id]'");
    $r=mysql_fetch_array($edit);

    if ($_SESSION[leveluser]=='admin'){
	echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li>
				<a href='?module=user'>Managemen Pengguna</a>
				</li>
				<li class='active'>
							<strong>Edit Pengguna</strong>
				</li>
			</ol>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Edit Pengguna</div>
						<div class='panel-options'>
						</div>
					</div>
			<div class='panel-body'>
			
          <form method=POST enctype='multipart/form-data' role='form' action='$aksi?module=user&act=update' class='validate'>";
		echo"<div class='form-group'>
			<input type=hidden name='id' value='$r[id_session]'>
			<label class='control-label'>Nama Pengguna</label>
			<div class='col-sm-12'>
			<input type=text name='username' disabled value='$r[username]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Pengguna'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class=control-label'>Kata Sandi</label>
			<div class='col-sm-12'>
			<input type=password name='password' class='form-control' placeholder='Kata Sandi'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Nama Lengkap</label>
			<div class='col-sm-12'>
			<input type=text name='nama_lengkap' value='$r[nama_lengkap]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Lengkap'>	
			</div>
		  </div>
		     <div class='form-group'>
			<label class='control-label'>Tempat lahir</label>
			<div class='col-sm-12'>
			<input type='text' name='tempat' value='$r[tempat]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Tempat lahir'>						
		  </div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Tanggal lahir</label>
			<div class='col-sm-12'>
			<div class='input-group'>
			<input type='text' name='tanggal' value='$r[tanggal]' data-validate='required' data-message-required='Wajib di isi.' class='form-control datepicker' placeholder='Tanggal lahir' data-format='yyyy-mm-dd'>					
			<div class='input-group-addon'>
			<a href='#'><i class='entypo-calendar'></i></a>
			</div>	
			</div>
		  </div>
		  </div>
		  <div class='form-group'>
						<label class='control-label'>Unggah Gambar</label>
						
						<div class='col-sm-12'>	
						<div class='fileinput fileinput-new' data-provides='fileinput'>
								<div class='fileinput-new thumbnail' style='width: 100px; height: 100px;' data-trigger='fileinput'>";
									if($r['img']!=''){
									echo"<img src='../img_foto/slide_$r[img]' alt='...'>";
									}else{
									echo"<img src='assets/images/login.png' alt='...'>";
									}
									echo"
								</div>
								<div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 100px; max-height: 100px'></div>
								<div>
									<span class='btn btn-white btn-file'>
										<span class='fileinput-new'>Select image</span>
										<span class='fileinput-exists'>Change</span>
										<input type='file' class='btn btn-white' name='fupload' accept='image/*'>
									</span>
									<a href='#' class='btn btn-orange fileinput-exists' data-dismiss='fileinput'>Remove</a>
								</div>
							</div>
						</div>
					</div>
		   <div class='form-group'>
			<label class='control-label' >Email</label>
			<div class='col-sm-12'>
			<input type=text name='email' value='$r[email]' class='form-control' data-validate='email' placeholder='Email'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Telepon</label>
			<div class='col-sm-12'>
			<input type=text name='no_telp' value='$r[no_telp]' data-validate='number' class='form-control' placeholder='Telepon'>	
			</div>
		  </div>
		  <div class='form-group'>
						<label class='control-label'>Level</label>
						
						<div class='col-sm-12'>";
							
							if($r['level']=='admin'){
								echo"<select name='level' class='selectboxit'>
								<optgroup label='Level Pengguna'>
									<option value='user'>Pengguna</option>
									<option value='admin' selected>Administrator</option>
								</optgroup>
							</select>";
							}else{
							echo"<select name='level' class='selectboxit'>
								<optgroup label='Level Pengguna'>
									<option value='user' selected>Pengguna</option>
									<option value='admin' >Administrator</option>
								</optgroup>
							</select>";
							}
							
						echo"</div>
					</div>
					  <div class='form-group'>
						<label class='control-label'>Blokir</label>
						
						<div class='col-sm-12'>";
							
							 if($r['blokir']=='N'){
								echo"<select name='blokir' class='selectboxit'>
								<optgroup label='Blokir Pengguna'>
									<option value='Y'>Y</option>
									<option value='N' selected>N</option>
								</optgroup>
							</select>";
							}else{
							echo"<select name='blokir' class='selectboxit'>
								<optgroup label='Blokir Pengguna'>
									<option value='Y' selected>Y</option>
									<option value='N'>N</option>
								</optgroup>
							</select>";
							}
							
						echo"</div>
					</div>
		  <div class='form-group'>
		<input type=submit value=Simpan class='btn btn-primary'> <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
		  </div>
		  
		  </div>
		  </form></div></div></div>
		  ";
    }
    else{
	    echo "<div class='row'>
	
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li>
				<a href='?module=user'>Managemen Pengguna</a>
				</li>
				<li class='active'>
							<strong>Tambah Pengguna</strong>
				</li>
			</ol>
			<div class='alert alert-info' >
		  *) Apabila password tidak diubah, dikosongkan saja.<br />
          **) Username tidak bisa diubah.
		  </div>
			<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Tambah Pengguna</div>
						<div class='panel-options'>
						</div>
					</div>
			<div class='panel-body'>
			
          <form method=POST role='form' enctype='multipart/form-data' action='$aksi?module=user&act=update' class='validate'>";
		echo"<div class='form-group'>
		<input type=hidden name='id' value='$r[id_session]'>
			<label class='control-label'>Nama Pengguna</label>
			<div class='col-sm-12'>
			<input type=text name='username' disabled value='$r[username]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Pengguna'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class=control-label'>Kata Sandi</label>
			<div class='col-sm-12'>
			<input type=password name='password' class='form-control' placeholder='Kata Sandi'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Nama Lengkap</label>
			<div class='col-sm-12'>
			<input type=text name='nama_lengkap' value='$r[nama_lengkap]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Lengkap'>	
			</div>
		  </div>
		     <div class='form-group'>
			<label class='control-label'>Tempat lahir</label>
			<div class='col-sm-12'>
			<input type='text' name='tempat' value='$r[tempat]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Tempat lahir'>						
		  </div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Tanggal lahir</label>
			<div class='col-sm-12'>
			<div class='input-group'>
			<input type='text' name='tanggal' value='$r[tanggal]' data-validate='required' data-message-required='Wajib di isi.' class='form-control datepicker' placeholder='Tanggal lahir' data-format='dd-mm-yyyy'>					
			<div class='input-group-addon'>
			<a href='#'><i class='entypo-calendar'></i></a>
			</div>	
			</div>
		  </div>
		  </div>
		  <div class='form-group'>
						<label class='control-label'>Unggah Gambar</label>
						
						<div class='col-sm-12'>	
							<div class='fileinput fileinput-new' data-provides='fileinput'>
								<div class='fileinput-new thumbnail' style='width: 100px; height: 100px;' data-trigger='fileinput'>";
									if($r['img']!=''){
									echo"<img src='../img_foto/slide_$r[img]' alt='...'>";
									}else{
									echo"<img src='assets/images/login.png' alt='...'>";
									}
									echo"
								</div>
								<div class='fileinput-preview fileinput-exists thumbnail' style='max-width: 100px; max-height: 100px'></div>
								<div>
									<span >
										<input type='file' class='btn btn-white' name='fupload' accept='image/*'>
									</span>
									<a href='#' class='btn btn-orange fileinput-exists' data-dismiss='fileinput'>Remove</a>
								</div>
							</div>
						</div>
					</div>
		   <div class='form-group'>
			<label class='control-label' >Email</label>
			<div class='col-sm-12'>
			<input type=text name='email' value='$r[email]' class='form-control' data-validate='email' placeholder='Email'>	
			</div>
		  </div>
		   <div class='form-group'>
			<label class='control-label'>Telepon</label>
			<div class='col-sm-12'>
			<input type=text name='no_telp' value='$r[no_telp]' data-validate='number' class='form-control' placeholder='Telepon'>	
			</div>
		  </div>
					 
		  <div class='form-group'>
		<input type=submit value=Simpan class='btn btn-primary'> <input type=button value=Batal onclick=self.history.back() class='btn btn-danger'>
		  </div>
		  
		  </div>
		  </form></div></div></div></div></div>";   
    }
    break;  
}
}
?>
