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
			$tgl	= $_GET['tgl'];
		?>
		<thead>
            <tr>
                <th>Pasien</th>
                <th>Keterangan</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$om		= mysql_query("Select * From riwayat_dokter Where no_idk='$id' And tgl_rd Like '%$tgl%'");
			while($hasil	= mysql_fetch_array($om)){
			$ida	= $hasil['id_antrian'];
			$per	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
			$idp	= $per['id_pasien'];
			$pas	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$idp'"));
			
		?>
            <tr>
                <td><?php echo $pas['nama_pasien']; ?></td>
                <td><?php echo $hasil['ket_rd']; ?></td>
            </tr>  
		<?php
			}
		?>
    	</tbody>
    </table>
	</div>