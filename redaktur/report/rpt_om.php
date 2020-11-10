<script type="text/javascript">
window.print();
</script>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$tgl1	= $_POST['tgl_awal'];
	$tgl2	= $_POST['tgl_akhir'];
?>
	<div align="center">
	<h2>REVIEW OBAT MASUK</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">Periode : <?php echo tgl_indo($tgl1).' s/d '.tgl_indo($tgl2); ?></div></td>
        </tr>
	</table>      	
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
        <tr>
			<td><div align="center" id="donker">Tanggal</div></td>
			<td><div align="center" id="donker">Poli</div></td>
			<td><div align="center" id="donker">Medis</div></td>
			<td><div align="center" id="donker">Pemeriksaan</div></td>
			<td><div align="center" id="donker">Uji Lab</div></td>
			<td><div align="center" id="donker">Rontgen</div></td>
			<td><div align="center" id="donker">Ruangan</div></td>
			<td><div align="center" id="donker">Obat</div></td>
			</tr>
        <?php
			$om		= mysql_fetch_array(mysql_query("Select tgl_datang, no_faktur, nama_pt, sum(total_harga) as total From supplier, obat_masuk Where supplier.id_supplier=obat_masuk.id_supplier And (tgl_datang Between '$tgl1' And '$tgl2') Group by tgl_datang"));
		?>
        <tr>
        	<td><?php echo $om['tgl_datang']; ?></td>
			<td><div align="right"><a target="_blank" href="../report_det/det_pem_poli.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo $om['no_faktur']); ?></a></div></td>
			<td><div align="right"><a target="_blank" href="../report_det/det_pem_medis.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo $om['nama_pt']); ?></a></div></td>
			<td><div align="right"><a target="_blank" href="../report_det/det_pem_ron.php?id=<?php echo $pem['tgl_tercatat']; ?>"><?php echo rupiah($om['total']); ?></a></div></td>
		</tr>
        <?php
			}
		?>
    </table>
</div>