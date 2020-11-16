  <!-- Main content -->
  <section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Bayar Obat</h3>
		</div>
    <div class="box-body">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
        <?php 
        
		$id = $_GET['faktur'];
		
		if($_GET['layan'] == "jalan"){
			$pem = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE history_ap.no_faktur='$id'"));
		} else {
			$pem = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM antrian_pasien JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.no_faktur='$id'"));
		}

               
           
				$id_pasien = $pem['id_pasien'];
				$mem = mysqli_fetch_assoc(mysqli_query($con,"SELECT a.* FROM kategori_pelanggan a JOIN pasien b ON a.kategori = b.klaster WHERE b.id_pasien = '$id_pasien'"));
				?>



				<div class="row">
					<div class="col-md-6">
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama 
							</div>
							<div class="col-md-6" id="data_n">
								: <?php echo $pem['nama_pasien']; ?>
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No Telp
							</div>
							<div class="col-md-6" id="data_nt">
								: <?php echo $pem['no_telp']; ?>	 
							</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Alamat
								</div>
								<div class="col-md-6" id="data_a">
								: <?php echo $pem['alamat']; ?>	 
								</div>
						</div>
					</div>
					<div class="col-md-6">
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Tanggal Lahir
								</div>
								<div class="col-md-6" id="data_tl">
								: <?php echo $pem['tgl_lahir']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Pekerjaan
								</div>
								<div class="col-md-6" id="data_jk">
								: <?php echo $pem['pekerjaan']; ?>
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Total Kunjungan
								</div>
								<div class="col-md-6" id="data_tk">
								: <?php echo $pem['total_kunjungan']; ?>				 
								</div>
							</div>
							<div class="row" style="margin-bottom: 10px;">
								<div class="col-md-3">
									Jenis Member
								</div>
								<div class="col-md-6" id="data_tk">
								: <?php echo $mem['kategori']; ?>				 
								</div>
							</div>
					</div>
<?php 

if($_GET['layan'] == "jalan"){

$rz = json_decode($_GET['data'],true);

//id yg dibeli penuh

$byrp = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(sub_total) jml FROM kasir_sementara WHERE no_faktur = '$_GET[faktur]' AND id IN ($rz[full])"));

//id yg dibeli setengah

$byrs = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(0.5 * sub_total) jml FROM kasir_sementara WHERE no_faktur = '$_GET[faktur]' AND id IN ($rz[half])"));

$byr = array("jml" => ($byrp['jml'] + $byrs['jml']));


} else {
$byr = mysqli_fetch_assoc(mysqli_query($con,"SELECT SUM(sub_total) jml FROM history_kasir WHERE no_faktur = '$_GET[faktur]'"));
}


?>

<table class="table">
<tr>
<td>Tagihan</td>
<td>Rp <?php echo number_format($byr['jml'],0,",","."); ?></td>
</tr>
<tr>
<td>Pembayaran
<br/><small>Tekan tombol TAB di keyboard untuk melanjutkan</small>
</td>
<td><input type="text" style="width: 25%" class="form-control" name="bayar" onblur="hitung()" id="bayar" data-bayar="<?php echo $byr['jml']; ?>"/></td>
</tr>
<tr>
<td>Kembalian</td>
<td><span id="sisa"></span></td>
</tr>
<tr>
<td colspan=2><button class="btn btn-info" id="selesai" disabled onclick="simpan()">Selesai</button></td>
</tr>
</table>
<script>
$(document).ready(function(){
  document.getElementById("bayar").focus();
});

function simpan(){
	window.open("modul/mod_kasir_apotek/bayar.php?faktur=<?php echo $_GET['faktur']; ?>&uang=" + $("#bayar").val() + "&data=<?php echo urlencode($_GET['data']); ?>&layan=<?php echo $_GET['layan']; ?>&pasien=<?php echo $id_pasien; ?>","_BLANK");
}

function hitung(){
 
  var a = parseInt($("#bayar").data("bayar"));
  var b = parseInt($("#bayar").val());

    var c = b - a;
    $("#sisa").html(c);
  
    if(b >= a){
     $("#selesai").attr("disabled",false);
    } else {
      $("#selesai").attr("disabled",true);
    }


}
</script>


				</div>
			</div>
    </div>
    </section>