<?php 


$id_kk = $_SESSION['klinik']; ?>
<style>
.styling {background: #00c0ef; padding: 1%}
.col-md-6 {margin-bottom: 1%}
.nav-tabs-custom > ul.nav-tabs > li.active > a {background: #00c0ef}
.width {width: 92% !important}
</style>
<section class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="accordion" >
				<div class="box box-success" id="boxbos">
					<div class="box-header" id="tabone">
						<h3>Data Pelayanan</h3>
						<ul class="nav nav-tabs box-header-tabs">
					     
					      <li class="nav-item" id="pb">	
					        <a class="nav-link" type="button" href="#" id="konsultasi">Data Rawat Jalan</a>
					      </li>
					<!--	  <li class="nav-item" id="pl">
					        <a class="nav-link" type="button" id="bpt" href="#">IGD</a>
					      </li>
						    <li class="nav-item" id="pk">
					        <a class="nav-link" type="button" id="lab" href="#">Laboratorium</a>
					      </li>
						  
						   -->
						  <li class="nav-item" id="pj">
					        <a class="nav-link" type="button" id="inap" href="#">Rawat Inap</a>
					      </li>
						
					    </ul>
					    <input type="hidden" id="awal">
					</div>
					<div class="box-body">
				

<!-- form panggil data pasien -->

					<form id="form_tam" class="collapse">
						<div class="row">
							<div class="col-md-6">
								<label>Cari Pelanggan</label>
									<div class="row">
										<div class="col-md-2">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio1" value="nama" checked>
							                      Nama
							                    </label>
							                  </div>
										</div>
										<div class="col-md-3">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio2" value="kode">
							                      No.RM
							                    </label>
							                  </div>
										</div>
										<div class="col-md-6">
											<div class="radio">
							                    <label>
							                      <input type="radio" name="cara_cari" id="radio3" value="tgl">
							                      Tanggal Lahir (yyyy-mm-dd)
							                    </label>
							                  </div>
										</div>
									</div>

								
								<input class="form-control" type="text" id="nama_k" name="nama_kode" style="width:93%;" required>
								<input class="form-control" type="hidden" name="nama" id="nama_hidden">
								<input type="hidden" id="cara2">
								<input type="hidden" id="cek_tampil">
								<button style="margin-top: 10px;margin-bottom: 10px;" class="btn btn-sm btn-info">Tampilkan</button>
							</div>
						</div>
					</form>

<!-- form panggil data pasien -->


							<form id="form_k" class="collapse">
								<?php $nofak = date("YmdHis"); 
								$ran = rand(1,9);
								$nofak .= $ran;
								?>
								<input class="form-control" type="hidden" id="nama_kon" name="nama" style="width:93%;" required>

								<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
									<h4>Data Pasien</h4>
									<div class="row">
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Rekam Medis
												</div>
												<div class="col-md-6" id="data_id">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Nama 
												</div>
												<div class="col-md-6" id="data_n">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													No Telp
												</div>
												<div class="col-md-6" id="data_nt">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Alamat
												</div>
												<div class="col-md-6" id="data_a">
													 
												</div>
											</div>
										</div>
										<div class="col-md-6">
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Tanggal Lahir
												</div>
												<div class="col-md-6" id="data_tl">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Jenis Kelamin
												</div>
												<div class="col-md-6" id="data_jk">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Total Kunjungan
												</div>
												<div class="col-md-6" id="data_tk">
													 
												</div>
											</div>
											<div class="row" style="margin-bottom: 10px;">
												<div class="col-md-3">
													Jenis Member
												</div>
												<div class="col-md-6" id="data_katmem">
													 
												</div>
											</div>
										</div>
									</div>
								</div> 
								
								<br/><br/>
								
								
								</form>



					 	
								

<!-- form poliklinik -->
								<div class="collapse" id="pilih_dok">

<!-- input tab -->
								<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_1" data-toggle="tab">Input Data Billing</a></li>
              <li><a href="#tab_2" data-toggle="tab">Resep Obat & Tindakan</a></li>
            </ul>
            <div class="tab-content">
              <div class="tab-pane active styling" id="tab_1">
			  <!-- input data pasien -->

			  <form style="margin-bottom: 20px;" id="form_p">
						<input class="form-control" type="hidden" name="id_kasir" value="<?php echo $_SESSION['id_user']; ?>">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" id="id_pasien">

							 <div class="row">

							 <div class="col-md-6">
								<label>Nomer Billing</label>
								<input type="text" class="form-control width" id="nofak" value="" onchange="chgdata()">
								</div>

							</div><div class="row">
							 <div class="col-md-6">
							 <label>Tanggal Registrasi</label>
							 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
							 
							 <input type="text" class="form-control datepicker width" name="tgl_reg" /> 
							 </div>
							 </div>
							 <div class="col-md-6">
							 <label>Tanggal Keluar</label>
							 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
							 
							 <input type="text" class="form-control datepicker width" name="tgl_out" /> 
							 </div>
							 </div>
							 </div>

							 <div class="row">
							 <div class="col-md-6">
										<label>Penjamin Pasien</label>
										<select class="form-control penjamin" style="width: 93%;" name="pas"  id="jamin_obat">
										<option value="">--silakan pilih--</option>
											<option value="umum">Umum</option>
											<option value="bpjs">BPJS</option>
											<option value="lain">Asuransi Lain</option>
											<option value="inhealt">Inhealt</option>
											<option value="jkk">JKK</option>
											<option value="corp1">Perusahaan 1</option>
											<option value="corp2">Perusahaan 2</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Asuransi</label>
										<select class="form-control" style="width: 93%;" name="ass">
											<option value="">--abaikan--</option>
											<?php 
											
											$asur = mysqli_query($con,"SELECT * FROM asuransi");
											while($asuri = mysqli_fetch_assoc($asur)){
												echo "<option value='$asuri[id]'>$asuri[nama]</option>";
											}
											
											?>
										</select>
										(abaikan jika tidak ada)
									</div>
								<div class="col-md-6">
										<label>Pilih Poliklinik</label>
										<select class="form-control" id="poli" name="poli" style="width: 93%;">
											<option value="belum">Silahkan pilih poliklinik ..</option>
											<?php 
											$q1 = mysqli_query($con,"SELECT *FROM poliklinik");
											while ($dok = mysqli_fetch_array($q1)) { ?>
												<option value="<?php echo $dok['id_poli']; ?>"><?php echo $dok['poli'] ?></option>
											<?php } ?>
										</select>
										
									</div>
									<div class="col-md-6" id="doct">
										<label>Dokter</label>
										<select class="form-control" style="width: 93%;" name="dokter">
											<option value="belum">Silahkan pilih dokter ..</option>
											<?php $do = mysqli_query($con,"SELECT * FROM user WHERE id_ju = 'JU-02'");
											while($doc = mysqli_fetch_assoc($do)){
												echo "<option value='$doc[id_user]'>$doc[nama_lengkap]</option>";
											}
											?>
										</select>
										
									</div>
									</div>
											<div class="row">
									<div class="col-md-6">
									<label>Status</label>
									<select class="form-control" style="width: 93%;" name="status">
										<option value="Belum Lunas">Belum Lunas</option>
										<option value="Lunas">Lunas</option>
										</select>
									</div>
											</div>
									<div class="row">
									<div class="col-md-3">
										<label>Berat Badan</label>
										<input type="text" name="bb" class="form-control" />
										
									</div>
									<div class="col-md-3">
										<label>Tinggi Badan</label>
										<input type="text" name="tb" class="form-control" />
										
									</div>
									<div class="col-md-3">
										<label>Keluhan</label>
										<textarea class="form-control" style="height: 150px" name="sakit" ></textarea>
										
									</div>
											</div>



									<div class="row">
									<div class="col-md-6"><br>
										<button style="margin-top: 5px;" type="submit" class="btn btn-sm btn-success">Simpan</button>
										<button style="margin-top: 5px;" type="button" class="btn btn-sm btn-danger data_batal">Batal</button>
									</div>
									</div>
								
					 		
				 	</form>


			 <!-- input data pasien -->
			  </div> <!-- tab pane -->
			  <div class="tab-pane" id="tab_2">
			  <!-- input data obat/dokter -->

<input type="hidden" id="cegahsimpan" />

			  <div class="col-md-12 styling">

<h4>Resep Obat & Tindakan Dokter (data tersimpan otomatis)</h4>
<span><small>Pastikan nomor billing dan jenis penjamin pasien sudah diisikan</small></span>
<br/><br/>
			
			<div class="col-md-6">
			<h4>Silahkan pilih Resep Obat</h4>
						<select id="tataup" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<option value="produk">Resep Obat</option>
						</select>
						</div>
						<div class="col-md-6">
						<h4>Silahkan pilih Tindakan Dokter</h4>
						<select id="tataup2" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<?php 
							
							$u = mysqli_query($con,"SELECT * FROM kategori_biaya");
							while($ux = mysqli_fetch_assoc($u)){
								echo "<option value='$ux[id]'>$ux[kategori]</option>";
							}
							
							?>
						</select>
						</div>
						<br/><br/>	<br/><br/>
<form style="margin-bottom: 20px;" id="form_px" class="collapse">
							<input class="form-control" type="hidden" name="id_kk" value="<?php echo $_SESSION['klinik'] ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
					 		<input type="hidden" class="form-control" name="id_dr" value="<?php echo $_SESSION['id_dr']; ?>">
					 		<input type="hidden" name="modal" id="modal">
					 		<input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Tindakan Dokter</label>
						 			</td>
						 			<td>
						 				<label>Harga</label>
						 			</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="nama_t" id="nama_t" style="width: 90%;" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="text" name="harga_t" id="harga" style="width: 90%;" readonly>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<label>Keterangan</label>
					 				</td>
					 				<td>
					 					<label>Diskon (%) </label>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_t" value="0" required>
					 				</td>
					 			</tr>
								 <tr>
					 				<td>
					 					<label>Tanggal </label>
					 				</td>
					 				<td>
					 					<label>Dokter Visit </label>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
									 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
					 					<input class="form-control datepicker" type="text" name="tgl_visit" style="width: 90%;" >
										 </div>
					 				</td>
					 				<td>
					 					<select class="form-control" name="dr_visit">
										 <option value="">--silakan pilih--</option>
										 <?php $do = mysqli_query($con,"SELECT * FROM user WHERE id_ju = 'JU-02'");
											while($doc = mysqli_fetch_assoc($do)){
												echo "<option value='$doc[id_user]'>$doc[nama_lengkap]</option>";
											}
											?>
										 <?php
while($ko = mysqli_fetch_assoc($c)){
   
   $dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

 
} ?>
</select>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<button  style="margin-top: 20px;" class="btn btn-sm btn-success">Tambah</button>
					 					<button type="button" id="reset_t" style="margin-top: 20px;" class="btn btn-sm btn-danger">Reset Tabel</button>
					 				</td>
					 			</tr>
					 		</table>
</form>
							<form style="margin-bottom: 20px;" id="form_produk" class="collapse">
							
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
					 		<input type="hidden" name="kode_p" id="kode_p">
				 			<input type="hidden" name="harga_b" id="harga_b">
				 			<input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
					 			<td>
					 				<label>Nama Resep Obat</label>
					 			</td>
					 			<td>
					 				<label>Harga</label>
					 			</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<input class="form-control" type="text" name="nama_p" id="nama_p" style="width: 90%;" required>
				 				</td>
				 				<td>
				 					<input class="form-control" type="text" name="harga_p" id="harga_p" style="width: 90%;" readonly>
				 				</td>
				 			</tr>
				 			<tr>
				 				<td>
					 				<label>Keterangan</label>
					 			</td>
					 			<td>
					 				<label>Diskon</label>
					 			</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-">
				 				</td>
				 				<td>
				 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_p" value="0">
				 				</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<label>Jumlah</label>
				 				</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<input class="form-control" min="1" type="number" name="jumlah" id="jumlah_p" style="width: 90%;" value="1" required>
				 				</td>
				 				<td>
				 					<button style="margin-top: 5px;" class="btn btn-sm btn-success">Tambah</button>
				 					<button type="button" style="margin-top: 5px;" class="btn btn-sm btn-danger" id="reset_t">Reset Tabel</button>
				 				</td>
				 			</tr>
					 		</table>
					 	</form>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" width="100%" id="tabel_tp">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Jumlah Beli</th>
						<th>Harga</th>
						<th>Jenis</th>
						<th>Ket</th>
						<th>Pilihan</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>

			   <!-- input data obat/dokter -->
			  </div> <!-- tab pane -->
			  </div> <!-- tab content -->
			  </div> <!-- nav-tabs-custom -->
			  </div> <!-- col-md-6 -->
			  </div> <!-- row -->

<!-- input tab -->


									<!------------------------------------------> 

					
					 



					 <script>
function changedoc(){
	
}
</script>


						<!------------------------------------------>
								</div>

								</div>
							
					<!-- form poliklinik -->
		

<!-- form inap -->
<div class="collapse" id="mondok">
							<!------------------------------------------> 

<!-- input tab --> 


<div class="row">
        <div class="col-md-12">
          <!-- Custom Tabs -->
          <div class="nav-tabs-custom">
            <ul class="nav nav-tabs">
              <li class="active"><a href="#tab_3" data-toggle="tab">Input Data Billing</a></li>
              <li><a href="#tab_4" data-toggle="tab">Resep Obat/Tindakan Dokter</a></li>
              
            </ul>
            <div class="tab-content">
              <div class="tab-pane active styling" id="tab_3">
			  <!-- inap --> 

			  <form style="margin-bottom: 20px;" id="form_j">
							<input class="form-control" type="hidden" name="id_kasir" value="<?php echo $_SESSION['id_user']; ?>">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" id="id_pasien2">
					 	
							 <div class="row">

							 <div class="col-md-6">
								<label>Nomer Billing</label>
								<input type="text" class="form-control width" id="nofak2" value="" onchange="chgdata()">
								</div>
								</div><div class="row">
							 <div class="col-md-6">
							 <label>Tanggal Registrasi</label>
							 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
							 
							 <input type="text" class="form-control datepicker width" name="tgl_reg" /> 
							 </div>
							 </div>
							 <div class="col-md-6">
							 <label>Tanggal Keluar</label>
							 <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
							 
							 <input type="text" class="form-control datepicker width" name="tgl_out" /> 
							 </div>
							 </div>
							 </div>
							
							 <div class="row">
							 <div class="col-md-6">
										<label>Penjamin Pasien</label>
										<select class="form-control" style="width: 93%;" name="pas" id="jamin_obat2">
										<option value="">--silakan pilih--</option>
											<option value="umum">Umum</option>
											<option value="bpjs">BPJS</option>
											<option value="lain">Asuransi Lain</option>
											<option value="inhealt">Inhealt</option>
											<option value="jkk">JKK</option>
											<option value="corp1">Perusahaan 1</option>
											<option value="corp2">Perusahaan 2</option>
										</select>
										
									</div>
									<div class="col-md-6">
										<label>Asuransi</label>
										<select class="form-control" style="width: 93%;" name="ass">
											<option value="">--abaikan--</option>
											<?php 
											
											$asur = mysqli_query($con,"SELECT * FROM asuransi");
											while($asuri = mysqli_fetch_assoc($asur)){
												echo "<option value='$asuri[id]'>$asuri[nama]</option>";
											}
											
											?>
										</select>
										(abaikan jika tidak ada)
									</div>
								<div class="col-md-6">
										<label>Pilih Ruang Perawatan</label>
										<select class="form-control" id="ruang" name="ruang" style="width: 93%;">
											<option value="belum">Silahkan pilih ruang ..</option>
											<?php 
											$q1 = mysqli_query($con,"SELECT *FROM ruangan");
											while ($dok = mysqli_fetch_array($q1)) { 
												if(!is_null($dok['status'])){
													$status = "(Rusak)";
													$stat = "disabled";
												} else if($dok['kapasitas'] == $dok['terpakai']){
													$status = "(Penuh)";
													$stat = "disabled";
												} else {
													$status = "";
												}
												?>
												<option value="<?php echo $dok['id']; ?>" <?php echo $stat; ?>><?php echo $dok['nama_ruangan']." ".$status; ?></option>
											<?php } ?>
										</select>
										
									</div>
									<div class="col-md-6" id="doct">
										<label>Dokter</label>
										<select class="form-control" style="width: 93%;" name="dokter">
											<option value="belum">Silahkan pilih dokter ..</option>
											<?php 
											$q1 = mysqli_query($con,"SELECT *FROM user WHERE id_ju = 'JU-02'");
											while ($dok = mysqli_fetch_array($q1)) { 
											
												?>
												<option value="<?php echo $dok['id_user']; ?>"><?php echo $dok['nama_lengkap']; ?></option>
											<?php } ?>
										</select>
										
									</div>
									</div>
									<div class="row">
									<div class="col-md-6">
									<label>Status</label>
									<select class="form-control" style="width: 93%;" name="status">
										<option value="Belum Lunas">Belum Lunas</option>
										<option value="Lunas">Lunas</option>
										</select>
									</div>
												</div>
									<div class="row">
									<div class="col-md-3">
										<label>Berat Badan</label>
										<input type="text" name="bb" class="form-control" />
										
									</div>
									<div class="col-md-3">
										<label>Tinggi Badan</label>
										<input type="text" name="tb" class="form-control" />
										
									</div>
									<div class="col-md-3">
										<label>Keluhan</label>
										<textarea class="form-control" style="height: 150px" name="sakit" ></textarea>
										
									</div>
									</div>
									<div class="row">
									<div class="col-md-6"><br>
										<button style="margin-top: 5px;" type="submit" class="btn btn-sm btn-success">Simpan</button>
										<button style="margin-top: 5px;" type="button" class="btn btn-sm btn-danger data_batal">Batal</button>
									</div> </div>
								
					 		
				 	</form>

			  <!-- inap --> 
			  </div> <!-- tab pane -->
			  <div class="tab-pane styling" id="tab_4">
			  <!-- inap obat --> 

			  <input type="hidden" id="cegahsimpan2" />

<div class="col-md-12 styling">

<h4>Resep Obat & Tindakan Dokter (data tersimpan otomatis)</h4>
<br/>
<span><small>Pastikan nomor billing dan jenis penjamin pasien sudah diisikan</small></span>
<br/><br/>

<div class="col-md-6">
<h4>Silahkan pilih Resep Obat</h4>
		  <select id="tataup3" class="form-control" style="width: 40%;">
		  <option value="">--silakan pilih--</option>
			  <option value="produk">Resep Obat</option>
		  </select>
		  </div>
		  <div class="col-md-6">
		  <h4>Silahkan pilih Tindakan Dokter</h4>
		  <select id="tataup4" class="form-control" style="width: 40%;">
		  <option value="">--silakan pilih--</option>
			  <?php 
			  
			  $u = mysqli_query($con,"SELECT * FROM kategori_biaya");
			  while($ux = mysqli_fetch_assoc($u)){
				  echo "<option value='$ux[id]'>$ux[kategori]</option>";
			  }
			  
			  ?>
		  </select>
		  </div>
		  <br/><br/>	<br/><br/>
<form style="margin-bottom: 20px;" id="form_px2" class="collapse">
			  <input class="form-control" type="hidden" name="id_kk" value="<?php echo $_SESSION['klinik'] ?>">
			   <input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
			   <input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
			   <input type="hidden" class="form-control" name="id_dr" value="<?php echo $_SESSION['id_dr']; ?>">
			   <input type="hidden" name="modal" id="modal">
			   <input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
			   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
				   <tr>
					   <td>
						   <label>Nama Tindakan Dokter</label>
					   </td>
					   <td>
						   <label>Harga</label>
					   </td>
				   </tr>
				   <tr>
					   <td>
						   <input class="form-control" type="text" name="nama_t" id="nama_t2" style="width: 90%;" required>
					   </td>
					   <td>
						   <input class="form-control" type="text" name="harga_t" id="harga2" style="width: 90%;" readonly>
					   </td>
				   </tr>
				   <tr>
					   <td>
						   <label>Keterangan</label>
					   </td>
					   <td>
						   <label>Diskon (%) </label>
					   </td>
				   </tr>
				   <tr>
					   <td>
						   <input class="form-control" type="text" name="ket" style="width: 90%;" value="-" required>
					   </td>
					   <td>
						   <input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_t" value="0" required>
					   </td>
				   </tr>
				   <tr>
					   <td>
						   <label>Tanggal </label>
					   </td>
					   <td>
						   <label>Dokter Visit </label>
					   </td>
				   </tr>
				   <tr>
					   <td>
					   <div class="input-group">
                  <div class="input-group-addon">
                    <i class="fa fa-calendar"></i>
                  </div>
						   <input class="form-control datepicker" type="text" name="tgl_visit" style="width: 90%;" >
						   </div>
					   </td>
					   <td>
						   <select class="form-control" name="dr_visit">
						   <option value="">--silakan pilih--</option>
						   <?php $do = mysqli_query($con,"SELECT * FROM user WHERE id_ju = 'JU-02'");
							  while($doc = mysqli_fetch_assoc($do)){
								  echo "<option value='$doc[id_user]'>$doc[nama_lengkap]</option>";
							  }
							  ?>
						   <?php
while($ko = mysqli_fetch_assoc($c)){

$dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";


} ?>
</select>
					   </td>
				   </tr>
				   <tr>
					   <td>
						   <button  style="margin-top: 20px;" class="btn btn-sm btn-success">Tambah</button>
						   <button type="button" id="reset_t" style="margin-top: 20px;" class="btn btn-sm btn-danger">Reset Tabel</button>
					   </td>
				   </tr>
			   </table>
</form>
			  <form style="margin-bottom: 20px;" id="form_produk2" class="collapse">
			  
			   <input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pem['id_pasien']; ?>">
			   <input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pem['no_urut']; ?>">
			   <input type="hidden" name="kode_p" id="kode_p">
			   <input type="hidden" name="harga_b" id="harga_b">
			   <input type="hidden" name="nofak" value="<?php echo $pem['no_faktur']; ?>">
			   <table border='0' cellpadding='0' cellspacing='0' width='100%'>
				   <tr>
				   <td>
					   <label>Nama Resep Obat</label>
				   </td>
				   <td>
					   <label>Harga</label>
				   </td>
			   </tr>
			   <tr>
				   <td>
					   <input class="form-control" type="text" name="nama_p" id="nama_p2" style="width: 90%;" required>
				   </td>
				   <td>
					   <input class="form-control" type="text" name="harga_p" id="harga_p2" style="width: 90%;" readonly>
				   </td>
			   </tr>
			   <tr>
				   <td>
					   <label>Keterangan</label>
				   </td>
				   <td>
					   <label>Diskon</label>
				   </td>
			   </tr>
			   <tr>
				   <td>
					   <input class="form-control" type="text" name="ket" style="width: 90%;" value="-">
				   </td>
				   <td>
					   <input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_p" value="0">
				   </td>
			   </tr>
			   <tr>
				   <td>
					   <label>Jumlah</label>
				   </td>
			   </tr>
			   <tr>
				   <td>
					   <input class="form-control" min="1" type="number" name="jumlah" id="jumlah_p" style="width: 90%;" value="1" required>
				   </td>
				   <td>
					   <button style="margin-top: 5px;" class="btn btn-sm btn-success">Tambah</button>
					   <button type="button" style="margin-top: 5px;" class="btn btn-sm btn-danger" id="reset_t">Reset Tabel</button>
				   </td>
			   </tr>
			   </table>
		   </form>
<div class="table-responsive">
  <table class="table table-bordered table-striped" width="100%" id="tabel_tp2">
	  <thead>
		  <th>No</th>
		  <th>Nama</th>
		  <th>Jumlah Beli</th>
		  <th>Harga</th>
		  <th>Jenis</th>
		  <th>Ket</th>
		  <th>Pilihan</th>
	  </thead>
	  <tbody>
	  </tbody>
  </table>
</div>
			  <!-- inap obat --> 
			  </div> <!-- tab pane -->
			  </div> <!-- tab content -->
			  </div> <!-- nav-tabs-custom -->
			  </div> <!-- col-md-6 -->
			  </div> <!-- row -->

<!-- input tab --> 



					 <script>
</script>


						<!------------------------------------------>
					 </div>
<!-- form inap -->

					</div>
				</div>
			</div>
		</div>
	</div>
</section>


<script>




	$(document).ready(function(){

		
  // Tambah Perawatan
  $('#form_px2').on('submit', function (e) {

e.preventDefault();

$.ajax({
  type: 'post',
  url: 'modul/mod_kasir_lama/tambah_t.php?nofak=' + $("#nofak2").val(),
  data: $('#form_px2').serialize(),
  success: function (data) {
	if (data=="ada") {
	  alert("Tindakan Dokter Sudah Ada");
	}else{
	  var ttable = $('#tabel_tp2').dataTable();
	  $("#cegahsimpan2").val("0");
	  ttable.fnDraw(false);
	   $('#form_px2').trigger("reset");
	}
  }
});

});
// Tambah Resep Obat
$('#form_produk2').on('submit', function (e) {

e.preventDefault();

$.ajax({
  type: 'post',
  url: 'modul/mod_kasir_lama/tambah_p.php?nofak=' + $("#nofak2").val(),
  data: $('#form_produk2').serialize(),
  success: function () {
	var oTable = $('#tabel_tp2').dataTable(); 
	oTable.fnDraw(false);
	$('#form_produk2').trigger("reset");
	$("#cegahsimpan2").val("0");
	}
});
});

  // Tambah Perawatan
     $('#form_px').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir_lama/tambah_t.php?nofak=' + $("#nofak").val(),
            data: $('#form_px').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Tindakan Dokter Sudah Ada");
              }else{
				var ttable = $('#tabel_tp').dataTable();
				$("#cegahsimpan").val("0");
                ttable.fnDraw(false);
                 $('#form_px').trigger("reset");
              }
            }
          });

        });
     // Tambah Resep Obat
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir_lama/tambah_p.php?nofak=' + $("#nofak").val(),
            data: $('#form_produk').serialize(),
            success: function () {
              var oTable = $('#tabel_tp').dataTable(); 
              oTable.fnDraw(false);
			  $('#form_produk').trigger("reset");
			  $("#cegahsimpan").val("0");
          	}
          });
        });
     // plus
  $('body').on("click","#plus_p",function(){

          var id = $(this).data("id");

          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/plus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

  // Hapus Perawatan
     $('body').on("click","#hapus_p",function(){

          var id = $(this).data("id");


          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/hapus.php',
              data:{
                id:id
              },
              success:function(data){
                  alert("Berhasil dihapus");
				  var ttable = $('#tabel_tp').dataTable();
				  if(ttable.length == 1){ $("#cegahsimpan").val(""); }
				  ttable.fnDraw(false);
				
              }
          });
     });
     // Minus Resep Obat
     $('body').on("click","#minus_p",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/minus.php',
              data:{
                id:id
              },
              success:function(data){
                  var oTable = $('#tabel_tp').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

});
</script>


<script>


function chgdata(){
	
}


$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  // cari pelanggan
  	// berdasarrkan nama
     $( "#nama_k" ).autocomplete({
      source: function( request, response ) {
      	var cara = $("#cara2").val();
       // Fetch data
       $.ajax({
        url: "modul/mod_kasir/source_p.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,cara:cara
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#nama_k').val(ui.item.label);
       $('#alamat_k').val(ui.item.alamat);
       $('#tgl_k').val(ui.item.tgl_lahir);
       $('#umur_k').val(ui.item.umur);
       $('#nohp_k').val(ui.item.no_telp);
       $('#jk_k').val(ui.item.jk);
       $("#nama_hidden").val(ui.item.id);
       tampilkan();
       return false;
      }
     });
     // Enter 
     $("#nama_k").keyup(function(event) {
	    if (event.keyCode === 13) {
	        $("#nama_hidden").val("");
	    }
	}); 

  // tampilkan
  $(' #form_tam').on('submit', function (e) {
          e.preventDefault();
          $("#nama_hidden").val("");
          tampilkan();
        });
  // fungsi tampilkan
  function tampilkan(){
  	var awal = $("#awal").val();
  	$.ajax({
            type: 'post',
            url: 'modul/mod_kasir/tampilkan.php',
            data: $('#form_tam').serialize(),
            success: function (data) {
            	if (data=="Kosong") {
            		alert("Pasien Tidak Ditemukan");
            	}else{
            		var obj = JSON.parse(data);
            		 $('#form_tam').trigger("reset");
            		 $('#form_p').collapse('hide');
            		 $("#data_id").html(obj.nid);
            		 $("#data_n").html(obj.np);
		             $("#nama_kk").val(obj.id);
		             $("#nama_kon").val(obj.id);
		             $("#data_tk").html(obj.tk);
		             $("#data_jk").html(obj.jk);
		             $("#data_tl").html(obj.tl);
		             $("#data_a").html(obj.a);
		             $("#data_nt").html(obj.nt);
		           //  $("#diskon_t").val(obj.dtr);
		          //   $("#diskon_p").val(obj.dpr);
					 $(".id_pasien").val(obj.id);
					 $("#data_katmem").html(obj.klas);
					 
/////////////////////////////////////////////////////////////////////


var pasien = $(".id_pasien").val();
var nofak = $("#nofak").val();
  // datatable
 var j = $('#tabel_tp').dataTable( {
	 "bPaginate": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/mod_kasir_lama/data_tp.php?nofak="+nofak+"&pasien="+pasien,
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
          var a = '<button id="hapus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          var b = '<button id="minus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>';
		  var c = '<button id="plus_p" data-id="'+data+'" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
		  var d = '<button class="btn btn-xs btn-success">Lunas</button>';
	          if(row[5]=="Lunas"){
		          return d;
	          }else if(row[4]=="Resep Obat") {
	          	  return a+' '+b+' '+c;
	          } else{
	          	  return a;
	          }
          
          }
        }
      ]
    } );

if(j.length >= 1){ $("#cegahsimpan").val("0"); } else {}

	//------------------------------------------------------------------------//

	var nofak2 = $("#nofak2").val();
	// datatable
	var j2 = $('#tabel_tp2').dataTable( {
		"bPaginate": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/mod_kasir_lama/data_tp2.php?nofak="+nofak2+"&pasien="+pasien,
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
          var a = '<button id="hapus_p2" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          var b = '<button id="minus_p2" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>';
		  var c = '<button id="plus_p2" data-id="'+data+'" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
		  var d = '<button class="btn btn-xs btn-success">Lunas</button>';
	          if(row[5]=="Lunas"){
		          return d;
	          }else if(row[4]=="Resep Obat") {
	          	  return a+' '+b+' '+c;
	          } else{
	          	  return a;
	          }
          
          }
        }
      ]
    } );
console.log(j2.length);
if(j2.length >= 1){ $("#cegahsimpan2").val("0"); } else {}

////////////////////////////////////////////////////////////////////


		             $("#cek_tampil").val("Sudah");
            		 if (awal=="lab") {
            		 	$('#pilih_dok').collapse('hide');
			            $(' #form_tam').collapse('hide');
			            $('#labs').collapse('show');
			            $('#form_k').collapse('show');
			            $('#tap').collapse('hide');
            		 }  else if(awal=="bpt"){
						$('#form_k').collapse('show');
						$('#tap').collapse('show');
            		 	$('#pilih_dok').collapse('hide');
            		 	$(' #form_tam').collapse('hide');
					 } else if(awal=="inap"){
						$('#form_k').collapse('show');
						$('#tap').collapse('hide');
						 $('#pilih_dok').collapse('hide');
						 $('#labs').collapse('hide');
						 $('#mondok').collapse('show');
            		 	$(' #form_tam').collapse('hide');
					 }
						 else {
            		 	$('#form_k').collapse('show');
            		 	$('#pilih_dok').collapse('show');
            		 	$(' #form_tam').collapse('hide');
					 }
            	}                        
            }
          });
  } 




  // Batal
  $(".data_batal").click(function(e){
  	  e.preventDefault();
  	  $.ajax({
          url: 'modul/mod_kasir/batal.php',
          success:function(data){
           	  $('#cekbok').collapse('hide');
			  $("#cek_tampil").val("");
			  $('#tap').collapse('hide');
			  $('#form_k').collapse('hide');
			  $('#form_tam').collapse('show');
			  $('#form_tam').trigger("reset");
          }
        });
});
  // plus
  $('body').on("click","#plus_kasir",function(){

          var id = $(this).data("id");

          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/plus.php',
              data:{
                id:id
              },
              success:function(data){
              	total();
                  var oTable = $('#tabel_kasir').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });

  // Hapus Perawatan
     $('body').on("click","#hapus_kasir",function(){

          var id = $(this).data("id");


          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/hapus.php',
              data:{
                id:id
              },
              success:function(data){
              	total();
                  var ttable = $('#tabel_kasir').dataTable();
                  ttable.fnDraw(false);
              }
          });
     });
     // Reset
     $("#reset_t").click(function(){
        $.ajax({
          url: 'modul/mod_kasir/reset_t.php',
          success:function(){
          	total();
            var oTable = $('#tabel_kasir').dataTable(); 
            oTable.fnDraw(false);
          }
        });
     });
     // Minus Produk
     $('body').on("click","#minus_kasir",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/mod_kasir_lama/minus.php',
              data:{
                id:id
              },
              success:function(data){
              	 total();
                  var oTable = $('#tabel_kasir').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
     // Tambah Pendaftaran
     $('#form_p').on('submit', function (e) {

		  e.preventDefault();
		  
		  var cek = $("#cegahsimpan").val();

		  if(cek == ""){
			alert("data tagihan obat/dokter belum lengkap");
		  } else {
			$.ajax({
            type: 'post',
            url: 'modul/mod_kasir_lama/tambah_p2.php?nofak=' + $("#nofak").val(),
            data: $('#form_p').serialize(),
            success: function (data) {
             if(data == "error"){} else {
				location.reload();
			 }
            }
          });
		  }

        

		});
		 // Tambah Rawat Inap
		 $('#form_j').on('submit', function (e) {

e.preventDefault();

$.ajax({
  type: 'post',
  url: 'modul/mod_kasir_lama/tambah_j.php?nofak=' + $("#nofak2").val(),
  data: $('#form_j').serialize(),
  success: function (data) {
   if(data == "error"){} else {
	   location.reload();
   }
  }
});

});
 // Tambah IGD
 $('#form_u').on('submit', function (e) {

e.preventDefault();

$.ajax({
  type: 'post',
  url: 'modul/mod_kasir_lama/tambah_u.php',
  data: $('#form_u').serialize(),
  success: function (data) {
   if(data == "error"){} else {
	   location.reload();
   }
  }
});

});
 // Tambah Lab
 $('#form_z').on('submit', function (e) {

e.preventDefault();

$.ajax({
  type: 'post',
  url: 'modul/mod_kasir_lama/tambah_z.php',
  data: $('#form_z').serialize(),
  success: function (data) {
   if(data == "error"){} else {
	   location.reload();
   }
  }
});

}); /*
     // Tambah Produk
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/mod_kasir_lama/tambah_produk.php',
            data: $('#form_produk').serialize(),
            success: function (data) {
              if (data=='tidak') {
              	  alert("produk tidak ada di gudang");
              }else{
              	  total();
	              var oTable = $('#tabel_kasir').dataTable(); 
	              oTable.fnDraw(false);
	              $('#form_produk').trigger("reset");
              }
              
            }
          });
        }); */
     // no rek
     // Onchange tunai or kredit
  $("#metode").change(function(){
  	  var select = $(this).val();
	  if(select=="Tunai"){
	    $('#no_rek').collapse('hide');
	    $('#uang_tu').collapse('show');
	    $('#uang_tr').collapse('hide');
	  }else if(select=="Transfer"){
	    $('#no_rek').collapse('show');
	    $('#uang_tr').collapse('show');
	    $('#uang_tu').collapse('hide');
	  }else{
	  	$('#no_rek').collapse('show');
	  	$('#uang_tu').collapse('show');
	  	$('#uang_tr').collapse('show');
	  }
});
  // Kembalian
     $('#uang_k').on('input',function(){
            kembalians();
         });
     $('#uang_t').on('input',function(){
            kembalians();
         });
     $('#ongkir').on('change',function(){
     		total();
            kembalians();
         });
     // fungsi kembalian
     function kembalians(){  /*
     
     var uang = parseFloat($("#uang_k").val());
     	var uang_tr = parseFloat($("#uang_t").val());
		var tots  = $("#total").val();
		var tot = parseFloat(tots.replace(/[A-Za-z\.,-]/gi,""));
		if(uang >= tot || uang_tr >= tot){
			$.ajax({
              type:"post",
              url:"modul/mod_kasir_lama/kembalian.php?v=<?php echo rand(1000,9000); ?>",
              data:{
                uang:uang,
                tot:tot,
                uang_tr:uang_tr
              },
              success:function(data){
                $('#kembalian').val(data);
              }
            });
		}
     
     
     /*
     	var uang = $("#uang_k").val();
     	var uang_tr = $("#uang_t").val();
        var tot  = $("#total").val();
            $.ajax({
              type:"post",
              url:"modul/mod_kasir_lama/kembalian.php",
              data:{
                uang:uang,
                tot:tot,
                uang_tr:uang_tr
              },
              success:function(data){
                $('#kembalian').val(data);
              }
            });
    */ }
     // tambah
     $('#form_kasir').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/mod_kasir/tambah_k.php',
            data: $('#form_kasir').serialize(),
            success: function (data) {
              if (data=="Yes") {
              	$('#form_kasir').trigger("reset");
                alert("Berhasil menambahkan pasien ke dalam antrian");
                window.location.href = "media.php?module=home";
              }else if(data=="No"){
                alert("Tidak ada perawatan atau Produk yang dipilih!\nSilahkan pilih produk atau perawatan terlebih dahulu!!");
              }else if(data=="D"){
                alert("Silahkan Pilih Dokter Terlebih Dahulu!!");
              }else if(data=="kurang"){
                alert("Uang Yang Dimasukan Kurang!!");
              }else if(data=="nama"){
                alert("Silahkan Masukan Nama Pasien Terlebih Dahulu!!");
              }else if(data=="pasien"){
                alert("Nama Pasien Belum Terdaftar! Silahkan Daftarkan Pasien Terlebih Dahulu");
              }else{
              	//alert("Transaksi Berhasil!");
             	$('#form_kasir').trigger("reset");
             	 window.open("modul/mod_kasir/print_kasir.php?nofak="+data,"_BLANK","modal=yes,alwaysRaised=yes");
              	 //location.reload();
              //	window.location.href = "media.php?module=history_transaksi";
              }	
            }
          });

        });
     // cara cari pelanggan
     $('#radio1').click(function () {
        if (this.checked) {
	     	$("#cara2").val("nama");
        }
    });

    $('#radio2').click(function () {
        if (this.checked) {
	        $("#cara2").val("kode");
        }
    });

    $('#radio3').click(function () {
        if (this.checked) {
	        $("#cara2").val("tanggal");
        }
    });
  //total
  function total(){
  	var ongkir = $("#ongkir").val();
  	$.ajax({
  		type: "POST",
  		data:{
  			ongkir:ongkir
  		},
  		url: 'modul/mod_kasir/total.php?pasien=' + $("#nama_kon").val(),
  		success:function(data){
  			var obj = JSON.parse(data);
  			$("#table_total").html(obj.rupiah1);
  			$("#total").val(obj.rupiah)
  			kembalians();
  			var oTable = $('#tabel_kasir').dataTable(); 
            oTable.fnDraw(false);
  		}
  	});
  }
  // collap form produk
  $('#form_tam').on('show.bs.collapse', function () {
  		$("#uang_tu").collapse("show");
	});
  // onload
  window.onload=total();
 /* // before unload
  window.onbeforeunload = function (){
  	$.ajax({
		  url: 'modul/mod_k */
	  });	  
</script>