
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Inkaso</h3>
		</div>

		<div class="box-body">
			<form action="" method="POST">
			<div class="row">
				
        <div class="col-md-3">
          <div class="form-group">
          <label>Dari Tanggal</label><br>
          <input type="date" name="tgl1" class="form-control datepicker" autocomplete="off">
          </div>
        </div>
        <div class="col-md-3">
          <div class="form-group">
          <label>Sampai Tanggal</label><br>
          <input type="date" name="tgl2" class="form-control datepicker" autocomplete="off">
          </div>
        </div>

			</div>
			<div class="row">
				<div class="col-md-6">
					<button type="submit" name="submit" class="btn btn-info"><i class="fa fa-search"></i> Tampilkan</button>
				</div>
			</div>
		</form>
	</div>

	<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Laporan Inkaso Dari tanggal : <?php 
      $tgl1 = $_POST['tgl1'];
      $tgl2 = $_POST['tgl2'];
			echo $tgl1;?> Sampai Tanggal : <?php echo $tgl2; ?></h3>
		</div>

		<div class="box-body">
			<form method="post" enctype="multipart/form-data" action="modul/kategori_pelanggan/update_pelanggan.php">
			    <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
			<table class="table table-bordered table-striped">
            <thead>
            <tr>
                 <th>No.Faktur</th>
                 <th>Tanggal transaksi</th>
                 <th>Tanggal Tempo</th>
                 <th>Total</th>
                 <th>Nama Suplier</th>
                 <th>Aksi</th>
                 <!-- <th>Aksi</th> -->
               
            </tr>
        	</thead>
			      <tbody>
                    <?php
            $tampil     = mysqli_query($con, "Select * From beli_k WHERE tgl_beli between '$tgl1' AND '$tgl2'");
            $no = 1;
            while($data = mysqli_fetch_array($tampil)){
        ?>
            <tr class="gradeX">
             <td><?php echo $data['no_fak']; ?></td>
             <td><?php echo $data['tgl_beli']; ?></td>
             <td><?php echo $data['tgl_tempo']?></td>
             <td><?php echo $data['total']?></td>
             <?php $q1 = mysqli_query($con, "SELECT *FROM suplier WHERE id_sup='$data[id_sup]'"); 
                 $k = mysqli_fetch_array($q1); ?>
             <td><?php echo $k['nama_sup']; ?></td>
             <td>
             	<?php if ($data['bukti_bayar']) {
             		echo '<a class="btn btn-xs btn-success col-md-12">Sudah Dibayar</a><br><a href="#detail" id="custId" data-toggle="modal" data-id="'.$data['id'].'" class="btn btn-xs btn-info col-md-12"><i class="fa fa-info"></i> Detail</a>';
             	}else{
             		echo '<a  href="?module=pembayaran_kredit" id="custId" data-toggle="modal" data-id="'.$data['id'].'" class="btn btn-xs btn-warning col-md-12"><i class="fa fa-edit"></i> Bayar</a>';
             	}?>
               
                     
             </td>
             
               
            </tr>
        <?php
            }
        ?>
                  </tbody>
                  <div class="modal fade" id="detail" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Detail Barang</h4>
                          </div>
                          <div class="modal-body">
                              <div class="fetched-data"></div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#detail').on('show.bs.modal', function (e) {
                        var id = $(e.relatedTarget).data('id');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'modul/pembayaran_kredit/detail.php',
                            data :  'id='+ id,
                            success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                            }
                        });
                     });
                });
              </script>

              <div class="modal fade" id="editmodal" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Transaksi</h4>
                          </div>
                          <div class="modal-body">
                              <div class="fetched-data"></div>
                          </div>
                          <div class="modal-footer">
                              
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#editmodal').on('show.bs.modal', function (e) {
                        var id = $(e.relatedTarget).data('id');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'modul/pembayaran_kredit/edit.php',
                            data :  'id='+ id,
                            success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                            }
                        });
                     });
                });
              </script>

          <div  class="modal fade" id="">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Barang</h4>
              </div>
                <div class="modal-body">
                <form style="margin-bottom: 20px;" role="form" method="POST" action="modul/pembelian_k/edit.php">
                  <?php
                  $id = $data['id']; 
                  $query_edit = mysqli_query($con, "SELECT * FROM beli WHERE id='$id'");
                  //$result = mysqli_query($conn, $query);
                  while ($row = mysqli_fetch_array($query_edit)) {  
                  ?>

                  <div class="form-group">
                    <label>Nomor Faktur</label>
                    <input  class="form-control" type="text" name="no_fak" value="<?php echo $row['id'];?>" >
                    <input  class="form-control" type="text" name="no_fak" value="<?php echo $row['no_fak'];?>" >
                  </div>
                  <div class="form-group">
                    <label>Tanggal Beli</label>
                    <input class="form-control"  type="date" name="tgl_beli" value="<?php echo $row['tgl_beli'];?>">
                  </div>
                  <div class="form-group">
                    <label>Total</label>
                    <input class="form-control"  type="text" name="total" value="<?php echo $row['total'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Suplier</label>
                    <select type="text" name="id_sup" name="id_sup" class="form-control" >
                             <option value="<?php echo $row['id_sup'];?>"><?php echo $row['id_sup'];?></option>
                              <?php $query = mysqli_query($con, "SELECT *FROM suplier");
                                 while ($cb = mysqli_fetch_array($query)) { ?>
                                   <option value="<?php echo $cb['id_sup']; ?>"><?php echo $cb['nama_sup']; ?></option>
                                <?php  } ?> 
                            </select>
                  </div>
                  <div class="form-group">
                    <label>Pembayaran</label>
                    <select>
                      <option value="<?php echo $row['pembayaran'];?>"></option>
                      <option value="Transfer">Transfer</option>
                      <option value="Tunai">Tunai</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input value="<?php echo $row['ket'];?>" class="form-control"  type="text" name="ket">
                  </div>
                  <?php }?>
                </table>
                <div class="row">
	            <div class="col-md-12">
	              <div class="form-group">
<!-- 	                  <button type="submit" name="submit" id="submit" class="btn btn-success">Simpan Perubahan</button>
 -->	              </div>
	            </div>
	            </div>
	        </form>
		</div>
	</div>
</section>
<script>
  $(document).ready(function(){ // Ketika halaman sudah siap (sudah selesai di load)
    $("#check-all").click(function(){ // Ketika user men-cek checkbox all
      if($(this).is(":checked")) // Jika checkbox all diceklis
        $(".check-item").prop("checked", true); // ceklis semua checkbox siswa dengan class "check-item"
      else // Jika checkbox all tidak diceklis
        $(".check-item").prop("checked", false); // un-ceklis semua checkbox siswa dengan class "check-item"
    });
    
  });
  </script>
	