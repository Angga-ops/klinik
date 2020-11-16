<?php 
$act = $_GET['act']; 
$id_kk = $_SESSION['klinik'];
?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h4 class="box-title">History Transaksi</h4>
		</div>
		<div class="box-body">
			<?php
				switch ($act) {
				case 'detail': ?>
				<!-- Start Detail -->
				<?php 
					$tgl = $_GET['tgl'];
					$nu = $_GET['nu'];
					$no_faktur = $_GET['nofak'];
					$p = mysqli_query($con, "SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE history_ap.no_faktur='$no_faktur'");
					if(mysqli_num_rows($p) > 0){
						$pas = mysqli_fetch_array($p);
					} else {
						$pas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE perawatan_pasien.no_faktur='$no_faktur'"));
						
					}
 					
 					// Total
					 $qhk = mysqli_query($con, "SELECT SUM(harga*jumlah) AS total FROM history_kasir WHERE no_faktur='$no_faktur'");
					 
					
 					while($hk  = mysqli_fetch_array($qhk)){
 							$total += $hk['total'];
 					}
 					
 					// End
 					$kk = mysqli_query($con, "SELECT *FROM pembayaran WHERE no_faktur='$pas[no_faktur]'");
 					$k = mysqli_fetch_array($kk);
 					$no_faktur = $k['no_faktur'];
				 ?>
				<div class="row">
				<div class="col-md-6">
				    <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
					<table class="table">
						<tbody>
								<tr>
									<td><label>Nomor Faktur</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['no_faktur']; ?>"></td>
								</tr>
								<tr>
									<td><label>Nama</label></td>
									<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
								</tr>
								<tr>
									<td><label>No Antrian</label></td>
									<td><input class="form-control" type="text" name="no_urut" readonly value="<?php echo $pas['no_urut']; ?>"></td>
								</tr>
								<?php if ($pas['pembayaran']=="Lunas" || $k["status"] == "Lunas") { ?>
								<tr>
									<td><label>Total Yang Harus Di Bayar</label></td>
									<td><input class="form-control" type="text" name="total" readonly value="<?php echo rupiah($k['total']); ?>"></td>
								</tr>
								<tr>
									<td><label>Kembalian</label></td>
									<td><input class="form-control" type="text" name="kembalian" value="<?php echo rupiah($k['kembalian']); ?>" readonly></td>
								</tr>
								<tr>
									<td><label>Ongkir</label></td>
									<td><input class="form-control" type="text" name="kembalian" value="<?php echo rupiah($k['ongkir']); ?>" readonly></td>
								</tr>
								<?php } ?>
								<tr>
									<td>
										<button type="submit" onclick="window.history.back()" class="btn btn-success btn-sm">Kembali</button>
									</td>
								</tr>
						</tbody>
					</table>
				</div>
				<div class="col-md-6">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal Pendaftaran</label></td>
								<td><input class="form-control" type="text" name="tgl" readonly value="<?php echo $pas['tanggal_pendaftaran']; ?>"></td>
							</tr>
							<tr>
								<td><label>Kunjungan Ke</label></td>
								<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['kunjungan_ke']; ?>"></td>
							</tr>
							<tr>
								<td><label>Status Pembayaran</label></td>
								<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['pembayaran']; ?>"></td>
							</tr>
							<?php if($pas['pembayaran']=="Lunas"){ ?>
							<tr>
								<td><label>Uang Tunai</label></td>
								<td><input class="form-control" type="text" name="uang" value="<?php echo rupiah($k['uang']); ?>" readonly></td>
							</tr>
							<tr>
								<td><label>Uang Transfer</label></td>
								<td><input class="form-control" type="text" name="uang" value="<?php echo rupiah($k['uang_transfer']); ?>" readonly></td>
							</tr>
							<?php } ?>
							<tr>
									<td>
										<div class="checkbox">
										<label>
										<input <?php if ($pas["konsultasi"]=="Yes"): ?>
												checked="TRUE"								
										<?php endif ?> type="checkbox" name="konsultasi" value="Yes">
												Konsultasi</label>
										</div>
									</td>
								</tr>
						</tbody>
					</table>
					</div>
					</div>
					<hr>
					<h4>Daftar Treatment atau Produk Yang Dibeli</h4>
					<div class="table-responsive">
				<table class="table table-bordered table-bordered datatable">
					<thead>
						<tr>
							<th>Nama</th>
							<th>Jenis</th>
							<th>Ket</th>
							<th>Jumlah Beli</th>
							<th>Harga</th>
							<th>Diskon (%)</th>
							<th>Sub Total</th>
						</tr>
					</thead>
					<tbody>
						<?php $qhk =  mysqli_query($con, "SELECT *FROM history_kasir WHERE no_faktur='$no_faktur'"); 
						while($hk=mysqli_fetch_array($qhk)){ ?>
						<tr>
							<td><?php echo $hk['nama']; ?></td>
							<td><?php echo $hk['jenis']; ?></td>
							<td><?php echo $hk['ket']; ?></td>
							<td><?php echo $hk['jumlah']; ?></td>
							<td><?php echo rupiah($hk['harga']); ?></td>
							<td><?php echo $hk['diskon']; ?></td>
							<td><?php echo rupiah($hk['sub_total']); ?></td>
						</tr>	
						<?php
						}
						?>
						
					</tbody>
					<tfoot>
						<tr>
							<td colspan="6"><b>TOTAL</b></td>
							<td><b>Rp <?php echo number_format($total); ?><b></td>
						</tr>
					</tfoot>
				</table>
			</div>
				</div>
			</div>
			
			<!-- End Detail -->
				<?php	break;

				case 'bayar':
				// Start Bayar
					$tgl = $_GET['tgl'];
					$nu = $_GET['nu'];
					$no_faktur = $_GET['nofak'];
					$p = mysqli_query($con, "SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE no_faktur='$no_faktur'");
					 
					 
					if(mysqli_num_rows($p) > 0){
						$pas = mysqli_fetch_array($p);
					} else {
						$pas = mysqli_fetch_array(mysqli_query($con, "SELECT * FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE perawatan_pasien.no_faktur='$no_faktur'"));
						
					}
 					// Total
 					$qt = mysqli_query($con, "SELECT *,SUM(jumlah*harga) AS total FROM history_kasir WHERE no_faktur='$no_faktur' AND status='Belum Lunas'");
 					while($tot = mysqli_fetch_array($qt)){
 						$totalp += $tot['total'];
 					}
 					$qp = mysqli_query($con, "SELECT *FROM pembayaran WHERE no_faktur='$no_faktur'");
 					$pem = mysqli_fetch_array($qp);
 					$total = $totalp; 
 					$id_kk = $_SESSION['klinik']; 
 					// End 
				 ?>
				<div class="row">
					<form id="form_bayar">
						<input type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
						<div class="col-md-6">
							<table class="table">
								<tbody>
										<tr>
											<td><label>No.Faktur</label></td>
											<td><input class="form-control" type="number" id="id_nofak" name="nofak" value="<?php echo $_GET['nofak']; ?>" readonly></td>
										</tr>
										<tr>
											<td><label>Nama</label></td>
											<td><input class="form-control" type="text" name="nama" readonly value="<?php echo $pas['nama_pasien']; ?>"></td>
										</tr>
										<tr>
											<td><label>No Antrian</label></td>
											<td><input id="nourut_ht" class="form-control" type="text" name="no_urut" readonly value="<?php echo $pas['no_urut']; ?>"></td>
										</tr>
										<tr>
											<td><label>Total Yang Harus Di Bayar</label></td>
											<td><input class="form-control" type="text" name="total" id="total_t" readonly></td>
										</tr>
										<tr>
											<td><label>Kembalian</label></td>
											<td><input class="form-control" type="text" name="kembalian" id="kembalian" readonly></td>
										</tr>
										<tr id="rekening" class="collapse">
										<td><label>No.Rek</label></td>
										<td>
											<select class="form-control" name="no_rek">
												<?php $qr = mysqli_query($con, "SELECT *FROM rekening"); 
													while ($r=mysqli_fetch_array($qr)) { ?>
														<option value="<?php echo $r['id_rekening']; ?>"><?php echo $r["nama_bank"]." | ".$r["no_rek"]; ?></option>
												<?php
													}
												?>
											</select>
										</td>
									</tr>
										<tr>
											<td>
												<a href="#" onclick="window.history.back()" class="btn btn-primary btn-sm">Kembali</a>
												<button id="btn_bayar" type="submit" class="btn btn-success btn-sm">Bayar</button>
											</td>
										</tr>
								</tbody>
							</table>
						</div>
						<div class="col-md-6">
							<table class="table">
								<tbody>
									<tr>
										<td><label>Tanggal Perawatan</label></td>
										<td><input class="form-control" type="text" id="tgl_ht" name="tgl" readonly value="<?php echo $pas['tanggal_pendaftaran']; ?>"></td>
									</tr>
									<tr>
										<td><label>Status Pembayaran</label></td>
										<td><input class="form-control" type="text" name="status" readonly value="<?php echo $pas['pembayaran']; ?>"></td>
									</tr>
									<tr id="tr_uang_tu" class="collapse">
										<td><label>Uang Tunai</label></td>
										<td><input class="form-control" type="text" id="uang_ht" name="uang"></td>
									</tr>
									<tr id="tr_uang_tr" class="collapse">
										<td><label>Uang Transfer</label></td>
										<td><input class="form-control" type="text" id="uang_tr" name="uang_tr"></td>
									</tr>
									<tr>
										<td><label>Uang Ongkir</label></td>
										<td><input class="form-control" id="ongkir" type="text"  name="ongkir" placeholder="Kosongkan jika tidak ada ongkir"></td>
									</tr>
									<tr>
										<td><label>Metode Pembayaran</label></td>
											<td>
												<select name="metode" class="form-control" id="metode">
													<option value="Tunai">Tunai</option>
													<option value="Transfer">Transfer</option>
													<option value="Tunai dan Transfer">Tunai dan Transfer</option>
												</select>
											</td>
										</tr>
									<tr>
										<td>
												<div class="checkbox">
												<label>
												<input <?php if ($pas["konsultasi"]=="Yes"): ?>
														checked="TRUE"								
												<?php endif ?> type="checkbox" name="konsultasi" value="Yes">
												Konsultasi</label>
											</div>
										</td>
									</tr>
								</tbody>
							</table>
						</div>
				</form>
			</div>
			<hr style="margin-top: 0; opacity: 0.5;">
			<div class="col-md-12">

<h4>Biaya Lainnya (data tersimpan otomatis)</h4>
			
		<!--	<div class="col-md-6"> 
			<h4>Silahkan pilih Resep Obat</h4>
						<select id="tataup" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<option value="produk">Resep Obat</option>
						</select> 
						</div> -->
						<div class="col-md-6">
						<h4>Silahkan pilih Biaya Lainnya</h4>
						<select id="tataup2" class="form-control" style="width: 40%;">
						<option value="">--silakan pilih--</option>
							<?php 
							
							$u = mysqli_query($con, "SELECT * FROM kategori_biaya WHERE id NOT IN (1,2)");
							while($ux = mysqli_fetch_assoc($u)){
								echo "<option value='$ux[id]'>$ux[kategori]</option>";
							}
							
							?>
						</select>
						</div>
						<br/><br/>	<br/><br/>
						
<form style="margin-bottom: 20px;" id="form_px" class="collapse">
							<input class="form-control" type="hidden" name="id_kk" value="<?php echo $_SESSION['klinik'] ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pas['no_urut']; ?>">
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
					 		<input type="hidden" class="form-control" name="id_dr" value="<?php echo $_SESSION['id_dr']; ?>">
					 		<input type="hidden" name="modal" id="modal">
					 		<input type="hidden" name="nofak" value="<?php echo $_GET['nofak']; ?>">
							 <input type="hidden" name="jasa" value="1">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
						 			<td>
						 				<label>Nama Biaya</label>
						 			</td>
						 			<td>
						 				<label>Harga</label>
						 			</td>
									 <td>
					 					<label>Keterangan</label>
					 				</td>
					 				<td>
					 					<label>Diskon (%) </label>
					 				</td>
									 <td>
					 					<label>Tanggal </label>
					 				</td>
					 				<td>
					 					<label>Dokter Visit </label>
					 				</td>
					 			</tr>
					 			<tr>
					 				<td>
					 					<input class="form-control" type="text" name="nama_t" id="nama_t" style="width: 90%;" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="text" name="harga_t" id="harga" style="width: 90%;" readonly>
					 				</td>
					 			
					 				<td>
					 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-" required>
					 				</td>
					 				<td>
					 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_t" value="0" required>
					 				</td>
					 		
					 				<td>
					 					<input class="form-control datepicker" type="text" name="tgl_visit" style="width: 90%;" >
					 				</td>
					 				<td>
					 					<select class="form-control" name="dr_visit">
										 <option value="">--silakan pilih--</option>
										 <?php $do = mysqli_query($con, "SELECT * FROM user WHERE id_ju = 'JU-02'");
											while($doc = mysqli_fetch_assoc($do)){
												echo "<option value='$doc[id_user]'>$doc[nama_lengkap]</option>";
											}
											?>
										
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
							
					 		<input class="form-control id_pasien" type="hidden" name="id_pasien" value="<?php echo $pas['id_pasien']; ?>">
					 		<input class="form-control" type="hidden" id="nou" name="no_urut" value="<?php echo $pas['no_urut']; ?>">
					 		<input type="hidden" name="kode_p" id="kode_p">
				 			<input type="hidden" name="harga_b" id="harga_b">
				 			<input type="hidden" name="nofak" value="<?php echo $_GET['nofak']; ?>">
					 		<table border='0' cellpadding='0' cellspacing='0' width='100%'>
					 			<tr>
					 			<td>
					 				<label>Nama Resep Obat</label>
					 			</td>
					 			<td>
					 				<label>Harga</label>
					 			</td>
								 <td>
					 				<label>Keterangan</label>
					 			</td>
					 			<td>
					 				<label>Diskon</label>
					 			</td>
								 <td>
				 					<label>Jumlah</label>
				 				</td>
				 			</tr>
				 			<tr>
				 				<td>
				 					<input class="form-control" type="text" name="nama_p" id="nama_p" style="width: 90%;" required>
				 				</td>
				 				<td>
				 					<input class="form-control" type="text" name="harga_p" id="harga_p" style="width: 90%;" readonly>
				 				</td>
				 			
				 				<td>
				 					<input class="form-control" type="text" name="ket" style="width: 90%;" value="-">
				 				</td>
				 				<td>
				 					<input class="form-control" type="number" name="dis" style="width: 90%;" id="diskon_p" value="0">
				 				</td>
				 			
				 				<td>
				 					<input class="form-control" min="1" type="number" name="jumlah" id="jumlah_p" style="width: 90%;" value="1" required>
				 				</td></tr><tr>
				 				<td>
				 					<button style="margin-top: 15px;" class="btn btn-sm btn-success">Tambah</button>
				 					<button type="button" style="margin-top: 15px;" class="btn btn-sm btn-danger" id="reset_t">Reset Tabel</button>
				 				</td>
				 			</tr>
					 		</table>
					 	</form>
			<div class="table-responsive">
				<table class="table table-bordered table-striped" width="100%" id="tabel_tp">
					<thead>
						<th>No</th>
						<th>Nama</th>
						<th>Jenis</th>
						<th>Jml Beli</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Subtotal</th>
						<th>Pilihan</th>
					</thead>
					<tbody>
					</tbody>
                    <tfoot>
						<tr>
							<td colspan="6"><b>TOTAL</b></td>
							<td colspan="2" id="table_total"></td>
						</tr>
					</tfoot>
				</table>
			</div>

			
			<?php
				// End Bayar
					break;

				default:
					// Start default
			$pl  = $_GET['pl'];
			$tgl = $_GET['tgl'];
			switch ($pl) {
				case '1':
					$date = $tgl; 
					break;
				
				default:
					$date = date("Y-m-d"); 
					break;
			}
			?>
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-3">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input id="tanggal_h" class="form-control datepicker" value="<?php echo $date; ?>" style="float: left;text-align: center;"></td>
								<td><button id="cari_h" class="btn btn-info">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</div>
			</div>
			<div class="table-responsive">
			<table class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						<th>Nama Pasien</th>
						<th>Jenis Layanan</th>
						<th>No Antrian</th>
						<th>Status Pembayaran</th>
						<th>Pilihan</th>
					</tr>
				</thead>
				<tbody>
					<?php $kuery =  mysqli_query($con, "SELECT *FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE history_ap.tanggal_pendaftaran='$date'");
					
				
						while($data=mysqli_fetch_array($kuery)){ ?>
					<tr>
						<td><?php echo $data['nama_pasien']; ?></td>
						<td><?php echo $data['jenis_layanan']; ?></td>
						<td><?php echo $data['no_urut']; ?></td>
						<td><?php echo $data['pembayaran']; ?></td>
						<td>
							<?php if ($data['pembayaran']=="Belum Lunas") { ?>
								<a href="media.php?module=history_transaksi&act=bayar&nofak=<?php echo $data['no_faktur']; ?>" class="btn btn-primary btn-xs">Bayar</a>
						<?php }else { ?>
							<a href="media.php?module=history_transaksi&act=detail&nofak=<?php echo $data['no_faktur']; ?>" class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Detail</a>
						<?php } ?>
						<a href="modul/history_transaksi/wa.php?faktur=<?php echo $data['no_faktur']; ?>" target="_BLANK" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"> Kirim Nota</i></a>
						</td>
					</tr>
					<?php	}
					 ?>
					<?php $kuery =  mysqli_query($con, "SELECT * FROM perawatan_pasien JOIN pasien ON perawatan_pasien.id_pasien=pasien.id_pasien WHERE perawatan_pasien.tanggal_pendaftaran='$date'");
					
				
					while($data=mysqli_fetch_array($kuery)){ 
						
						$lu = mysqli_fetch_assoc(mysqli_query($con, "SELECT status AS nas FROM pembayaran WHERE no_faktur = '$data[no_faktur]'"));
						
						?>
				<tr>
					<td><?php echo $data['nama_pasien']; ?></td>
					<td><?php echo "inap"; ?></td>
					<td><?php echo $data['no_urut']; ?></td>
					<td><?php echo $lu['nas']; ?></td>
					<td>
						<?php if($lu["nas"] == "Lunas"){ ?>
						<a href="media.php?module=history_transaksi&act=detail&nofak=<?php echo $data['no_faktur']; ?>" class="btn btn-info btn-xs"><i class="fa fa-bars"></i> Detail</a>

					<a href="modul/history_transaksi/wa.php?faktur=<?php echo $data['no_faktur']; ?>" target="_BLANK" class="btn btn-success btn-xs"><i class="fa fa-whatsapp"> Kirim Nota</i></a>
						<?php } else { ?>
						<?php  } ?>
					</td>
				</tr>
				<?php	}
				 ?>
				</tbody>
			</table>
			</div>
			<!-- End -->
					<?php
					break;
			} ?>
		</div>
	</div>
</section>


<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  var nofak = "<?php echo $_GET['nofak']; ?>";
  var layan = "<?php echo $_GET['layan']; ?>";
  // datatable
  $('#tabel_tp').dataTable( {
	"bPaginate": false,
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/history_transaksi/data_tp.php?nofak="+nofak+"&layan="+layan,
      "aoColumnDefs": [],
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, row ) {
		  
		  var x = '';
          var a = '<button id="hapus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          var b = '<button id="minus_p" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-minus"></i></button>';
		  var c = '<button id="plus_p" data-id="'+data+'" class="btn btn-success btn-xs"><i class="fa fa-plus"></i></button>';
		  var d = '<button class="btn btn-xs btn-success">Lunas</button>';
	          if(row[7]=="Lunas"){
		        //  return d;
	          }else if(row[2]=="Obat") {
	            return x;
	          } else{
	           return a;
	          }

          
          }
        }
      ]
    } );
  // Onchange tunai or kredit
  $("#metode").change(function(){
  	  var select = $(this).val();
	  if(select=="Tunai"){
	    $('#rekening').collapse('hide');
	    $('#tr_uang_tu').collapse('show');
	    $('#tr_uang_tr').collapse('hide');
	  }else if(select=="Transfer"){
	    $('#rekening').collapse('show');
	    $('#tr_uang_tu').collapse('hide');
	    $('#tr_uang_tr').collapse('show');
	  }else{
	  	$('#rekening').collapse('show');
	    $('#tr_uang_tu').collapse('show');
	    $('#tr_uang_tr').collapse('show');
	  }
});
  // Auto Complete pencarian produk
    $( "#no_rek" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/history_transaksi/rekening.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
     });
    // diskon
    $('#uang_tr').on('input',function(){
        total();
        kembalian();
     });
    // Kembalian
     $('#uang_ht').on('input',function(){
        kembalian();
     });
     // kembalian
     function kembalian(){
     	var uang     = $("#uang_ht").val();
     	var  uang_tr = $("#uang_tr").val();
     	var tot   = $("#total_t").val();
        $.ajax({
            type:"post",
            url:"modul/history_transaksi/kembalian.php",
            data:{
               uang:uang,tot:tot,uang_tr:uang_tr
            },
            success:function(data){
               $('#kembalian').val(data);
            }
        });
     }
     // total
     function total(){
     	var nofak 	 = $("#id_nofak").val();
     	var ongkir 	 = $("#ongkir").val();
		 var layan 	 = "<?php echo $_GET['layan']; ?>";
     	$.ajax({
     		type: "POST",
     		url:"modul/history_transaksi/total.php",
     		data:{
     			nofak:nofak,ongkir:ongkir,layan:layan
     		},
     		success:function(data){
     			var obj = JSON.parse(data);
     			$("#table_total").html(obj.rupiah);
     			$("#total_t").val(obj.rupiah1);
     			kembalian();
     		}
     	});
     }
     // ads
     window.onload=load();

     function load (){
     	$("#tr_uang_tu").collapse("show");
     	total();
     }

     window.setInterval(kembalian(), 10000);
     // Tambah Produk
     $('#form_produk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/history_transaksi/tambah_p.php',
            data: $('#form_produk').serialize(),
            success: function () {
              var oTable = $('#tabel_tp').dataTable(); 
              oTable.fnDraw(false);
              $('#form_produk').trigger("reset");
              total();
              kembalian();
          	}
          });
        });
     // Tambah Perawatan
     $('#form_px').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/history_transaksi/tambah_t.php',
            data: $('#form_px').serialize(),
            success: function (data) {
              if (data=="ada") {
                alert("Treatment Sudah Ada");
              }else{
                var ttable = $('#tabel_tp').dataTable();
                ttable.fnDraw(false);
                 $('#form_px').trigger("reset");
                 total();
             	 kembalian();
              }
            }
          });

        });
     // plus
  $('body').on("click","#plus_p",function(){

          var id = $(this).data("id");

          $.ajax({
              type:'POST',
              url: 'modul/history_transaksi/plus.php',
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
              url: 'modul/history_transaksi/hapus.php',
              data:{
                id:id
              },
              success:function(data){
                  alert("Berhasil dihapus");
                /*  var ttable = $('#tabel_tp').dataTable();
				  ttable.fnDraw(false); */
				  location.reload();
              }
          });
     });
     // Minus Produk
     $('body').on("click","#minus_p",function(){

          var id = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/history_transaksi/minus.php',
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