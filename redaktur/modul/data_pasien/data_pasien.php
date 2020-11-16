<?php

  switch($_GET['act']){

  default:

?>



<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

<div class="row">
      <div class="col-md-2">
                <a target="_blank" href="report/rpt_lap_pasien.php"> <button type="button" class="btn btn-warning btn-sm">Laporan Data Pasien</button></a>
</div>

<div class="col-md-6">
<div class="col-md-6" style="margin-top: 2%">Tampilkan data menurut</div>
<div class="col-md-6">
<select class="form-control" id="abjad">
<option value="1">abjad A - B</option>
<option value="2">abjad C - D</option>
<option value="3">abjad E - F</option>
<option value="4">abjad G - H</option>
<option value="5">abjad I - J</option>
<option value="6">abjad K - L</option>
<option value="7">abjad M - N</option>
<option value="8">abjad O - P</option>
<option value="9">abjad Q - R</option>
<option value="10">abjad S - T</option>
<option value="11">abjad U - V</option>
<option value="12">abjad W - X</option>
<option value="13">abjad Y - Z</option>
<option value="all">semua abjad</option>
</select>
</div>
</div>
<div class="col-md-4">
<button class="btn btn-info xbtn">Tampilkan</button>
</div>

</div>


    </div>

        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box">

            <div class="box-header">

              <h3 class="box-title">Data Pasien</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                <div class="table-responsive" >

              <table style="overflow-x: scroll;" class="table table-bordered table-striped">

                  <thead>

            <tr>

              <th>No.RM</th>

                 <th>Nama Pasien</th>

                 <th>Tanggal Lahir</th>

                 <th>Alamat</th>
				<th>HP</th>
				 <th>Pekerjaan</th>
                 <th>Tanggal Daftar</th>
				 

                 <th>Total Kunjungan</th>

                 <th>Pilihan</th>

            </tr>

        </thead>

      <tbody>

    <?php

    $id_kk = $_SESSION['klinik'];

    if(!isset($_GET["act"])){
      $where1 = "WHERE nama_pasien RLIKE '^[A-B]'";
      $where2 = "AND nama_pasien RLIKE '^[A-B]'";
    } else {
      switch($_GET["act"]){
        case "1": $rlike = "^[A-B]"; break;
        case "2": $rlike = "^[C-D]"; break;
        case "3": $rlike = "^[E-F]"; break;
        case "4": $rlike = "^[G-H]"; break;
        case "5": $rlike = "^[I-J]"; break;
        case "6": $rlike = "^[K-L]"; break;
        case "7": $rlike = "^[M-N]"; break;
        case "8": $rlike = "^[O-P]"; break;
        case "9": $rlike = "^[Q-R]"; break;
        case "10": $rlike = "^[S-T]"; break;
        case "11": $rlike = "^[U-V]"; break;
        case "12": $rlike = "^[W-X]"; break;
        case "13": $rlike = "^[Y-Z]"; break;
        case "all": $rlike = "."; break;
      }
      $where1 = "WHERE nama_pasien RLIKE '$rlike'";
      $where2 = "AND nama_pasien RLIKE '$rlike'";
    }

      if (isset($_GET['pageno'])) {
          $pageno = $_GET['pageno'];
      } else {
          $pageno = 1;
      }
      $no_of_records_per_page = 10;
      $offset = ($pageno-1) * $no_of_records_per_page;
      if ($_SESSION['jenis_u'] =="JU-01") {

        $total_pages_sql  = mysqli_query($con, "SELECT * FROM pasien  $where1");

      }else{

        $total_pages_sql  = mysqli_query($con, "SELECT * From pasien WHERE id_kk = '$id_kk'  $where2");

      }
      //$result = mysql_query($total_pages_sql);
      $total_rows = mysqli_num_rows($total_pages_sql);
      $total_pages = ceil($total_rows / $no_of_records_per_page);
      if ($_SESSION['jenis_u'] =="JU-01") {

        $data  = mysqli_query($con, "SELECT * FROM pasien  $where1 order by nama_pasien ASC LIMIT $offset, $no_of_records_per_page");

      }else{

        $data  = mysqli_query($con, "SELECT * FROM pasien WHERE id_kk = '$id_kk'  $where2 order by nama_pasien ASC LIMIT $offset, $no_of_records_per_page");

      }
      if(mysqli_num_rows($data) > 0){
      while($r    = mysqli_fetch_array($data))
      {
      ?>
      <tr class="gradeX">

        <td><?php echo $r["id_pasien"]; ?></td>

            <td><?php echo $r["nama_pasien"]; ?></td>

            <td><?php echo $r["tgl_lahir"] ?></td>

            <td><?php echo $r["alamat"] ?></td>
            <td><?php echo $r["no_telp"] ?></td>
            <td><?php echo $r["pekerjaan"] ?></td>

            <td><?php echo $r["tgl_pendaftaran"] ?></td>

            <td><?php echo $r["total_kunjungan"] ?></td>

            <td>

              <a href="media.php?module=lap_transaksi&act=detail&np=<?php echo $r["nama_pasien"]; ?>" class="btn btn-xs btn-info col-md-12"><i class="fa fa-check"></i> Cek</a><br><a href="?module=data_pasien&act=edit_pasien&id=<?php echo $r["id"]; ?>" class="btn btn-xs btn-warning col-md-12"><i class="fa fa-edit"></i> Edit</a>
               <a onclick="return confirm('Yakin Ingin Menghapus Data Pasien ini?')" href="modul/data_pasien/aksi_pasien.php?module=data_pasien&act=hapus&id_pasien=<?php echo $r['id']; ?>" class="btn btn-xs btn-danger col-md-12"><i class="fa fa-trash-o"></i> Hapus</a>

            </td>

        </tr> 
    <?php }
  }
   else{ ?>
            <tr class="gradeX">
              <td colspan="10" align="center">Data Tidak ditemukan</td>
            </tr>
          <?php }

    $currentpage = $_SERVER['REQUEST_URI'];
    ?>


    </tbody>

                </table>
            </div>
            <div class="row" style="float: right;margin-right: 0px;">
              <ul class="pagination">
                <li class="paginate_button">
                        <a class="page-link" href="<?php echo $currentpage ?>&pageno=<?php echo 1; ?>">First</a>
                    </li>
                      <?php
                  $brake = $pageno+2;
                  if($pageno <= 3){
                    $start = 1;
                  }
                  else{
                    $start = $pageno-2;
                    ?>
                <li class="paginate_button">
                        <a class="page-link" href="<?php if($pageno <= 1){ echo '#'; } else { echo "<?php echo $currentpage ?>&pageno=".($pageno - 1); } ?>">Prev</a>
                    </li>
                     <li class="paginate_button disabled"><a class="page-link">...</a></li>
                    <?php
                  }
                  for ($i=$start; $i <= $brake ; $i++) {
                    if($pageno >= $total_pages){
                        $brake = $total_pages;
                      }
                      else{
                        $brake = $pageno+2;
                      }
                      ?>
                    <li class="page-item <?php if($i == $pageno){echo"active";} ?>"><a class="page-link" href="<?php echo $currentpage ?>&pageno=<?php echo $i; ?>"><?php echo $i; ?></a></li>
                    <?php
                  }
                  if($pageno > 3) {
                 ?>
                 <li class="paginate_button disabled"><a class="page-link">...</a></li>
                 <li><a class="page-link" href="<?php if($pageno >= $total_pages){ echo '#'; } else { echo "<?php echo $currentpage ?>&pageno=".($pageno + 1); } ?>">Next</a></li>
                 <?php } ?>
                 <li class="paginate_button">
                        <a class="page-link" href="<?php echo $currentpage ?>&pageno=<?php echo $total_pages; ?>">Last</a>
                    </li>
                </ul>
            </div>

     </div></div></div></div>



</section>

<!-- DataTables -->

  <link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

$(document).ready(function(){

  $(".xbtn").click(function(){
    var act = ($("#abjad").val() == "all")? "&act=all" : "&act=" + $("#abjad").val();
    location.href="media.php?module=data_pasien" + act;
  });

    $("#example1").DataTable();

});

</script>



<?php

  break;

  case "edit_pasien":

  $id   = $_GET['id'];

  $edit   = mysqli_fetch_array(mysqli_query($con, "Select * From pasien Where id='$id'"));

?>



<section class="content">

    

    <div class="row">

    <div class="col-md-12">

          <div class="box box-success">

        <div class="box-header with-border">

          <h3 class="box-title">Edit Kategori</h3>



        </div>

        <!-- /.box-header -->

        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/data_pasien/aksi_pasien.php?module=data_pasien&act=update">

          <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>No.RM</label>

                <input type="hidden" class="form-control" name="id"  value="<?php echo $edit['id']; ?>" required/>

                <input type="text" class="form-control" name="norm"  value="<?php echo $edit['id_pasien']; ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Nama Pasien</label>

                <input type="text" class="form-control" name="nama"  value="<?php echo $edit['nama_pasien']; ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Alamat</label>

                <input type="text" class="form-control" name="alamat"  value="<?php echo $edit['alamat']; ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Jenis Kelamin</label>

                <select class="form-control" name="jk">

                  <?php if ($edit['jk'] == "") {

                    echo "<option>Pilih jenis Kelamin</option>";

                  }else{

                    echo "<option value=".$edit['jk'].">".$edit['jk']."</option>";

                  }?>

                    <option value="L">Laki-Laki</option>

                    <option value="P">Perempuan</option>

                </select>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Tanggal Lahir</label>

                <input type="date" class="form-control" name="tgl_lahir"  value="<?php echo $edit['tgl_lahir']; ?>" autocomplete="off" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>No.Telpon</label>

                <input type="text" class="form-control" name="no_telp"  value="<?php echo $edit['no_telp']; ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Tgl Pendaftaran</label>

                <input type="date" autocomplete="off" class="form-control" name="tgl_pendaftaran"  value="<?php echo $edit['tgl_pendaftaran']; ?>" required/>

              </div>

              </div>

            </div>

            <div class="row">

            <div class="col-md-12">

              <div class="form-group">

                <label>Pekerjaan</label>

                <input type="text" class="form-control" name="pekerjaan"  value="<?php echo $edit['pekerjaan']; ?>" required/>

              </div>

              </div>

            </div>

             <div class="row">

            <div class="col-md-12">

              <div class="form-group">

               <a href="?module=data_pasien"><button type="button" class="btn btn-danger">Batal</button></a>

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





