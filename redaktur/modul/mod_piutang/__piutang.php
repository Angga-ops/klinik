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
</style>

  <div class='callout callout-success'>
 
<div class="row">
<div class="col-md-6">
</div>
<div class="col-md-6">
<table><form action="" method="POST">
<?php $now = date("Y-m-d"); ?>
  <tr>
  <td><input type="text" name="tgl1" class="picker form-control" placeholder="dari tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td><input type="text" name="tgl2" class="picker form-control" placeholder="sampai tanggal..." value="<?php echo $now; ?>"/></td>
  <td>&nbsp;&nbsp;</td>
  <td><input type="text" name="nama" class="form-control" placeholder="nama pelanggan..."/></td>
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
								<th>Nota</th>
								<th>Nama Pelanggan</th>
								<th>Tgl Mulai</th>
								<th>Tgl Selesai</th>
								<th>Detail</th>   
                <th>Harga Layanan</th>  
								<th>Total</th>
                <th>Diskon</th>         
                <th>Tagihan</th>
								<th>Cabang</th>
                   </tr>
              </thead>
              <tbody>
               <?php 
               
          

             $nama = (empty($_POST["nama"]))? "" : "AND id_cus IN (SELECT id_cus FROM customer WHERE nama_m LIKE '%".$_POST["nama"]."%')";

             //pencarian tanggal
             $tgl = (empty($_POST["tgl1"]))? "AND tgl_mulai <= '$now'" : "AND tgl_mulai >= '".$_POST["tgl1"]."' AND tgl_mulai <= '".$_POST["tgl2"]."'"; 

             $qlau = mysqli_query($conn,"SELECT * FROM nota WHERE stts_pss NOT IN ('Share Pelunasan','Pelunasan') AND stts_byr IS NULL $tgl $nama  ORDER BY tgl_mulai DESC, id_cb ASC ");

             $json = "";
             while($hasil = mysqli_fetch_assoc($qlau)){

               $cus = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_m AS nama, telp_m AS telp FROM customer WHERE id_cus = '".$hasil[id_cus]."'"));

               $det = mysqli_fetch_assoc(mysqli_query($conn,"SELECT id_mode,qty,pcs FROM nota_detail WHERE id_nota = '".$hasil[id_nota]."'"));

               $mode = mysqli_fetch_assoc(mysqli_query($conn,"SELECT * FROM mode WHERE id_mode = '".$det[id_mode]."'"));

               $cb = mysqli_fetch_assoc(mysqli_query($conn,"SELECT nama_cb FROM cabang WHERE id_cb = '".$hasil[id_cb]."'"));

               $detail = mysqli_fetch_array(mysqli_query($conn,"SELECT nota.*, SUM(nota_detail.qty) AS berat, SUM(nota_detail.pcs) AS potong, 
								SUM(nota_detail.dis_plus) AS potongan, mode.kode_mode, mode.mode, mode.satuan_mode, mode.hrg_mode FROM nota 
                INNER JOIN nota_detail ON nota.id_nota = nota_detail.id_nota INNER JOIN mode ON nota_detail.id_mode = mode.id_mode WHERE nota.id_nota = '".$hasil[id_nota]."'"));
                
                $tot = ($det[qty] * $mode[hrg_mode]);
                $dsk = $tot * ($hasil[diskon_member]/100);
                $tagihan = number_format($tot - $dsk,0,",",".");

               echo "
               <tr><!--
               <td><a href='modul/mod_bayar/share.php?id_nota=$hasil[id_nota]' target='_BLANK'><i class='fa fa-print fa-2x'></i></a></td>-->
              
               <td>".$hasil[no_nota]."</td>
               <td>".$cus[nama]."</td>
               <td>".(strftime("%d %B %Y",strtotime($hasil[tgl_mulai])))."</td>
               <td>".(strftime("%d %B %Y",strtotime($hasil[tgl_selesai])))."</td>
               <td>".$mode[mode]." <br/> ".$det[qty]." kg / ".$det[pcs]." Pcs </td>
               <td>Rp ".number_format($mode[hrg_mode],0,",",".")."</td>
               <td>Rp ".number_format($tot,0,",",".")."</td>
               <td>Rp ".number_format($dsk,0,",",".")."</td>
               <td>Rp ".$tagihan."</td>
               <td>".$cb[nama_cb]."</td>
               </tr>
               ";

              

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
$(document).ready(function(){

   var tbl =  $('#user_example').DataTable({
    "scrollX" : true,
    "pageLength" : 100,
    "aaSorting": [[ 9, "asc" ]]
   });

    $(".picker").datepicker({
    autoclose: true,
        format: "yyyy-mm-dd"
});



$("#xbtn").click(function(){
  });



});



</script>