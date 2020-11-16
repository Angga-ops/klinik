<div id="main-content">
    <div class="container_12">
        <div class="grid_12">
			<div class='block-border'>
	            <div class="block-header">
                    <h1>REVIEW BARANG MASUK</h1>
                    <div class="flip" style="right:45; top:8; float: right; margin-top: 7px; margin-right: 10px; align: center;"><img src="../redaktur/img/faq.png" style=" border:none;"></img></div>
				</div>
    <div class='block-content'>

    <br />
	<div style="margin-left:1%; margin-right:1%;">
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
		<?php
			$id		= $_GET['id'];
			$pt		= mysqli_fetch_array(mysqli_query($con, "Select nama_pt From supplier, barang_masuk Where supplier.id_supplier=barang_masuk.id_supplier And no_faktur='$id'"));
		?>
            <tr>
              <td colspan="5"><div align="center" id="pem2"><?php echo $pt['nama_pt']; ?></div></td>
              </tr>
            <tr>
                <td><div align="center" id="donker">Nama Barang</div></td>
                <td><div align="center" id="donker">Jumlah</div></td>
                <td><div align="center" id="donker">Harga Beli</div></td>
                <td><div align="center" id="donker">Total Harga</div></td>
            </tr>
		<?php
			$om		= mysqli_query($con, "Select id_bm, nama_pt, nama_brg, jumlah, harga_beli, total_harga From supplier, gudang, barang_masuk Where supplier.id_supplier=barang_masuk.id_supplier And gudang.id_brg=barang_masuk.id_brg And no_faktur='$id'");
			$tot	= mysqli_fetch_array(mysqli_query($con, "Select sum(total_harga) as total From barang_masuk Where no_faktur='$id'"));
			while($hasil	= mysqli_fetch_array($bm)){
		?>
            <tr id="tdb">
                <td id="tdku"><div align="center"><?php echo $hasil['nama_brg']; ?></div></td>
                <td id="tdku"><div align="center"><?php echo $hasil['jumlah']; ?></div></td>
                <td id="tdku"><div align="right"><?php echo rupiah($hasil['harga_beli']); ?></div></td>
                 <td id="tdku"><div align="right"><?php echo rupiah($hasil['total_harga']); ?></div></td>
            </tr>  
		<?php
			}
		?>
        	<tr>
            	<td><div id="hitam">Total</div></td>
            	<td colspan="4"><div id="hitam" align="right"><?php echo rupiah($tot['total']); ?></div></td>
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