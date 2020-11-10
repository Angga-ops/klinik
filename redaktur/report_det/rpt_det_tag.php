<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
		//Set Tagihan
		$idt		= $_GET['id'];
		$cek_id		= mysql_query("Select * From tagihan Where id_tagihan='$idt'");
		$hasil_cek	= mysql_fetch_array($cek_id); 
		$ida		= $hasil_cek['id_antrian'];
		//Cek Id Pemeriksaan	
		$cek_per	= mysql_query("Select * From pemeriksaan_pasien Where id_antrian='$ida'");
		$hasil_per	= mysql_fetch_array($cek_per);
		$idper		= $hasil_per['id_periksa'];
		//Total Biaya Lab	
		$cek_lab	= mysql_query("Select Sum(total) as jumlah From pemeriksaan_lab Where id_antrian='$ida'");
		$hasil_cek2	= mysql_fetch_array($cek_lab);
		$total_lab	= $hasil_cek2['jumlah'];
		//Total Biaya Rontgen		
		$cek_ron	= mysql_query("Select Sum(total) as jumlah2 From pemeriksaan_rontgen Where id_antrian='$ida'");
		$hasil_cek3	= mysql_fetch_array($cek_ron);
		$total_ron	= $hasil_cek3['jumlah2'];
		//Total Biaya Tindakan 
		$cek_tin	= mysql_query("Select Sum(biaya) as jumlah3 From pemeriksaan_tindakan Where id_antrian='$ida'");
		$hasil_tin	= mysql_fetch_array($cek_tin);
		$total_tin	= $hasil_tin['jumlah3'];
		//Total Biaya Kamar
		//Cek Tanggal Kedatangan
		$cek_datang	= mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'");
		$hasil_cek4	= mysql_fetch_array($cek_datang);
		$idp		= $hasil_cek4['id_pasien'];
		$tgl_datang	= $hasil_cek4['tgl_datang'];
		$poli		= $hasil_cek4['id_poli'];
		$dok		= $hasil_cek4['no_idk'];
		//Biaya Dokter
		$sel_dok	= mysql_query("Select * From medis Where no_idk='$dok'");
		$cek_dok	= mysql_fetch_array($sel_dok);
		$dok		= $cek_dok['biaya_praktik'];		
		//Total Biaya Poli
		$cek_poli	= mysql_query("Select * From tujuan Where id_poli='$poli'");
		$hasil_poli	= mysql_fetch_array($cek_poli);
		$total_poli	= $hasil_poli['biaya_poli'];
		//Cek Nama Pasien
		$data_pas	= mysql_query("Select * From pasien Where id_pasien='$idp'");
		$hasil_pas	= mysql_fetch_array($data_pas);
		$nama_pas	= $hasil_pas['nama_pasien'];
		//Cek Harga Kamar
		$id_kamar	= $hasil_cek4['id_kamar'];
		$cek_kamar	= mysql_query("Select * From kamar Where id_kamar='$id_kamar'");
		$hasil_cek5	= mysql_fetch_array($cek_kamar);
		$harga_kmr	= $hasil_cek5['biaya_kamar'];
		//Cek Tanggal Keluar
		$tgl_keluar	= date("Y-m-d");
		//Cek Total Harga Kamar
		$selisih	= ((abs(strtotime ($tgl_datang) - strtotime ($tgl_keluar)))/(60*60*24) + 1);
		$total_kmr	= ($selisih * $harga_kmr);
		$total_dok	= ($selisih * $dok); 
		//Total Tagihan
		$total_tag	= ($total_poli + $total_tin + $total_lab + $total_ron + $total_kmr + $total_dok);
		/*Set Tagihan*/
		$tagihan	= mysql_query("Update tagihan Set biaya_poli='$total_poli', biaya_dokter='$total_dok', biaya_tindakan='$total_tin', biaya_lab='$total_lab', biaya_rontgen='$total_ron', biaya_kamar='$total_kmr', total='$total_tag' Where id_tagihan='$idt'");
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
	<div align="center">
    <h2>DATA TAGIHAN PASIEN</h2>
  <table width="100%" id="rpt">
        <tr>
       	  <td height="35">Id. Tagihan</td>
            <td><?php echo $idt; ?></td>
            <td>Biaya Poli</td>
            <td>
            	<div align="right"><span style="float:left;">Rp.</span><?php echo rupiah2($total_poli); ?>			</div></td>
        </tr>
    
        <tr>
          <td height="35">Id. Antrian</td>
            <td>
				<?php echo $ida; ?>
            <td>Biaya Periksa</td>
            <td><div align="right"><span style="float:left;">Rp.</span><?php echo rupiah2($total_tin); ?></div></td>
        </tr>

        <tr>
          <td height="35">Id. Pasien</td>
            <td><?php echo $idp; ?></td>
            <td>Biaya Dokter</td>
            <td>	
            	<div align="right"><span style="float:left;">Rp.</span><?php echo rupiah2($total_dok); ?>			</div></td>
        </tr>
    
        <tr>
          <td height="35">Nama Pasien</td>
            <td><?php echo $nama_pas; ?></td>
            <td>Biaya Lab</td>
            <td>
            	<div align="right"><span style="float:left;">Rp.</span><?php echo rupiah2($total_lab); ?>			</div></td>
        </tr>
    
        <tr>
          <td height="35">Poli</td>
            <td><?php echo $hasil_poli['nama_poli']; ?></td>
            <td>Biaya Rontgen</td>
            <td><div align="right"><span style="float:left;">Rp.</span><?php echo rupiah2($total_ron); ?>			</div></td>
        </tr>

        <tr>
          <td height="35">Dokter</td>
          <td><?php echo $cek_dok['nama_tm']; ?></td>
          <td>Biaya Kamar</td>
          <td><div align="right"><span style="float:left;">Rp.</span>(<?php echo $selisih; ?> Hari) <?php echo rupiah2($total_kmr); ?> </div></td>
        </tr>
    <tr>
            <td height="35">&nbsp;</td>
            <td>&nbsp;</td>
            <td><b>Total Tagihan</b></td>
            <td><div align="right"><b><span style="float:left;">Rp.</span><?php echo rupiah2($total_tag); ?></b></div></td>
    </tr>
	</table>
</div>