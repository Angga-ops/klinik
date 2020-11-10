<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
    $tgl	= $_GET['id'];	
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>DETAIL PEMASUKAN RUANGAN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl); ?></div></td>
        </tr>    
    </table>
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Id. Antrian</th>
			<th>Kamar</th>
			<th>Lama</th>
			<th>Total Biaya</th>
		</tr>
        </thead>
        <tbody>
		<?php
			$kmr1	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_kamar) as total From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Like '%$tgl%')"));		
			$kmr	= mysql_query("Select id_antrian, pembayaran.keterangan, sum(biaya_kamar) as total From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Like '%$tgl%') Group by id_antrian");		
			while($tot_kmr	= mysql_fetch_array($kmr)){
		?>
        <tr>
        	<?php
				$ida		= $tot_kmr['id_antrian'];
				$jn			= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
				//Selisih
				$tgl_dt		= $jn['tgl_datang'];
				$ck			= mysql_fetch_array(mysql_query("Select * From checkout Where id_antrian='$ida'"));
				$tgl_ck		= $ck['tgl_checkout'];
				$selisih	= ((abs(strtotime ($tgl_dt) - strtotime ($tgl_ck)))/(60*60*24) + 1);
				//Nama Kamar
				$idk	= $jn['id_kamar'];
				$nm		= mysql_fetch_array(mysql_query("Select * From kamar Where id_kamar='$idk'"));
			?>
        	<td><?php echo $tot_kmr['id_antrian']; ?></td>
        	<td><?php echo $nm['nama_kamar']; ?></td>
        	<td><?php echo $selisih; ?> Hari</td>
			<td><div align="right"><?php echo rupiah($tot_kmr['total']); ?></div></td>
        </tr>
        <?php
			}
		?>
		<tr>
        	<td><b>Total</b></td>
        	<td colspan="3"><div align="right"><b>Total : <?php echo rupiah($kmr1['total']); ?></b></div></td>
        </tr>
        </tbody>        
    </table>
</div>    