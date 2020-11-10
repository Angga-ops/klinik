<style>
.tbl {width: 100%}
.tbl td {padding: 1%}
</style>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Pasca Treatment</h3>
		</div>
		<div class="box-body">
		<form action="modul/prarilis_pt/aksi_pt.php" method="POST" enctype="multipart/form-data">
			<div style="border: 2px solid green;padding: 0px 0px 10px 10px;box-sizing: border-box;margin-bottom: 15px;">
				<h4>Data Pasien</h4>
				
								<div class="row">
					<div class="col-md-6">

					<div class="row" style="margin-bottom: 10px;">
							 <div class="col-md-3">Faktur</div>
							 <div class="col-md-6">
							 <input type="text" class="form-control" id="fak" name="nofak" required/>
							 </div>
							 </div>

							 <div class="row" style="margin-bottom: 10px;">
							 <div class="col-md-3">Nama Dokter</div>
							 <div class="col-md-6">
							 <input type="text" class="form-control" id="dr" placeholder="ketik untuk memilih" required/>
							 <input type="hidden" id="kddr" name="id_dr"/>
							 </div>
							 </div>

					<div class="row" style="margin-bottom: 10px;">
							 <div class="col-md-3">Cabang</div>
							 <div class="col-md-6">
							 <select class="form-control" id="cab" name="klinik" required>
							 <?php 
							 
							 $c = mysql_query("SELECT * FROM daftar_klinik");
							 while($cab = mysql_fetch_assoc($c)){
								 echo "<option value='$cab[id_kk]'>$cab[nama_klinik]</option>";
							 }
							 
							 ?>
							 </select>
							 </div>
							 </div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								Nama 
							</div>
							<div class="col-md-6" id="data_n">
								<input type="text" class="form-control" id="pas"  placeholder="ketik untuk memilih"/>
														</div>
						</div>
						<div class="row" style="margin-bottom: 10px;">
							<div class="col-md-3">
								No Telp
							</div>
							<div class="col-md-6" id="data_nt">
							<input type="text" class="form-control" id="hp" disabled/>
							</div>
						</div>
						<input type="hidden" name="id_pasien" id="kd" />
				</div>
			</div>
			<hr>
			<h4>Data Pasca Treatment</h4>
		
				<div class="row">
					<div class="col-md-6">
						<label>Tanggal</label>
						<input class="form-control picker" type="text" name="tanggal" id="tgl" autocomplete="off" required>
						<label>Subject</label>
						<textarea style="height: 35px;" name="subjek" class="form-control" required></textarea>
						<label>Foto 1</label>
						<input class="form-control" type="file" name="foto1">
						<label>Foto 2</label>
						<input class="form-control" type="file" name="foto2">
						<br>
					
					</div>
					<div class="col-md-6">
						<label>Object</label>
						<textarea name="objek" style="height: 35px;" class="form-control" required></textarea>
						<label>Assestment</label>
						<textarea style="height: 35px;" name="assest" class="form-control" required></textarea>
						<label>Foto 3</label>
						<input class="form-control" type="file" name="foto3">
						<label>Foto 4</label>
						<input class="form-control" type="file" name="foto4">
					</div>
				</div>
		
			<hr>
			<h4>Produk & Treatment (tidak wajib, data akan tersimpan di history transaksi)</h4>
			<h4>Silahkan pilih treatment atau produk</h4>
						
					 		<table class="tbl">
							 
							
							 <tr>
							 <td>Nama Produk/Treatment</td>
							 <td>
							 <input type="text" class="form-control clr" id="acs" placeholder="ketik untuk memilih"/>
							 <input type="hidden" class="form-control clr" id="kdprod"/>
							 <input type="hidden" class="form-control clr" id="status"/>
							 </td>
							 </tr>
							 <tr>
							 <td>Harga</td>
							 <td>
							 <input type="text" class="form-control clr" id="hrg" disabled/>
							 <input type="hidden" class="form-control clr" id="hrgb"/>
							 </td>
							 </tr>
							 <tr>
							 <td>Diskon (%)</td>
							 <td><input type="text" class="form-control clr" id="disc" value="0"/></td>
							 </tr>
							 <tr>
							 <td>Jumlah</td>
							 <td><input type="text" class="form-control clr" id="jml" /></td>
							 </tr>
							 <tr>
							 <td>Keterangan</td>
							 <td><input type="text" class="form-control clr" id="ket" /></td>
							 </tr>
							 <tr>
							 <td><button type="button" class='btn btn-danger jbtn'>+Tambah</button></td>
							 <td></td>
							 </tr>
							 </table>

							 <small><strong><span id="msg"></span></strong></small>
							
			<div class="table-responsive">
				<table class="table table-bordered table-striped" width="100%" id="tabel_tp">
					<thead>
					<th>Faktur</th>
						<th>Dokter</th>
						<th>Kd Dokter</th>
						<th>Nama</th>
						<th>Jumlah</th>
						<th>Harga Beli</th>
						<th>Harga</th>
						<th>Diskon</th>
						<th>Ket</th>
						<th>Pilihan</th>
					</thead>
					<tbody>
					</tbody>
				</table>
			</div>
			<hr/>
			<button type="submit" class="btn btn-success btn-sm">Simpan</button>
</form>
			</div>
		</div>
	</div>
</section>

<script>

function dels(id){

var xhr = $.ajax({
	
	url: "modul/prarilis_pt/faktur.php?act=hapus",
	data: {"id": id},
	success: function(data){
		$("#msg").html("");
		$("#" + id).parents("tr").addClass("deleted");
    var tbl =  $('#tabel_tp').DataTable();
    tbl.row(".deleted").remove().draw();
	}
});


if(xhr.readyState == 1){
$("#msg").html("sedang menghapus....jika tidak ada respon dalam beberapa saat silakan ulangi hapus data");
}


}


$(document).ready(function(){


	$(".picker").datepicker({
		dateFormat: "yy-mm-dd",
		changeMonth: true,
			changeYear: true
	})

$("#tabel_tp").DataTable({
	"columns": [  
		{ "data": "fak" },
		{ "data": "dr" },
		{ "data": "kddr" },
        { "data": "item" },
        { "data": "jml" },
		{ "data": "hrgb" },
        { "data": "hrg" },
        { "data": "disc" },              
        { "data": "ket" },
		{ "data": "pil" }
	]
});


$(".jbtn").click(function(){

var t =	$("#tabel_tp").DataTable();

var fak = $("#fak").val();
var hrgb = $("#hrgb").val();
var kddr = $("#kddr").val();
var dr = $("#dr").val();
var item = $("#acs").val();
var hrg = $("#hrg").val();
var disc = $("#disc").val();
var jml = $("#jml").val();
var ket = $("#ket").val();
var kdprod = $("#kdprod").val();
var status = $("#status").val();
var cab = $("#cab").val();
var pasien = $("#kd").val();
var tgl = $("#tgl").val();

var jsonp = '{"fak":"'+ fak + '","dr":"'+ dr + '","kddr":"'+ kddr + '","item":"'+ item + '","hrgb":"'+ hrgb + '","hrg":"'+ hrg + '","disc":"'+ disc + '","jml":"'+ jml+ '","ket":"'+ ket + '","status":"'+ status + '","cab":"'+ cab + '","pasien":"'+ pasien + '","kdprod":"'+ kdprod + '","tgl":"'+ tgl +'"}';

//simpan dulu


var xhr = $.ajax({


url: "modul/prarilis_pt/faktur.php?act=simpan",
type: "POST",
data: {"serial": jsonp},
success: function(data){


	var pil = "<span class='btn btn-sm btn-danger' style='cursor: pointer' onclick='dels(this.id)' id='" + data + "'>Hapus</span>"

var json = '{"fak":"'+ fak + '","dr":"'+ dr + '","kddr":"'+ kddr + '","item":"'+ item + '","hrgb":"'+ hrgb + '","hrg":"'+ hrg + '","disc":"'+ disc + '","jml":"'+ jml+ '","ket":"'+ ket + '","pil":"' + pil + '"}';
var j = JSON.parse(json);

t.row.add(j).draw();

$("#msg").html("");
$(".clr").val("");	
$("#disc").val("0");

}


});

if(xhr.readyState == 1){
$("#msg").html("sedang menyimpan....jika tidak ada respon dalam beberapa saat silakan ulangi inputan data");
}



});




$( "#dr" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/prarilis_pt/ajax_dr.php",
        type: 'post',
        dataType: "json",
        data: {
         search: $("#dr").val()
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kddr').val(ui.item.kd);
       $('#dr').val(ui.item.label);
       return false;
      }
     });




$( "#pas" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/prarilis_pt/ajax_pas.php?cab=" + $("#cab").val(),
        type: 'post',
        dataType: "json",
        data: {
         search: $("#pas").val()
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kd').val(ui.item.kd);
       $('#hp').val(ui.item.hp);
       $('#pas').val(ui.item.label);
       return false;
      }
     });

//autocomplete jui


$( "#acs" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/prarilis_pt/ajax_acs.php?cab=" + $("#cab").val(),
        type: 'post',
        dataType: "json",
        data: {
         search: $("#acs").val()
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
      
if(ui.item.status == "treatment"){
	$("#jml").val("1");
	$("#jml").attr("disabled",true);
	$("#acs").val(ui.item.label);
	$("#hrg").val(ui.item.harga);
	$("#hrgb").val(ui.item.hargab);
	$("#status").val(ui.item.status);
} else {
	$("#jml").val("");
	$("#jml").attr("disabled",false);
	$("#acs").val(ui.item.label);
	$("#hrg").val(ui.item.harga);
	$("#hrgb").val(ui.item.hargab);
	$("#status").val(ui.item.status);
	$("#kdprod").val(ui.item.kdprod);
}


       return false;
      }
     });

//autocomplete jui

});
</script>