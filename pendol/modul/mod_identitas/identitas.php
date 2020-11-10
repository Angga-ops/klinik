<?php
$aksi="modul/mod_identitas/aksi_identitas.php";
switch($_GET[act]){
  // Tampil identitas
  default:
    $sql  = mysql_query("SELECT * FROM identitas LIMIT 1");
    $r    = mysql_fetch_array($sql);

    echo "<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Identitas Perusahaan</strong>
				</li>
			</ol>
			<div class='col-sm-12'>
			<div class='panel panel-default'>
			<div class='panel-heading'><div class='panel-title'>Identitas Perusahaan</div>
						<div class='panel-options'>
						</div>
					</div>
         <div class='panel-body'>
		 <form method=POST role='form' enctype='multipart/form-data' action='$aksi?module=identitas&act=update' class='validate'>
		  <input type=hidden name=id value=$r[id_identitas]>
		  <div class='form-group'>
		  <label class='control-label'>Nama Perusahaan</label>
							 						<div class='col-sm-12'>
			<input type=text name='nama_website' value='$r[nama_website]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Nama Perusahaan'>	
			</div>
		  </div>
		  <div class='form-group'>
		  <label class='control-label'>Alamat Perusahaan</label>
							 						<div class='col-sm-12'>
			<input type=text name='alamat_web' value='$r[alamat_web]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Alamat Web'>	
			</div>
		  </div>
		    <div class='form-group'>
		  <label class='control-label'>Email</label>
							 						<div class='col-sm-12'>
			<input type=text name='email' value='$r[email]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='Email'>	
			</div>
		  </div>
		     <div class='form-group'>
		  <label class='control-label'>Telp</label>
							 						<div class='col-sm-12'>
			<input type=text name='telp' value='$r[telp]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='telp'>	
			</div>
		  </div>
		       <div class='form-group'>
		  <label class='control-label'>Link Web</label>
							 						<div class='col-sm-12'>
			<input type=text name='link_web' value='$r[link_web]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='URL'>	
			</div>
		  </div>
		  
		      <div class='form-group'>
		  <label class='control-label'>Link Facebook</label>
							 						<div class='col-sm-12'>
			<input type=text name='link_fb' value='$r[link_fb]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='URL Facebook'>	
			</div>
		  </div>
		     <div class='form-group'>
		  <label class='control-label'>Link Twitter</label>
							 						<div class='col-sm-12'>
			<input type=text name='link_twitter' value='$r[link_twitter]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' placeholder='URL Twitter'>	
			</div>
		  </div>
		  		  <div class='form-group'>
		  <label class='control-label'>Meta Deskripsi</label>
							 						<div class='col-sm-12'>
			<input type=text name='meta_deskripsi' value='$r[meta_deskripsi]' class='form-control' data-validate='required' data-message-required='Wajib di isi.' >	
			</div>
		  </div>
		   <div class='form-group'>
		  <label class='control-label'>Keyword</label>
							 						<div class='col-sm-12'>
			<input type=text name='meta_keyword' value='$r[meta_keyword]' class='form-control tagsinput' data-validate='required' data-message-required='Wajib di isi.' >	
			</div>
		  </div>
		   <div class='form-group'>
		   
		  <label class='control-label'>Favicon</label>
							 						<div class='col-sm-12'>
			<img src=../$r[favicon]><p></p>
		  
		  <div class='fileinput fileinput-new' data-provides='fileinput'>
								<span class='btn btn-default btn-file'>
									<span class='fileinput-new'>Select file</span>
									<span class='fileinput-exists'>Change</span>
									<input type='file' name='fupload' >
								</span>
								<span class='fileinput-filename'>$r[nama_file]</span>
								<a href='#' class='lose fileinput-exists' data-dismiss='fileinput' style='float: none'><i class='entypo-cancel'></i></a>
							</div>
		  </div>
		  </div>
		  </div>
		  </div>
		   <input type=submit value=Update class='btn btn-primary'>
		  </div>
		 
		  </form>
		  </div>
		  </div>";
    break;  
}
?>
