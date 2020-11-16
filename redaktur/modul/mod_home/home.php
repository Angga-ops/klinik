<style type="text/css">
  .icon {
    margin-top: 15px;
  }
</style>
<section class="content-header">
      <h1>
        <?php
		
		/* if ($_SESSION['jenis_u']=='JU-01') {
          echo "Administrator";
        }else if ($_SESSION['jenis_u']=='JU-06'){
          echo "Resepsionis";
        }else{
          echo "Dokter";
        }*/
           

		?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="#"><i class="fa fa-home"></i> Home</a></li>
      </ol>
    </section>
<?php 

if($_SESSION['jenis_u']!="JU-01"){ ?>
<section class="content" style="margin-top: 10px;">
<?php $daten = date("Y-m-d"); 
$id_kk = $_SESSION['klinik'];
?>

<div class="row">
    
<div class="col-md-12">
  <div class="callout callout-success">
    <?php $k =  mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$id_kk'");
     $kk =  mysqli_fetch_array($k); ?>
     <h4 style="text-transform: uppercase;">SELAMAT DATANG DI KLINIK <?php echo $kk['nama_klinik']; ?></h4>
    </div>
  </div>
</div>
<?php 
$date_now = date("Y-m-d");
$q1  = mysqli_query($con, "SELECT * FROM antrian_pasien WHERE tanggal_pendaftaran='$date_now' AND jenis_layanan IN ('igd','poliklinik') AND rujuk_inap IS NULL");
$mp  = mysqli_num_rows($q1);
$q2  = mysqli_query($con, "SELECT *FROM history_ap WHERE tanggal_pendaftaran='$date_now'");
$mp2 = mysqli_num_rows($q2);
$tot = $mp+$mp2;
$q3  = mysqli_query($con, "SELECT *FROM history_ap WHERE tanggal_pendaftaran='$date_now' AND pembayaran='Belum Lunas'");
$mp3 = mysqli_num_rows($q3);
?>

  <?php if ($_SESSION['jenis_u']=="JU-06") { ?>
    <div class="row">
    <div class="col-md-3">
      <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $mp; ?></h3>

            <p>Pasien yang sedang<br> mengantri</p>
          </div>
          <div class="icon">
          <i class="fa fa-plus-circle"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $mp3; ?></h3>

            <p>Pasien yang sedang<br> mengantri pembayaran</p>
          </div>
          <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>
    <div class="col-md-3">
      <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $tot; ?></h3>

            <p>Total Pasien yang<br>berkunjung hari ini</p>
          </div>
          <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
       <div class="col-md-3">
      <a href="media.php?module=kasir">
        <div class="small-box bg-blue">
            <div class="inner">
              <h3>+</h3>

            <p>Pendaftaran Antrian</p>
            </div>
            <div class="icon">
            <i class="fa fa-shopping-cart"></i>
          </div>
        </div>
      </a>
    </div>
  </div>
    <?php }else if($_SESSION['jenis_u']=="JU-02"){
      ?>
      <div class="row">
    <div class="col-md-4">
      <div class="small-box bg-aqua">
          <div class="inner">
            <h3><?php echo $mp; ?></h3>

            <p>Pasien yang sedang<br> mengantri</p>
          </div>
          <div class="icon">
          <i class="fa fa-plus-circle"></i>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-yellow">
          <div class="inner">
            <h3><?php echo $mp3; ?></h3>

            <p>Pasien yang sedang<br> mengantri pembayaran</p>
          </div>
          <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
      </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-green">
          <div class="inner">
            <h3><?php echo $tot; ?></h3>

            <p>Total Pasien yang<br>berkunjung hari ini</p>
          </div>
          <div class="icon">
          <i class="fa fa-users"></i>
        </div>
      </div>
    </div>
  </div>

    <?php
    } ?>
   


  
    
      <?php if($_SESSION['jenis_u']=="JU-08"){ ?>
        <div class="row">
 <div class="col-md-6">
        <div class="box box-success">
    <div class="box-header">
      <h3 class="box-title">Notice Dokter Hari ini Untuk Pemeriksaan Pasien</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered datatable2">
          <thead>
            <tr>
              <th>Nama Pasien</th>
              <th>No Faktur</th>
              <th>Nama Dokter</th>
              <th>Status</th>
              <th>Ruang Perawatan</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $now = date("Y-m-d");
            $q4 =  mysqli_query($con, "SELECT id_pasien,(SELECT nama_pasien FROM pasien WHERE id_pasien = noticelab.id_pasien) pasien,no_faktur,(SELECT nama_lengkap FROM user WHERE id_user = noticelab.id_dr) dr, status FROM noticelab WHERE tgl = '$now'"); 
              while ($s = mysqli_fetch_array($q4)) { 

                $jalan = mysqli_fetch_assoc(mysqli_query($con, "SELECT id FROM antrian_pasien WHERE no_faktur = '$s[no_faktur]' AND rujuk_inap IS NULL"));
                $bang = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_ruangan AS sal FROM ruangan a JOIN perawatan_pasien b ON a.id = b.id_ruang WHERE b.no_faktur = '$s[no_faktur]'"));

                if(is_null($jalan['id'])){
                  $rawat = "Rawat Inap";
                  $ruang = $bang['sal'];
                } else {
                  $rawat = "Rawat Jalan";
                }

                ?>
            <tr>
              <td><?php echo $s["pasien"]; ?></td>
              <td><?php echo $s["no_faktur"]; ?></td>
              <td><?php echo $s["dr"]; ?></td>
              <td><?php echo $rawat; ?></td>
              <td><?php echo $ruang; ?></td>
              <td> 
                <?php
                  if($s['status']=='T'){
                ?>
                      <a href="modul/mod_home/antrian.php?nofak=<?php echo $s['no_faktur']; ?>&id=<?php echo $s['id_pasien']; ?>" class="btn btn-xs btn-primary">Antri</a>
                    </td>
                  <?php }
                  else{
                  ?>
                 <span class='badge bg-green'><i class='fa fa-check'></i></span></td>
                <?php } ?>
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
  <div class="col-md-6">
    <div class="box box-success">
    <div class="box-header">
      <h3 class="box-title">Antrian Pasien</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered datatable2">
          <thead>
            <tr>
              <th>No Faktur</th>
                    <th>Nama Pasien</th>
                    <th>Pengunjung Ke</th>
              <th>Aksi</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            $now = date("Y-m-d");
            $q5 =  mysqli_query($con, "SELECT no_faktur,(SELECT nama_pasien FROM pasien WHERE id_pasien = antrian_pasien.id_pasien) pasien, no_urut FROM antrian_pasien WHERE tanggal_pendaftaran = '$now' AND jenis_layanan='lab' AND status is NULL ORDER BY no_urut DESC"); 
            $no=1;
              while ($s1 = mysqli_fetch_array($q5)) {
                ?>
            <tr>
              <td><?php echo $s1["no_faktur"]; ?></td>
              <td><?php echo $s1["pasien"]; ?></td>
              <td><?php echo $s1["no_urut"]; ?></td>
              <td> 
                <a href="media.php?module=lab_treatment&nofak=<?php echo $s1['no_faktur']; ?>&id=<?php echo $s1['id_pasien']; ?>" class="btn btn-xs btn-primary">Panggil</a>
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
  </div>
  <?php } else {} ?>

        <div class="col-md-12">
          <!-- Antrian Pasien -->
         <?php
         if($_SESSION['jenis_u'] != "JU-08"){
          ?>

          <div class="box box-success">
                    <div class="box-header">
                      <h3 class="box-title">Pasien Yang Sedang mengantri <?php
                      
                      $doc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = $_SESSION[id_dr]"));

                     if(is_null($doc["nama_lengkap"])){ } else {
                      echo "untuk Dokter ".$doc["nama_lengkap"];
                     }
                      
                      ?></h3>
                    </div>
                    <!-- /.box-header -->
                    <div class="box-body">
                      <div class="callout callout-success">
                        <?php
                        
                        $docs = isset($_SESSION['id_dr'])? "AND id_dr = $_SESSION[id_dr]" : "";
                        if($_SESSION['jenis_u']=="JU-10"){

                          //cari range expired
           $skrg = date("d");
           if($skrg <= 24){
           $now = date("Y-m-24");
           $last = date("Y-m",strtotime("-1 month"))."-25";
           } else {
            $last = date("Y-m-25");
            $now = date("Y-m",strtotime("+1 month"))."-24";
           }

                    //hari perawat login
                    $hari = date("N",strtotime($date_now));
                    
                  //cari id_dr
                  $nrs = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_dr FROM dr_praktek a JOIN nurse b ON a.id_drpraktek = b.drpraktek
                  WHERE b.perawat = '$_SESSION[id_user]'  AND a.hari = '$hari' AND a.expired >= '$last' AND a.expired <= '$now'"));
                  $id_dr = $nrs['id_dr'];

                          $tot = mysqli_num_rows(mysqli_query($con, "SELECT *FROM antrian_pasien 
                      JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.status IS NULL AND id_dr='$id_dr' AND antrian_pasien.tanggal_pendaftaran = '$date_now' AND antrian_pasien.rujuk_inap IS NULL"));
                        }
                        else{
                          $tot = mysqli_num_rows(mysqli_query($con, "SELECT * FROM antrian_pasien WHERE tanggal_pendaftaran='$date_now' $docs AND jenis_layanan IN ('igd','poliklinik') AND rujuk_inap IS NULL")); 
                        }
                        ?>
                        <p>Jumlah Total Antrian Pasien <?php echo $tot; ?></p>
                        <?php
                          if($_SESSION['jenis_u']=="JU-06"){
                            $query1 = mysqli_query($con, "SELECT * FROM poliklinik");
                            while($f1 = mysqli_fetch_assoc($query1)){
                              $query2 = mysqli_num_rows(mysqli_query($con, "SELECT * FROM antrian_pasien WHERE status IS NULL AND tanggal_pendaftaran = '$date_now' AND rujuk_inap IS NULL AND poliklinik='$f1[id_poli]'"));
                            ?>
                            <p>Jumlah Antrian Pasien <?php echo $f1['poli']." ".$query2; ?></p>
                          <?php
                            }
                          }
                        ?>
                    </div>
            <div class="table-responsive">
            <table class="table table-bordered table-striped datatable2">            
              <thead>
                <tr>
                <th>No Faktur</th>
                    <th>Nama Pasien</th>
                    <th>Antrian utk Layanan</th>
                    <th>Pengunjung Ke</th>
                    <th>Pendaftaran Online</th>
                    <th>Pilihan</th>
                </tr>
              </thead>
              <tbody>
                <?php 
                switch ($_SESSION['jenis_u']) {
                  case "JU-02":
                    $id_dr = $_SESSION['id_dr'];
                    $ap = mysqli_query($con, "SELECT *FROM antrian_pasien 
                      JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.status IS NULL AND id_dr='$id_dr' AND antrian_pasien.tanggal_pendaftaran = '$date_now' AND antrian_pasien.rujuk_inap IS NULL ORDER BY antrian_pasien.no_urut ASC");
                    break;

                    case "JU-07":
                    $ap = mysqli_query($con, "SELECT  history_ap.*,pasien.*,history_ap.id AS antri_id FROM history_ap 
                    JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE jenis_layanan IN ('poliklinik','igd')  AND history_ap.tanggal_pendaftaran = '$date_now' ORDER BY history_ap.no_urut ASC");

                    break;

                    case "JU-08":
                    $ap = mysqli_query($con, "SELECT  antrian_pasien.*,pasien.*,antrian_pasien.id AS antri_id FROM antrian_pasien 
                    JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.status IS NULL AND jenis_layanan = 'lab'  AND antrian_pasien.tanggal_pendaftaran = '$date_now' ORDER BY antrian_pasien.no_urut ASC");
                    break;

                    case "JU-10":

                      //cari range expired
           $skrg = date("d");
           if($skrg <= 24){
           $now = date("Y-m-24");
           $last = date("Y-m",strtotime("-1 month"))."-25";
           } else {
            $last = date("Y-m-25");
            $now = date("Y-m",strtotime("+1 month"))."-24";
           }

                    //hari perawat login
                    $hari = date("N",strtotime($date_now));
                    
                  //cari id_dr
                  $nrs = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_dr FROM dr_praktek a JOIN nurse b ON a.id_drpraktek = b.drpraktek
                  WHERE b.perawat = '$_SESSION[id_user]'  AND a.hari = '$hari' AND a.expired >= '$last' AND a.expired <= '$now'"));
                  $id_dr = $nrs['id_dr'];

                    $ap = mysqli_query($con, "SELECT *FROM antrian_pasien 
                      JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.status IS NULL AND id_dr='$id_dr' AND antrian_pasien.tanggal_pendaftaran = '$date_now' AND antrian_pasien.rujuk_inap IS NULL ORDER BY antrian_pasien.no_urut ASC");

                    break;
                  
                  default:
                    $ap = mysqli_query($con, "SELECT  antrian_pasien.*,pasien.*,antrian_pasien.id AS antri_id FROM antrian_pasien 
                      JOIN pasien ON antrian_pasien.id_pasien=pasien.id_pasien WHERE antrian_pasien.status IS NULL AND jenis_layanan IN ('igd','poliklinik') AND antrian_pasien.tanggal_pendaftaran = '$date_now' AND antrian_pasien.rujuk_inap IS NULL ORDER BY antrian_pasien.no_urut ASC");


                    break;
                }

               $no = 1;
                while($i = mysqli_fetch_array($ap)){ ?>
                <tr>
                <td><?php echo $i['no_faktur']; ?></td>
                  <td><?php echo $i['nama_pasien']; ?></td>
                  <td><?php echo strtoupper($i['jenis_layanan']); ?></td>
                  <td><?php echo $i['no_urut']; ?></td>
                  <td><?php if(is_null($i['online'])){ echo "Tidak"; } else { echo "Ya"; } ?></td>
                  <?php if ($_SESSION['jenis_u']=="JU-02") { ?>
                    <td>
                      <a href="media.php?module=pasca_treatment&nofak=<?php echo $i['no_faktur']; ?>&id=<?php echo $i['id_pasien']; ?>" class="btn btn-xs btn-primary">Panggil</a> &nbsp; <a href="#" data-toggle="modal" data-target="#modal-default-notice" class="btn btn-xs btn-warning" onclick="nl(this.id)" id="nl<?php echo $no; ?>" data-faktur="<?php echo $i['no_faktur']; ?>" data-pasien="<?php echo $i['id_pasien']; ?>" data-dr="<?php echo $_SESSION['id_dr']; ?>" data-layanan="jalan" data-jamin="<?php echo $i['jenis_pasien']; ?>">Notice Lab</a>
                    </td>
                    <?php } else if ($_SESSION['jenis_u']=="JU-07"){ $cek = mysqli_num_rows(mysqli_query($con, "SELECT no_faktur FROM kasir_sementara WHERE no_faktur = '$i[no_faktur]' AND jenis = 'Produk'")); if($cek > 0){ ?>
                  <td> 
                      <a href="media.php?module=resep_jalan&faktur=<?php echo $i['no_faktur']; ?>&id=<?php echo $i['id_pasien']; ?>" class="btn btn-xs btn-primary">Panggil</a>
                    </td>
                  <?php } else { echo "<td><span class='badge bg-green'><i class='fa fa-check'></i></span></td>"; } } else if ($_SESSION['jenis_u']=="JU-08"){ ?>
                  <td> 
                      <a href="media.php?module=lab_treatment&nofak=<?php echo $i['no_faktur']; ?>&id=<?php echo $i['id_pasien']; ?>" class="btn btn-xs btn-primary">Panggil</a>
                    </td>
                  <?php } else if ($_SESSION['jenis_u']=="JU-10"){ ?>
                  <td> 
                  <button data-toggle="modal" data-faktur="<?php echo $i['no_faktur']; ?>" data-pasien="<?php echo $i['nama_pasien']; ?>" data-tb="<?php echo $i['tb']; ?>" data-bb="<?php echo $i['bb']; ?>" data-tensi="<?php echo $i['tensi']; ?>" data-respirasi="<?php echo $i['respirasi']; ?>" data-nadi="<?php echo $i['nadi']; ?>" data-suhu="<?php echo $i['suhu']; ?>" data-keluhan="<?php echo $i['keluhan']; ?>" data-target="#modal-default" class="btn btn-xs btn-warning" onclick="editonline(this.id)" id="<?php echo rand(1,200); ?>">Cek Pasien</button>
                    </td>
                  <?php } else {
                    $check = mysqli_query($con, "SELECT * FROM rujuk_inap WHERE antrian_pasien='$i[antri_id]'");
                    if(mysqli_num_rows($check) > 0){
                      ?>
                      <td> <a href="?module=rujuk_inap" class="btn btn-xs btn-warning">Sedang menunggu kamar</a></td>
                    <?php }
                    else {
                    ?>
                      <td> <a href="modul/mod_home/delete.php?id=<?php echo $i['antri_id']; ?>" class="btn btn-xs btn-danger" onclick="return confirm('apakah akan membatalkan?')">Batalkan</a></td>
                 <?php }
                  } ?>
                </tr>
                <?php $no++; }
                ?>
                
              </tbody>
            </table>

            <?php include "add_noticelab.php"; ?>


            <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Pemeriksaan Umum Pasien</h4>
              </div><form action="modul/mod_home/pendol.php" method="POST">
              <div class="modal-body">
                <table class="table">
                <tr>
                <td>No Faktur</td><td><input type="text" class="form-control" name="faktur" id="fakturonline" readonly/></td>
                </tr>
                <tr>
                <td>Pasien</td><td><input type="text" class="form-control" id="pasienonline" readonly/></td>
                </tr>
                <tr>
                <td>Tinggi Badan</td><td><input type="text" class="form-control" name="tb" id="tb" required/></td>
                </tr>
                <tr>
                <td>Berat Badan</td><td><input type="text" class="form-control" name="bb" id="bb" required/></td>
                </tr>
                <tr>
                <td>Tekanan Darah</td><td><input type="text" class="form-control" name="tensi" id="tensi" required/></td>
                </tr>
                <tr>
                <td>Respirasi</td><td><input type="text" class="form-control" name="respirasi" id="respirasi" required/></td>
                </tr>
                <tr>
                <td>Denyut Nadi</td><td><input type="text" class="form-control" name="nadi" id="nadi" required/></td>
                </tr>
                <tr>
                <td>Suhu Badan</td><td><input type="text" class="form-control" name="suhu" id="suhu" required/></td>
                </tr>
                <tr>
                <td>Keluhan</td><td><textarea class="form-control" style="height: 100px" name="keluhan" id="keluhan" required></textarea></td>
                </tr>
                </table>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

<script>
function editonline(id){
  var faktur = $("#" + id).data("faktur");
  var pasien = $("#" + id).data("pasien");
  var tb = $("#" + id).data("tb");
  var bb = $("#" + id).data("bb");
  var tensi = $("#" + id).data("tensi");
  var respirasi = $("#" + id).data("respirasi");
  var nadi = $("#" + id).data("nadi");
  var suhu = $("#" + id).data("suhu");
  var keluhan = $("#" + id).data("keluhan");
  $("#fakturonline").val(faktur);
  $("#pasienonline").val(pasien);
  $("#tb").val(tb);
  $("#bb").val(bb);
  $("#tensi").val(tensi);
  $("#respirasi").val(respirasi);
  $("#nadi").val(nadi);
  $("#suhu").val(suhu);
  $("#keluhan").val(keluhan);
}
</script>


            </div>
             </div>
            </div>
          
         <?php }
         ?>
    <!-- Antrian Pembayaran Produk Pasien -->
          <?php if($_SESSION['jenis_u']=="JU-06"){ ?>
            <!--<div class="box box-success">
                  <div class="box-header">
                    <h3 class="box-title">Antrian Pembayaran Pasien</h3>
                  </div>
                  <!-- /.box-header
                  <div class="box-body">
          <div class="table-responsive">
          <table class="table table-bordered table-striped datatable2">            
            <thead>
              <tr>
                  <th>Nama Pasien</th>
                  <th>Pengunjung Ke</th>
                  <th>Pilihan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $appp = mysqli_query($con, "SELECT nama_pasien,no_urut,history_ap.id_kk,history_ap.tanggal_pendaftaran,no_faktur FROM history_ap JOIN pasien ON history_ap.id_pasien=pasien.id_pasien WHERE pembayaran IN ('Belum Lunas') AND history_ap.tanggal_pendaftaran='$daten' AND history_ap.id_kk='$id_kk' ORDER BY history_ap.no_urut ASC");
              while($iii = mysqli_fetch_array($appp)){ ?>
              <tr>
                <td><?php echo $iii['nama_pasien']; ?></td>
                <td><?php echo $iii['no_urut']; ?></td>
                  <td>
                    <a href="media.php?module=history_transaksi&act=bayar&nofak=<?php echo $iii['no_faktur']; ?>" class="btn btn-xs btn-primary">Bayar</a>
                  </td>
              </tr>
              <?php }
              ?>
              
            </tbody>
          </table>
          </div>
           </div>
          </div>-->
        <?php } ?>
    </div>
    
    </div>


</section>
<!-- Modal -->

<?php
}elseif($_SESSION['jenis_u']=="JU-01"){ 
  $tgl = date("Y-m-d");
  ?>
<section class="content" style="margin-top: 10px;">

  <div class="row">
    <div class="col-md-4">
      <div class="small-box bg-yellow">
          <div class="inner">
            <?php $tp = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS jumlah_total FROM history_kasir WHERE tanggal='$tgl' AND jenis='Produk' ")); ?>
            <h3><?php if(empty($tp['jumlah_total'])){ echo "0"; }else{  echo $tp['jumlah_total']; }   ?></h3>

            <p>Total Pendaftaran Pasien<br>hari ini</p>
          </div>
          <div class="icon">
          <i class="fa fa-cubes"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-red">
          <div class="inner">
            <?php $tt = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS jumlah_total FROM history_kasir WHERE tanggal='$tgl' AND jenis='Treatment' ")); ?>
            <h3><?php if(empty($tt['jumlah_total'])){ echo "0"; }else{ echo $tt['jumlah_total']; } ?></h3>

            <p>Total <br>Pasien Rawat Inap hari ini</p>
          </div>
          <div class="icon">
          <i class="fa fa-plus-circle"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
    <div class="col-md-4">
      <div class="small-box bg-green">
          <div class="inner">
            <?php $tp = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) AS jumlah FROM pembayaran WHERE tgl='$tgl'")); ?>
            <h3><?php echo rupiah($tp['jumlah']); ?></h3>

            <p>Total pendapatan<br> hari ini</p>
          </div>
          <div class="icon">
          <i class="fa fa-dollar"></i>
        </div>
        <!-- <a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a> -->
      </div>
    </div>
  </div>
  <!-- Table dari cabang -->
  <div class="row">
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header">
          <h4 class="box-title">Pendapatan Klinik Hari Ini</h4>
        </div>
        <div class="box-body">
          <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Total Pendapatan</th>
              </tr>
            </thead>
            <tbody>
              <?php 
                $q2 = mysqli_query($con, "SELECT *FROM daftar_klinik");
                while($data2 = mysqli_fetch_array($q2)){ ?>
                  <tr>
                    <td><?php echo $data2['nama_klinik']; ?></td>
                    <td><?php $pem = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(total) AS jumlah FROM pembayaran WHERE id_kk='$data2[id_kk]' AND tgl='$tgl'")); if(empty($pem['jumlah'])){ echo rupiah("0"); }else{ echo rupiah($pem['jumlah']); } ?></td>
                  </tr>
                <?php }
               ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>

   <!--<div class="box box-success">
        <div class="box-header">
          <h4 class="box-title">Penjualan Produk</h4>
        </div>
        <div class="box-body">
          <div class="table-responsive">
          <table class="table table-striped table-bordered datatable">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Total Terjual</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $q1 = mysqli_query($con, "SELECT *FROM daftar_klinik");
              while($data = mysqli_fetch_array($q1)){  ?>
                <tr>
                  <td><?php echo $data['nama_klinik']; ?></td>
                  <td><?php $kk = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS jumlah_total FROM history_kasir WHERE id_kk='$data[id_kk]' AND tanggal='$tgl' AND jenis='Produk' ")); if(empty($kk['jumlah_total'])){ echo "0"; }else{ echo $kk['jumlah_total']; } ?></td>
                </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>-->

    </div>
    <div class="col-md-6">
      <div class="box box-success">
        <div class="box-header">
          <h4 class="box-title">Stok Obat Yang Akan Habis</h4>
        </div>
        <div class="box-body">
          <div class="table-responsive">
          <table class="table table-bordered">
            <thead>
              <tr>
                
                <th>Nama Produk</th>
                <th>Stok</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $q1 = mysqli_query($con, "SELECT *FROM produk limit 15");
              while($data = mysqli_fetch_array($q1)){  
                if ($data['jumlah']>$data['batas_minim']) {
                  continue;
                }
                ?>
                <tr>
                          <td><?php echo $data['nama_p']; ?></td>
                  <td><?php echo $data['jumlah']; ?></td>
                </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>

    <!--  <div class="box box-success">
        <div class="box-header">
          <h4 class="box-title">Penjualan Treatment</h4>
        </div>
        <div class="box-body">
          <div class="table-responsive">
          <table class="table table-striped table-bordered datatable">
            <thead>
              <tr>
                <th>Nama Klinik</th>
                <th>Total Terjual</th>
              </tr>
            </thead>
            <tbody>
              <?php 
              $q1 = mysqli_query($con, "SELECT *FROM daftar_klinik");
              while($data = mysqli_fetch_array($q1)){  ?>
                <tr>
                  <td><?php echo $data['nama_klinik']; ?></td>
                  <td><?php $kk = mysqli_fetch_array(mysqli_query($con, "SELECT SUM(jumlah) AS jumlah_total FROM history_kasir WHERE id_kk='$data[id_kk]' AND tanggal='$tgl' AND jenis='Treatment' ")); if(empty($kk['jumlah_total'])){ echo "0"; }else{ echo $kk['jumlah_total']; } ?></td>
                </tr>
              <?php 
              }
              ?>
            </tbody>
          </table>
          </div>
        </div>
      </div>
-->
    </div>
  </div>

<!-- Grafik -->
<div class="row">
  <div class="col-md-12">
    <div class="box">
     <div class="box-header">
        <h3 class="box-title">Grafik Pendapatan </h3>
     </div>
      <div class="box-body">
        <form action="" method="post">
           <div class="row">
            <div class="col-md-6">

              

              <div class="form-group">
                <label>Nama Klinik</label>
                  
                <select class="form-control" id="jenis_klinik" name="jenis_klinik">
                  
                  <?php
                        $sql = 'SELECT * from daftar_klinik';
                        $query  = mysqli_query($con, $sql);
                    while ($row = mysqli_fetch_array($query)) {
                    ?>
                    <option value="<?php echo $row['id_kk']; ?>"><?php echo $row['nama_klinik']; ?></option>
                  <?php }?>
                </select>
              </div>
              <div class="form-group">
              <button type="submit" name="submit" class="btn btn-primary col-md-6"><i class="fa fa-search"></i> Tampilkan</button>
            </div>
              </div>
            </div>

            
          
        <div>
        <canvas id="pendapatan" class="pendapatan" style="height:100px"></canvas>  
        </div>
        
        
        <script>
                  var ctx = document.getElementById("pendapatan").getContext('2d');
                  
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [
                      <?php
                      $klinik = mysqli_query($con, "SELECT tanggal, SUM(harga*jumlah) as total FROM history_kasir WHERE id_kk='$_POST[jenis_klinik]' group by tanggal");
                      while ($t=mysqli_fetch_array($klinik)) { ?>
                      "<?php echo $t['tanggal']; ?>",
                      <?php  } ?>
                      ],
                      datasets: [{
                        label: '',
                        data: [
                         <?php
                        $klinik = mysqli_query($con, "SELECT tanggal, SUM(harga*jumlah) as total FROM history_kasir WHERE id_kk='$_POST[jenis_klinik]' group by tanggal");
                        while ($t=mysqli_fetch_array($klinik)) { ?>
                        "<?php echo $t['total']; ?>",
                        <?php  } ?>
                        ],
                        backgroundColor: [
                        'rgba(255, 99, 132, 0.2)',
                        'rgba(54, 162, 235, 0.2)',
                        'rgba(255, 206, 86, 0.2)',
                        'rgba(75, 192, 192, 0.2)'
                        ],
                        borderColor: [
                        'rgba(255,99,132,1)',
                        'rgba(54, 162, 235, 1)',
                        'rgba(255, 206, 86, 1)',
                        'rgba(75, 192, 192, 1)'
                        ],
                        borderWidth: 1
                      }]
                    },
                    options: {
                      scales: {
                        yAxes: [{
                          ticks: {
                            beginAtZero:true
                          }
                        }]
                      }
                    }
                  });
                </script>                </form>
                
      </div>
      </div>
  </div>


  
  </section>
<?php 
}