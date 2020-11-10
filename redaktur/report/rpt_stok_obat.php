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
	<h2>Laporan Stok Obat Apotek</h2>    
	<table width="100%" class="table1">
	<thead>
    	<tr>
        	<th>Obat</th>
        	<th>Jumlah</th>
        	<th>Satuan</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$stok	= mysql_query("Select nama_obat, satuan, jumlah From obat, obat_stok Where obat.id_obat=obat_stok.id_obat");
		while($hasil	= mysql_fetch_array($stok)){    
    ?>
    	<tr>
        	<td><?php echo $hasil['nama_obat']; ?></td>
        	<td><?php echo $hasil['jumlah']; ?></td>
        	<td><?php echo $hasil['satuan']; ?></td>
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