<?php

  switch($_GET['act']){

  default:

?>

<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

               <a href="?module=kritik_saran&act=tambah_krisar"> <button type="button" class="btn btn-warning btn-sm">Tambah Kritik Saran</button></a>



                <!--<select type="text" name="id_kk" class="form-control" id="pk">

                  <option value="a">Pilih Klinik...</option>

                      <?php 



                      $query = mysql_query("SELECT *FROM daftar_klinik");



                      while ($cb = mysql_fetch_array($query)) { 



                        ?>

                      <option value="<?php echo $cb['id_kk']?>"><?php echo $cb['nama_klinik']; ?></option>

                      <?php  } ?> 

                 </select>-->





         </div>





        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Data Kritik dan Saran</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table id="example1" class="table table-bordered table-striped">

                  <thead>

            <tr>

                 <th>Tanggal</th>

                 <th>Nama</th>

                 <th>No Telepon</th>

                 <th>Beauty</th>

                 <th>Kritik Dan Saran</th>

                 

                 

                 <!-- <th>Aksi</th> -->

               

            </tr>

        </thead>

      <tbody>

    <?php

    $tampil   = mysql_query("Select * From krisar");

    while($r  = mysql_fetch_array($tampil)){

    ?>

      <tr class="gradeX">

                <td><?php echo $r["tanggal"]; ?></td>

                <td><?php echo $r["nama"]; ?></td>

                <td><?php echo $r["no_telp"]; ?></td>

                <td><?php echo $r["beauty"]; ?></td>

                <td><?php echo $r["krisar"]; ?></td>

            <!-- <td>

                     

                     <a href="?module=kritik_saran&act=edit_krisar&id_krisar=<?php echo $r["id_krisar"]; ?>" class="btn btn-xs btn-success"><i class="fa fa-edit"></i> Edit</a>&nbsp;<a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/kritik_saran/aksi_krisar.php?module=krisar&act=hapus&id_krisar=<?php echo $r['id_krisar']; ?>" class="btn btn-xs btn-danger"><i class="fa fa-trash-o"></i> Hapus</a>

                     

                  

                </td> -->

               

      </tr>

    <?php

            }

        ?>

    </tbody>

                </table>

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

    $("#pk").change(function(){

      var select = $(this).val();

      window.location.href = "http://localhost/klinik-kecantikan/redaktur/media.php?module=produk&id="+select;

    })

});

</script>

<!--

   -->





<?php

  break;

  case "tambah_krisar":

?>



<section class="content">

    

    <div class="row">

    <div class="col-md-12">

          <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">Tambah Kategori Produk</h3>



        </div>

        <!-- /.box-header -->

        <div class="box-body"> 

        	<form method="post" enctype="multipart/form-data" action="modul/kritik_saran/aksi_krisar.php?module=krisar&act=input">

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Cabang Klinik</label>

                <select name="cabang" class="form-control" required>

                   <option value="">-- Pilih Cabang --</option>

      <?php

        $data     = mysql_query("Select * From daftar_klinik");            

              while($hasil  = mysql_fetch_array($data)){

      ?>

        <option value="<?php echo $hasil['id_kk']; ?>"><?php echo $hasil['nama_klinik']; ?></option>            

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

                <label>Tanggal</label>

                <input type="text" class="form-control" name="tanggal" value="<?php echo date('Y-m-d') ?>" readonly/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Nama</label>

                <input type="text" class="form-control" name="nama" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Nomor Telepon</label>

                <input type="text" class="form-control" name="no_telp" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Beauty</label>

                <input type="text" class="form-control" name="beauty" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Kritik dan Saran</label>

                <textarea type="text" class="form-control" name="krisar" required></textarea>

              </div>

              </div>

            </div>

             <div class="row">

            <div class="col-md-12">

              <div class="form-group">

               <a href="?module=kritik_saran"><button type="button" class="btn btn-danger">Batal</button></a>

                  <button type="submit" class="btn btn-success">Simpan</button>

              </div>

              </div>

            </div></form>

              </div>

        </div>

        </div>

    </div>

</section>



<!--

     -->

<?php

  break;

  case "edit_krisar":

  $id_krisar   = $_GET['id_krisar'];

  $edit   = mysql_fetch_array(mysql_query("Select * From krisar Where id_krisar='$id_krisar'"));

?>



<section class="content">

    

    <div class="row">

    <div class="col-md-12">

          <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">Edit Kritik dan Saran</h3>



        </div>

        <!-- /.box-header -->

        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/kritik_saran/aksi_krisar.php?module=krisar&act=update">

          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Jenis Cabang</label>

                <select name="cabang" class="form-control" required>

                 <?php

                    $ca   = mysql_query("Select * From daftar_klinik");

                    if ($edit['id_kk'] =='') {

                ?>

                    <option value="" selected>-- Pilih Cabang --</option>

                <?php

                }

                    while ($edit_ca   = mysql_fetch_array($ca)) {

                    if ($edit_ca['id_kk']  == $edit['id_kk']) {

                    ?>

                        <option value="<?php echo $edit_ca['id_kk']; ?>" selected><?php echo $edit_ca['nama_klinik']; ?></option>

                    <?php

                    } else {

                    ?>

                        <option value="<?php echo $edit_ca['id_kk']; ?>"><?php echo $edit_ca['nama_klinik']; ?></option>

                    <?php

                    }

                    }

                ?>

                </select>

              </div>

              </div>

            </div>

          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Tanggal</label>

                <input type="text" class="form-control" name="tanggal" value="<?php echo $edit['tanggal'] ?>" readonly/>

                <input type="hidden" class="form-control" name="id_krisar" value="<?php echo $edit[id_krisar] ?>" readonly/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Nama</label>

                <input type="text" class="form-control" name="nama" value="<?php echo $edit[nama] ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Nomor Telepon</label>

                <input type="text" class="form-control" name="no_telp" value="<?php echo $edit[no_telp] ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Beauty</label>

                <input type="text" class="form-control" name="beauty" value="<?php echo $edit[beauty] ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Kritik dan Saran</label>

                <input type="text" class="form-control" name="krisar" value="<?php echo $edit[krisar] ?>" required></input>

              </div>

              </div>

            </div>

             <div class="row">

            <div class="col-md-12">

              <div class="form-group">

               <a href="?module=kritik_saran"><button type="button" class="btn btn-danger">Batal</button></a>

                  <button type="submit" class="btn btn-success">Simpan</button>

              </div>

              </div>

            </div></form>

              </div>

        </div>

        </div>

    </div>

</section>

<?php

  break;

  }

?>