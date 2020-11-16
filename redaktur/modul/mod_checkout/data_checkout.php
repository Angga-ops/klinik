<?php
	switch($_GET['act']){
	default:
?>
   <div id='main-content'>
   <div class='container_12'>
   <div class='grid_12'>
   <div class='block-border'>
   <div class='block-header'>
   <h1>Data Checkout</h1>
   <span></span>
   </div>
   <div class='block-content'>
    <table id='table-example' class='table'>
    <thead>
        <tr>
            <th>Id. Checkout</th>
            <th>Id. Antrian</th>
            <th>No. RM</th>
            <th>Pasien</th>
            <th>Kondisi</th>
            <th>Checkout</th>
            <th>Aksi</th>
		</tr>
    </thead>
    <tbody>
<?php
	$data 			= mysqli_query($con, "Select * From checkout");
	while($hasil	= mysqli_fetch_array($data)){
	$tgl_cko		= tgl_indo($hasil['tgl_checkout']);
	$ida			= $hasil['id_antrian'];
	$atr			= mysqli_fetch_array(mysqli_query($con, "Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idp			= $atr['id_pasien'];
	$pas			= mysqli_fetch_array(mysqli_query($con, "Select * From pasien Where id_pasien='$idp'"));
?>

  <tr class="gradeX">
	<td><?php echo $hasil['id_checkout']; ?></td>
	<td><?php echo $hasil['id_antrian']; ?></td>
	<td><?php echo $atr['id_pasien']; ?></td>
	<td><?php echo $pas['nama_pasien']; ?></td>
	<td><?php echo $hasil['kondisi_pas']; ?></td>
	<td><?php echo $tgl_cko." - ".substr($hasil['jam_checkout'], 0,5)." WIB" ?></td>
	<td><a target="_blank" href="report/rpt_ck.php?id=<?php echo $hasil['id_checkout']; ?>"><img src="img/id-card.png" /></a></td>
</tr>
<?php
    }
?>
</tbody>
</table>
  </div>
  </div>
  </div>
<?php
	break;
	case"input_checkout":
	$ida		= $_GET['id'];
	$sel_tag	= mysqli_query($con, "Select * From tagihan Where id_antrian='$ida'");
	$data_tag	= mysqli_fetch_array($sel_tag);
	$idt		= $data_tag['id_tagihan'];
	$tagihan	= $data_tag['total'];
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
	    <div class="block-header">
        <h1>INPUT DATA CHECKOUT</h1>
        </div>
    <div class='block-content'>
  <form method="post" action="modul/mod_checkout/aksi_checkout.php?module=checkout&act=input" enctype="multipart/form-data">
	<?php
		/*Id Tagihan*/
		$ida			= $_GET['id'];
		$sel_tag		= mysqli_query($con, "Select * From tagihan Where id_antrian='$ida'");
		$cek_tag		= mysqli_fetch_array($sel_tag);
		$tag			= $cek_tag['id_tagihan'];
		$now 			= date('Y-m-d');
		$selectidmax 	= mysqli_query($con, "SELECT max(id_checkout) as id_cko, tgl_checkout FROM checkout WHERE tgl_checkout='$now'");
		$hsilidmax 		= mysqli_fetch_array($selectidmax);
		$idmax 			= $hsilidmax['id_cko'];
		$nourut 		= (int) substr($idmax, 10,3);
		$nourut++;
		/*Ambil Kode Tanggal*/
        $tgl 		= date('d');
        $bln 		= date('m');
        $thn 		= date('Y');
        $thn2		= substr($thn,2,2);
        $sekarang   = "".$thn2."".$bln."".$tgl;
    ?>

	<p class="inline-small-label">
	<label for="field4">Id. Checkout</label>
		<input type="text" style="text-align:center;" name="id_cko" size="25" value="<?php echo $idbaru = "CKO-".$sekarang. sprintf("%03s", $nourut); ?>"/>
	</p>

	<p class="inline-small-label">
	<label for="field4">Id. Tagihan</label>
		<input type="text" style="text-align:center;" name="id_tag" size="25" value="<?php echo $tag; ?>"/>
	</p>

	<p class="inline-small-label">
	<label for="field4">No. RM</label>
		<input type="text" style="text-align:center;" name="id_antrian" size="25" readonly="readonly" value="<?php echo $ida; ?>" />
	</p>

	<p class="inline-small-label">
	<label for="field4">Cara Keluar</label>
		<select name="kondisi" required>
        	<option value="">-- Pilih --</option>
        	<option value="Persetujuan Dokter">Persetujuan Dokter</option>
        	<option value="Pulang Paksa">Pulang Paksa</option>
        	<option value="Pindah RS Lain">Pindah RS Lain</option>
        	<option value="Meniggal">Menginggal</option>
        </select>
	</p>

	<p class="inline-small-label">
	<label for="field4">Kondisi</label>
		<select name="keterangan" required>
        	<option value="">-- Pilih Kondisi --</option>
        	<option value="Sehat">Sehat</option>
        	<option value="Sakit">Sakit</option>        
        	<option value="Meninggal">Meninggal</option>        
        </select>
	</p>

	<p class="inline-small-label">
	<label for="field4">Tgl. Checkout</label>
		<input type="text" style="text-align:center;" name="tgl_cko" size="25" value="<?php echo $now; ?>" />
	</p>

   <div class=block-actions>
   <ul class=actions-right>
   <li>
   <a class='button red' id=reset-validate-form href='?module=antrianbaru'>Batal</a>
   </li> </ul>
   <ul class=actions-left>
   <li>
   <input type='submit' name='upload' class='button' value=' Simpan &nbsp;&nbsp;&nbsp;&nbsp;'>
   </li> </ul>
   </form>
<?php	
	break;
	}
?>