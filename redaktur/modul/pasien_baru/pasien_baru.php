<?php 


$c = mysqli_query($con,"SELECT id_pasien FROM pasien WHERE id_kk = '$_SESSION[klinik]'");
$d = '[';
while($cu = mysqli_fetch_assoc($c)){
    $dt .= '{"id":"'.$cu['id_pasien'].'"},';
}
$dt = substr($dt,0,strlen($dt) - 1);
$d .= $dt.']';

file_put_contents("../redaktur/modul/pasien_baru/cust.json",$d);

?>
<section class="content">
	
	<div class="row">
	<div class="col-md-12">
	<div class="callout callout-success">
	<strong>PERHATIAN</strong>
	<ul>
	<li>Format Rekam Medis adalah {inisial nama pasien}{nomor urut}{kode nama klinik} misalnya: A999B </li>
	<li>Kode nama klinik muncul otomatis</li>
	<li>Rekam Medis yang sama dengan yang sudah ada akan muncul peringatan</li>
	</ul>
	</div>
	</div>
	</div>
	
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
						$klinik = inisial($p['nama_klinik']);
						$ini = substr($klinik,0,strlen($klinik) - 1);
						?>
						<label>Rekam Medis</label>



						<input type="text" id="acs" name="id_pasien" class="form-control" value="<?php echo $ini; ?>">




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

<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/typeahead.css">
<script src="<?php echo $url2; ?>bower_components/typeahead.bundle.min.js"></script>
<script src="<?php echo $url2; ?>bower_components/hb.js"></script>

<script>
//typeahead
        
var namaCus = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('id'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/pasien_baru/cust.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


$('#acs').typeahead({
    hint: true,
  highlight: true,
  minLength: 3
}, {
  name: 'nama-cus',
  display: 'id',
  source: namaCus,
  templates: {
	suggestion: Handlebars.compile('<div><strong>Rekam Medis sudah ada. Silakan gunakan nomor urut lainnya</strong></div>')
  }
} );
 

</script>