 

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
            	<a href="#"  data-toggle="modal" data-target="#modal-default"> <button type="button" class="btn btn-warning btn-sm">Tambah Jadwal</button></a>
              <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default2">
               Tukarkan Jadwal Perawat
              </button>
    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jadwal Praktek Perawat</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>              
               <th>Nama Perawat</th>
               <th>Nama Dokter</th>
               <th>Poliklinik</th>
               <th>Hari</th>
               <th>Jam</th>
               
            </tr>
        </thead>
        <tbody>
        <?php 

           //cari range expired
           $skrg = date("d");
 if($skrg <= 24){
 $now = date("Y-m-24");
 $last = date("Y-m",strtotime("-1 month"))."-25";
 } else {
	$last = date("Y-m-25");
	$now = date("Y-m",strtotime("+1 month"))."-24";
 }
        
        $d = mysql_query("SELECT * FROM nurse WHERE drpraktek IN (SELECT id_drpraktek FROM dr_praktek WHERE expired >= '$last' AND expired <= '$now')");
        while($du = mysql_fetch_assoc($d)){

          $dr = mysql_fetch_assoc(mysql_query("SELECT a.nama_lengkap,b.* FROM user a JOIN dr_praktek b ON a.id_user = b.id_dr WHERE b.id_drpraktek = '$du[drpraktek]'"));

          $nurse = mysql_fetch_assoc(mysql_query("SELECT * FROM karyawan WHERE id_karyawan = '$du[perawat]'"));

          $poli = mysql_fetch_assoc(mysql_query("SELECT * FROM poliklinik WHERE id_poli = '$dr[id_poli]'"));

          switch($dr[hari]){
            case "1": $day = "Senin"; break;
            case "2": $day = "Selasa"; break;
            case "3": $day = "Rabu"; break;
            case "4": $day = "Kamis"; break;
            case "5": $day = "Jumat"; break;
            case "6": $day = "Sabtu"; break;
            case "7": $day = "Minggu"; break;
          }

          echo "<tr>";
          echo "<td>$nurse[nama_karyawan]</td>";
          echo "<td>$dr[nama_lengkap]</td>";
          echo "<td>$poli[poli]</td>";
          echo "<td>$day</td>";
          echo "<td>$dr[jam]</td>";
          echo "</tr>";

        }
        
        ?>
                 </tbody>
                </table>
     </div></div></div></div>

     <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Jadwal Perawat</h4>
              </div>
              <div class="modal-body">

              <span><strong>Jadwal perawat mengikuti jadwal dokter yang dipilih</strong></span>

<div class="row">               
<div class="col-md-12">
<label>Pilih Jadwal Dokter</label>
<select class="form-control" id="dr">
<option value="">--silakan pilih--</option>
<?php 
$today = DATE('Y-m-d');
$do = mysql_query("SELECT * FROM user a JOIN dr_praktek b ON a.id_user = b.id_dr JOIN poliklinik c ON b.id_poli=c.id_poli WHERE a.id_ju = 'JU-02' AND b.expired>='$today'");
while($dok = mysql_fetch_assoc($do)){
  switch($dok[hari]){
    case "1": $hari = "Senin"; break;
    case "2": $hari = "Selasa"; break;
    case "3": $hari = "Rabu"; break;
    case "4": $hari = "Kamis"; break;
    case "5": $hari = "Jumat"; break;
    case "6": $hari = "Sabtu"; break;
    case "7": $hari = "Minggu"; break;
  }
    echo "<option value='$dok[id_drpraktek]'>$dok[nama_lengkap] || $hari || $dok[jam] || $dok[poli]</option>";
}

?>
</select>
</div>
</div>

<div class="row">               
<div class="col-md-12">
<label>Pilih Perawat</label>
<select class="form-control" id="nurse">
<option value="">--silakan pilih--</option>
<?php 

$do = mysql_query("SELECT * FROM karyawan WHERE id_ju = 'JU-10'");
while($dok = mysql_fetch_assoc($do)){
    echo "<option value='$dok[id_karyawan]'>$dok[nama_karyawan]</option>";
}

?>
</select>
</div>
</div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tukarin" onclick="switched()">Tambah</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

        <div class="modal fade" id="modal-default2">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
              
                 
                <h4 class="modal-title">Tukarkan Jadwal Perawat</h4>
              </div>
              <div class="modal-body">

              <span><strong>Jadwal perawat yang dipilih akan bertukar Hari dan Jam piketnya</strong></span>

<div class="row">               
<div class="col-md-12">
<label>Pilih Jadwal Perawat 1</label>
<select class="form-control" id="dr1">
<option value="">--silakan pilih--</option>
<?php 
$today = DATE('Y-m-d');
$u = mysql_query("SELECT * FROM nurse n JOIN karyawan k ON(n.perawat=k.id_karyawan) JOIN dr_praktek d ON(n.drpraktek=d.id_drpraktek) JOIN poliklinik p ON(d.id_poli=p.id_poli) WHERE d.expired>='$today'");
while($ux = mysql_fetch_assoc($u)){
  switch($ux[hari]){
    case "1": $hari = "Senin"; break;
    case "2": $hari = "Selasa"; break;
    case "3": $hari = "Rabu"; break;
    case "4": $hari = "Kamis"; break;
    case "5": $hari = "Jumat"; break;
    case "6": $hari = "Sabtu"; break;
    case "7": $hari = "Minggu"; break;
  }
    echo "<option value='$ux[id_nurse]'>$ux[nama_karyawan] || $ux[poli] || $hari || $ux[jam]</option>";
}
?>
</select>
</div>
</div>
<div class="row">
<div class="col-md-12">
<label>Pilih Jadwal Perawat 2</label>
<select class="form-control" id="dr2">
<option value="">--silakan pilih--</option>
<?php 

$u = mysql_query("SELECT * FROM nurse n JOIN karyawan k ON(n.perawat=k.id_karyawan) JOIN dr_praktek d ON(n.drpraktek=d.id_drpraktek) JOIN poliklinik p ON(d.id_poli=p.id_poli) WHERE d.expired>='$today'");
while($ux = mysql_fetch_assoc($u)){
  switch($ux[hari]){
    case "1": $hari = "Senin"; break;
    case "2": $hari = "Selasa"; break;
    case "3": $hari = "Rabu"; break;
    case "4": $hari = "Kamis"; break;
    case "5": $hari = "Jumat"; break;
    case "6": $hari = "Sabtu"; break;
    case "7": $hari = "Minggu"; break;
  }
    echo "<option value='$ux[id_nurse]'>$ux[nama_karyawan] || $ux[poli] || $hari || $ux[jam]</option>";
}
?>
</select>
</div>
</div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tukarin" onclick="switched2()">Tukarkan</button>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->

</section>

<script>
function switched(){
  var dr = $("#dr").val();
  var nurse = $("#nurse").val();
  var xhr = $.ajax({
    url: "modul/nurse/ajax_nurse.php",
    data: {"dr": dr,"nurse": nurse},
    success: function(data){
      if(data == "error"){
        alert("Dokter yang dipilih sudah ada perawat ini");
        $("#tukarin").html("Tambah");
      } else {
        location.reload();
      }
    }
  });
  if(xhr.readyState == "1"){
    $("#tukarin").html("menambah jadwal...");
  }
}

function switched2(){
    var a = $("#dr1").val();
    var b = $("#dr2").val();
    if(a == b){
        alert("Tidak dapat menukarkan data yang sama");
    } else {
        $("#tukarin").html("menukarkan...");
        $.ajax({
            url: "modul/nurse/switched.php",
            data: {"dr1":a,"dr2":b},
            success: function(data){
              if(data == "error"){
                alert("Poliklinik berbeda tidak dapat ditukarkan");
                $("#tukarin").html("Tukarkan");
              }
                location.reload();
            }
        });
    }
}
</script>