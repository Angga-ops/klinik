<?php
	switch($_GET['act']){
	default:
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <br/>
    <a href="?module=data_poli&act=tambah_poli" class="button"><span>Tambahkan Poli</span></a>
    <div class="block-border">
        <div class="block-header">
        <h1>DATA POLI</h1>
        </div>
    <div class="block-content">
    <table id="table-example" class="table">
    <thead>
        <tr>
            <th>Id. Poli</th>
            <th>Nama</th>
            <th>Biaya</th>
            <th>Aktif</th>
            <th>Aksi</th>
	    </tr>
    </thead>
    <tbody>
<?php
	$tampil		= mysqli_query($con, "Select * From tujuan Order by iden_poli Asc");
	while($r	= mysqli_fetch_array($tampil)){
?>
        <tr class="gradeX">
            <td><?php echo $r['iden_poli']; ?></td>
            <td><?php echo $r['nama_poli']; ?></td>
            <td><?php echo rupiah($r['biaya_poli']); ?></td>
            <td><?php echo $r['aktif']; ?></td>
            <td>
            <a href="?module=data_poli&act=edit_poli&id=<?php echo $r['id_poli']; ?>" title='Edit' class='with-tip'><center><img src='img/edit.png'></a>
            <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_data_poli/aksi_data_poli.php?module=data_poli&act=hapus&id=<?php echo $r['id_poli']; ?>" title='Hapus' class='with-tip'><img src='img/hapus.png'></center></a>
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
	case"tambah_poli":
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">    
        <h1>TAMBAH POLI</h1>
        </div>
    <div class="block-content">
    <form method='post' enctype='multipart/form-data' action="modul/mod_data_poli/aksi_data_poli.php?module=data_poli&act=input">
        <p class="inline-small-label">
            <label for="field4">Id. Poli</label>
            <input type="text" name="iden_poli" style="text-align:center;" size="25" required />
        </p>        
        <p class="inline-small-label">
            <label for="field4">Nama</label>
            <input type="text" size="25" style="text-align:center;" name="nama_poli" required />
        </p>
        
        <p class="inline-small-label">
            <label for="field4">Biaya</label>
            <input type="text" size="25" style="text-align:center;" name="biaya_poli" required />
        </p>        
        <p class="inline-small-label">
            <label for="field4">Status</label>
            <select name="aktif" required>
            <option value="">-- Pilih Status --</option>
            <option value="Y">Ya</option>
            <option value="N">Tidak</option>                        
            </select>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=data_poli">Batal</a>
            </li> 
        </ul>
        <ul class="actions-left">
            <li>
            <input type="submit" name="simpan" class="button" value="Simpan" />
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
    case "edit_poli":
	$idp	= $_GET['id'];
    $edit 	= mysqli_query($con, "SELECT * FROM tujuan WHERE id_poli='$idp'");
    $data	= mysqli_fetch_array($edit);
?>
    <div id="main-content">
    <div class="container_12">    
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>EDIT POLI</h1>
        </div>
    <div class="block-content">
    <form method="post" enctype="multipart/form-data" action="modul/mod_data_poli/aksi_data_poli.php?module=data_poli&act=edit">
        <p class="inline-small-label">
            <label for="field4">Id. Poli</label>
            <input type="hidden" name="id_poli" style="text-align:center;" size="25" value="<?php echo $idp; ?>" readonly="readonly" />
            <input type="text" name="iden_poli" style="text-align:center;" size="25" value="<?php echo $data['iden_poli']; ?>" readonly="readonly" />
        </p>    
        <p class="inline-small-label">
            <label for="field4">Nama</label>
            <input type="text" size="25" style="text-align:center;" name="nama_poli" value="<?php echo $data['nama_poli']; ?>" required />
        </p>    
        <p class="inline-small-label">
            <label for="field4">Biaya</label>
            <input type="text" size="25" style="text-align:center;" name="biaya_poli" value="<?php echo $data['biaya_poli']; ?>" required />
        </p>    
        <p class="inline-small-label">
            <label for="field4">Status</label>
            <select name="aktif" required>
            	<option value="">-- Pilih Status --</option>
                <option value="Y" <?php if ($data['aktif'] == 'Y') { echo "selected"; } ?>>Y</option>
                <option value="N" <?php if ($data['aktif'] == 'N') { echo "selected"; } ?>>N</option>
            </select>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=data_poli">Batal</a>
            </li> 
		</ul>
        <ul class="actions-left">
            <li>
            <input type="submit" name="update" class="button" value="Update" />
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