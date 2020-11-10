<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");
	$id_kk = $_SESSION['klinik'];
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
$tgl1 = $_GET['tanggal1'];
$tgl2 = $_GET['tanggal2'];
$id_kk = $_GET['id_kk'];
	$p = mysql_fetch_array(mysql_query("SELECT *FROM krisar WHERE tanggal='$_GET[tanggal]' AND id_kk='$_GET[id_kk]'"));
?>
<div align="center">
	<h4>Kritik dan Saran dari Tanggal : <?php echo $_GET['tanggal1'] ?> Sampai Tanggal : <?php echo $_GET['tanggal1'] ?> </h4>
</div>
<div align="center">
	<div align="left"><h4>Kritik dan Saran</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	          <th>No</th>
	          <th>ID Klinik</th>
              <th>Tanggal</th>
              <th>Nama</th>
              <th>No Telepon</th>
              <th>Beauty</th>
              <th>Kritik dan Saran</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php 
             $tgls = "";
			if ($id_kk == 0) {
				$q1 = mysql_query("SELECT *FROM krisar WHERE tanggal between '$_GET[tanggal1]' AND '$_GET[tanggal2]'"); 
              $no =1;
              while ($br = mysql_fetch_array($q1)) {?>
	            <tr>
	              <td><?php echo $no; ?></td>
				  <td><?php echo $br['id_kk']; ?></td>
	              <td><?php echo $br['tanggal']; ?></td>
	              <td><?php echo $br['nama']; ?></td>
	              <td><?php echo $br['no_telp']; ?></td>
	              <td><?php echo $br['beauty']; ?></td>
	              <td><?php echo $br['krisar']; ?></td>
	            </tr>
	                <?php
	                
	                	if($br["tanggal"] == $tgls){
											
										}
											else {
												echo "<tr><td colspan = 6 style='background: #00a65a'></td></tr>";
											}
									
											$tgls = $br["tanggal"];
	                
	                
	                $no++;
	              }?>
			<?php }else{
			     $tgls = "";
				$q1 = mysql_query("SELECT *FROM krisar WHERE tanggal between '$_GET[tanggal1]' AND '$_GET[tanggal2]' AND id_kk='$_GET[id_kk]'"); 
              $no =1;
              while ($br = mysql_fetch_array($q1)) {?>
	            <tr>
	              <td><?php echo $no; ?></td>
	              <?php $q2 = mysql_query("SELECT * daftar_klinik where id_kk='$_GET[id_kk]'");
	              		$k = mysql_fetch_array($q2);?>
				  <td><?php echo $k['nama_klinik']; ?></td>
	              <td><?php echo $br['tanggal']; ?></td>
	              <td><?php echo $br['nama']; ?></td>
	              <td><?php echo $br['no_telp']; ?></td>
	              <td><?php echo $br['beauty']; ?></td>
	              <td><?php echo $br['krisar']; ?></td>
	            </tr>
	                <?php
	                
	                	if($br["tanggal"] == $tgls){
											
										}
											else {
												echo "<tr><td colspan = 6 style='background: #00a65a'></td></tr>";
											}
									
											$tgls = $br["tanggal"];
	                
	                $no++;
	              }?>
			<?php }?>
			  
	    </tbody>
    </table>
    <br/>
</div>
