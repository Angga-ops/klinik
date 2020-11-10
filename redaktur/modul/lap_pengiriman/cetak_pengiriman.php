<script type="text/javascript">
// window.print();
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
	<h2>Laporan Pengiriman Produk</h2>
</div>
<div class="row">
        <div class="col-md-2">
          Tanggal Pengiriman
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo tgl_indo($_GET['tgl']); ?> - <?php echo tgl_indo($_GET['tgl2']); ?>
        </div>
      </div>
      <br>
<div align="center">
	<table width="100%" class="table1">
		<thead>
      <tr>
        <th>Tujuan Cabang</th>
        <th>Tanggal</th>
        <th>Kode Produk</th>
        <th>Nama Produk</th>
        <th>Jumlah</th>
      </tr>
    </thead>
    <tbody>
      <?php $tgl=$_GET["tgl"];  $tgl2=$_GET["tgl2"]; 
      $q = mysql_query("SELECT *FROM pengiriman p JOIN daftar_klinik dk ON p.cabang=dk.id_kk WHERE p.tanggal>='$tgl' AND p.tanggal<='$tgl2'");  
      while($d = mysql_fetch_array($q)){
        $jumlah = 0;
      ?>
      <?php $q1 = mysql_query("SELECT *FROM produk_pengiriman WHERE no_pengiriman='$d[no_pengiriman]'");
      while($p =  mysql_fetch_array($q1)){  ?>
      <tr>
        <td><?php echo $d['nama_klinik']; ?></td>
        <td><?php echo tgl_indo($d["tanggal"]); ?></td>
        <td><?php echo $p["kode_produk"]; ?></td>
        <td><?php echo $p["nama_produk"]; ?></td>
        <td><?php echo $p["jumlah"]; $jumlah += $p["jumlah"]; ?></td>
      </tr>
      <?php
      }
      ?>
      <tr>
        <th>No Pengiriman</th>
        <td><?php echo $d['no_pengiriman']; ?></td>
        <th colspan="2">Total Jumlah</th>
        <td><?php echo $jumlah; ?></td>
      </tr>
    <?php } ?>
	    </tbody>
    </table>
    <br>
</div>