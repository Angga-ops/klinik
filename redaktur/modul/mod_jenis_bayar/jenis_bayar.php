<?php
	switch($_GET['act']){
	default:
?>
    <div id="main-content">
    <div class="container_12">
    <div class=grid_12>
    <br/>
        <a href="?module=jenis_bayar&act=tambah" class="button">
        <span>Tambahkan Jenis Pembayaran</span>
        </a>
    <div class="block-border">
        <div class="block-header">
            <h1>DATA JENIS PEMBAYARAN</h1>
        </div>
    <div class="block-content">
    <table id="table-example" class="table">
        <thead>
            <tr>
                <th>Id. Jenis</th>
                <th>Jenis</th>
                <th>Aksi</th>
            </tr>
        </thead>
    	<tbody>
		<?php
            $tampil		= mysql_query("Select * From jenis_pembayaran");
            while($data	= mysql_fetch_array($tampil)){
        ?>
			<tr class="gradeX">
                <td><?php echo $data['id_jenispem']; ?></td>
                <td><?php echo $data['nama_jenispem']; ?></td>
                <td>
                <a href="?module=jenis_bayar&act=edit&id=<?php echo $data["id_jenispem"]; ?>" title="Edit" class="with-tip"><center><img src="img/edit.png"></a>
                <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_jenis_bayar/aksi_jenis_bayar.php?module=jp&act=hapus&id=<?php echo $data["id_jenispem"]; ?>" title="Hapus" class="with-tip"><img src="img/hapus.png"></center></a>
                </td>
			</tr>
		<?php
            }
        ?>
		</tbody>
	</table>
	            </div>
            </div>
        </div>
    </div>
</div>
<?php
	break;
	case "tambah":
?>
    <div id="main-content">
    <div class="container_12">
	<div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>TAMBAH JENIS PEMBAYARAN</h1>
        </div>
    <div class="block-content">
    <form method="post" enctype="multipart/form-data" action="modul/mod_jenis_bayar/aksi_jenis_bayar.php?module=jp&act=input">
        <p class="inline-small-label">        
			<?php
				$kode  	= buatKode('jenis_pembayaran','PEM-');
			?>
            <label for="field4">Id. Jenis</label>
            <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $kode; ?>" readonly="readonly" />
        </p>
        <p class="inline-small-label">
            <label for="field4">Jenis Pembayaran</label>
            <input type="text" size="25" style="text-align:center;" name="nama" required />
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=jenis_bayar">Batal</a>
        </li> 
        </ul>
        <ul class="actions-left">
            <li>
            <input type="submit" name="upload" class="button" value="Simpan" />
            </li>
        </ul>
    </div>
    </form>
				</div>
			</div>
		</div>
    </div>
</div>
<?php
	break;
    case "edit":
	$id		= $_GET["id"];
    $edit 	=  mysql_fetch_array(mysql_query("Select * From jenis_pembayaran Where id_jenispem='$id'"));
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>EDIT JENIS PEMBAYARAN</h1>
        </div>
    <div class="block-content">
	<form method="POST" enctype="multipart/form-data" action="modul/mod_jenis_bayar/aksi_jenis_bayar.php?module=jp&act=edit">
        <p class="inline-small-label">
            <label for="field4">Id. Jenis</label>
            <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $id; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Nama Jenis</label>
            <input type="hidden" name="id" value="<?php echo $id; ?>" readonly="readonly" />
            <input type="text" size="25" style="text-align:center;" name="nama" value="<?php echo $edit['nama_jenispem']; ?>" required />
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=jenis_bayar">Batal</a>
            </li> 
        </ul>
        <ul class="actions-left">
            <li>
            <input type="submit" name="upload" class="button" value="Update" />
            </li> 
        </ul>
    </div>
    </form>
				</div>
			</div>
		</div>
	</div>
</div>
<?php
	break;
	}
?>