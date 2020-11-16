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
    width: 10%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}

</style>
<div align="center">
	<h2>Laporan Kehadiran Dokter</h2>
</div>
<div class="row">
        <div class="col-md-2">
          Tanggal 
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
	          <th>No</th>
              <th>Nama Dokter</th>
              <th>Cabang Klinik</th>
              <th>Tanggal</th>
              <th>Waktu</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php $q1 = mysqli_query($con, "SELECT *FROM kehadiran_dr k JOIN user u ON k.id_dr=u.id_user JOIN daftar_klinik dk ON k.id_kk=dk.id_kk WHERE k.tanggal='$_GET[tgl]'"); 
              $no =1;
              while ($br = mysqli_fetch_array($q1)) {
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['nama_lengkap']; ?></td>
              <td><?php echo $br['nama_klinik']; ?></td>
              <td><?php echo tgl_indo($br["tanggal"]); ?></td>
              <td><?php echo $br["jam"]; ?></td>
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