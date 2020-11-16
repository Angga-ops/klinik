
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Daftar Pembayaran Kredit</h3>
            </div>                    
            <div class="box-body">
               <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                       <th>No</th>
                       <th>No Faktur</th>
                       <th>Tanggal Pembelian</th>
                       <th>Id Suplier</th>
                       <th>Total</th>
                       <th>Tanggal Tempo</th>
                       <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
            $tampil     = mysqli_query($con,"Select * From beli_k WHERE '$date' <= tgl_tempo");
            $no = 1;
            while($data = mysqli_fetch_array($tampil)){
        ?>
            <tr class="gradeX">
             <td><?php echo $no++?></td>
             <td><?php echo $data['no_fak']; ?></td>
             <td><?php echo $data['tgl_beli']; ?></td>
             <?php $q1 = mysqli_query($con,"SELECT *FROM suplier WHERE id_sup='$data[id_sup]'"); 
                 $k = mysqli_fetch_array($q1); ?>
             <td><?php echo $k['nama_sup']; ?></td>
             <td><?php echo $data['total']?></td>
             <td><?php echo $data['tgl_tempo']?></td>
             <td>
             	<?php if ($data['bukti_bayar']) {
             		echo '<a class="btn btn-xs btn-success col-md-12">Sudah Dibayar</a><br><a href="#detail" id="custId" data-toggle="modal" data-id="'.$data['id'].'" class="btn btn-xs btn-info col-md-12"><i class="fa fa-info"></i> Detail</a>';
             	}else{
             		echo '<a  href="#editmodal" id="custId" data-toggle="modal" data-id="'.$data['id'].'" class="btn btn-xs btn-warning col-md-12"><i class="fa fa-edit"></i> Bayar</a>';
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
                  $query_edit = mysqli_query($con,"SELECT * FROM beli WHERE id='$id'");
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
                              <?php $query = mysqli_query($con,"SELECT *FROM suplier");
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

                </form><br>
              </div>
              <div class="modal-footer">
                <button type="button" type="submit" class="btn btn-default pull-left" >Simpan</button>
                <button class="btn btn-primary"  data-dismiss="modal">Batal</button>
              </div>                
                </table>
      <tbody>
   
    </tbody>
     </div></div></div></div>

</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
});
</script>
<!--
   -->


