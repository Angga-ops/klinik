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
	<h2>Laporan Transaksi Obat Masuk</h2>    
	<table width="100%" class="table1">
		<?php
			$id		= $_GET['id'];
			$pt		= mysql_fetch_array(mysql_query("Select nama_pt From supplier, obat_masuk Where supplier.id_supplier=obat_masuk.id_supplier And no_faktur='$id'"));
		?>
		<thead>
            <tr>
    			<td><b>Supplier</b></td>        
	            <td colspan="4"><div align="right"><b><?php echo $pt['nama_pt']; ?></b></div></td>
            </tr>
            <tr>
                <th>Obat</th>
                <th>Jumlah</th>
                <th>Harga Beli</th>
                <th>Diskon</th>
                <th>Total Harga</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$om		= mysql_query("Select id_om, nama_pt, nama_obat, jumlah, harga_beli, diskon, total_harga From supplier, obat, obat_masuk Where supplier.id_supplier=obat_masuk.id_supplier And obat.id_obat=obat_masuk.id_obat And no_faktur='$id'");
			$tot	= mysql_fetch_array(mysql_query("Select sum(total_harga) as total From obat_masuk Where no_faktur='$id'"));
			while($hasil	= mysql_fetch_array($om)){
		?>
            <tr>
                <td><?php echo $hasil['nama_obat']; ?></td>
                <td><?php echo $hasil['jumlah']; ?></td>
                <td><div align="right"><?php echo rupiah($hasil['harga_beli']); ?></td>
                <td><?php echo $hasil['diskon']; ?>%</td>
                <td><div align="right"><?php echo rupiah($hasil['total_harga']); ?></td>
            </tr>  
		<?php
			}
		?>
        	<tr>
            	<td><b>Total</b></td>
            	<td colspan="4"><div align="right"><b><?php echo rupiah($tot['total']); ?></b></div></td>
            </tr>
    	</tbody>
    </table>
	</div>