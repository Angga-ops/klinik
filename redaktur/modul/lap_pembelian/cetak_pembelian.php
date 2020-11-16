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
	$p = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM history_beli_t WHERE tgl_beli between '$_GET[tgl1]' AND '$_GET[tgl2]'"));
?>
<div align="center">
	<h4>Pembelian Produk Pada Tanggal : <?php echo $_GET['tgl1']; ?> Sampai Tanggal : <?php echo $_GET['tgl2']; ?></h4>
</div>
<div align="center">
	<div align="left"><h4>Produk Yang Dibeli</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	          <th>No</th>
              <th>Kode Barang</th>
              <th>Nama Barang</th>
              <th>Jumlah</th>
              <th>Harga</th>
              <th>Diskon %</th>
              <th>Sub Total</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php $q1 = mysqli_query($con, "SELECT *FROM history_beli_t WHERE tgl_beli between '$_GET[tgl1]' AND '$_GET[tgl2]'"); 
              $no =1;
              while ($br = mysqli_fetch_array($q1)) {
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['kd_brg']; ?></td>
              <td><?php echo $br['nama_brg']; ?></td>
              <td><?php echo $br['jumlah']; ?></td>
              <td><?php echo $br['hrg']; ?></td>
              <td><?php echo $br['diskon']; ?> %</td>
              <td><?php echo $br['sub_tot']; ?></td>
            </tr>
                <?php
                $no++;
              }
            ?>
	    </tbody>
	    <tfoot>
		<tr>
			<td><b>TOTAL</b></td>
		<?php
          $jumlahkan = "SELECT SUM(sub_tot) AS total FROM history_beli_t where tgl_beli between '$_GET[tgl1]' AND '$_GET[tgl2]'"; //perintah untuk menjumlahkan
          $total =@mysqli_query($con, $jumlahkan) or die (mysqli_error($con));//melakukan query dengan varibel $jumlahkan
          $t = mysqli_fetch_array($total); //menyimpan hasil query ke variabel $t
          echo '
          	<td>-</td>
          	<td>-</td>
          	<td>-</td>
          	<td>-</td>
          	<td>-</td>
			<td><b>'.rupiah($t['total']).'<b></td>';
			?>

		</tr>
	</tfoot>
    </table>
    <br/>
</div>