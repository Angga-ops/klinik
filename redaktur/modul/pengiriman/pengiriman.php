<?php 
$act = $_GET['act'];
switch ($act) {
  case 'lapor':
?>
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pengiriman</li>
</ol>
</section>


<section class="content">
  <div class="box box-success">
    <div class="box-header">
      <h1 class="box-title">Data Pengiriman yang Tidak Sesuai</h1>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th>Tujuan Cabang</th>
              <th>Tanggal Pengiriman</th>
              <th>Pengirim</th>
              <th>Penerima</th>
              <th>Keterangan</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
            <?php $q1 = mysql_query("SELECT *FROM pengiriman WHERE status='lapor' ORDER BY tanggal DESC"); 
                  while($pp = mysql_fetch_array($q1)){ ?>

            <tr>
              <td><?php $c =  mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$pp[cabang]'")); echo $c["nama_klinik"]; ?></td>
              <td><?php echo $pp["tanggal"]; ?></td>
              <td><?php echo $pp["pengirim"]; ?></td>
              <td><?php echo $pp["penerima"]; ?></td>
              <td><?php echo $pp["keterangan"]; ?></td>
              <td>
                <a href="media.php?module=pengiriman&act=detail&nop=<?php echo $pp[no_pengiriman]; ?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Detail</a>
                <a href="modul/pengiriman/cetak_pengiriman.php?nop=<?php echo $pp[no_pengiriman]; ?>" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Cetak</a>
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
</section>
<?php
    break;
  case 'detail':
  $nop = $_GET['nop'];
  ?>
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Detail Pengiriman</li>
</ol>
</section>
<section class="content">
  <div class="box box-success">
    <div class="box-header"> 
      <h3 class="box-title">Detail Pengiriman</h3>
    </div>
    <div class="box-body">
      <?php $q2 = mysql_query("SELECT *FROM pengiriman WHERE no_pengiriman='$nop'");
        $p = mysql_fetch_array($q2);
      ?>
      <div class="row">
        <div class="col-md-2">
          Tanggal Pengiriman 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['tanggal'] ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Nomer Pengiriman 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['no_pengiriman'] ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Tujuan Cabang    
        </div>
        <div class="col-md-5">
          :&emsp; <?php $k = mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$p[cabang]'")); echo $k['nama_klinik']; ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Pengirim 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['pengirim']; ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Penerima 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['penerima']; ?>
        </div>
      </div>
      <div class="row" style="margin-top: 5px;">
        <div class="col-md-2">
          Keterangan 
        </div>
        <div class="col-md-5">
          :&emsp; <?php echo $p['keterangan']; ?>
        </div>
      </div><br>
      <button class="btn btn-success btn-sm" onclick="window.history.back()">Kembali</button>
      <?php if($p['status']=="Lapor"){?>
            <a href="modul/pengiriman/konfirmasi.php?nop=<?php echo $p[no_pengiriman]; ?>" class="btn btn-primary btn-sm">Konfirmasi</a>
        <?php
      } ?>
      <?php if($p['keterangan']!="Telah Diterima"){?>
            <a href="modul/pengiriman/cetak_pengiriman.php?nop=<?php echo $p[no_pengiriman]; ?>" class="btn btn-info btn-sm"><i class="fa fa-print"></i> Cetak</a>
        <?php
      } ?>
      <hr>
      <h4>Daftar Produk Yang Dikirim</h4>
      <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Satuan</th>
              <th>Harga Jual</th>
              <th>Jumlah</th>
              <th>Diterima</th>
              <th>Ket</th>
            </tr>
          </thead>
          <tbody>
            <?php $q1 = mysql_query("SELECT *FROM produk_pengiriman WHERE no_pengiriman='$nop'"); 
              $no =1;
              while ($br = mysql_fetch_array($q1)) {
                ?>
            <tr>
              <td><?php echo $no; ?></td>
              <td><?php echo $br['kode_produk']; ?></td>
              <td><?php echo $br['nama_produk']; ?></td>
              <td><?php $sat = mysql_fetch_array(mysql_query("SELECT *FROM kategori WHERE id_kategori='$br[id_kat]'")); 
              echo $sat['kategori']; ?></td>
              <td><?php $kat = mysql_fetch_array(mysql_query("SELECT *FROM data_satuan WHERE id_s='$br[id_sat]'")); 
              echo $kat['satuan']; ?></td>
              <td><?php echo $br['harga_jual']; ?></td>
              <td><?php echo $br['jumlah']; ?></td>
              <td><?php echo $br['jumlah_diterima']; ?></td>
              <td><?php echo $br['ket']; ?></td>
            </tr>
                <?php
                $no++;
              }
            ?>
            
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>
<?php
    break;


  case 'tambah':
    ?>
    <!-- SECTION TAMBAH PENGIRIMAN BARU -->
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pengiriman Baru</li>
</ol>
</section>
<section class="content">
  <div class="box box-success">
    <div class="box-header">
      <h1 class="box-title">Tambah Pengiriman Baru</h1>
    </div>
    <div class="box-body">
      <form method="post" id="form_kirim">
        <table class="table" cellspacing="1">
          <tr>
            <td><label>Tujuan Cabang Klinik</label></td>
            <td>
              <select class="form-control" name="cabang" required id="klinik">
                <option value="0">Pilih Klinik</option>
                <?php $q1 = mysql_query("SELECT *FROM daftar_klinik"); 
                      while($k = mysql_fetch_array($q1)){ ?>

                      <option value="<?php echo $k[id_kk]; ?>"><?php echo $k["nama_klinik"]; ?></option>
                      <?php 
                    }
                ?>
              </select>
            </td>
          </tr>
          <tr>
            <td><label>Nomor Pengiriman</label></td>
            <td><input id="no_peng" class="form-control" type="text" name="no_peng"></td>
          </tr>
          <tr>
            <td><label>Tanggal</label></td>
            <td><input class="form-control" type="text" name="tgl" value="<?php echo date("Y-m-d"); ?>"></td>
          </tr>
          <tr>
            <td><label>Pengirim</label></td>
            <td><input class="form-control" type="text" name="pengirim" value="<?php echo $_SESSION['namalengkap']; ?>"></td>
          </tr>
          <tr>
            <td><button class="btn btn-success" type="submit">Kirim</button>
              <a href="media.php?module=pengiriman" class="btn btn-danger">Batal</a></td>
          </tr>
        </table>        
      </form>
      <hr>
      <h4>Daftar Produk Yang Akan Dikirim</h4><br>
      <form method="post" id="produk_kirim">
        <div class="row">
          <div class="col-md-2">
            <label>Kode Produk</label>
            <input class="form-control" type="text" name="kd_brg" id="kode_brg" required>
          </div>
          <div class="col-md-2">
            <label>Nama Produk</label>
            <input class="form-control" type="text" name="nama_brg" id="nama_brg" required>
          </div>
          <div class="col-md-2">
            <label>Kategori</label>
            <select class="form-control" name="kat_brg" id="kat_brg">
              <option>Kategori ..</option>
              <?php  $q1 = mysql_query("SELECT *FROM kategori"); 
              while ($kat = mysql_fetch_array($q1)) { ?>
                <option value="<?php echo $kat[id_kategori]; ?>"><?php echo $kat['kategori']; ?></option>
            <?php  }
            ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Satuan</label>
            <select class="form-control" name="sat_brg" id="sat_brg">
              <option>Satuan ..</option>
              <?php  $q1 = mysql_query("SELECT * FROM data_satuan"); 
              while ($kat = mysql_fetch_array($q1)) { ?>
                <option value="<?php echo $kat[id_s]; ?>"><?php echo $kat['satuan']; ?></option>
            <?php  }
            ?>
            </select>
          </div>
          <div class="col-md-2">
            <label>Harga Jual</label>
            <input class="form-control" type="text" name="harga" id="harga" readonly required>
          </div>
          <div class="col-md-2">
            <label>Jumlah</label>
            <input class="form-control" type="number" name="jumlah" id="Jumlah" value="10">
          </div>
        </div>
        <div class="form-group">
          <input type="hidden" name="min" id="min">
          <input type="hidden" name="max" id="max">
          <input type="hidden" name="harga_b" id="harga_b">
          <br>
          <button class="btn btn-primary btn-sm" type="submit"><i class="fa fa-plus"></i> Tambah Produk</button>
          <input type="button" class="btn btn-sm btn-danger" onclick="this.form.reset();" value="Reset Form">
          <a href="#" class="btn btn-warning btn-sm" id="reset_table">Reset Table</a>
        </div>
      </form><br>
      <div class="table-responsive">
        <table class="table table-striped table-bordered" id="dp_kirim">
          <thead>
            <tr>
              <th>No</th>
              <th>Kode Produk</th>
              <th>Nama Produk</th>
              <th>Kategori</th>
              <th>Satuan</th>
              <th>Harga Jual</th>
              <th>Jumlah</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
          </tbody>
        </table>
      </div>
    </div>
  </div>
</section>  

  <?php
    break;
  
  default:
?>
<!-- SECTION DATA PENGIRIMAN -->
<section class="content-header"> 
<h1>
  Administrator
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Pengiriman</li>
</ol>
</section>


<section class="content">
  <div class="callout callout-success">
        <a style="text-decoration: none;" href="media.php?module=pengiriman&act=tambah" class="btn btn-warning btn-sm"><i class="fa fa-plus"></i> Pengiriman Baru</a>
    </div>
  <div class="box box-success">
    <div class="box-header">
      <h1 class="box-title">Data Pengiriman</h1>
    </div>
    <div class="box-body">
      <div class="table-responsive">
        <table class="table table-striped table-bordered datatable">
          <thead>
            <tr>
              <th>Tujuan Cabang</th>
              <th>Tanggal Pengiriman</th>
              <th>Pengirim</th>
              <th>Penerima</th>
              <th>Keterangan</th>
              <th>Pilihan</th>
            </tr>
          </thead>
          <tbody>
            <?php $q1 = mysql_query("SELECT *FROM pengiriman ORDER BY tanggal DESC"); 
                  while($pp = mysql_fetch_array($q1)){ ?>

            <tr>
              <td><?php $c =  mysql_fetch_array(mysql_query("SELECT *FROM daftar_klinik WHERE id_kk='$pp[cabang]'")); echo $c["nama_klinik"]; ?></td>
              <td><?php echo $pp["tanggal"]; ?></td>
              <td><?php echo $pp["pengirim"]; ?></td>
              <td><?php echo $pp["penerima"]; ?></td>
              <td><?php echo $pp["keterangan"]; ?></td>
              <td>
                <a href="media.php?module=pengiriman&act=detail&nop=<?php echo $pp[no_pengiriman]; ?>" class="btn btn-primary btn-xs"><i class="fa fa-list"></i> Detail</a>
                <a href="modul/pengiriman/cetak_pengiriman.php?nop=<?php echo $pp[no_pengiriman]; ?>" class="btn btn-info btn-xs"><i class="fa fa-print"></i> Cetak</a>
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
</section>

<?php
    break;
}

?>
<div  class="modal fade" id="modal_edit">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Produk</h4>
              </div>
              <div class="modal-body">
                <form method="POST" id="form_edit">
                  <input class="form-control" type="hidden" id="id_brg" name="id">
                  <div class="form-group">
                    <label>Kode Produk</label>
                    <input class="form-control" type="text" name="kb" id="kb">
                  </div>
                  <div class="form-group">
                    <label>Nama Produk</label>
                    <input class="form-control" type="text" name="nb" id="nb">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <select class="form-control" name="kat_brg" id="kat">
                      <option>Kategori ..</option>
                      <?php  $q1 = mysql_query("SELECT *FROM kategori"); 
                      while ($kat = mysql_fetch_array($q1)) { ?>
                        <option value="<?php echo $kat[id_kategori]; ?>"><?php echo $kat['kategori']; ?></option>
                    <?php  }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Satuan</label>
                    <select class="form-control" name="sat_brg" id="sat">
                      <option>Satuan ..</option>
                      <?php  $q1 = mysql_query("SELECT *FROM data_satuan"); 
                      while ($kat = mysql_fetch_array($q1)) { ?>
                        <option value="<?php echo $kat[id_s]; ?>"><?php echo $kat['satuan']; ?></option>
                    <?php  }
                    ?>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Harga Jual</label>
                    <input class="form-control" type="text" name="hj" id="hj">
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input class="form-control" type="number" name="j" id="j">
                  </div>
                  <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Batal</button>
                <button type="submit" class="btn btn-primary" id="edit_s">Edit</button>
                </form>
              </div>
             
            </div>
          </div>
</div>

<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
  // Datatable pengiriman
  $('#dp_kirim').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/pengiriman/data_produk.php",
      "columnDefs": [{
        "orderable": false
    }],
      "fnRowCallback": function (nRow, aData, iDisplayIndex) {
           var info = $(this).DataTable().page.info();
           $("td:nth-child(1)", nRow).html(info.start + iDisplayIndex + 1);
           return nRow;
       },
      "aoColumns": [
        null,
        null,
        null,
        null,
        null,
        null,
        null,
        {
        "mData": "0",
        "mRender": function ( data, type, full ) {
          return '<button id="edit_brg" data-id="'+data+'" class="btn btn-info btn-xs"><i class="fa fa-edit"></i> Edit</button> <button id="hapus_brg" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Hapus</button>';
          }
        }
      ]
    } );
  // Auto complete
  $( "#kode_brg" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/pengiriman/cari.php",
        type: 'post',
        dataType: "json",
        data: {
         search: $( "#kode_brg" ).val()
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kode_brg').val(ui.item.label);
       $('#harga').val(ui.item.harga);
       $('#nama_brg').val(ui.item.nama);
       $('#kat_brg').val(ui.item.kat);
       $('#sat_brg').val(ui.item.sat);
       $('#min').val(ui.item.min);
       $('#max').val(ui.item.maks);
       $('#harga_b').val(ui.item.harga_b);
       $("#Jumlah").attr({
          "max" : ui.item.limit     
        });
       return false;
      }
     });
  // Nama BRG
  $( "#nama_brg" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/pengiriman/cari.php?src=nama",
        type: 'post',
        dataType: "json",
        data: {
         search: $( "#nama_brg" ).val()
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kode_brg').val(ui.item.kode);
       $('#harga').val(ui.item.harga);
       $('#nama_brg').val(ui.item.label);
       $('#kat_brg').val(ui.item.kat);
       $('#sat_brg').val(ui.item.sat);
       $('#min').val(ui.item.min);
       $('#max').val(ui.item.maks);
       $('#harga_b').val(ui.item.harga_b);
       $("#Jumlah").attr({
          "max" : ui.item.limit     
        });
       return false;
      }
     });

  // Reset
  $("#reset_table").click(function(){
        $.ajax({
          url: 'modul/pengiriman/reset.php',
          success:function(){
            alert("Tabel Berhasil Direset");
            var oTable = $('#dp_kirim').dataTable(); 
            oTable.fnDraw(false);
          }
        });
     });
  // Tambah Produk
  $('#produk_kirim').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/pengiriman/tambah_produk.php',
            data: $('#produk_kirim').serialize(),
            success: function (data) {
              var otable = $('#dp_kirim').dataTable();
              otable.fnDraw(false);
               $('#produk_kirim').trigger("reset");
            }
          });

        });
    // Hapus barang
    $('body').on("click","#hapus_brg",function(){

          var id_p = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/pengiriman/hapus_produk.php',
              data:{
                id_p:id_p
              },
              success:function(data){
                  var oTable = $('#dp_kirim').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
     });
    // EDIT
    $('body').on("click","#edit_brg",function(){

          var id_p = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/pengiriman/edit_produk.php',
              data:{
                id_p:id_p
              },
              success:function(data){

                 var obj = JSON.parse(data);
                
                $("#nb").val(obj.nama);
                $("#kb").val(obj.kode);
                $("#j").val(obj.j);
                $("#kat").val(obj.kat);
                $("#sat").val(obj.sat);
                $("#hj").val(obj.harga);
                $("#id_brg").val(obj.id);

                $("#modal_edit").modal("show");

              }
          });
     });
    // Edit
    $("#form_edit").on("submit",function(e){
      e.preventDefault();
      $.ajax({
              type:'POST',
              url: 'modul/pengiriman/aksi_edit.php',
              data: $('#form_edit').serialize(),
              success:function(data){
                  alert("Berhasil mengedit");
                  $('#form_edit').trigger("reset");
                  $("#modal_edit").modal("hide");
                  var oTable = $('#dp_kirim').dataTable(); 
                  oTable.fnDraw(false);
              }
          });
    });
    // Form kirim
    $("#form_kirim").on("submit",function(e){
      e.preventDefault();
      $.ajax({
              type:'POST',
              url: 'modul/pengiriman/aksi_pengiriman.php',
              data: $('#form_kirim').serialize(),
              success:function(data){
                  if (data=="No") {
                    alert("Produk Yang Akan Dikirim Belum Ada!!")
                  }else if(data=="K"){
                    alert("Klinik Tujuan Belum Dipilih!!");
                  }else{
                    alert("Pengiriman Berhasil");
                    window.location.href = "media.php?module=pengiriman";
                }
              }
          });
    });
    // change klinik
    $("#klinik").change(function(){
      var id = $(this).val();
      $.ajax({
        type: 'POST',
        data:{
          id:id
        },
        url: 'modul/pengiriman/no_pengiriman.php',
        success:function(data){
          $("#no_peng").val(data);
        }
      });
    });

});
</script>
