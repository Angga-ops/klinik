<?php
session_start();
?>
<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");
?>
<style type="text/css" media="print">
  @page { size: landscape; }
</style>
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
    width: 15%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}

</style>
<div align="center">
	<h2>Laporan Transaksi </h2>
</div>
<?php 
$id = $_GET['id'];
$q = mysqli_query($con, "SELECT *FROM pasien WHERE id_pasien='$_GET[id]'"); 
$p = mysqli_fetch_array($q);
?>
<div class="row">
        <div class="col-md-2">
          Nama Pelanggan
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['nama_pasien']; ?>
        </div>
      </div>
      <br>
<div align="center">
	<table width="100%" class="table1">
		<thead>
	      <tr>
	        <th>Kasir</th>
	        <th>Nama</th>
	        <th>Jenis</th>
	        <th>Jumlah</th>
	        <th>Harga</th>
	        <th>Diskon</th>
	        <th>Sub Total</th>
	      </tr>
	    </thead>
	    <tbody>
	    	<?php 
	    	$id_kk = $_SESSION['klinik'];
	    	$jenis = $_SESSION['jenis_u'];

	    	if ($jenis=="JU-06") {
	    		$q = mysqli_query($con, "SELECT *FROM pembayaran p JOIN daftar_klinik d ON p.id_kk=d.id_kk WHERE p.id_pasien='$id' AND p.id_kk='$id_kk'"); 
	    	}else{
	    		$q = mysqli_query($con, "SELECT *FROM pembayaran p JOIN daftar_klinik d ON p.id_kk=d.id_kk WHERE p.id_pasien='$id'"); 
	    	}
	    	

	    		while($d= mysqli_fetch_array($q)){ 
	    			$q2 = mysqli_query($con, "SELECT *FROM history_kasir h JOIN user u ON h.id_kasir=u.id_user WHERE h.no_faktur='$d[no_faktur]'");
	    			$cek = mysqli_num_rows($q2);
	    			if ($cek==0) {
	    				continue;
	    			}
	    			while ($p=mysqli_fetch_array($q2)) { ?>
	    	<tr>
	    		<td><?php echo $p['nama_lengkap']; ?></td>
	    		<td><?php echo $p['nama']; ?></td>
	    		<td><?php echo $p['jenis']; ?></td>
	    		<td><?php echo $p['jumlah']; ?></td>
	    		<td><?php echo rupiah($p['harga']); ?></td>
	    		<td>
	    			<?php 
	    			if ($p['jenis']=="Produk") {
	    				echo $d['diskon_pr']."%"; 
	    				$dis_s = $d['diskon_pr'];
	    			}else{
	    			 	echo $d['diskon_tr']."%"; 
	    			 	$dis_s = $d['diskon_tr'];
	    			}

	    			?>
	    			
	    			
	    		</td>
	    		<td>
	    			<?php 
	    			$sub_to = $p['jumlah']*$p['harga']; 
	    			$min    = ($dis_s/100)*$sub_to;
	    			$sub_to = $sub_to-$min;

	    			echo rupiah($sub_to); 
	    			?>
	    		</td>
	    	</tr>
	    <?php } ?>
	    	<tr>
	    		<th>Cabang Klinik</th>
	    		<td><?php echo $d['nama_klinik']; ?></td>
	    		<th>No.Faktur</th>
	    		<td><?php echo $d['no_faktur']; ?></td>
	    		<td><b>Diskon Total</b> = <?php echo $d['diskon']."%"; ?></td>
	    		<th>Total</th>
	    		<td><?php echo rupiah($d['total']); ?></td>
	    	</tr>
	    	<?php
	    			
	    		}
	    	?>
		</tbody>
    </table>
    <br>
</div>