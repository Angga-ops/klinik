<?php

include "../../../config/koneksi.php";


setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");

?>


<?php 
$klin = mysqli_fetch_array(mysqli_query($con,"SELECT nama_klinik AS ik FROM daftar_klinik WHERE id_kk = '$_GET[klinik]'"));

if(!empty($_GET['klinik']) || $_GET['klinik'] != 0){
$klinik = "AND id_kk = '$_GET[klinik]'";
$stats = "Cabang Klinik $klin[ik]";
} else {
    $klinik = "";
    $stats = "Semua Cabang Klinik";
}

if(isset($_GET['tgl1'])){
    $tgl = "tanggal >= '$_GET[tgl1]' AND tanggal <= '$_GET[tgl2]' $klinik";
    $tgl2 = "tgl >= '$_GET[tgl1]' AND tgl <= '$_GET[tgl2]'";
    $tgl3 = "DATE(tgl) >= '$_GET[tgl1]' AND DATE(tgl) <= '$_GET[tgl2]'";
    $stat = $stats." antara ".strftime("%d %B %Y",strtotime($_GET['tgl1']))." s/d ".strftime("%d %B %Y",strtotime($_GET['tgl2']));
} else {
    $tgl = "tanggal >= '".date("Y-m-d")."' $klinik";
    $tgl2 = "tgl >= '".date("Y-m-d")."'";
    $tgl3 = "DATE(tgl) >= '".date("Y-m-d")."'";
    $stat = $stats." s/d ".strftime("%d %B %Y",strtotime(date("Y-m-d")));
}

?>

<style>
table {border-collapse: collapse}
th {border: solid 1px black; background: black; color: white}
td {border: solid 1px black; padding: 2px}
</style>

     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

            <center>
<h1>KS Beauty</h1>
<hr/>
              <h3 class="box-title">Lap Produk yang Laku <?php echo $stat; ?></h3>
</center>
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
        
       
        
        $q1 = mysqli_query($con,"SELECT history_kasir.*, SUM(harga*jumlah) AS subtotal, SUM(jumlah) AS jml FROM history_kasir WHERE $tgl GROUP BY nama");

              $no =1;
              while ($br = mysqli_fetch_array($q1)) {
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
              $q2 = mysqli_query($con,"SELECT * FROM retur_jual WHERE $tgl2");
        
             
              while ($br2 = mysqli_fetch_array($q2)) {

                $hist = mysqli_fetch_assoc(mysqli_query($con,"SELECT * FROM history_kasir WHERE id = '$br2[history]'"));
                $prod = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_p FROM produk WHERE id_kk = '$hist[id_kk]' AND kode_barang = '$br2[replaces]'"));
                $prod2 = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_p FROM produk WHERE id_kk = '$hist[id_kk]' AND kode_barang = '$hist[nama]'"));
                $subt =$hist['harga'] *  $br2['jml'];
                $produk = is_null($prod['nama_p']) || empty($prod['nama_p']) || $prod['nama_p'] == ""? $prod2['nama_p'] : $prod['nama_p'];
                ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $produk; ?></td>
              <td>Rp <?php echo number_format($hist['harga'],0,",","."); ?></td>
              <td><?php echo $br2['jml']; ?></td>
              <td><?php echo $hist['jenis']; ?></td>
              <td>Rp <?php echo number_format($subt,0,",","."); ?></td>
              <td>Retur <?php $ret = mysqli_fetch_assoc(mysqli_query($con,"SELECT retur FROM master_retur_jual WHERE id = '$br2[retur]'")); echo $ret["retur"];  ?> <br/> asal faktur: <?php echo $hist['no_faktur']; ?></td>
              
            </tr>
                <?php
                $no++;
              }


              
              $q3 = mysqli_query($con,"SELECT * FROM bonus WHERE $tgl3");
        
              while ($br3 = mysqli_fetch_array($q3)) {
                $prod2 = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_p FROM produk WHERE id_kk = '$br3[klinik]' AND kode_barang = '$br3[produk]'"));
                $pas = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_pasien FROM pasien WHERE id = '$br3[pasien]'"));
               
                ?>
          <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $prod2['nama_p']; ?></td>
              <td>-</td>
              <td><?php echo $br3['jml']; ?></td>
              <td><?php echo $br3['ket']; ?></td>
              <td>-</td>
              <td>Bonus utk pasien <?php echo $pas['nama_pasien']; ?> </td>
              
            </tr>
                <?php
                $no++;
              } 

              ?>
	    </tbody>
                </table>
<script>
window.print();
</script>