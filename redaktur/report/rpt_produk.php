<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
?>
<style>
.table1{
	margin:0 auto;
	border-collapse:collapse;
	background:#FFFFFF;
}
.table1 th{
	border:solid;
	border-width:1px;
	border-color:#000000;
	color:#FFFFFF;
	padding:4px 8px;
	background:#23333E;
}
.table1 td{
	border:solid;
	border-width:1px;
	border-color:#000000;
	padding:4px 8px;
}
#hitam{
	text-align:center;
	background:#333333;
	color:#FFFFFF;
}
#rpt{
	border:solid;
	border-color:#000000;
	border-width:1px;
}
</style>
<div align="center">
	<h2>Laporan Data Produk</h2>    
	<table width="100%" class="table1">
	<thead>
    	<tr>
        	<th>Nama Produk</th>
        	<th>Satuan</th>
        	<th>Keterangan</th>
        	<th>Harga Jual</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$obat			= mysql_query("Select * From produk Where id");
		while($hasil	= mysql_fetch_array($obat)){    
    ?>
    	<tr>
        	<td><?php echo $hasil['nama_produk']; ?></td>
        	<td><?php echo $hasil['satuan']; ?></td>
        	<td><?php echo $hasil['keterangan']; ?></td>
        	<td><?php echo $hasil['harga_jual']; ?></td>
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