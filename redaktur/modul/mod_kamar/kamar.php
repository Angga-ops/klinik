<?php
	switch($_GET['act']){
	default:
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
        <br/>
        <a href="?module=kamar&act=tambah_kamar" class="button">
        <span>Tambahkan Ruangan</span>
        </a>
        <a target="_blank" href="report/rpt_kmr.php" class="button">
        <span>Laporan Data Ruangan</span>
        </a>
    <div class="block-border">
        <div class="block-header">
        <h1>DATA RUANGAN</h1>
        </div>
    <div class="block-content">
    <table id="table-example" class="table">
    <thead>
        <tr>
            <th>Kelas</th>
            <th>Nama Ruangan</th>
            <th>Harga Ruangan</th>
            <th>Aksi</th>
        </tr>
    </thead>
    <tbody>
	<?php
		$tampil		= mysqli_query($con, "Select id_kamar, kelas, nama_kamar, biaya_kamar From kamar, kamar_jenis Where kamar_jenis.id_jenkamar=kamar.id_jenkamar Order by kelas");
		while($r	= mysqli_fetch_array($con, $tampil)){
    ?>
        <tr class="gradeX">
            <td><?php echo $r["kelas"]; ?></td>
            <td><?php echo $r["nama_kamar"] ?></td>
            <td><?php echo rupiah($r["biaya_kamar"]); ?></td>    
            <td>
                <a href="?module=kamar&act=edit_kamar&id=<?php echo $r["id_kamar"]; ?>" title="Edit" class="with-tip">
                <center><img src="img/edit.png"></a>
                <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_kamar/aksi_kamar.php?module=kamar&act=hapus" title="Hapus" class="with-tip"><img src="img/hapus.png"></center></a>
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
	case "tambah_kamar":
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
    	<div class="block-header">
        <h1>TAMBAH RUANGAN</h1>
        </div>
	<div class="block-content">
    <form method="POST" enctype="multipart/form-data" action="modul/mod_kamar/aksi_kamar.php?module=kamar&act=input">
        <p class="inline-small-label">
            <label for="field4">Jenis Ruangan</label>
            <select name="kelas" required>
                <option value="">-- Pilih Jenis --</option>
                <?php $kelas = mysqli_query($con, "Select * From kamar_jenis");
                while ($r = mysqli_fetch_array($kelas)) {
                ?>
                <option value="<?php echo $r["id_jenkamar"]; ?>"><?php echo $r["kelas"]; ?></option>
                <?php
                }
                ?>
            </select>
        </p>
        <p class="inline-small-label">
          <label for="field4">Nama Kamar</label>
          <input type="text" size="20" name="nama_kamar" required />
        </p>
        <p class="inline-small-label">
          <label for="field4">Biaya Kamar</label>
          <input type="text" size="20" name="biaya_kamar" required />
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=kamar">Batal</a>
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
	case "edit_kamar":
	$id		= $_GET['id'];
	$edit 	= mysqli_fetch_array(mysqli_query($con, "Select * From kamar Where id_kamar='$id'"));
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">    
        <h1>EDIT RUANGAN</h1>
        </div>
    <div class="block-content">
    <form method="POST" enctype="multipart/form-data" action="modul/mod_kamar/aksi_kamar.php?module=kamar&act=update">
            <input type="hidden" size="20" value="<?php echo $id; ?>" name="id" readonly="readonly" />
        <p class="inline-small-label">
            <label for="field4">Jenis Ruangan</label>
            <select name="kelas">
				<?php
                    $jr	= mysqli_query($con, "Select * From kamar_jenis");
                    if ($edit['id_jenkamar'] == '') {
                ?>
                    <option value="" selected>-- Pilih Jenis --</option>
                <?php
                }
                    while ($edit_jr 		= mysqli_fetch_array($jr)) {
                    if ($edit['id_jenkamar']	== $edit_jr['id_jenkamar']) {
                    ?>
                        <option value="<?php echo $edit_jr['id_jenkamar']; ?>" selected><?php echo $edit_jr['kelas']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_jr['id_jenkamar']; ?>"><?php echo $edit_jr['kelas']; ?></option>
                    <?php
                    }
                    }
                ?>
            </select>
        </p>        
        <p class="inline-small-label">
            <label for="field4">Nama Kamar</label>
            <input type="text" size="20" name="nama_kamar" value="<?php echo $edit['nama_kamar']; ?>" />
        </p>        
        <p class="inline-small-label">
            <label for="field4">Biaya Kamar</label>
            <input type="text" size="20" name="biaya_kamar" value="<?php echo $edit['biaya_kamar']; ?>" />
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=kamar">Batal</a>
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