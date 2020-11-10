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
$harian = date('Y-m-d');
	$p = mysql_fetch_array(mysql_query("SELECT *FROM history_kasir WHERE tanggal='$harian'"));
?>
<div align="center">
	<h3>Pendapatan pada tanggal : <?php echo $harian; ?></h3>
</div>
<div align="center">
	<div align="left"><h4>Produk Yang Terjual</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	    		<th>No Faktur</th>
		        <th>Tanggal</th>
	 	        <th>Nama Produk/Jasa</th>
	            <th>Harga</th>
	            <th>Jumlah</th>
	            <th>Jenis</th>
	            <th>Sub Total</th>
	            <th>Status</th>
			            
	        </tr>
	    </thead>
	    <tbody>
		<?php $q1 = mysql_query("SELECT *FROM history_kasir WHERE tanggal='$harian'"); 
              $no =1;
              while ($br = mysql_fetch_array($q1)) {
              	$subtotal= $br['harga']*$br['jumlah'];
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['no_faktur']; ?></td>
              <td><?php echo $br['tanggal']; ?></td>
              <td><?php echo $br['nama']; ?></td>
              <td><?php echo $br['harga']; ?></td>
              <td><?php echo $br['jumlah']; ?></td>
              <td><?php echo $br['jenis']; ?></td>
              <td><?php echo $subtotal; ?></td>
              <td><?php echo $br['Status']; ?></td>
              
            </tr>
                <?php
                $no++;
              }
            ?>
	    </tbody>
	   <!--  -->
    </table>
    <br/>
</div>