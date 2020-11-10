

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
            	<a href="?module=tambah_jadwal_dokter"> <button type="button" class="btn btn-warning btn-sm">Tambah Jadwal</button></a>
                <button type="button" class="btn btn-default btn-sm" data-toggle="modal" data-target="#modal-default">
               Tukarkan Jadwal Dokter
              </button>
    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box">
            <div class="box-header">
              <h3 class="box-title">Data Jadwal Praktek Dokter</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
              <table  class="table table-bordered table-striped datatable">
                  <thead>
            <tr>             
            <th>Aksi</th> 
               <th>Nama Dokter</th>
               <th>Poliklinik</th>
               <th>Hari</th>
               <th>Jam</th>
               <th>Berlaku s/d</th>
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
                   
                   $d = mysql_query("SELECT b.id_drpraktek,b.expired,b.jam,a.nama_lengkap,b.hari,(SELECT poli FROM poliklinik WHERE id_poli = b.id_poli) poli 
                   FROM user a JOIN dr_praktek b ON a.id_user = b.id_dr WHERE b.expired >= '$last' AND b.expired <= '$now' ORDER BY b.hari ASC");

                   while($dr = mysql_fetch_assoc($d)){
                       
                    switch($dr[hari]){
                        case 1: $day = "Senin"; break;
                        case 2: $day = "Selasa"; break;
                        case 3: $day = "Rabu"; break;
                        case 4: $day = "Kamis"; break;
                        case 5: $day = "Jumat"; break;
                        case 6: $day = "Sabtu"; break;
                        case 7: $day = "Minggu"; break;
                    }

                       echo "<tr>";
                       echo "<td><a href='modul/dr_praktek/aksi.php?act=del&id=$dr[id_drpraktek]' onclick='return confirm(\"Menghapus jadwal dokter praktek akan menyebabkan jadwal perawat yang terkait ikut terhapus. Apakah yakin akan menghapus? \")'><button class='btn btn-xs btn-danger'>Hapus</button></a></td>";
                       echo "<td>$dr[nama_lengkap]</td>";
                       echo "<td>$dr[poli]</td>";
                       echo "<td>$day</td>";
                       echo "<td>$dr[jam]</td>";
                       echo "<td>".strftime("%d %B %Y",strtotime($dr[expired]))."</td>";
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
              
                 
                <h4 class="modal-title">Tukarkan Jadwal Dokter</h4>
              </div>
              <div class="modal-body">

              <span><strong>Jadwal dokter yang dipilih akan bertukar Hari dan Jam piketnya</strong></span>

<div class="row">               
<div class="col-md-12">
<label>Pilih Jadwal Dokter 1</label>
<select class="form-control" id="dr1">
<option value="">--silakan pilih--</option>
<?php 

$u = mysql_query("SELECT hari,jam,id_drpraktek,(SELECT nama_lengkap FROM user WHERE id_user = dr_praktek.id_dr) dokter, (SELECT poli FROM poliklinik WHERE id_poli = dr_praktek.id_poli) poli FROM dr_praktek WHERE expired >= '$last' AND expired <= '$now' ORDER BY hari ASC");
while($ux = mysql_fetch_assoc($u)){
    switch($ux[hari]){
        case "1": $day = "Senin"; break;
        case "2": $day = "Selasa"; break;
        case "3": $day = "Rabu"; break;
        case "4": $day = "Kamis"; break;
        case "5": $day = "Jumat"; break;
        case "6": $day = "Sabtu"; break;
        case "7": $day = "Minggu"; break;
    }
    echo "<option value='$ux[id_drpraktek]'>$ux[dokter] $ux[poli] $day $ux[jam] </option>";
}
?>
</select>
</div>
</div>
<div class="row">
<div class="col-md-12">
<label>Pilih Jadwal Dokter 2</label>
<select class="form-control" id="dr2">
<option value="">--silakan pilih--</option>
<?php 

$u = mysql_query("SELECT hari,jam,id_drpraktek,(SELECT nama_lengkap FROM user WHERE id_user = dr_praktek.id_dr) dokter, (SELECT poli FROM poliklinik WHERE id_poli = dr_praktek.id_poli) poli FROM dr_praktek WHERE expired >= '$last' AND expired <= '$now' ORDER BY hari ASC");
while($ux = mysql_fetch_assoc($u)){
    switch($ux[hari]){
        case "1": $day = "Senin"; break;
        case "2": $day = "Selasa"; break;
        case "3": $day = "Rabu"; break;
        case "4": $day = "Kamis"; break;
        case "5": $day = "Jumat"; break;
        case "6": $day = "Sabtu"; break;
        case "7": $day = "Minggu"; break;
    }
    echo "<option value='$ux[id_drpraktek]'>$ux[dokter] $ux[poli] $day $ux[jam] </option>";
}
?>
</select>
</div>
</div>

              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="button" class="btn btn-primary" id="tukarin" onclick="switched()">Tukarkan</button>
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
    var a = $("#dr1").val();
    var b = $("#dr2").val();
    if(a == b){
        alert("Tidak dapat menukarkan data yang sama");
    } else {
        $("#tukarin").html("menukarkan...");
        $.ajax({
            url: "modul/dr_praktek/switched.php",
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