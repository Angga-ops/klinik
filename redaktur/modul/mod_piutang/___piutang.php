<?php 
$bc = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM modul WHERE link = '?module=".$_GET["module"]."'"));
?>
<section class="content-header">
  <h1>
   <?php echo $bc["nama_modul"]; ?>
    <small></small>
  </h1>
  <ol class="breadcrumb">
    <li><a href="laundry.php"><i class="fa fa-dashboard"></i> Home</a></li>
    <li class="active"><?php echo $bc["nama_modul"]; ?></li>
  </ol>
</section>

<!-- breadcrumb end -->

<section class="content">
<style>
.tbl td { padding: 5px }
span.select2 { width: 100% !important }
.menus {
    height: 200px;
    overflow-y: scroll
}
.dropdown-menu li a { text-decoration: none }
</style>

  <div class='callout callout-success'>
 
<div class="row">
<div class="col-md-6">
</div>
<div class="col-md-8">
<table><form action="" method="POST">
<?php $now = date("Y-m-d"); ?>
<tr>
<td style="width: 30%">
<div>
	<select name="out" class="form-control">
	<option value="">--pilih outlet--</option>
	<?php 
	$pg = mysqli_query($conn,"SELECT * FROM outlet");
	while($pgw = mysqli_fetch_assoc($pg)){ 
		echo "<option value='$pgw[id_outlet]'>$pgw[nama_outlet] </option>";
	}
	?>
	</select></div>
</td>
<td>&nbsp;&nbsp;</td>
  <td  style="width: 30%"><input type="text" name="tgl1" class="picker form-control" placeholder="dari tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td  style="width: 30%"><input type="text" name="tgl2" class="picker form-control" placeholder="sampai tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td>&nbsp;&nbsp;</td>
  <td><button class='btn btn-info' type="submit">Cari</button></td>
  </tr></form>
  </table>
</div>
</div>
  

     </div>
<div class="row">
      <div class="col-xs-12"><div class="box">
          <div class="box-header">
            <h3 class="box-title"></h3>
          </div>
          <!-- /.box-header -->
          <div class="box-body">
            <table class="table table-striped table-bordered table-hover" id="user_example">
              <thead>
                <tr>      
                <th>Periode</th>
                <th>Total Piutang</th>
								<th>Cabang</th>
                   </tr>
              </thead>
              <tbody>
               <?php 
               
          

             //pencarian tanggal
             $tgl = (empty($_POST["tgl1"]))? "a.tgl_mulai <= '$now'" : "a.tgl_mulai >= '".$_POST["tgl1"]."' AND a.tgl_mulai <= '".$_POST["tgl2"]."'"; 

             if(isset($_POST["out"])){

              $out =  "AND a.id_cb IN (SELECT id_cb FROM cabang WHERE outlet = '".$_POST["out"]."')";


             $qlau = mysqli_query($conn,"SELECT a.id_cb, SUM(b.hrg_sub) total FROM nota a JOIN nota_detail b ON a.id_nota = b.id_nota WHERE $tgl $out AND a.stts_pss !='Share Pelunasan' GROUP BY a.id_cb "); 


                 while($hasil = mysqli_fetch_assoc($qlau)){
                   
            $cb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_cb FROM cabang WHERE id_cb = '$hasil[id_cb]'"));
                  echo "<tr><td>".(strftime("%d %B %Y",strtotime($_POST['tgl1'])))." s/d ".(strftime("%d %B %Y",strtotime($_POST['tgl2'])))."</td>";
                  echo "<td>Rp ".(number_format($hasil['total'],0,",","."))."</td>";
                  echo "<td>$cb[nama_cb]</td></tr>";
                 }         
                         
             


            } 
           
               
               ?>
              </tbody></table>
          </div>
          <!-- /.box-body -->
        </div></div></div>
    

      
      </section>
        <!-- User defined -->
<link rel="stylesheet" href="bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<script src="bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>



<script>

function getcb(id){
  $("#cb").val(id);
}

$(document).ready(function(){

   var tbl =  $('#user_example').DataTable({
    "scrollX" : true,
    "pageLength" : 100
   });

    $(".picker").datepicker({
    autoclose: true,
        format: "yyyy-mm-dd"
});



$("#xbtn").click(function(){
  });



});



</script>