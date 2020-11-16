   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Tagihan Pasien</h1>
   <span></span>
   </div>
   <div class='block-content'>
   <table id='table-example' class='table'>
   <thead>
   <tr>
	<th>Id. Tagihan</th>
	<th>Pasien</th>
	<th>Golongan</th>
	<th>Proses</th>
   </tr>
   </thead>
   <tbody>
<?php
	$data 	= mysqli_query($con, "Select * From perawatan_pasien, pasien, jenis_pembayaran, tagihan Where perawatan_pasien.id_antrian=tagihan.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien And pasien.id_jenispem=jenis_pembayaran.id_jenispem And nama_jenispem='Umum' Group by id_tagihan");
	while($hasil= mysqli_fetch_array($data)){
	$tgl_datang	= tgl_indo($hasil['tgl_periksa']);
    ?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_tagihan']; ?></td>
	<td><?php echo $hasil['nama_pasien']; ?></td>
	<td><?php echo $hasil['nama_jenispem']; ?></td>
	<td>
		<?php
			$idt		= $hasil['id_tagihan'];
			$sel_lunas	= mysqli_query($con, "Select * From pembayaran Where id_tagihan='$idt'");
			$cek_lunas	= mysqli_fetch_array($sel_lunas);
			$lunas		= $cek_lunas['keterangan'];
        	if($lunas == 'Lunas'){
		?>
	        <a href="#"><center>Riwayat</center></a>
		<?php
			} else {
		?>
	        <a href="?module=pembayaran&id=<?php echo $idt; ?>"><center>Pembayaran</center></a>
		<?php
			}
		?>    
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