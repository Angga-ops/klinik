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
			<div class="row" style="margin-bottom: 5px;">
				<div class="col-md-12">
					<form method="POST" action="?module=antrian&act=cari">
					<table class="table">
						<tbody>
							<tr>
								<td><label>Tanggal</label></td>
								<td><input id="tanggal_h" class="form-control datepicker" name="date" value="<?php echo $date; ?>" style="float: left;text-align: center;"></td>
								<td><label>Poliklinik</label></td>
								<td>
									<select class="form-control" name="klinik">
										<option value="All">All</option>
										<?php
											$query1 = mysqli_query($con, "SELECT * FROM poliklinik");
											while($result = mysqli_fetch_assoc($query1)){
										?>
										<option value="<?php echo $result['id_poli']; ?>"><?php echo $result['poli']; ?></option>
									<?php } ?>
									</select>
								</td>
								<td><button class="btn btn-info">Cari</button></td>
							</tr>
						</tbody>
					</table>
				</form>
				</div>
			</div>
			<div class="table-responsive">
			<table class="datatable table table-bordered table-striped">
				<thead>
					<tr>
						<th>No Faktur</th>
						<th>No Antrian</th>
						<th>Nama Pasien</th>
						<th>Poliklinik</th>
						<th>Online</th>
					</tr>
				</thead>
				<tbody>
					<?php
					switch ($_GET['act']) {
						case 'cari':
							$date = $_POST['date'];
							$poli = $_POST['klinik'];
							switch ($poli) {
								case 'All':
									$kuery =  mysqli_query($con, "SELECT * FROM antrian_pasien a JOIN pasien b ON a.id_pasien=b.id_pasien JOIN poliklinik c ON a.poliklinik=c.id_poli WHERE a.tanggal_pendaftaran='$date'");
									break;
								
								default:
									$kuery =  mysqli_query($con, "SELECT * FROM antrian_pasien a JOIN pasien b ON a.id_pasien=b.id_pasien JOIN poliklinik c ON a.poliklinik=c.id_poli WHERE a.tanggal_pendaftaran='$date' AND a.poliklinik='$poli'");
									break;
							}
							break;
						
						default:
							$kuery =  mysqli_query($con, "SELECT * FROM antrian_pasien a JOIN pasien b ON a.id_pasien=b.id_pasien JOIN poliklinik c ON a.poliklinik=c.id_poli");
							break;
					}
				
						while($data=mysqli_fetch_array($kuery)){ ?>
					<tr>
						<td><?php echo $data['no_faktur']; ?></td>
						<td><?php echo $data['no_urut']; ?></td>
						<td><?php echo $data['nama_pasien']; ?></td>
						<td><?php echo $data['poli']; ?></td>
						<td><?php if($data['online']==NULL){ echo "Tidak"; } else{ echo "Ya"; } ?></td>
					<?php	}
					 ?>
				</tbody>
			</table>
			</div>
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