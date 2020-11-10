<div id="main-content">
    <div class="container_12">
        <div class="grid_12">
			<div class='block-border'>
	            <div class="block-header">
                    <h1>REVIEW BARANG KELUAR</h1>
                    <div class="flip" style="right:45; top:8; float: right; margin-top: 7px; margin-right: 10px; align: center;"><img src="../redaktur/img/faq.png" style=" border:none;"></img></div>
				</div>
    <div class='block-content'>

    <br />
	<div style="margin-left:1%; margin-right:1%;">
<?php
	$id				= $_GET['id'];
	$oexp			= mysql_query("Select nama_brg, jumlah, tgl_keluar From gudang, barang_keluar Where gudang.id_brg=barang_keluar.id_brg And no_fbk='$id'");
?>
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
            <tr>
              <td colspan="5"><div align="center" id="pem2">No. Faktur : <?php echo $id; ?></div></td>
              </tr>
            <tr>
                <td><div align="center" id="donker">Nama Barang</div></td>
                <td><div align="center" id="donker">Jumlah</div></td>
                <td><div align="center" id="donker">Harga</div></td>
                <td><div align="center" id="donker">Total Harga</div></td>
                <td><div align="center" id="donker">Tgl. Keluar</div></td>
            </tr>
		<?php
			while($hasil	= mysql_fetch_array($oexp)){
		?>
            <tr id="tdb">
                <td id="tdku"><div align="center"><?php echo $hasil['nama_brg']; ?></div></td>
                <td id="tdku"><div align="center"><?php echo $hasil['jumlah']; ?></div></td>
                <td id="tdku"><div align="center"><?php echo $hasil['harga']; ?></div></td>
                <td id="tdku"><div align="center"><?php echo $hasil['total']; ?></div></td>
                <td id="tdku"><div align="center"><?php echo $hasil['tgl_bk']; ?></div></td>
            </tr>  
		<?php
			}
			$tgl	= mysql_fetch_array(mysql_query("Select tgl_bk From barang_keluar Where no_fbk='$id'"));
		?>
        
        	<tr>
            	<td colspan="5"><div id="hitam" align="center">Periode : <?php echo $tgl['tgl_bk']; ?></div></td>
            </tr>
    </table>
	</div>
	<br>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="">Kembali</a>
            </li> 
        </ul>
	</div>
				</div>
			</div>
        </div>
    </div>
</div>