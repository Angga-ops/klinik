<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$per	= mysql_fetch_array(mysql_query("Select * From pemeriksaan_pasien Where id_periksa='$id'"));
	$ida	= $per['id_antrian'];
	$pas	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
	$idp	= $pas['id_pasien'];
	$detp	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idp'"));
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
	<div align="center">
    <h2>REVIEW PEMERIKSAAN PASIEN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Id. Pemeriksaan : <?php echo $id; ?></div></td>
        </tr>    
    </table>
	<table width="100%" class="table1">
        <thead>
        <tr>
        	<th>Uraian</th>
        	<th>Detail</th>
        </tr>
        </thead>
        <tr>
			<td><div align="left">No. RM</div></td>
			<td><div align="right"><?php echo $idp; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Nama Pasien</div></td>
			<td><div align="right"><?php echo $detp['nama_pasien']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Gejala</div></td>
			<td><div align="right"><?php echo $per['gejala']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Pemeriksaan</div></td>
			<td><div align="right"><?php echo $per['pemeriksaan']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Penunjang</div></td>
			<td><div align="right"><?php echo $per['penunjang']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Diagnosa</div></td>
			<td><div align="right"><?php echo $per['diagnosa']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Keterangan</div></td>
			<td><div align="right"><?php echo $per['keterangan']; ?></div></td>
		</tr>
        <tr>
			<td><div align="left">Waktu Periksa</div></td>
			<td><div align="right"><?php echo tgl_indo($per['tgl_periksa']).' - '.substr($per['jam_periksa'], 0,5); ?> WIB</div></td>
		</tr>
    </table>
	<br />
    <h2>RESEP PEMERIKSAAN PASIEN</h2>
    <table class="table1" width="50%">
    	<thead>
        <tr>
			<th>Obat</th>
			<th>Jumlah</th>
			<th>Satuan</th>
        </tr>
        </thead>
		<tbody>
		<?php
			$obt	= mysql_query("Select * From obat_resep Where id_periksa='$id'");
			while($hasil = mysql_fetch_array($obt)){
			$ido	= $hasil['id_obat'];
			$dt_obt	= mysql_fetch_array(mysql_query("Select * From obat Where id_obat='$ido'"));
		?>
        <tr>
       	  <td><?php echo $dt_obt['nama_obat']; ?></td>
        	<td><?php echo $hasil['jumlah_or']; ?></td>
        	<td><?php echo $dt_obt['satuan']; ?></td>
        </tr>
        <?php
			}
		?>
        </tbody>
    </table>
    <br />
    <table width="80%">
    	<tr>
	        <td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>    
		<tr>
			<td height="200"><div align="right">Bagian Pemeriksaan</div></td>        
        </tr>
    </table>
	</div>