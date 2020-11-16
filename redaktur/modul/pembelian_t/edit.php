<?php

include "../../../config/koneksi.php";

if($_POST['id']) {
        $id = $_POST['id'];
        // mengambil data berdasarkan id
        ?>
        <form style="margin-bottom: 20px;" role="form" method="POSt" enctype="multipart/form-data" action="modul/pembelian_t/edit_transaksi.php">
            <?php
         $tampil     = mysqli_query($con,"SELECT * FROM beli WHERE id = $id");
        while($data = mysqli_fetch_array($tampil)){
         ?>
            
              <div class="form-group">
                <label>Nomor Faktur</label>
                <input  class="form-control" type="hidden" name="id" value="<?php echo $data['id'];?>" >
                <input  class="form-control" type="text" name="no_fak" value="<?php echo $data['no_fak'];?>" readonly>
              </div>

              <div class="form-group">
                <label>Tanggal Beli</label>
                <input class="form-control"  type="date" name="tgl_beli" value="<?php echo $data['tgl_beli'];?>">
              </div>

              <div class="form-group">
                <label>Total</label>
                <input class="form-control"  type="text" name="total" value="<?php echo $data['total'];?>" readonly>
              </div>

              <div class="form-group">
                <label>Suplier</label>
                <select type="text" name="id_sup" class="form-control" >
                 <option value="<?php echo $data['id_sup'];?>">
                  <?php $query = mysqli_query($con,"SELECT *FROM suplier");
                     while ($cb = mysqli_fetch_array($query)) { ?>
                        <?php echo $cb['nama_sup'];?></option>
                       <option value="<?php echo $cb['id_sup']; ?>"><?php echo $cb['nama_sup']; ?></option>
                    <?php  } ?> 
                </select>
              </div>

              <div class="form-group">
                <label>Pembayaran</label>
                <select class="form-control" name="pembayaran">
                  <option value="<?php echo $data['pembayaran'];?>"> <?php echo $data['pembayaran'];?></option>
                  <option value="Transfer">Transfer</option>
                  <option value="Tunai">Tunai</option>
                </select>
              </div>
              <div class="form-group">
                <label>Keterangan</label>
                <input value="<?php echo $data['ket'];?>" class="form-control"  type="text" name="ket">
              </div>

              <div class="form-group">
                <label>Upload Bukti Bayar</label>
                <input class="form-control"  type="file" name="file" value="<?php echo $data['bukti_bayar'];?>">
              </div>
              <?php }?>
              <div class="form-group">
                  <button class="btn btn-success col-md-6" name="submit" type="submit"> Simpan</button>
                  <button  class="btn btn-danger col-md-6" data-dismiss="modal">Batal</button>
              </div>


            </form>
        <?php 
 
        }
    

?>