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
<?php
	$p = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM pengiriman WHERE no_pengiriman='$_GET[nop]'"));
?>
<div align="center">
	<h2>Penerimaan Produk</h2>
</div>
<div class="row">
    <div class="col-md-2">
          Nomer Pengiriman 
    </div>
	<div class="col-md-5">
          :&emsp; <?php echo $p['no_pengiriman'] ?>
	</div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-md-2">
          Cabang Klinik 
    </div>
    <div class="col-md-5">
          :&emsp; <?php $k = mysqli_fetch_array(mysqli_query($con,"SELECT *FROM daftar_klinik WHERE id_kk='$p[cabang]'")); echo $k['nama_klinik']; ?>
    </div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-md-2">
      Pengirim 
    </div>
    <div class="col-md-5">
       :&emsp; <?php echo $p['pengirim']; ?>
    </div>
</div>
<div class="row" style="margin-top: 5px;">
    <div class="col-md-2">
      Penerima 
    </div>
    <div class="col-md-5">
       :&emsp; <?php echo $p['penerima']; ?>
    </div>
</div>
<div align="center">
	<div align="left"><h4>Produk Yang Diterima</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	          <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Jumlah Diterima</th>
              <th>Keterangan</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php $q1 = mysqli_query($con,"SELECT *FROM produk_pengiriman WHERE no_pengiriman='$_GET[nop]'"); 
              $no =1;
              while ($br = mysqli_fetch_array($q1)) {
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['kode_produk']; ?></td>
              <td><?php echo $br['nama_produk']; ?></td>
              <td><?php echo $br['jumlah']; ?></td>
              <td><?php echo $br['jumlah_diterima']; ?></td>
              <td><?php echo $br['ket']; ?></td>
            </tr>
                <?php
                $no++;
              }
            ?>
	    </tbody>
    </table>
    <br />
  <table width="100%">
    	<tr>
            <td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
    	<tr>
            <td height="200"><div align="right">Penerima</div></td>
        </tr>
  </table>
</div>