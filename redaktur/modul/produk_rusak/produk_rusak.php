<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Produk Rusak</li>
</ol>
</section>

<section class="content">
  <div class="box box-success">
    <div class="box-header">
        <h3 class="box-title">Data Produk Rusak</h3>
    </div>
    <div class="box-body">
      <div class="table-responsive">
      <table class="table table-bordered table-stripped datatable">
        <thead>
          <tr>
            <th>Kode Produk</th>
            <th>Nama Produk</th>
            <th>Kategori Produk</th>
            <th>Satuan Produk</th>
            <th>Jumlah</th>
            <th>Keterangan</th>
          </tr>
        </thead>
        <tbody>
          <?php $q = mysqli_query($con,"SELECT *FROM produk_rusak p 
          JOIN kategori k ON p.id_kat=k.id_kategori
          JOIN data_satuan s ON p.id_sat=s.id_s
          "); 
          while ($pr = mysqli_fetch_array($q)) {
            ?>
          <tr>
            <td><?php echo $pr['kode_produk'] ?></td>
            <td><?php echo $pr['nama_produk'] ?></td>
            <td><?php echo $pr['kategori'] ?></td>
            <td><?php echo $pr['satuan'] ?></td>
            <td><?php echo $pr['jumlah'] ?></td>
            <td><?php echo $pr['keterangan'] ?></td>
          </tr>
          <?php 
          }
          ?>
        </tbody>
    </table>
    </div>
  </div>
</div>
</section>