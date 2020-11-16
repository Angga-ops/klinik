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
	<div align="left"><h4>Daftar Pelanggan</h4></div>    
	<table width="100%" class="table1">
		<thead>
	    	<tr>
	          <th>No</th>
              <th>Nama Klinik</th>
              <th>Nama Pasien</th>
              <th>Alamat</th>
              <th>Jenis Kelamin</th>
              <th>Tanggal Lahir</th>
              <th>No Telepon</th>
              <th>Tanggal Daftar</th>
              <th>Total Kunjungan</th>
	        </tr>
	    </thead>
	    <tbody>
		<?php 
		$id_kk = $_GET['id_kk'];
			if ($id_kk == 0) {
				$q1 = mysqli_query($con, "SELECT *FROM pasien"); 
              	$no =1;
              	while($br = mysqli_fetch_array($q1)) { ?>
		            <tr>
		              <td><?php echo $no++; ?></td>
		              <td><?php $sat = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik")); 
		              echo $sat['nama_klinik']; ?></td>
		              <td><?php echo $br['nama_pasien']; ?></td>
		              <td><?php echo $br['alamat']; ?></td>
		              <td><?php echo $br['jk']; ?></td>
		              <td><?php echo $br['tgl_lahir']; ?></td>
		              <td><?php echo $br['no_telp']; ?></td>
		              <td><?php echo $br['tgl_pendaftaran']; ?></td>
		              <td><?php echo $br['total_kunjungan']; ?></td>
		            </tr>
                <?php } ?>
			<?php }else{
				$q1 = mysqli_query($con, "SELECT *FROM pasien where id_kk='$_GET[id_kk]'"); 
              $no =1;
              while ($br = mysqli_fetch_array($q1)) {
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php $sat = mysqli_fetch_array(mysqli_query($con, "SELECT *FROM daftar_klinik WHERE id_kk='$br[id_kk]'")); 
              echo $sat['nama_klinik']; ?></td>
              <td><?php echo $br['nama_pasien']; ?></td>
              <td><?php echo $br['alamat']; ?></td>
              <td><?php echo $br['jk']; ?></td>
              <td><?php echo $br['tgl_lahir']; ?></td>
              <td><?php echo $br['no_telp']; ?></td>
              <td><?php echo $br['tgl_pendaftaran']; ?></td>
              <td><?php echo $br['total_kunjungan']; ?></td>
            </tr>
                <?php
                $no++; } ?>
            <?php }?>
			  
	    </tbody>
    </table>
    <br />
  
</div>