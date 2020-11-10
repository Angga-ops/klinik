<?php
	switch($_GET['act']){
	default:
?>

<section class="content-header">
    
<?php 
    
$bc = mysql_fetch_assoc(mysql_query("SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
    ?> 

    <h1>
        <?php echo $bc[crumb]; ?>
      </h1>
    </section>



    <section class="content">
      <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=gudang&act=tambah_stok"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Stok Barang</button></a>

    </div>
        </div>
    </div>

   
        <div class="row">
          <div class="col-md-12">
            <div class="box">
              <div class="box-header">
                <h3 class="box-title">Data Stok Barang</h3>
            </div>
            <!-- /.box-header -->
            <div class="box-body">
                <div class="table-responsive">
              <table class="table table-bordered table-stripped datatable">
                  <thead>
            <tr>
                <th>Gambar</th>
                 <th>Kode Produk</th>
                 <th>Nama Produk</th>
                 <th>Kategori Produk</th>
                 <th>Stok Produk</th>
                 <th>Harga Beli</th>
                 <th>Harga Jual</th>
                 <th>Batas Minim</th>
                 <th>Aksi</th>
            </tr>
        </thead>
      <tbody>
    <?php
    $tampil   = mysql_query("Select * From produk_pusat");
    while($r  = mysql_fetch_array($tampil)){
    ?>
      <tr class="gradeX">
                 
                   <?php $q1 = mysql_query("SELECT *FROM produk_master WHERE nama_produk='$r[nama_produk]'"); 
                 $k = mysql_fetch_array($q1); ?>
                 <td><?php
                        if ( $k['gambar'] == '') {
                            echo "Belum Ada Gambar";
                        }else{
                            echo '<center><a href="'.$url.'/gambar_produk/'.$k['gambar'].'"><img src="'.$url.'/gambar_produk/'.$k['gambar'].'" width="40px" height="40px"></a></center>';
                        }?></td>
                 
                <td><?php echo $r["kode_produk"]; ?></td>
                <td><?php echo $r["nama_produk"]; ?></td>
                <?php $q1 = mysql_query("SELECT *FROM kategori WHERE id_kategori='$r[id_kategori]'"); 
                 $k = mysql_fetch_array($q1); ?>
                <td><?php echo $k['kategori']; ?></td>
                <td><?php echo $r["jumlah"]; ?></td>
                <td><?php echo rupiah($r["harga_beli"]); ?></td>
                <td><?php echo rupiah($r["harga_jual"]); ?></td>
                <td><?php echo $r["batas_minim"]; ?></td>

               <td>
                     
                     <a href="?module=gudang&act=edit_brg&id_pp=<?php echo $r["id_pp"]; ?>" class="btn btn-xs btn-success col-md-12"><i class="fa fa-edit"></i> Edit</a>

                     <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/gudang/aksi_stok.php?module=pembelian_t&act=hapus&id_pp=<?php echo $r['id_pp']; ?>" class="btn btn-xs btn-danger col-md-12"><i class="fa fa-trash-o"></i> Hapus</a>
                     
  
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

</section>
<!-- DataTables -->
  <link rel="stylesheet" href="<?php echo $url2; ?>/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">
<!-- DataTables -->
<script src="<?php echo $url2; ?>/bower_components/datatables.net/js/jquery.dataTables.min.js"></script>
<script src="<?php echo $url2; ?>/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>
<script>
$(document).ready(function(){
    $("#example1").DataTable();
});
</script>


<!-- Tambah data barang -->


<?php
  break;
  case "tambah_stok":

  $cx = mysql_query("SELECT * FROM produk_master WHERE id_kategori != 0");
  $dx = '[';
  while($cux = mysql_fetch_assoc($cx)){

    $kat = mysql_fetch_assoc(mysql_query("SELECT kategori AS egori FROM kategori WHERE id_kategori = $cux[id_kategori]"));

    $sat = mysql_fetch_assoc(mysql_query("SELECT satuan AS uan FROM data_satuan WHERE id_s = $cux[id_satuan]"));


      $dtx .= '{"nama":"'.$cux[nama_produk].'","prod":"('.$cux[kd_produk].') '.$cux[nama_produk].'","kd":"'.$cux[kd_produk].'","kat_kd":"'.$cux[id_kategori].'","sat_kd":"'.$cux[id_satuan].'","kat":"'.$kat[egori].'","satuan":"'.$sat[uan].'","beli":"'.$cux[harga_beli].'","jual":"'.$cux[harga_jual].'"},';
  }
  $dtx = substr($dtx,0,strlen($dtx) - 1);
  $dx .= $dtx.']';
  
  file_put_contents("../redaktur/modul/gudang/prod.json",$dx);


?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/gudang/aksi_stok.php?act=input">
          <div class="col-md-6">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode/Nama Produk</label>
                <input type="text" class="form-control" id="prod" required/>
                <small>Hanya produk yang kategori dan satuan tidak kosong muncul di sini</small>
                <input type="hidden" class="form-control" id="kd" name="kd_produk"/>
                <input type="hidden" class="form-control" id="nama" name="nama_produk"/>
              </div>
              </div>
            </div>
<!--
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" class="form-control" placeholder="Nama Produk" required/>
                </div>
              </div>
            </div> -->

            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                <label>Kategori Produk</label>
                <!--
                <select name="kategori_produk" class="form-control" required>
                <option >Pilih Kategori</option>
                <?php 
                /*  $data = mysql_query("Select * From kategori");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_kategori']; ?>"><?php echo $hasil['kategori'];  ?></option>
              <?php } */ ?>
            </select> --> 

            <input type="hidden" id="kat_kd" name="kategori_produk" />

                    <input type="text" class="form-control" readonly id="kat"  />

                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Stock Awal</label>
                  <input type="number" class="form-control" name="stok_produk" placeholder="Stok Awal" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group"> 
                <label>Satuan</label>
                <!--
                 
                  <select name="satuan" class="form-control" required>
                <option >Pilih Satuan</option>
                <?php 
                /*  $data = mysql_query("Select * From data_satuan");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_s']; ?>"><?php echo $hasil['satuan'];  ?></option>
              <?php } */ ?>
            </select> --> 
            <input type="hidden" id="sat_kd" name="satuan" />
            <input type="text" class="form-control" readonly id="sat" />
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=gudang">
                    <button type="button" class="btn btn-danger col-md-6">Batal</button></a>
                    <button type="submit" class="btn btn-success col-md-6">Simpan</button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Beli</label>
                  <input type="number" class="form-control" name="harga_beli" id="beli" placeholder="Harga Beli" readonly/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Jual</label>
                  <input type="number" class="form-control" name="harga_jual" id="jual" placeholder="Harga jual" readonly/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Suplier</label>
                
                  <select name="suplier" class="form-control" required>
                <option >Pilih Suplier</option>
                <?php 
                  $data = mysql_query("Select * From suplier");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_sup']; ?>"><?php echo $hasil['nama_sup']; ?></option>
              <?php } ?>
            </select> 
        
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Cabang</label>
                  <input type="number" class="form-control" name="batas_cabang" placeholder="Batas Cabang" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Minim</label>
                  <input type="number" class="form-control" name="batas_minim" placeholder="Batas Minim" required/>
                </div>
              </div>
            </div>
          </div>

            

          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/typeahead.css">
<script src="<?php echo $url2; ?>bower_components/typeahead.bundle.min.js"></script>

<script>
$(document).ready(function(){
  //typeahead

                      
  var namaProd = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('prod'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/gudang/prod.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


                      
var kdProd = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('kd'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/gudang/prod.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


$('#prod').typeahead({
    hint: true,
  highlight: true,
minLength: 3
}, {
  name: 'nama-prod',
  display: 'prod',
  source: namaProd
},{
  name: 'kd-prod',
  display: 'prod',
  source: kdProd
} );
        


        $('#prod').bind('typeahead:select', function(ev, suggestion) {   
               
$("#kd").val(suggestion.kd);
$("#nama").val(suggestion.nama);
$("#kat").val(suggestion.kat);
$("#sat").val(suggestion.satuan);
$("#kat_kd").val(suggestion.kat_kd);
$("#sat_kd").val(suggestion.sat_kd);
$("#jual").val(suggestion.jual);
$("#beli").val(suggestion.beli);

               });


  //typeahead
});
</script>


<!-- Edit data barang -->
<?php
  break;
  case "edit_brg":
  $id   = $_GET['id_pp'];
  $edit   = mysql_fetch_array(mysql_query("Select * From produk_pusat Where id_pp='$id'"));
?>

<section class="content">
    
    <div class="row">
    <div class="col-md-12">
          <div class="box box-success">
        <div class="box-header with-border">
          <h3 class="box-title">Tambah Data Stok Barang</h3>

        </div>
        <!-- /.box-header -->
        <div class="box-body"> <form method="post" enctype="multipart/form-data" action="modul/gudang/aksi_stok.php?act=update">
          <div class="col-md-6">
            <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <label>Kode Produk</label>
                <input type="hidden" class="form-control" name="id_pp" value="<?php echo $edit['id_pp'];?>" required/>
                <input type="text" class="form-control" name="kd_produk" value="<?php echo $edit['kode_produk'];?>" required/>
              </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Nama Produk</label>
                  <input type="text" class="form-control" name="nama_produk" value="<?php echo $edit['nama_produk'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
               <div class="form-group">
                <label>Kategori Produk</label>
                <select name="kategori_produk" class="form-control" required>
                  <option value="<?php echo $edit['id_kategori']; ?>">
                <?php
                  $data = mysql_query("Select * From kategori");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <?php echo $hasil['kategori']; ?></option>
                <option value="<?php echo $hasil['id_kategori']; ?>"><?php echo $hasil['kategori']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Jumlah Stok</label>
                  <input type="number" class="form-control" name="stok_produk" value="<?php echo $edit['jumlah'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Satuan</label>
                  <select name="satuan" class="form-control" required>
                <?php
                  $data = mysql_query("Select * From data_satuan where id_s='$edit[id_sat]'");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <option value="<?php echo $hasil['id_s']; ?>"><?php echo $hasil['satuan']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=gudang">
                    <button type="button" class="btn btn-danger col-md-6">Batal</button></a>
                    <button type="submit" class="btn btn-success col-md-6">Simpan</button>
                </div>
              </div>
            </div>

          </div>
          <div class="col-md-6">
            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Beli</label>
                  <input type="number" class="form-control" name="harga_beli" value="<?php echo $edit['harga_beli'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Harga Jual</label>
                  <input type="number" class="form-control" name="harga_jual" value="<?php echo $edit['harga_jual'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Suplier</label>
                  <select name="suplier" class="form-control">
                <option value="<?php echo $edit['id_sup']?>">
                <?php
                  $data = mysql_query("Select * From suplier ");            
                  while($hasil  = mysql_fetch_array($data)){
                ?>
                <?php echo $hasil['nama_sup'];?></option>
                <option value="<?php echo $hasil['id_sup']; ?>"><?php echo $hasil['nama_sup']; ?></option>
              <?php }?>
            </select>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Cabang</label>
                  <input type="number" class="form-control" name="batas_cabang" value="<?php echo $edit['batas_cabang'];?>" required/>
                </div>
              </div>
            </div>

            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Batas Minim</label>
                  <input type="number" class="form-control" name="batas_minim" value="<?php echo $edit['batas_minim'];?>" required/>
                </div>
              </div>
            </div>
          </div>

            

          </form>
        </div>
      </div>
    </div>
  </div>
</section>


<?php
  break;
  }
?>