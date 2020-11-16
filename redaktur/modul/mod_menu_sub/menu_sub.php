<?php
	switch($_GET['act']){
	default:
?>
    <div id="main-content">
    <div class="container_12">
    <div class=grid_12>
    <br/>
        <a href="?module=menu_sub&act=tambah_ms" class="button">
        <span>Tambahkan Menu Sub</span>
        </a>
    <div class="block-border">
        <div class="block-header">
            <h1>DATA MENU SUB</h1>
        </div>
    <div class="block-content">
    <table id="table-example" class="table">
        <thead>
            <tr>
                <th>Sub Menu</th>
                <th>Menu Sub</th>
                <th>Link/Page</th>
                <th>Status</th>
                <th>Aksi</th>
            </tr>
        </thead>
    	<tbody>
		<?php
            $menu		= mysqli_query($con,"Select * From menu, menu_sub Where menu.id_menu=menu_sub.id_menu");
            while($data	= mysqli_fetch_array($menu)){
        ?>
			<tr class="gradeX">
                <td><?php echo $data['nama_menu']; ?></td>
                <td><?php echo $data['nama_ms']; ?></td>
                <td><?php echo $data['page_ms']; ?></td>
                <td><?php echo $data['sts_ms']; ?></td>
                <td>
                <a href="?module=menu_sub&act=edit_ms&id=<?php echo $data['id_ms']; ?>" title="Edit" class="with-tip"><center><img src="img/edit.png"></a>
                <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_menu_sub/aksi_menu_sub.php?module=ms&act=hapus&id=<?php echo $data['id_ms']; ?>" title="Hapus" class="with-tip"><img src="img/hapus.png"></center></a>
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
	case "tambah_ms":
?>
    <div id="main-content">
    <div class="container_12">
	<div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>TAMBAH SUB MENU</h1>
        </div>
    <div class="block-content">
    <form method="post" enctype="multipart/form-data" action="modul/mod_menu_sub/aksi_menu_sub.php?module=ms&act=input">
        <p class="inline-small-label">
            <label for="field4">Sub Menu</label>
			<select name="menu" required>
                <option value="">-- Pilih Sub Menu --</option>
                <?php
					$now 			= date('Y-m-d');
					$selectidmax 	= mysqli_query($con,"Select max(id_ms) as id From menu_sub Where id_ms Like '%MS-%'");
					$hsilidmax		= mysqli_fetch_array($selectidmax);
					$idmax 			= $hsilidmax['id'];
					$nourut 		= (int) substr($idmax, 3,2);
					$nourut++;
					$kode			= "MS-".sprintf("%02s", $nourut);
                    $sql 			= mysqli_query($con,"Select * From menu");
                    while($data		= mysqli_fetch_array($sql)) {
               ?>
                <option value=<?php echo $data['id_menu']; ?>><?php echo $data['nama_menu']; ?></option>
                <?php
                    }
                ?>
			</select>
		</p>
        <p class="inline-small-label">
          <label for="field4">Id. Menu Sub</label>
          <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $kode; ?>" readonly="readonly" />
        </p>
        <p class="inline-small-label">
          <label for="field4">Menu Sub</label>
          <input type="text" size="25" style="text-align:center;" name="nama" required />
        </p>
        <p class="inline-small-label">
          <label for="field4">Link/Page</label>
          <input type="text" size="25" style="text-align:center;" name="page" required />
        </p>
        <p class="inline-small-label">
	        <label for="field4">Status Menu Sub</label>            
    		<select name="status" required>
            	<option value="">-- Pilih Status --</option>
            	<option value="Aktif">Aktif</option>
            	<option value="Non Aktif">Non Aktif</option>
            </select>    
        </p>        
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=menu_sub">Batal</a>
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
    case "edit_ms":
	$id		= $_GET["id"];
    $edit 	=  mysqli_fetch_array(mysqli_query($con,"Select * From menu_sub Where id_ms='$id'"));
?>
    <div id="main-content">
    <div class="container_12">
    <div class="grid_12">
    <div class="block-border">
        <div class="block-header">
        <h1>EDIT MENU SUB</h1>
        </div>
    <div class="block-content">
	<form method="POST" enctype="multipart/form-data" action="modul/mod_menu_sub/aksi_menu_sub.php?module=ms&act=edit">
        <p class="inline-small-label">
            <label for="field4">Menu</label>
            <select name="menu" required>
				<?php
                    $mn		= mysqli_query($con,"Select * From menu");
                    if ($edit['id_menu'] == '') {
                ?>
                    <option value="" selected>-- Pilih Sub Menu --</option>
                <?php
                }
                    while ($edit_mn 	= mysqli_fetch_array($mn)) {
                    if ($edit['id_menu']	== $edit_mn['id_menu']) {
                    ?>
                        <option value="<?php echo $edit_mn['id_menu']; ?>" selected><?php echo $edit_mn['nama_menu']; ?></option>
                    <?php
                    } else {
                    ?>
                        <option value="<?php echo $edit_mn['id_menu']; ?>"><?php echo $edit_mn['nama_menu']; ?></option>
                    <?php
                    }
                    }
                ?>
			</select>
		</p>
        <p class="inline-small-label">
            <label for="field4">Id. Menu Sub</label>
            <input type="text" size="25" style="text-align:center;" name="id" value="<?php echo $edit['id_ms']; ?>" readonly="readonly" />
        </p>
        <p class="inline-small-label">
            <label for="field4">Menu Sub</label>
            <input type="text" size="25" style="text-align:center;" name="nama" value="<?php echo $edit['nama_ms']; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Link/Page</label>
            <input type="text" size="25" style="text-align:center;" name="page" value="<?php echo $edit['page_ms']; ?>" required />
        </p>
        <p class="inline-small-label">
            <label for="field4">Status Menu Sub</label>
            <select name="status" required>
            	<option value="">-- Pilih Status --</option>
                <option value="Aktif" <?php if ($edit['sts_ms'] == 'Aktif') { echo "selected"; } ?>>Aktif</option>
                <option value="Non Aktif" <?php if ($edit['sts_ms'] == 'Non Aktif') { echo "selected"; } ?>>Non Aktif</option>
            </select>
        </p>
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=menu_sub">Batal</a>
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