<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");
?>
<style>
.table1{
	margin:0 auto;
	border-collapse:collapse;
	background:#FFFFFF;
}
.table1 th{
	border:solid;
	border-width:1px;
	border-color:#000000;
	color:black;
	padding:4px 8px;
}
.table1 td{
	border:solid;
	border-width:1px;
	border-color:#000000;
	padding:4px 8px;
}
#hitam{
	text-align:center;
	background:#333333;
	color:#FFFFFF;
}
#rpt{
	border:solid;
	border-color:#000000;
	border-width:1px;
}
.row:after, .row:before {
	display: table;
	content: " ";
}
.row:after {
	clear: both;
}
.col-md-2 {
    width: 20%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}

</style>
<div align="center">
	<h2>Laporan Reture Produk</h2>
</div>
<div class="row">
        <div class="col-md-2">
          Tanggal Reture
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo tgl_indo($_GET['tgl']); ?>
        </div>
      </div>
      <br>
<div align="center">
	<table width="100%" class="table1">
		<thead>
      <tr>
        <th>Asal Cabang</th>
        <th>Tanggal</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Keterangan</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php $tgl=$_GET["tgl"]; $q = mysqli_query($con, "SELECT *FROM reture r JOIN daftar_klinik dk ON r.asal_cabang=dk.id_kk WHERE r.tanggal='$tgl'");  
      $grand_total=0;
      while($d = mysqli_fetch_array($q)){
        $jumlah = 0;
      ?>
      <?php $q1 = mysqli_query($con, "SELECT *FROM produk_reture WHERE no_reture='$d[no_reture]'");
      while($p =  mysqli_fetch_array($q1)){  ?>
      <tr>
        <td><?php echo $d['nama_klinik']; ?></td>
        <td><?php echo tgl_indo($d["tanggal"]); ?></td>
        <td><?php echo $p["kode_produk"]; ?></td>
        <td><?php echo $p["nama_produk"]; ?></td>
        <td><?php echo $p["keterangan"]; ?></td>
        <td><?php echo $p["jumlah"]; $jumlah += $p["jumlah"]; ?></td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <th>No Reture</th>
        <td><?php echo $d['no_reture']; ?></td>
        <th>Pengirim</th>
        <td><?php echo $d['pengirim']; ?></td>
        <th>Total Jumlah</th>
        <td><?php echo $jumlah; $grand_total+=$jumlah; ?></td>
      </tr>
    <?php } ?>
	    </tbody>
      <tfoot>
        <th colspan="5">Grand Total Jumlah</th>
        <td><?php echo $grand_total; ?></td>
      </tfoot>
    </table>
    <br>
</div>