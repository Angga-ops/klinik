<?php    
  switch($_GET['act']){
  default:

?>
<section class="content">
  <div class="box box-success">
    <div class="box-header">
      <h4 class="box-title">Laporan Pelanggan</h4>
    </div>
    <div class="box-body">
      <div class="row" style="margin-bottom: 5px;">
        <div class="col-md-6">
          <form method="POST">
              <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
          <table class="table">
            <tbody>
              <tr>
                <td>
                <label>Pilih Klinik</label>
                <select name="klinik" class="form-control" autocomplete="off" style="float: left;text-align: center;">
                  <option value="NULL">Pilih Klinik</option>
                  <?php
                  $q = mysql_query("SELECT * FROM daftar_klinik");
                  while ($data = mysql_fetch_array($q)) {?>
                    <option value="<?php echo $data['id_kk']?>"><?php echo $data['nama_klinik']?></option>
                  <?php }?>
                </select>
                </td>
              </tr>
              <tr>
                <td><button type="submit" name="submit" class="btn btn-info">Tampilkan</button></td></td>
              </tr>
            </tbody>
          </table>
        </div>
      </div>
      <?php 
      $tgl1 = $_POST['tgl1'];
      $tgl2 = $_POST['tgl2'];
      $klinik = $_POST['klinik'];
      if ($klinik == NULL ) {
        echo '
        <table class="table table-bordered table-striped" id="example1">
        <thead>
          <tr>
            <th>No.RM</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Tgl Lahir</th>
            <th>Telepon</th>
            <th>Tgl Daftar</th>
            <th>Pekerjaan</th>
          </tr> 
        </thead>
        <tbody>
        </tbody>
        <tfoot>
          <tr>
            <td></td>
            
          </tr>
        </tfoot>
      </table>';
      }else{
        echo'
            <table class="table table-bordered table-striped" id="example2">
        <thead>
          <tr>
          <th>Nama Klinik</th>
          <th>No.RM</th>
            <th>Nama Pasien</th>
            <th>Alamat</th>
            <th>Tgl Lahir</th>
            <th>Telepon</th>
            <th>Tgl Daftar</th>
            <th>Pekerjaan</th>
          </tr> 
        </thead>
        <tbody>';

            
            if ($id_kk != 0) {
              $p = mysql_query("SELECT *FROM pasien where id_kk='$_POST[klinik]'"); 
              while($dat=mysql_fetch_array($p)){
                $q1 = mysql_query("SELECT * FROM daftar_klinik where id_kk='$dat[id_kk]'");
                      $k = mysql_fetch_array($q1);
                echo '
                    <tr>
                      <td>'.$k['nama_klinik'].'</td>
                      <td>'.$dat["id_pasien"].'</td>
                      <td>'.$dat["nama_pasien"].'</td>
                      <td>'.$dat['alamat'].'</td>
                      <td>'.$dat['tgl_lahir'].'</td>
                      <td>'.$dat['no_telp'].'</td>
                      <td>'.$dat['tgl_pendaftaran'].'</td>
                      <td>'.$dat['pekerjaan'].'</td>
                              
                  </tr>';
              }
            }elseif($id_kk == 0){
              $klinik = $_POST['klinik'];
              $p = mysql_query("SELECT * FROM pasien WHERE id_kk='$klinik'"); 
              while($dat=mysql_fetch_array($p)){
                $q1 = mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$dat[id_kk]'");
                      $k = mysql_fetch_array($q1);
                echo '
                    <tr>
                      <td>'.$k['nama_klinik'].'</td>
                      <td>'.$dat["id_pasien"].'</td>
                      <td>'.$dat["nama_pasien"].'</td>
                      <td>'.$dat['alamat'].'</td>
                      <td>'.$dat['tgl_lahir'].'</td>
                      <td>'.$dat['no_telp'].'</td>
                      <td>'.$dat['tgl_pendaftaran'].'</td>
                      <td>'.$dat['pekerjaan'].'</td>
                              
                  </tr>';
              }
            }
            
          '
        </tbody>
        <tfoot>
          <tr>
            <td></td>';
                $jumlahkan = "SELECT SUM(sub_tot) AS total FROM history_beli_t where tgl_beli='$tgl'"; //perintah untuk menjumlahkan
                $total =@mysql_query($jumlahkan) or die (mysql_error());//melakukan query dengan varibel $jumlahkan
                $t = mysql_fetch_array($total); //menyimpan hasil query ke variabel $t
                echo '
            <td></td>
          </tr>
          <a href="modul/laporan_pelanggan/cetak_pelanggan.php?id_kk='.$_POST['klinik'].'" target="_blank" class="btn btn-success btn-sm"><i class="fa fa-print"></i> Cetak Data Pelanggan</a>
        </tfoot>
      </table>
                </form>
                
      </div>';}?>
      </div>
  </div>
</section>
<!-- DataTables -->
<link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
    $("#example2").DataTable();
});
</script>

<?php
  break;
  }
?>

      
          