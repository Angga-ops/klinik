
<?php 

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");

?>

<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

<div class="row">

<div class="col-md-4">
        
<select id="klinik" class="form-control">
<option value="all">Tampilkan Semua Klinik</option>
<?php
$kl = mysql_query("SELECT * FROM daftar_klinik");
while($kli = mysql_fetch_array($kl)){
    echo "<option value='$kli[id_kk]'>$kli[nama_klinik]</option>";
}
?>
</select>

         </div>

         <div class="col-md-2">
         <input type="text" class="form-control picker" id="tgl1" value="<?php echo date("Y-m-d"); ?>" />
         </div>

         <div class="col-md-2">
         <input type="text" class="form-control picker" id="tgl2" value="<?php echo date("Y-m-d"); ?>" />
         </div>

         <div class="col-md-2">
         <button type="button" class="btn btn-info xbtn">
              Cari
              </button>
         </div>

         <div class="col-md-2">
         <button type="button" class="btn btn-info pbtn">
              Print
              </button>
         </div>
         </div>

         </div>





        </div>

    </div>

<?php 

$klin = mysql_fetch_array(mysql_query("SELECT nama_klinik AS ik FROM daftar_klinik WHERE id_kk = '$_GET[klinik]'"));

if(isset($_GET[klinik])){
$klinik = "AND id_kk = '$_GET[klinik]'";
$stats = "Cabang Klinik $klin[ik]";
} else {
    $klinik = "";
    $stats = "Semua Cabang Klinik";
}

if(isset($_GET[tgl1])){
    $tgl = "tanggal >= '$_GET[tgl1]' AND tanggal <= '$_GET[tgl2]' $klinik";
    $tgl2 = "tgl >= '$_GET[tgl1]' AND tgl <= '$_GET[tgl2]'";
    $tgl3 = "DATE(tgl) >= '$_GET[tgl1]' AND DATE(tgl) <= '$_GET[tgl2]'";
    $stat = $stats." antara ".strftime("%d %B %Y",strtotime($_GET[tgl1]))." s/d ".strftime("%d %B %Y",strtotime($_GET[tgl2]));
} else {
    $tgl = "tanggal >= '".date("Y-m-d")."' $klinik";
    $tgl2 = "tgl >= '".date("Y-m-d")."'";
    $tgl3 = "DATE(tgl) >= '".date("Y-m-d")."'";
    $stat = $stats." s/d ".strftime("%d %B %Y",strtotime(date("Y-m-d")));
}

?>

     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Lap Produk yang Laku <?php echo $stat; ?></h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                

              <table id="example1" class="table table-bordered table-striped">

                  <thead>

                  <tr>
	    		<th>No</th>
	 	        <th>Nama Produk/Jasa</th>
	            <th>Harga</th>
	            <th>Jumlah</th>
	            <th>Jenis</th>
	            <th>Sub Total</th>
	            <th>Status</th>
			            
	        </tr>

        </thead>

        <tbody>
        <?php 
        
       
        
        $q1 = mysql_query("SELECT history_kasir.*, SUM(harga*jumlah) AS subtotal, SUM(jumlah) AS jml FROM history_kasir WHERE $tgl GROUP BY nama");
        
              $no =1;
              while ($br = mysql_fetch_array($q1)) {
              	$subtotal= $br['harga']*$br['jumlah'];
                ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['nama']; ?></td>
              <td>Rp <?php echo number_format($br['harga'],0,",","."); ?></td>
              <td><?php echo $br['jml']; ?></td>
              <td><?php echo $br['jenis']; ?></td>
              <td>Rp <?php echo number_format($br['subtotal'],0,",","."); ?></td>
              <td><?php echo $br['status']; ?></td>
              
            </tr>
                <?php
                $no++;
              }
            
              $q2 = mysql_query("SELECT * FROM retur_jual WHERE $tgl2");
        
             
              while ($br2 = mysql_fetch_array($q2)) {

                $hist = mysql_fetch_assoc(mysql_query("SELECT * FROM history_kasir WHERE id = '$br2[history]'"));
                $prod = mysql_fetch_assoc(mysql_query("SELECT nama_p FROM produk WHERE id_kk = '$hist[id_kk]' AND kode_barang = '$br2[replaces]'"));
                $prod2 = mysql_fetch_assoc(mysql_query("SELECT nama_p FROM produk WHERE id_kk = '$hist[id_kk]' AND kode_barang = '$hist[nama]'"));
                $subt =$hist['harga'] *  $br2['jml'];
                $produk = is_null($prod['nama_p']) || empty($prod[nama_p]) || $prod[nama_p] == ""? $prod2['nama_p'] : $prod['nama_p'];
                ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $produk; ?></td>
              <td>Rp <?php echo number_format($hist['harga'],0,",","."); ?></td>
              <td><?php echo $br2['jml']; ?></td>
              <td><?php echo $hist['jenis']; ?></td>
              <td>Rp <?php echo number_format($subt,0,",","."); ?></td>
              <td>Retur <?php $ret = mysql_fetch_assoc(mysql_query("SELECT retur FROM master_retur_jual WHERE id = '$br2[retur]'")); echo $ret["retur"];  ?> <br/> asal faktur: <?php echo $hist[no_faktur]; ?></td>
              
            </tr>
                <?php
                $no++;
              }



              $q3 = mysql_query("SELECT * FROM bonus WHERE $tgl3");
        
              while ($br3 = mysql_fetch_array($q3)) {
                $prod2 = mysql_fetch_assoc(mysql_query("SELECT nama_p FROM produk WHERE id_kk = '$br3[klinik]' AND kode_barang = '$br3[produk]'"));
                $pas = mysql_fetch_assoc(mysql_query("SELECT nama_pasien FROM pasien WHERE id = '$br3[pasien]'"));
               
                ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $prod2[nama_p]; ?></td>
              <td>-</td>
              <td><?php echo $br3['jml']; ?></td>
              <td><?php echo $br3['ket']; ?></td>
              <td>-</td>
              <td>Bonus utk pasien <?php echo $pas[nama_pasien]; ?> </td>
              
            </tr>
                <?php
                $no++;
              } 



            ?>
	    </tbody>
                </table>


<style>
.tbl {border-collpase: collapse; width: 100%}
.tbl td {padding: 1%}
</style>

     </div></div></div></div>

   


</section>

<link rel="stylesheet" href="<?php echo $url1; ?>bower_components/typeahead.css">
<script src="<?php echo $url1; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

  <link rel="stylesheet" href="<?php echo $url1; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url1; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url1; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>
$(document).ready(function(){
    
  $(".picker").datepicker({
        dateFormat: 'yy-mm-dd',
        showButtonPanel: true
});



$(".xbtn").click(function(){
    var klinik = ($("#klinik").val() == "all")? "" : "&klinik=" + $("#klinik").val();
    var t1 = $("#tgl1").val();
    var t2 = $("#tgl2").val();
    location.href="media.php?module=penjualan_ha&tgl1=" + t1 + "&tgl2=" + t2 + klinik;
});

$(".pbtn").click(function(){
    <?php 

    $lynx = "?klinik=$_GET[klinik]";


if(isset($_GET[tgl1])){
    $links = "modul/penjualan_h/pa.php".$lynx."&tgl1=$_GET[tgl1]&tgl2=$_GET[tgl2]";
} else {
    $links = "modul/penjualan_h/pa.php".$lynx;
}

    ?>
   window.open("<?php echo $links; ?>","_BLANK");
});

});
</script>