<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Data Pasien Baru</h3>
		</div>
		<div class="box-body">
			<form id="form_pp">
				<div class="row">
					<div class="col-md-6">
						<?php 
						$id_kk = $_SESSION['klinik'];
						$q = mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'");
						$p = mysqli_fetch_array($q);
						$ini = inisial($p['nama_klinik']);
						?>
						<label>Rekam Medis</label>
						<input type="text" name="id_pasien" class="form-control" value="<?php echo $ini; ?>">
						<label>Nama</label>
						<input class="form-control" type="text" name="nama" style="width: 100%;" required >
						<label>Tanggal Lahir</label>
						<input id="tgl_ks" class="form-control" type="text" name="tgl_lahir" style="width: 100%;" required>
						<label>Jenis Kelamin</label>
						<select class="form-control" name="jk">
						    <option value="Perempuan">Perempuan</option>
							<option value="Laki-laki">Laki-laki</option>
						</select>

						<button style="margin-top: 5px;" id="tambah_pb" class="btn btn-primary">Tambah Data Pasien</button>	
						<input style="margin-top: 5px;" type="button" class="btn btn-danger" onclick="this.form.reset();" value="Reset Form">
					</div>
					<div class="col-md-6">
					    <label>Nomor Handphone</label>
						<input class="form-control" type="text" name="nohp" style="width: 100%;" required>
						<label>Umur</label>
						<input class="form-control" type="number" name="umur" style="width: 100%;" required>
						<label>Alamat</label>
						<input class="form-control" type="text" name="alamat" style="width: 100%;" required></input>
						<label>Pekerjaan</label>
						<input type="text" name="pekerjaan" class="form-control"><br>
					</div>
				</div>
			</form>
		</div>
	</div>
</section>