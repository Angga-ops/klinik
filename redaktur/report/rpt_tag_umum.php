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
    <h2>DATA TAGIHAN PASIEN (UMUM)</h2>
	<table width="100%" class="table1">
        <thead>
        <tr>
        	<th>Pasien</th>
        	<th>Antrian</th>
        	<th>Tgl. Datang</th>
        	<th>Biaya</th>
        </tr>
        </thead>
		<tbody>
		<?php
			$data 	= mysql_query("Select * From perawatan_pasien, pasien, jenis_pembayaran, tagihan Where perawatan_pasien.id_antrian=tagihan.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien And pasien.id_jenispem=jenis_pembayaran.id_jenispem And nama_jenispem='Umum'");
			while($hasil = mysql_fetch_array($data)){
		?>
        <tr>
        	<td><?php echo $hasil['nama_pasien']; ?></td>
        	<td><?php echo $hasil['antrian']; ?></td>
        	<td><?php echo tgl_indo($hasil['tgl_datang']); ?></td>
        	<td><div align="right"><a target="_blank" href="../report_det/rpt_det_tag.php?id=<?php echo $hasil['id_tagihan']; ?>"><?php echo rupiah($hasil['total']); ?></a></div></td>
        </tr>
        <?php
			}
			$tot 	= mysql_fetch_array(mysql_query("Select sum(total) as total From perawatan_pasien, pasien, jenis_pembayaran, tagihan Where perawatan_pasien.id_antrian=tagihan.id_antrian And perawatan_pasien.id_pasien=pasien.id_pasien And pasien.id_jenispem=jenis_pembayaran.id_jenispem And nama_jenispem='Umum'"));
		?>
        <tr>
        	<td colspan="3"><strong>Total</strong></td>
        	<td><div align="right"><strong><?php echo rupiah($tot['total']); ?></strong></div></td>
        </tr>        
        </tbody>
    </table>
</div>