<script type="text/javascript">
window.print();
</script>
<?php
	include("../../config/koneksi.php");
	include("../../config/fungsi_rupiah.php");
	include("../../config/fungsi_indotgl.php");
?><style>
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
	<h2>Laporan Transaksi Obat Masuk</h2>    
	<table width="100%" class="table1">
		<?php
			$id		= $_POST['id_dr'];
			$tg	= $_POST['tgl'];
    $tgl = explode(" - ",$tg);
    $tgl_1 = explode("/",$tgl[0]);
    $tgl_2 = explode("/",$tgl[1]);

    $tgl1 = $tgl_1[2]."-".$tgl_1[0]."-".$tgl_1[1];
    $tgl2 = $tgl_2[2]."-".$tgl_2[0]."-".$tgl_2[1];
		?>
		<thead>
            <tr>
                <th>Tanggal</th>
                <th>Jumlah</th>
            </tr>
		</thead>
		<tbody>
		<?php
			$om		= mysql_query("Select tgl_rd, count(id_antrian) as total From riwayat_dokter Where no_idk='$id' And tgl_rd Between '$tgl1' And '$tgl2' Group by tgl_rd");
			while($hasil	= mysql_fetch_array($om)){			
		?>
            <tr>
                <td><?php echo $hasil['tgl_rd']; ?></td>
                <td><a target="_blank" href="../report_det/det_rd.php?id=<?php echo $id; ?>&tgl=<?php echo $hasil['tgl_rd']; ?>"><?php echo $hasil['total']; ?> Pasien</a></td>
            </tr>  
		<?php
			}
		?>
    	</tbody>
    </table>
	</div>