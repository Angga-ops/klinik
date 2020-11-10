<?php
session_start();
?>
<script type="text/javascript">
window.print();
</script>
<?php
	include("../../../config/koneksi.php");
	include("../../../config/fungsi_rupiah.php");
	include("../../../config/fungsi_indotgl.php");
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
	color:black;
	padding:4px 8px;
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
.row:after, .row:before {
	display: table;
	content: " ";
}
.row:after {
	clear: both;
}
.col-md-2 {
    width: 20%;
  }
.col-md-1, .col-md-2, .col-md-3, .col-md-4, .col-md-5, .col-md-6, .col-md-7, .col-md-8, .col-md-9, .col-md-10, .col-md-11, .col-md-12 {
    float: left;
}

</style>
<div align="center">
	<h3>Laporan Netto - Bruto</h3>
</div>
<div align="center">
	<table width="100%" class="table1">
		<thead>
            <tr>
                <th>tanggal</th>
                <th>Pendapatan (Bruto)</th>
                <th>Pengeluaran (Kredit)</th>
                <th>Bersih (Netto)</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $bulan = $_GET['bulan'];
    $tahun = $_GET['tahun'];
    $id_kk = $_SESSION['klinik'];
    $q1   = mysql_query("SELECT tanggal, SUM(sub_total) as subt FROM history_kasir WHERE month(tanggal) = '$bulan' AND year(tanggal) = '$tahun' AND id_kk='$id_kk' group by tanggal ORDER BY tanggal ASC");

    while($r  = mysql_fetch_array($q1)){

      $ong = mysql_fetch_assoc(mysql_query("SELECT SUM(uang_ongkir) AS kir FROM pembayaran WHERE tgl = '$r[tanggal]'"));
      $ret = mysql_fetch_assoc(mysql_query("SELECT SUM(a.harga*b.jml) ur FROM history_kasir a JOIN retur_jual b ON a.id = b.history WHERE b.retur = 3 AND b.tgl = '$r[tanggal]' AND a.id_kk = '$id_kk'"));


      $total = ($r["subt"] + $ong["kir"]) - $ret["ur"];

    ?>
      <tr class="gradeX">
                <td><?php echo $r["tanggal"]; ?></td>
                <td><?php echo rupiah($total);?></td>
        <?php $q2   = mysql_query("SELECT SUM(biaya_p) as luar FROM pengeluaran where tanggal='$r[tanggal]' AND id_kk='$id_kk' order by tanggal");
            $k = mysql_fetch_array($q2) ?>
                <td><?php echo rupiah($k["luar"]); ?></td>
                <td><?php echo rupiah(($total)-$k["luar"]); ?></td>
               
      </tr>
    <?php
            }
        ?>
    </tbody>
	   <!--  -->
    </table>
    <br/>
</div>