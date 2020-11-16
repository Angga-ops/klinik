<?php

    switch($_GET['act']){

    default:

    $pengirim = $_SESSION['namauser'];

?>

<section class="content">

    

    <div class="row">

    <div class="col-md-12">

          <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">Broadcast Pesan Berdasarkan Pekerjaan</h3>

        </div>

        <!-- /.box-header -->

        <div class="box-body"> 

        <form method="post" enctype="multipart/form-data" action="modul/broadcast_pekerjaan/aksi_broadcast.php">

          <div class="col-md-6">

           <div class="row">

            <div class="col-md-12">

              <div class="form-group">

           <label for="field4">Jenis Pekerjaan</label>

            <select name="pekerjaan" class="form-control"  required>

                <option value="">-- Pilih Jenis Pekerjaan Pelanggan --</option>

      <?php

        $sel  = mysqli_query($con, "Select * From pekerjaan");

        while($data = mysqli_fetch_array($sel)){

      ?>

                <option value="<?php echo $data['pekerjaan']; ?>"><?php echo $data['pekerjaan']; ?> </option>            

            <?php

        }

      ?>

            </select>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

           <label for="field4">Subjek Pesan</label>

            <input type="text" name="subjek" class="form-control" required="">

            <input type="hidden" name="pengirim" value="<?php echo $pengirim;?>" class="form-control" required="">

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                  <button type="submit" name="submit" id="submit" class="btn btn-success">Kirim Broadcast</button>

              </div>

              </div>

            </div>    

          </div>

          <div class="col-md-6">

             <div class="row">

            <div class="col-md-12">

              <div class="form-group">

           <label for="field4">Isi Pesan</label>

            <textarea type="text"  name="isi" required="" class="form-control"></textarea>

              </div>

              </div>

            </div>

             </div>

              

            </form>

              </div>

        </div>

        </div>

    </div>



</section>



<section class="content">

    

    <div class="row">

    <div class="col-md-12">

          <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">History Broadcast Pesan</h3>

        </div>

        <!-- /.box-header -->

        <div class="box-body">
            <div class="table-responsive">
          <table id="example1" class="table table-bordered table-striped">

                  <thead>

            <tr>

                 <th>Pekerjaan Pelanggan</th>

                 <th>Subjek</th>

                 <th>Isi</th>

                 <th>Tanggal</th>

                 <th>pengirim</th>

                 <th>Aksi</th>

               

            </tr>

        </thead>

      <tbody>

    <?php

    $tampil   = mysqli_query($con, "Select * From broadcast_pekerjaan");

    while($r  = mysqli_fetch_array($tampil)){

      $no=1;

    ?>

      <tr class="gradeX">

                <td><?php echo $r["pekerjaan"]; ?></td>

                <td><?php echo $r["subjek"]; ?></td>

                <td><?php echo $r["isi"]; ?></td>

                <td><?php echo $r["tgl_kirim"]; ?></td>

                <td><?php echo $r["pengirim"]; ?></td>

                <!--<?php $q1 = mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$r[id_kk]'"); 

                 $k = mysqli_fetch_array($q1); ?>

                <td><?php echo $k['nama_klinik']; ?></td>-->

            <td>

                     

                     <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/broadcast_pekerjaan/hapus_broadcast.php?module=broadcast_pekerjaan&act=hapus&id_broadcast=<?php echo $r['id_broadcast']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>

                     

                  

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

<script type="text/javascript" src="<?php echo $url2; ?>/modul/broadcast/ckeditor/ckeditor.js"></script>

<link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

$(document).ready(function(){

    $("#example1").DataTable();

    $("#pk").change(function(){

      var select = $(this).val();

      window.location.href = "http://localhost/klinik-kecantikan/redaktur/media.php?module=produk&id="+select;

    })

});

</script>

<?php

    break;

    }

?>