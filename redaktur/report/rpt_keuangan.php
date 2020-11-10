<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl1	= $_POST['tgl_awal'];	
	$tgl2	= $_POST['tgl_akhir'];
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
    <h2>RIVIEW KEUANGAN RUMAH SAKIT</h2>
	<table width="100%">
		<tr>
			<td><div align="left"><?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2) ?></div></td>
		</tr>    
    </table>
	<table width="100%" class="table1">
        <?php
			//Total Poli
			$tot_poli	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_poli) as tot_poli From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));		
			//Total Dokter
			$tot_medis	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_dokter) as tot_medis From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			//Total Tindakan
			$tot_tin	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_tindakan) as tot_tindakan From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			//Total Lab
			$tot_lab	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_lab) as tot_lab From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			//Total Rontgen
			$tot_ron	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_rontgen) as tot_ron From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			//Total Kamar
			$tot_kmr	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(biaya_kamar) as tot_kamar From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			//Total Pemasukan
			$tot_pem	= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(total) as tot_pem From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));					
			//Total Obat RS
			$tot_obt	= mysql_fetch_array(mysql_query("Select sum(total_harga) as tot_obt From pembayaran_resep Where sts_pem='Lunas' And (tgl_pemrsp Between '$tgl1' And '$tgl2')"));
			//Total Penjualan Obat
			$tot_po		= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From pembayaran_po Where ket_pepo='Lunas' And (tgl_pepo Between '$tgl1' And '$tgl2')"));
		?>
        <thead>
    	<tr>
			<th><div align="center">Uraian</th>
        	<th><div align="center">Pengeluaran</th>
        	<th><div align="center">Pemasukan</th>
		</tr>
    	</thead>
        <tr>
    	  	<td>Poli</td>
            <td><div align="right"></div></td>
        	<td><div align="right"><?php echo rupiah($tot_poli['tot_poli']); ?></div></td>
        	</tr>
    	<tr>
    	  	<td>Tenaga Medis</td>
        	<td><div align="right"></div></td>
        	<td><div align="right"><?php echo rupiah($tot_medis['tot_medis']); ?></div></td>
        	</tr>
    	<tr>
			<td>Pemeriksaan</td>
			<td><div align="right"></div></td>
			<td><div align="right"><?php echo rupiah($tot_tin['tot_tindakan']); ?></div></td>
		</tr>
    	<tr>
            <td>Uji Lab</td>
            <td><div align="right"></div></td>
            <td><div align="right"><?php echo rupiah($tot_lab['tot_lab']); ?></div></td>
        </tr>
    	<tr>
            <td>Rontgen</td>
            <td><div align="right"></div></td>
            <td><div align="right"><?php echo rupiah($tot_ron['tot_ron']); ?></div></td>
        </tr>
    	<tr>
            <td>Kamar/Ruangan</td>
            <td><div align="right"></div></td>
            <td><div align="right"><?php echo rupiah($tot_kmr['tot_kamar']); ?></div></td>
            </tr>
    	<tr>
            <td>Obat RS</td>
            <td><div align="right"></div></td>
            <td><div align="right"><?php echo rupiah($tot_obt['tot_obt']); ?></div></td>
		</tr>
    	<tr>
            <td>Penjualan Obat</td>
            <td><div align="right"></div></td>
            <td><div align="right"><?php echo rupiah($tot_po['total']); ?></div></td>
		</tr>
		<?php
			$tot_pop	= mysql_query("Select det_pop, ket_pop, sum(jumlah_pop) as tot_pop From pengeluaran_op Where (tgl_pop Between '$tgl1' And '$tgl2') Group by ket_pop");		
			while($pop	= mysql_fetch_array($tot_pop)){
		?>
    	<tr>
    	  <td><?php echo $pop['ket_pop']; ?> (<?php echo $pop['det_pop']; ?>)</td>
        	<td><div align="right"><?php echo rupiah($pop['tot_pop']); ?></div></td>
        	<td><div align="right"></div></td>
       	</tr>        
		<?php
			}
			$pem1		= mysql_fetch_array(mysql_query("Select pembayaran.keterangan, sum(total) total From pembayaran, tagihan Where pembayaran.id_tagihan=tagihan.id_tagihan And pembayaran.keterangan='Lunas' And (tgl_tercatat Between '$tgl1' And '$tgl2')"));
			$obt1		= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From pembayaran_resep Where sts_pem='Lunas' And (tgl_pemrsp Between '$tgl1' And '$tgl2')"));		
			$obt2		= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From pembayaran_po Where ket_pepo='Lunas' And (tgl_pepo Between '$tgl1' And '$tgl2')"));		
			$png1		= mysql_fetch_array(mysql_query("Select sum(jumlah_pop) as total From pengeluaran_op Where (tgl_pop Between '$tgl1' And '$tgl2')"));		
			//Kalkulasi
			$pemasukan	= $pem1['total'] + $obt1['total'] + $obt2['total'];
			$pengeluaran = $png1['total'];
			$hasil		= ($pemasukan - $pengeluaran);
		function laba_rugi($data1, $data2){
			if($data2 > $data1){
				echo 'Rugi';
			} elseif($data2 == $data1){
				echo 'Impas';
			} elseif($data2 < $data1){
				echo 'Untung';
			}
		}
		?>
        
		<tr>
            <td><div align="left" id="hitam">Kalkulasi</div></td>
            <td><div align="right" id="hitam"><?php echo rupiah($pengeluaran); ?></div></td>
            <td><div align="right" id="hitam"><?php echo rupiah($pemasukan); ?></div></td>
        </tr>
		<tr>
            <td><div align="left" id="donker"><strong>Total</strong></div></td>
          <td colspan="2"><div align="right"><strong><?php echo rupiah($hasil);?> (<?php echo laba_rugi($pemasukan, $pengeluaran); ?>)</strong></div></td>
	  </tr>
    </table>
</div> 