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
	<h2>Laporan Data Ruangan</h2>    
	<table width="100%" class="table1">
	<thead>
    	<tr>
        	<th>Kelas</th>
        	<th>Ruangan</th>
        	<th>Tarif</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$kmr			= mysql_query("Select * From kamar, kamar_jenis Where kamar.id_jenkamar=kamar_jenis.id_jenkamar");
		while($hasil	= mysql_fetch_array($kmr)){    
    ?>
    	<tr>
        	<td><?php echo $hasil['kelas']; ?></td>
        	<td><?php echo $hasil['nama_kamar']; ?></td>
        	<td><div align="right"><?php echo rupiah($hasil['biaya_kamar']); ?></div></td>
        </tr>
	<?php
		}
	?>
    </tbody>
    </table>
    <br />
  <table width="100%">
    	<tr>
            <td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d')); ?></div></td>
        </tr>
    	<tr>
            <td height="200"><div align="right">Bagian Administrasi</div></td>
        </tr>
  </table>
</div>