 
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Edit Data Kategori Biaya</h3>
<?php

$edit = mysql_fetch_assoc(mysql_query("SELECT * FROM kategori_biaya WHERE id = '$_GET[id]'"));

?>
        </div>
        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/kategori_biaya/aksi.php?act=edit">
              <div class="form-group">
                <label>Kategori</label>
                <input type='hidden' name="id" value="<?php echo $_GET[id]; ?>" />
               <input type="text" class="form-control" name="nama" value='<?php echo $edit[kategori]; ?>' required/>
              </div>
              
              <div class="form-group">
               <a href="?module=cabang"><button type="button" class="btn btn-danger">Batal</button></a>
                  <button type="submit" class="btn btn-success">Simpan</button>
              </div>
            </form>
              </div>
        </div>
        </div>
    </div>
</section>