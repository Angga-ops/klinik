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
$harian = date('Y-m-d');
$tgl = $_GET['tanggal'];
$id_kk = $_GET['klinik'];
	$p = mysql_fetch_array(mysql_query("SELECT *FROM history_kasir WHERE tanggal='$_GET[tanggal]' AND id_kk='$_GET[id_kk]'"));
?>
<div align="center">
	<h3>Penjualan pada tanggal : <?php echo $tgl; ?></h3>
</div>
<div align="center">
	<div align="left"><h4>Produk Yang Terjual</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	    		<th>No</th>
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
		<?php /* $q1 = mysql_query("SELECT history_kasir.*, SUM(harga*jumlah) AS subtotal, SUM(jumlah) AS jml FROM history_kasir WHERE tanggal='$_GET[tanggal]' AND id_kk='$_GET[id_kk]' GROUP BY nama"); 
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
              <td><?php echo $br['jml']; ?></td>
              <td><?php echo $br['jenis']; ?></td>
              <td><?php echo $br['subtotal']; ?></td>
              <td><?php echo $br['status']; ?></td>
              
            </tr>
                <?php
                $no++;
              } */
            ?>
           <?php $q1 = mysql_query("SELECT *FROM history_kasir WHERE tanggal='$_GET[tanggal]' AND id_kk='$_GET[id_kk]'"); 
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
              <td><?php echo $br['status']; ?></td>
              
            </tr>
                <?php
                $no++;
              }
            ?>
	    </tbody>
	    <tfoot>
	    	<tr>
	    		<td>TOTAL</td>
	    		<td>-</td>
	    		<td>-</td>
	    		<td>-</td>
	    		<td>-</td>
	    		<td>-</td>
	    		<td>-</td>
	    		<?php $jumlahkan = "SELECT SUM(harga) AS total FROM history_kasir where tanggal='$_GET[tanggal]' AND id_kk='$_GET[id_kk]'"; //perintah untuk menjumlahkan
			          $total = mysql_query($jumlahkan) or die (mysql_error());//melakukan query dengan varibel $jumlahkan
			          $t = mysql_fetch_array($total);
			          echo '<td>-</td>

						<td><b>'.rupiah($t['total']).'<b></td>';?>
	    	</tr>
	    </tfoot>
	   <!--  -->
    </table>
    <br/>
</div>