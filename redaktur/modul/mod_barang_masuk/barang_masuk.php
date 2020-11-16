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
          <a href="?module=barang_masuk&act=tambah_bm"> <button type="button" class="btn btn-warning btn-sm">Tambah Data Barang Masuk</button></a>
        </div>
      </div>
    </div>


    <div class="row">
      <div class="col-md-12">
        <div class="box">
          <div class="box-header">
            <h3 class="box-title">Data Barang Masuk</h3>
      </div>
      <div class="box-body">
        <table class="table table-bordered table-stripped datatable">
          <thead>
        <tr>
            <th>No. Faktur</th>
            <th>Supplier</th>
            <th>Nama Barang</th>
            <th>Jumlah Barang</th>
            <th>Harga</th>
            <th>Total Harga</th>
            <th>Jam Datang</th>
            <th>Tanggal Datang</th>
            <th>Aksi</th>
    </tr>
    </thead>
    <tbody>

      
<?php
  $p          = new Paging;
  $batas      = 15;
  $posisi     = $p->cariPosisi($batas);
  $data       = mysqli_query($con, "Select no_faktur, nama_pt, nama_brg, jumlah, harga_beli,total_harga, jam_datang, tgl_datang From barang_masuk, supplier Where barang_masuk.id_supplier=supplier.id_supplier Group by no_faktur");
  $tampil   = mysqli_query($con, "Select * From barang_masuk");
    while($r  = mysqli_fetch_array($tampil)){
  $tgl_datang   = tgl_indo($hasil['tgl_datang']);
    ?>


  <tr class="gradeX">
        <td><?php echo $hasil['no_faktur']; ?></td>
        <td><?php echo $hasil['nama_pt']; ?></td>
        <td><?php echo $hasil['nama_brg']; ?></td>
        <td><?php echo $hasil['jumlah']; ?></td>
        <td><div align="left"><?php echo rupiah($hasil['harga_beli']); ?></td>
        <td><div align="left"><?php echo rupiah($hasil['total_harga']); ?></td>
        <td><?php echo $jam_datang; ?></td>
        <td><?php echo $tgl_datang; ?></td>
        <td><a target="_blank" href="report/rpt_barang_masuk.php?id=<?php echo $hasil['no_faktur'] ?>"><img src="img/id-card.png" /></a></td>
  </tr>
<?php
    }
    ?>

</table>
  </div>
  </div>
  </div>
<?php
  $jmldata  = mysqli_num_rows(mysqli_query($con, "Select * From barang_masuk"));
  $jmlhalaman  = $p->jumlahHalaman($jmldata, $batas);
  $linkHalaman = $p->navHalaman($_GET['halaman'], $jmlhalaman);
  break;
  case "tambah_bm":
?>
  <style type="text/css">
        div.pesan {
          width: 220px;
      height:380px;
      display:none;
        }
        div.pesan, p.flip {
          position: absolute;
          top: 30;
          right: 120;
          margin: 2px;
          margin-left: 760px;
          padding: 8px;
          text-align: center;
          background: #474747;
          border: 1px dotted white;
          cursor: pointer;
        }
        .pesan p {
          color: #fff;
        }
  </style>

<section class="content">
    
    <div class="row">
      <div class="col-md-12">
        <div class="box box-success">
          <div class="box-header with-border">
            <h3 class="box-title">Tambah Barang Masuk</h3>
          </div>

  
  <form name="autoSumForm" id="data" method="post" action="modul/mod_barang_masuk/aksi_barang_masuk.php?module=barang_masuk&act=tambah_bm" enctype="multipart/form-data">
  <?php
    $now          = date('Y-m-d');
    $selectidmax  = mysqli_query($con, "SELECT max(no_faktur) as nofak From barang_masuk Where tgl_datang='$now'");
    $hsilidmax    = mysqli_fetch_array($selectidmax);
    $idmax        = $hsilidmax['nofak'];
    $nourut       = (int) substr($idmax, 10,3);
    $nourut++;
        /*Kode Depan*/
        $tgl      = date('d');
        $bln      = date('m');
        $thn      = date('Y');
        $thn2     = substr($thn,2,2);
        $sekarang = "".$thn2."".$bln."".$tgl;
  ?>

  <section class="content">

        <!-- /.box-header -->
        <div class="box-body"> 
          <form method="post" enctype="multipart/form-data" action="modul/mod_barang_masuk/aksi_barang_masuk.php?act=tambah_bm">

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label >No. Faktur</label>
              <input type="text" class="form-control" name="no_faktur" readonly="readonly" value="<?php echo $idbaru = "FOM-".$sekarang. sprintf("%03s", $nourut); ?>" required/>
        </p>

        <div class="row">
          <div class="col-md-12">
            <div class="form-group">
              <label>Supplier</label>
              <select name="id_supplier" class="form-control" required>
                <option value="">-- Pilih Supplier --</option>
                <?php 
                    $sel_sp   = mysqli_query($con, "Select * From supplier");
                    while ($sp  = mysqli_fetch_array($sel_sp)){
                ?>
                <option value="<?php echo $sp['id_supplier']; ?>"><?php echo $sp['nama_pt']; ?></option>
                <?php
          }
                ?>
            </select>
        </p>

        <p class="inline-small-label">
        <label for="fieldd4">Nama</label>
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
        <label for=field4>Jumlah Barang</label>
            <input type="text" class="form-control" name="jumlah" size="25" required/>
        </p>

        <p class=inline-small-label>
        <label for=field4>Harga</label>
            <input type="text" class="form-control" name="harga_beli" size="25" required/>
        </p>

        <p class=inline-small-label>
        <label for=field4>Total Harga</label>
            <input type="text" class="form-control" name="total_harga" size="25" required/>
        </p>

        <p class=inline-small-label>
        <label for=field4>Jam Datang</label>
        <input type="text" name="jam_datang" class="form-control" readonly="readonly" value="<?php echo date("H:i:s"); ?>" size="25" required="" />
        </p>

        <p class=inline-small-label>
        <label for=field4>Tanggal Datang</label>
            <input type="text" name="tgl_datang" class="form-control" readonly="readonly" size="25" value="<?php echo date('Y-m-d'); ?>" />
        </p>

        <div class="row">
              <div class="col-md-12">
                <div class="form-group">
                  <a href="?module=barang_masuk">
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
  }
        