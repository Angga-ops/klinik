<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
?>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<div align="center">
	<h2>Laporan Data Obat Apotek</h2>    
	<table width="100%" class="table1">
	<thead>
    	<tr>
        	<th>Obat</th>
        	<th>Satuan</th>
        	<th>Keterangan</th>
        	<th>Harga Jual</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$obat			= mysql_query("Select * From obat");
		while($hasil	= mysql_fetch_array($obat)){    
    ?>
    	<tr>
        	<td><?php echo $hasil['nama_obat']; ?></td>
        	<td><?php echo $hasil['satuan']; ?></td>
        	<td><?php echo $hasil['keterangan']; ?></td>
        	<td><div align="right"><?php echo rupiah($hasil['harga_jual']); ?></div></td>
        </tr>
	<?php
		}
	?>
    </tbody>
    </table>
    <br />
  <table width="100%">
    	<tr>
            <td><div align="right">Indramayu, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
    	<tr>
            <td height="200"><div align="right">Bagian Apotek</div></td>
        </tr>
  </table>
</div>