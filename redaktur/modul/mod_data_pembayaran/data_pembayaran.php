   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Pembayaran Pasien</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Pembayaran</th>
	<th>Id. Tagihan</th>
	<th>Id. Antrian</th>
	<th>No. RM</th>
	<th>Pasien</th>
	<th>Aksi</th>
   </tr>
   </thead>
   <tbody>
<?php
	$data 	= mysqli_query($con, "Select id_pembayaran, nama_pasien From pembayaran, tagihan, perawatan_pasien, pasien Where pembayaran.id_tagihan=tagihan.id_tagihan And tagihan.id_antrian=perawatan_pasien.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien Order by id_pembayaran");
	//$tampil=mysql_query("SELECT * FROM antrianbaru ORDER BY ID DESC");
	$hasil2	= mysqli_fetch_array(mysqli_query($con, "Select id_antrian from pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan"));
	$hasil3	= mysqli_fetch_array(mysqli_query($con, "Select id_tagihan, id_pasien From tagihan, perawatan_pasien Where tagihan.id_antrian=perawatan_pasien.id_antrian Order by id_tagihan"));
	while($hasil= mysqli_fetch_array($data)){
	$tgl_datang	= tgl_indo($hasil['tgl_periksa']);
    ?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_pembayaran']; ?></td>
	<td><?php echo $hasil3['id_tagihan']; ?></td>
	<td><?php echo $hasil2['id_antrian']; ?></td>
	<td><?php echo $hasil3['id_pasien']; ?></td>
	<td><?php echo $hasil['nama_pasien']; ?></td>
	<td>
	<a target="_blank" href="report/rpt_bayar.php?id=<?php echo $hasil['id_pembayaran']; ?>"><center>Detail</center></a>
	</td>
    </tr>
<?php
    }
?>
</tbody>
</table>
</div>
</div>
</div>  
</div>  
</div>