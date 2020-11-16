<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title pull-left">Kartu Member</h3>
			<!-- <a class="btn btn-sm btn-success pull-right" href="modul/lap_harian_produk/cetak_hp.php?klinik=<?php echo $klinik; ?>"><i class="fa fa-print"></i> Cetak</a> -->
		</div>
		<div class="box-body">
		 	<div class="table-responsives">
		 		<table class="table table-bordered table-striped datatable2">
		 			<thead>
		 				<tr>
		 					<th>Nama Pasien</th>
		 					<th>Kartu Member Expired</th>
		 					<th>Pilihan</th>
		 				</tr>
		 			</thead>
		 			<tbody>
		 				<?php $qp = mysqli_query($con, "SELECT *FROM pasien"); 
		 					while($p=mysqli_fetch_array($qp)){ ?>
		 				<tr>
		 					<td><?php echo $p["nama_pasien"]; ?></td>
			 				<td><?php echo tgl_indo($p["km_exp"]); ?></td>
			 				<td>
			 					<button id="perpanjang" data-id="<?php echo $p['id_pasien']; ?>" class="btn btn-xs btn-info"><i class="fa fa-refresh"></i> Perpanjang</button>
			 				</td>
		 				</tr>
		 				<?php
		 					}
		 				?>
		 			</tbody>
		 		</table>
		 	</div>
		</div>
		</div>
	</div>
</section>

<div class="modal fade" id="modal_p">
    <div class="modal-dialog">
        <div class="modal-content" style="width: 100%;">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Perpanjang Kartu Member</h4>
            </div>
            <div class="modal-body">
                <form method="POST" id="form_exp">
                	<input class="form-control" type="hidden" id="id_pasien" name="id_pasien">
                	<label>Nama Pasien</label>
                	<input class="form-control" type="text" name="nama" id="nama">
                	<label>Tanggal Expired</label>
                	<input class="form-control" type="text" id="tgl_expired" name="tgl_exp" readonly>
                	<label>Tanggal Perpanjangan</label>
                	<input class="form-control" type="text" name="tgl_p" id="tgl_p">
                	<button style="margin-top: 5px;" type="button" class="btn btn-sm btn-default" data-dismiss="modal">Batal</button>
                	<button style="margin-top: 5px;" type="submit" class="btn btn-sm btn-primary">Perpanjang</button>
                </form>
            </div>
        </div>
    </div>
</div>

<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  // modal
  $('body').on("click","#perpanjang",function(){

          var id = $(this).data("id");

          $.ajax({
          	type: "POST",
          	url : "modul/kartu_member/modal_data.php",
          	data: {
          		id:id
          	},
          	success:function(data){
          		var obj = JSON.parse(data);
          		$("#id_pasien").val(obj.id);
          		$("#tgl_expired").val(obj.tgl_exp);
          		$("#nama").val(obj.nama);
          		$('#modal_p').modal('show');  
          	}
          });
     });
  // datepicker
  $( "#tgl_p").datepicker({
	  dateFormat: "yy-mm-dd",
	  defaultDate: "1 y",
	  changeYear: true,
	  changeMonth: true
  });
  // form submint
  $('#form_exp').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/kartu_member/perpanjang.php',
            data: $('#form_exp').serialize(),
            success: function (data) {
            	if (data=="kurang") {
            		alert("Tanggal Perpanjangan Tidak Valid");
            	}
            	else{
            		alert("Katu Member Berhasil Diperpanjang");
            		$('#modal_p').modal('hide'); 
            		window.location.reload(); 

            	}
            }
          });

        });
  // data pasien

});
</script>