<script type="text/javascript">
window.print();
</script>
<link href="../css/paid.css" rel="stylesheet" type="text/css" />
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
	$id		= $_GET['id'];
	$data	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$id'"));
?>
	<div align="center">
	<h2>REVIEW DATA PASIEN</h2>
	<table width="100%">
        <tr>
        	<td><div align="left">No. RM : <?php echo $id; ?></div></td>
        </tr>
	</table>      	
	<table width="100%" class="table1">
        <thead>
        <tr>
			<th>Uraian</th>
			<th>Detail</th>
		</tr>
        </thead>
        <tbody>
		<tr>
            <td>Nama Pasien</td>
            <td><div align="right"><?php echo $data['nama_pasien']; ?></div></td>
		</tr>
        <tr>
            <td>Agama</td>
            <td><div align="right"><?php echo $data['agama']; ?></div></td>
        </tr>
		<tr>
            <td>Suku</td>
            <td><div align="right"><?php echo $data['suku']; ?></div></td>
        </tr>
		<tr>
            <td>Kewarganegaraan</td>
            <td><div align="right"><?php echo $data['kewarganegaraan']; ?></div></td>
		</tr>
		<tr>
            <td>Pendidikan</td>
            <td><div align="right"><?php echo $data['pendidikan']; ?></div></td>
        </tr>
		<tr>
            <td>Pekerjaan</td>
            <td><div align="right"><?php echo $data['pekerjaan']; ?></div></td>
		</tr>
		<tr>
            <td>Status Pernikahan</td>
            <td><div align="right"><?php echo $data['status_pernikahan']; ?></div></td>
        </tr>
		<tr>
            <td>Golongan Darah</td>
            <td><div align="right"><?php echo $data['gol_darah']; ?></div></td>
        </tr>
		<tr>
            <td>Usia</td>
            <td><div align="right"><?php echo $data['umur']; ?> Tahun</div></td>
        </tr>
		<tr>
            <td>Alamat</td>
            <td><div align="right"><?php echo $data['alamat']; ?></div></td>
        </tr>
		<tr>
        	<td>Riwayat Penyakit</td>
            <td><p align="right" style="text-align:justify;"><?php echo $data['riwayat_penyakit']; ?></p></td>
        </tr>
		<tr>
        	<td>Alergi</td>
          <td><p align="right" style="text-align:justify;"><?php echo $data['alergi_obat']; ?></p></td>
        </tr>
		<tr>
        	<td>Pendaftaran</td>
            <td><div align="right"><?php echo tgl_indo($data['tgl_pendaftaran']); ?></div></td>
        </tr>
        </tbody>
    </table>
	<br />
    <table width="100%">
    	<tr>
        	<td><div align="right">Yogyakarta, <?php echo tgl_indo(date('Y-m-d'));  ?></div></td>
        </tr>
    	<tr>
        	<td height="200"><div align="right">Bagian Administrasi</div></td>
        </tr>
    </table>
</div>