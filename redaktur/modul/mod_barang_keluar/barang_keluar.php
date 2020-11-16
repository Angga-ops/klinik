<?php
  switch($_GET['act']){
  default:
?>

<section class="content-header">
    
<?php 
    
$bc = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_menu AS crumb FROM menu WHERE page_menu = '$_GET[module]'"));
    
    ?> 

    <h1>
        <?php echo $bc['crumb']; ?>
      </h1>
      <ol class="breadcrumb">
        <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
        <li class="active"> <?php echo $bc['crumb']; ?></li>
      </ol>
    </section>

<section class="content">

  <div class="row">
       <div class="col-md-12">
         <div class="callout callout-success">
          <a href="?module=barang_keluar&act=tambah_bk"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Barang Keluar</button></a>
        </div>
      </div>
    </div>

   
   <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Barang Keluar</h3>
      </div>

   <div class="box-body">
    <table class='table table-bordered table-stripped datatable'>
      <thead>
        <tr>
          <th>Cabang</th>
          <th>Nama Barang</th>
          <th>Jumlah Keluar</th>
          <th>Harga</th>
          <th>Total</th>
          <th>Jam Keluar</th>
          <th>Tgl. Keluar</th>
          <th>Aksi</th>
        </thead>
   <tbody>

  <?php
    $p      = new Paging;
    $batas  = 15;
    $posisi = $p->cariPosisi($batas);
    $data       = mysqli_query($con, "SELECT no_fbk, nama_brg, jumlah, harga, total,jam_bk, tgl_bk From gudang, barang_keluar Where gudang.id_gudang=barang_keluar.id_gudang Group by no_fbk");
    $no       = $posisi+1;
    $tampil   = mysqli_query($con, "Select * From barang_keluar");
    while($hasil  = mysqli_fetch_array($data)){
    $tgl    = tgl_indo($hasil['tgl_bk']);  
      $lebar      = strlen($no);
      switch($lebar){
        case 1:
        {
          $g  = "0".$no;
          break;
        }
        case 2:
        {
          $g  = $no;
          break;
        }
      }
      ?>

    <tr class="gradeX">
          <td><?php echo $hasil['nama_brg']; ?></td>
          <td><?php echo $hasil['jumlah']; ?></td>
          <td><div align="left"><?php echo rupiah($hasil['harga']); ?></td>
          <td><div align="left"><?php echo rupiah($hasil['total']); ?></td>
          <td><?php echo $jam_bk; ?></td>
          <td><?php echo $tgl_bk; ?></td>
          <td>
          <a href="?module=view_barang_keluar&id=<?php echo $hasil['no_fbk'] ?>"><img src="img/id-card.png" /></a>
          <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/mod_barang_keluar/aksi_barang_keluar.php?module=barang_keluar&act=del&id=<?php echo $hasil['no_fbk'] ?>"><img src="img/hapus.png" /></a>
          </td> 
      </tr>
  <?php
        $no++;
      }
      ?>

  </table>
  </div>
  </div>
  </div>
<?php
  $jmldata  = mysqli_num_rows(mysqli_query($con, "Select * From barang_keluar"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
  break;


  case "tambah_bk":
?>
 <section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Barang Keluar</h3>
          </div>

          <div class="block-content">
            <form id="data" method="post" action="modul/mod_barang_keluar/aksi_barang_keluar.php?module=barang_keluar&act=barang_keluar" enctype="multipart/form-data">
  
  <?php
        $now      = date('Y-m-d');
    $selectidmax  = mysqli_query($con, "SELECT max(no_fbk) as nofex From barang_keluar Where tgl_bk='$now'");
    $hsilidmax    = mysqli_fetch_array($selectidmax);
    $idmax      = $hsilidmax['nofex'];
    $nourut     = (int) substr($idmax, 10,3);
    $nourut++;
        /*Kode Depan*/
    $tgl      = date('d');
        $bln      = date('m');
        $thn      = date('Y');
        $thn2     = substr($thn,2,2);
        $sekarang     = "".$thn2."".$bln."".$tgl;
  ?>

  <section class="content">

    <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/mod_barang_keluar/aksi_barang_keluar.php?act=tambah_bk">


            <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label >No. Faktur</label>
                  <input type="text" class="form-control" name="no_fbk" readonly="readonly" value="<?php echo $idbaru = "FOM-".$sekarang. sprintf("%03s", $nourut); ?>" required/>
                </div>

                <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <label>Pilih Cabang</label>
                  <select type="text" class="form-control" name="" required/>
                  <option value="">-- Pilih Cabang --</option>
                </select>


                <p class="inline-small-label">
                  <label for="fieldd4">Nama Barang</label>
                  <select name="id_brg" class="form-control" required>
                    <option value="">-- Pilih Barang --</option>
                    <?php 
                    $sel_sp   = mysqli_query($con, "Select * From gudang");
                    while ($sp  = mysqli_fetch_array($sel_sp)){
                    ?>
                    <option value="<?php echo $sp['id_brg']; ?>"><?php echo $sp['nama_brg']; ?></option>
                    <?php
                    }
                    ?>
                </select>
              </p>

              <p class=inline-small-label>
                <label for=field4>Jumlah Keluar</label>
                <input type="text" class="form-control" name="jumlah" size="25" required/>
             </p>

             <p class=inline-small-label>
                <label for=field4>Harga</label>
                <input type="text" class="form-control" name="harga" size="25" required/>
             </p>

            <p class=inline-small-label>
                <label for=field4>Total Harga</label>
                <input type="text" class="form-control" name="total" size="25" required/>
            </p>

            <p class=inline-small-label>
                <label for=field4>Jam Keluar</label>
                <input type="text" name="jam_bk" class="form-control" readonly="readonly" value="<?php echo date("H:i:s"); ?>" size="25" required="" />
            </p>

              <p class=inline-small-label>
                <label for=field4>Tanggal Keluar</label>
                <input type="text" name="tgl_bk" class="form-control" readonly="readonly" size="25" value="<?php echo date('Y-m-d'); ?>" />
              </p>

              <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=barang_keluar">
                    <button type="submit" class="btn btn-danger">Batal</button>
                    <button type="submit" class="btn btn-success">Tambah</button>
                </div>
              </div>
            </div>

  
   </form>
        </div>
      </div>
    </div>
  </div>
</div>
<?php
  break;
  case "edit_obat_exp":
?>
<div id="main-content">
<div class="container_12">
<div class="grid_12">
<div class="block-border">
    <div class="block-header">
        <h1>EDIT BARANG KELUAR</h1>
        <div class="flip" style="right:45; top:8; float: right; margin-top: 7px; margin-right: 10px; align: center;">
          <img src="../redaktur/img/faq.png" style=" border:none;"></img>
        </div>
    </div>
  <div class="block-content">
  <form id="data" method="post" action="" enctype="multipart/form-data">
  <?php
    $id = $_GET['id'];
    $ok = mysqli_fetch_array(mysqli_query($con, "Select no_fbk, nama_brg, jumlah, tgl_bk From gudang, barang_keluar Where gudang.id_gudang=barang_keluar.id_gudang And no_bk='$id'"));
  ?>
        <p class="inline-small-label">
        <label for="field4">No. Faktur</label>
            <input type="text" name="no_fbk" readonly="readonly" value="<?php echo $ok['no_fbk']; ?>" style="text-align:center;" size="25" />
        </p>

        <p class="inline-small-label">
        <label for="field4">Jumlah</label>
    <input name="jumlah[]" type="text" id="jumlah-0" size="25" style="text-align:center;" value="<?php echo $ok['jumlah']; ?>" required/>
    </p>

    <p class="inline-small-label">
        <label for="field4">Tanggal Keluar</label>
            <input type="text" name="tgl_bk" readonly="readonly" style="text-align:center;" size="25" value="<?php echo $ok['tgl_bk']; ?>" />
        </p>

    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=antrianbaru">Batal</a>
            </li> 
        </ul>
        <ul class=actions-left>
            <li>
            <input type="submit" name="upload" class="button" value="Update">
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
  <script src="js/libs/jquery-1.10.2.min.js"></script>
    <script src="js/libs/jquery-ui-1.9.2.custom.min.js"></script>
  <script>
// proses menambah inputan
$('#tambah').click(function() {

    var i = $('input').size() + 1,
  input = '<div id="box' + i + '"><a href="#" id="hapus" color="red"><button>Hapus</button></a>';
  input += '<p class="inline-small-label"><label for="fieldd4">Nama Barang</label><select name="gudang[]" id="gudang-0" required><option value="">-- Pilih Barang --</option><?php $sel_brg   = mysqli_query($con, "Select * From gudang"); while ($ob   = mysqli_fetch_array($sel_ob)){?><option value="<?php echo $ob['id_brg']; ?>"><?php echo $brg['nama_brg']; ?></option><?php } ?></select></p>';
  input += '<p class="inline-small-label"><label for="fieldd4">Jumlah</label><input name="jumlah[]" type="text" size="25" id="jumlah-' + i + '" class="hitung" required/></p>';
    input += '</div>';

    $('#box').append(input);

    i++;
    return false;

});

// proses menghapus inputan
$('body').on('click', '#hapus', function() {

    $(this).parent('div').remove();

});
    </script>         