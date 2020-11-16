<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
        


        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Grafik Pendapatan treatment</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
            <div class="row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              <form method="POST">
                <table class="table">
                  <tbody>
                    <tr>
                      <td><label>Bulan/Tahun</label></td>
                      <td><select name="bulan" class="form-control">
                          <option value="01">Januari</option>
                          <option value="02">Februari</option>
                          <option value="03">Maret</option>
                          <option value="04">April</option>
                          <option value="05">Mei</option>
                          <option value="06">Juni</option>
                          <option value="07">Juli</option>
                          <option value="08">Agustus</option>
                          <option value="09">September</option>
                          <option value="10">Oktober</option>
                          <option value="11">November</option>
                          <option value="12">Desember</option>
                          </select>
                          <select name="tahun" class="form-control">
                          <?php
                          $mulai= date('Y') - 50;
                          for($i = $mulai;$i<$mulai + 100;$i++){
                              $sel = $i == date('Y') ? ' selected="selected"' : '';
                              echo '<option value="'.$i.'"'.$sel.'>'.$i.'</option>';
                          }
                          ?>
                          </select>
                      </td>
                      <td><button type="submit" name="submit" class="btn btn-info">Tampilkan Grafik</button></td>
                    </tr>
                  </tbody>
                </table>
              </div>
            </div>
            <canvas id="pendapatan" style="height:100px"></canvas>
          </div>
</section>
      <script>
                  var ctx = document.getElementById("pendapatan").getContext('2d');
                  
                  var myChart = new Chart(ctx, {
                    type: 'bar',
                    data: {
                      labels: [
                      <?php
                      $klinik = mysqli_query($con, "SELECT nama,  COUNT(*) as jumlah FROM history_kasir WHERE month(tanggal) = '$_POST[bulan]' AND year(tanggal) = '$_POST[tahun]' AND jenis='Treatment' GROUP BY nama Order by jumlah DESC limit 10");
                      while ($t=mysqli_fetch_array($klinik)) { ?>
                      "<?php echo $t['nama']; ?> (<?php echo $t['jumlah']; ?>)",
                      <?php  } ?>
                      ],
                      datasets: [{
                        label: '',
                        data: [
                         <?php
                      $klinik = mysqli_query($con, "SELECT nama,  COUNT(*) as jumlah FROM history_kasir WHERE month(tanggal) = '$_POST[bulan]' AND year(tanggal) = '$_POST[tahun]' AND jenis='Treatment' GROUP BY nama Order by jumlah DESC limit 10");
                      while ($t=mysqli_fetch_array($klinik)) { ?>
                      "<?php echo $t['jumlah']; ?>",
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
                </script>
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
<?php
  break;
  }
?>