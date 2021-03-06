<style>
.hidden {display: none}
.flt tbody tr td {border: none !important}
</style>
<section class="content-header"> 
<h1>
  Broadcast Message
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Broadcast Message</li>
</ol>
</section>

<section class="content">

<div class="row">
<div class="col-md-12"> 
<div class="alert alert-info alert-dismissible">
               
			   
                <h4><i class="icon fa fa-info-circle"></i> Perhatian</h4>
				<strong>Silakan cek pengaturan Whatsapp massal sesuai <a href='modul/broadcast_new/2019wa.pdf' target='_BLANK'>panduan ini</a> </strong><br/>
				<strong>Silakan filter data pasien, pilih nama pasien yang akan dikirim pesan, lengkapi isi pesan lalu klik tombol "Kirim Pesan" </strong>
              </div>

</div>
</div>


<div class="row">
<div class="col-md-12">
<div class="box box-primary"><div class="box-body">
<div class="row">
<div class="col-md-3"  style="margin-bottom: 3%">Dari Tanggal</div><div class="col-md-9"><input type="text" class="form-control piku" id="tgl1" value="<?php echo date("Y-m-d"); ?>"/></div></div><div class="row">
<div class="col-md-3"  style="margin-bottom: 3%">Sampai Tanggal</div><div class="col-md-9"><input type="text" class="form-control piku" id="tgl2"  value="<?php echo date("Y-m-d"); ?>"/></div></div>

</div></div>
</div>
</div>



<div class="row">
<div class="col-md-12">
<div class="box box-primary"><div class="box-body">
<table class="table flt" style="border: none">
<tr>
<td style="width: 25%">Filter Pasien Menurut</td>
<td>
<select class="form-control" id="flt">
<option value="">--pilih filter--</option>
<option value="1">Jumlah Perawatan</option>
<option value="2">Pekerjaan</option>
<option value="3">Nominal</option>
<option value="4">Kelas</option>
</select>
</td>
</tr>
<tr id="1-kiss" class="hidden">
<td>Jumlah Perawatan >= </td><td> <input type="text" id="1-input" class="form-control" placeholder="banyaknya perawatan..."/></td>
</tr>
<tr id="2-kiss" class="hidden">
<td>Jenis Pekerjaan</td><td> <select id="2-input" class="form-control" disabled="disabled" >

<option value="">-- Pilih Jenis Pekerjaan Pelanggan --</option>

<?php

  $sel  = mysqli_query($con, "Select * From pekerjaan");

  while($data = mysqli_fetch_array($sel)){

?>

		  <option value="<?php echo $data['pekerjaan']; ?>"><?php echo $data['pekerjaan']; ?> </option>            

	  <?php

  }

?>
</select></td>
</tr>
<tr id="3-kiss" class="hidden">
<td>Jumlah Pembayaran >= </td><td><input type="text" id="3-input" class="form-control" placeholder="banyaknya pembayaran..."/></td>
</tr>
<tr id="4-kiss" class="hidden">
<td>Klaster</td><td><select id="4-input" class="form-control" disabled="disabled" >

<option value="">-- Pilih Jenis Klaster Pelanggan --</option>
      <?php
        $sel  = mysqli_query($con, "Select * From kategori_pelanggan");
        while($data = mysqli_fetch_array($sel)){
      ?>
                <option value="<?php echo $data['kategori']; ?>"><?php echo $data['kategori']; ?> (<?php echo $data['keterangan']; ?>)</option>            
            <?php
        }
      ?>

</select></td>
</tr>
</table>
<button class="btn btn-warning" id="kiss" disabled="disabled">Cari</button>
</div></div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="box box-primary"><div class="box-body">
<div class="row">
<div class="col-md-3"  style="margin-bottom: 3%">Subject Pesan</div><div class="col-md-9"><input type="text" id="subject" class="form-control" placeholder="subjek pesan"/></div></div><div class="row">
<div class="col-md-3"  style="margin-bottom: 3%">Isi Pesan</div><div class="col-md-9"><textarea class="form-control"  id="pesan">hapus teks ini untuk menulis pesan</textarea></div></div>

<button class="btn btn-warning" id="send"  disabled="disabled" onclick="kirimpesan()">Kirim Pesan</button> &nbsp;&nbsp; <span id="msg"><small>mengirim pesan </small><img src="img/loading.gif" style="width: 5%"/></span>
</div></div>
</div>
</div>

<?php

$tgl1 = !isset($_GET['tgl1']) || $_GET['tgl1'] != date("Y-m-d")? " AND tanggal >= '$_GET[tgl1]' AND tanggal <= '$_GET[tgl2]'" : "";
$tgl2 = !isset($_GET['tgl1']) || $_GET['tgl1'] != date("Y-m-d")? " AND tgl >= '$_GET[tgl1]' AND tgl <= '$_GET[tgl2]'" : "";

switch($_GET["tipe"]){
	default: $where = "LIMIT 0"; break;

	case "1": 
	$c = mysqli_query($con, "SELECT count(nama) as jum, id_pasien from history_kasir where jenis='Treatment' $tgl1 group by id_pasien having jum>='$_GET[val]'"); 

	while($cx = mysqli_fetch_assoc($c)){
		$xz .= "'".$cx['id_pasien']."',";
	}
	if(mysqli_num_rows($c) == 0){
		$where = "LIMIT 0";
	} else {
		$xz = substr($xz,0,strlen($xz) - 1);
	$where = "WHERE id_pasien IN ($xz)";
	}
	
	$status = "Menurut Banyaknya Treatment";
	break;

	case "2": 
	$where = "WHERE pekerjaan = '$_GET[val]'";
	$status = "Menurut Jenis Pekerjaan";
	break;

	case "3": 
	$c = mysqli_query($con, "SELECT * from pembayaran where total>='$_GET[val]' $tgl2 group by id_pasien"); 

	while($cx = mysqli_fetch_assoc($c)){
		$xz .= "'".$cx['id_pasien']."',";
	}

	if(mysqli_num_rows($c) == 0){
		$where = "LIMIT 0";
	} else {
	$xz = substr($xz,0,strlen($xz) - 1);
	$where = "WHERE id_pasien IN ($xz)";
	}

	$status = "Menurut Banyaknya Pembayaran";
	break;

	case "4": 
	$where = "WHERE klaster='$_GET[val]'";
	$status = "Menurut Kelas";
	break;

} ?>

	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Data Pelanggan <?php echo $status; ?></h3>
		</div>
		<div class="box-body">
			<table class="table table-striped table-bordered">
				<thead>
					<tr>
						<th>Aksi</th>
						<th>Nama Pasien</th>
						<th>No HP</th>
					</tr>
				</thead>
				<tbody>
                   <?php
                    
					$q = mysqli_query($con, "SELECT id,nama_pasien,no_telp FROM pasien $where"); 

						 while($r = mysqli_fetch_array($q)){
						 	?>
					<tr>
						<td><input type="checkbox" class="chk" data-hp="<?php echo $r['no_telp']; ?>" checked/></td>
                        <td><?php echo $r['nama_pasien']; ?></td>
                        <td><?php echo $r['no_telp']; ?></td>
					</tr>
						 	<?php
						 }
					?>
				</tbody>
			</table>
		</div>
	</div>
</section>
 <script>
 	$(document).ready(function(){

		 $(".piku").datepicker({

			dateFormat: "yy-mm-dd"

		 });

		 $("#msg").hide();

         $("#flt").change(function(){
             var n = $(this).val();
             $("#" + n + "-kiss").attr("class","");
			 $("#" + n + "-input").attr("disabled",false);
			 $("#kiss").attr("disabled",false);
             $(["1","2","3","4"]).each(function(i,val){
				 if(n != val){
					$("#" + val + "-kiss").attr("class","hidden");
					$("#" + val + "-input").attr("disabled",true);
				 }
			 });
         });

		 $("#pesan").on("keydown",function(){
			$("#send").attr("disabled",false);
		 });


		 $("#kiss").click(function(){

			 var t = $("#flt").val();
			 var v = $("#" + t + "-input").val();
			 var g1 = $("#tgl1").val();
			 var g2 = $("#tgl2").val();

			 if(t == ""){
				 alert("Anda belum memilih filter");
			 } else {
				 location.href = "media.php?module=broadcast_new&tipe=" + t + "&val=" + v + "&tgl1=" + g1 + "&tgl2=" + g2;
			 }

		 });

		


});

function kirimpesan(){
			
			//panggil data no hp dari check
			var k = '[';
			$(".chk").each(function(i,val){
				if($(this).is(":checked")){
					k += '"' + $(this).data("hp") + '",';
				}
			});
			k = k.substring(0,k.length - 1) + ']';

		var zzx =	$.ajax({
				type: "POST",
				url: "modul/broadcast_new/bc_api.php",
				data: {"data": k, "pesan": $("#pesan").val()},
				success: function(data){
					$("#msg").hide();
					if(data == "0"){
						alert("Pesan sudah dikirim");
					} else {
						alert("Satu atau beberapa pesan gagal dikirim. Silakan cek pengaturan Whatsapp massal dan coba lagi");
					}
					
				}
			});

			if(zzx.readyState == "1"){
				$("#msg").show();
			}

			$.ajax({
				type: "POST",
				url: "modul/broadcast_new/bc_report.php",
				data: {"pesan": $("#pesan").val() , "tipe": "<?php echo $_GET['tipe']; ?>", "val": "<?php echo $_GET['val']; ?>", "subject" : $("#subject").val(), "namauser": "<?php echo $_SESSION['namauser']; ?>"}
			});

		 };

 </script>