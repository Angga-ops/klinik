<?php
  switch($_GET['act']){
  default:
?>
<section class="content">
    
    <div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=pembelian_k&act=tambah_produk"> <button type="button" class="btn btn-warning btn-sm">Tambah Pembelian Kredit</button></a>
                

    </div>
        </div>
    </div>

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Daftar Pembelian Kredit</h3>
            </div>                    
            <div class="box-body">
			<!-- untuk scrool horizontal -->
			<div style="border:1px solid white;width:100%;overflow-y:hidden;overflow-x:scroll;">
               <table class="table table-bordered table-striped" id="example1">
                  <thead>
                    <tr>
                       <th>No</th>
                       <th>No Faktur</th>
                       <th>Tanggal Pembelian</th>
                       <th>Id Suplier</th>
                       <th>Total</th>
                       <th>Tanggal Tempo</th>
                       <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
            $tampil     = mysql_query("Select * From beli_k");
            $no = 1;
            while($data = mysql_fetch_array($tampil)){
        ?>
            <tr class="gradeX">
             <td><?php echo $no++?></td>
             <td><?php echo $data['no_fak']; ?></td>
             <td><?php echo $data['tgl_beli']; ?></td>
             <?php $q1 = mysql_query("SELECT *FROM suplier WHERE id_sup='$data[id_sup]'"); 
                 $k = mysql_fetch_array($q1); ?>
             <td><?php echo $k['nama_sup']; ?></td>
             <td><?php echo $data['total']?></td>
             <td><?php echo $data['tgl_tempo']?></td>
             <td>
               <a href="#detail" id="custId" data-toggle="modal" data-id="<?php echo $data['id']?>" class="btn btn-xs btn-info col-md-12"><i class="fa fa-info"></i> Detail</a><br>
               <a  href="#editmodal" id="custId" data-toggle="modal" data-id="<?php echo $data['id']?>" class="btn btn-xs btn-warning col-md-6"><i class="fa fa-edit"></i> Edit</a>
               <a onclick="return confirm('Yakin Ingin Menghapus Data?')" href="modul/pembelian_k/aksi_pembelian_k.php?module=pembelian_k&act=hapus&no_fak=<?php echo $data['no_fak']; ?>" class="btn btn-xs btn-danger col-md-6"><i class="fa fa-trash-o"></i> Hapus</a>
                     
             </td>
             
               
            </tr>
        <?php
            }
        ?>
                  </tbody>
                  <div class="modal fade" id="detail" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Detail Barang</h4>
                          </div>
                          <div class="modal-body">
                              <div class="fetched-data"></div>
                          </div>
                          <div class="modal-footer">
                              <button type="button" class="btn btn-default" data-dismiss="modal">Keluar</button>
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#detail').on('show.bs.modal', function (e) {
                        var id = $(e.relatedTarget).data('id');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'modul/pembelian_k/detail.php',
                            data :  'id='+ id,
                            success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                            }
                        });
                     });
                });
              </script>

              <div class="modal fade" id="editmodal" role="dialog">
                  <div class="modal-dialog" role="document">
                      <div class="modal-content">
                          <div class="modal-header">
                              <button type="button" class="close" data-dismiss="modal">&times;</button>
                              <h4 class="modal-title">Edit Transaksi</h4>
                          </div>
                          <div class="modal-body">
                              <div class="fetched-data"></div>
                          </div>
                          <div class="modal-footer">
                              
                          </div>
                      </div>
                  </div>
              </div>
              <script type="text/javascript">
                $(document).ready(function(){
                    $('#editmodal').on('show.bs.modal', function (e) {
                        var id = $(e.relatedTarget).data('id');
                        //menggunakan fungsi ajax untuk pengambilan data
                        $.ajax({
                            type : 'post',
                            url : 'modul/pembelian_k/edit.php',
                            data :  'id='+ id,
                            success : function(data){
                            $('.fetched-data').html(data);//menampilkan data ke dalam modal
                            }
                        });
                     });
                });
              </script>

          <div  class="modal fade" id="">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Barang</h4>
              </div>
                <div class="modal-body">
                <form style="margin-bottom: 20px;" role="form" method="POST" action="modul/pembelian_k/edit.php">
                  <?php
                  $id = $data['id']; 
                  $query_edit = mysql_query("SELECT * FROM beli WHERE id='$id'");
                  //$result = mysqli_query($conn, $query);
                  while ($row = mysql_fetch_array($query_edit)) {  
                  ?>

                  <div class="form-group">
                    <label>Nomor Faktur</label>
                    <input  class="form-control" type="text" name="no_fak" value="<?php echo $row['id'];?>" >
                    <input  class="form-control" type="text" name="no_fak" value="<?php echo $row['no_fak'];?>" >
                  </div>
                  <div class="form-group">
                    <label>Tanggal Beli</label>
                    <input class="form-control"  type="date" name="tgl_beli" value="<?php echo $row['tgl_beli'];?>">
                  </div>
                  <div class="form-group">
                    <label>Total</label>
                    <input class="form-control"  type="text" name="total" value="<?php echo $row['total'];?>" readonly>
                  </div>
                  <div class="form-group">
                    <label>Suplier</label>
                    <select type="text" name="id_sup" name="id_sup" class="form-control" >
                             <option value="<?php echo $row['id_sup'];?>"><?php echo $row['id_sup'];?></option>
                              <?php $query = mysql_query("SELECT *FROM suplier");
                                 while ($cb = mysql_fetch_array($query)) { ?>
                                   <option value="<?php echo $cb['id_sup']; ?>"><?php echo $cb['nama_sup']; ?></option>
                                <?php  } ?> 
                            </select>
                  </div>
                  <div class="form-group">
                    <label>Pembayaran</label>
                    <select>
                      <option value="<?php echo $row['pembayaran'];?>"></option>
                      <option value="Transfer">Transfer</option>
                      <option value="Tunai">Tunai</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label>Keterangan</label>
                    <input value="<?php echo $row['ket'];?>" class="form-control"  type="text" name="ket">
                  </div>
                  <?php }?>

                </form><br>
              </div>
              <div class="modal-footer">
                <button type="button" type="submit" class="btn btn-default pull-left" >Simpan</button>
                <button class="btn btn-primary"  data-dismiss="modal">Batal</button>
              </div>                
                </table>
      <tbody>
   
    </tbody>
	</div>
	<!--Penutuup DIV Scroll -->
     </div></div></div></div>

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
<!--
   -->


<?php
  break;
  case "tambah_produk":
?>

<section class="content">
    
    <!--<div class="row">
    <div class="col-md-12">
         <div class="callout callout-success">
               <a href="?module=pembelian_t&act=tambah_produk"> <button type="button" class="btn btn-warning btn-sm">Tambah Pembelian Tunai</button></a>
    </div>
        </div>
    </div>-->

     <div class="row">
    <div class="col-md-12">
 <div class="box box-success">
            <div class="box-header">
              <h3 class="box-title">Pembelian Kredit Baru</h3>
            </div>                    
            <div class="box-body">
              
      <h4>Silahkan pilih produk yang akan dibeli</h4><br>
            <!--<select id="tataup" class="form-control" style="width: 35%;">
              <option value="treatment">Treatment</option>
              <option value="produk">Produk</option> 
            </select>-->
            <form style="margin-bottom: 20px;" id="form_kk">
              <?php 
              $tgl_beli = date('Y-m-d');
              ?>
              <input class="form-control" type="hidden" name="id_k" value="<?php echo $id_k ?>">
              <table border='0' cellpadding="" ng='0' cellspacing='0' width='100%'>
                <tr>
                  <td>
                    <label>Nama Barang</label>
                  </td>
                  <td>
                    <label>Kode Barang</label>
                  </td>
                  
                  <td>
                    <label>Satuan</label>
                  </td>
                  <td>
                    <label>Kategori</label>
                  </td>
                  <td>
                    <label>Jumlah</label>
                  </td>
                  <td>
                    <label>Harga</label>
                  </td>
                  
                  
                </tr>
                <tr>
                  <td>
                    <input class="form-control" type="text" name="nama_brg" id="nama_barang" style="width: 90%;" required>
                  </td>
                  <td>
                    <input class="form-control" type="text" name="kd_brg" id="kd_brg" style="width: 90%;" required>
                  </td>
                  
                  <td>
                    <select type="text" name="id_satuan" id="id_satuan" style="width: 90%;" class="form-control" readonly >
                     <option value="">Satuan</option>
                      <?php $query = mysql_query("SELECT *FROM data_satuan");
                         while ($cb = mysql_fetch_array($query)) { ?>
                           <option value="<?php echo $cb['id_s']; ?>"><?php echo $cb['satuan']; ?></option>
                        <?php  } ?> 
                    </select>
                  </td>
                  <td>
                    <select type="text" name="id_kategori" id="id_kategori" style="width: 90%;" class="form-control" readonly >
                     <option value="">Kategori</option>
                      <?php $query = mysql_query("SELECT *FROM kategori");
                         while ($cb = mysql_fetch_array($query)) { ?>
                           <option value="<?php echo $cb['id_kategori']; ?>"><?php echo $cb['kategori']; ?></option>
                        <?php  } ?> 
                    </select>
                  </td>
                  <td>
                    <input class="form-control" type="number" name="jumlah" id="jumlah" style="width: 90%;" required>
                  </td>
                  <td>
                    <input class="form-control" type="text" name="hrg" id="hrg" style="width: 90%;" readonly>
                  </td>
                   <td>
                    <input class="form-control" type="hidden" name="harga_jual" id="harga_jual" style="width: 90%;" required>
                  </td>
                  <td>
                    <input class="form-control" type="hidden" name="tgl_beli" value="<?php echo $tgl_beli?>">
                  </td>
                 
                </tr>
                <tr>
                  <td><label>Diskon</label></td>
                </tr>
                <tr>
                  <td>
                  <input class="form-control" type="number" name="diskon" placeholder="%" id="diskon" style="width: 90%;" value="0">
                  </td>
                   <td>
                  <input class="form-control" type="hidden" name="batas_cabang"  id="batas_cabang" style="width: 90%;" value="100" required>
                  </td>
                   <td>
                  <input class="form-control" type="hidden" name="batas_minim" value="10"  id="batas_minim" style="width: 90%;" required>
                  </td>
                </tr>
                <tr>
                  <td>
                    <input style="margin-top: 5px;" type="button" class="btn btn-sm btn-danger" onclick="this.form.reset();" value="Reset Form">
                    <button style="margin-top: 5px;" type="submit"  class="btn btn-sm btn-success">Tambah</button>
                    <br>
                  </td>
                </tr>
              </table>
            </form><br><br>
             <table class="table table-bordered table-striped" id="barang12">
                  <thead>
                    <tr>
                      <th>No</th>
                      <th>Kode Barang</th>
                       <th>Nama Barang</th>
                       <th>Jumlah</th>
                       <th>Harga</th>
                       <th>Diskon</th>
                       <th>Sub Total</th>
                       <th>Aksi</th>
                    </tr>
                  </thead>
                  <tbody>
                     <?php
            $tampil     = mysql_query("Select * From pembelian_k");
            $no = 1;
            while($data = mysql_fetch_array($tampil)){
        ?>
            <tr class="gradeX">
             <td><?php echo $no++?></td>
             <td><?php echo $data['kd_brg']; ?></td>
             <td><?php echo $data['nama_brg']; ?></td>
             <td><?php echo $data['harga']; ?></td>
             <td><?php echo $data['jumlah']; ?></td>
             <td><?php echo $data['diskon']; ?></td>
             <td><?php echo $data['sub_tot']; ?></td>
            </tr>
        <?php
            }
        ?>
                  </tbody>
    <tr>
      <th colspan="6" style="text-align: right;">Total</th>
      <td id="total">
        
        </td>
    </tr>
                </table>
    
          <hr>
           <div class="col-md-6">
           <table class="table">
            <div class="row" style="margin-bottom: 5px;">
              <div class="col-md-6">
              <form method="POST"  action="modul/pembelian_k/input_transaksi.php">
                <table class="table" >
                      <tbody>
                       <!-- <?php
                        $selectidmax  = mysql_query("SELECT From beli_k");
                        $nofakmax = array();
                        while($no       = mysql_fetch_array($selectidmax)){
                            $ambil      = intval(substr($no['no_fak'], 4));
                            $nofakmax[] = $ambil;
                        }
                          $nmax = max($nofakmax);
                          $nmax++;
                          // $kode = "FAK-".$nmak;
                        ?> -->
                          <tr>
                            <td><label>No Faktur</label></td>
                            <td><input class="form-control" type="text" name="no_fak" value="<?php echo $kode; ?>" autocomplete="off"></td>
                          </tr>
                          <tr><input type="hidden" name="total" id="tot"></tr>
                          <tr>
                            <td><label>Tanggal Pembelian</label></td>
                            <td><input class="form-control" type="date" name="tgl_beli"  value="<?php echo date('Y-m-d') ?>"></td>
                          </tr>
                          <tr>
                            <td><label>Suplier</label></td>
                            <td><select type="text" name="id_sup" name="id_sup" class="form-control" >
                             <option value="">--- Pilih Suplier ---</option>
                              <?php $query = mysql_query("SELECT *FROM suplier");
                                 while ($cb = mysql_fetch_array($query)) { ?>
                                   <option value="<?php echo $cb['id_sup']; ?>"><?php echo $cb['nama_sup']; ?></option>
                                <?php  } ?> 
                            </select></td>
                          </tr>
                          <tr>
                            <td><label>Tanggal Tempo</label></td>
                            <td><input class="form-control" type="date" name="tgl_tempo"></td>
                          </tr>
                      </tbody>
                    </table>
                  </div>
        <div class="row">
            <div class="col-md-12">
              <div class="form-group">
                <button style="align-items: : right;" type="submit" name="submit" class="btn btn-success">Simpan Transaksi</a>
              </div>
              </div>
            </div>   
            </form>
     </div></div></div></div>

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
<script>
$('#datepicker3').datepicker({
      format: "yyyy-mm-dd",
      autoclose: true
    })
</script>
<!--
   -->

<!--
     -->
     <!-- Modal -->
<div  class="modal fade" id="modal_pembelian_k">
          <div class="modal-dialog">
            <div class="modal-content" style="width: 100%;">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Edit Barang</h4>
              </div>
                <div class="modal-body">
                <form style="margin-bottom: 20px;" id="edit_brg">
                  <div class="form-group">
                    <label>Kode Barang</label>
                    <input id="kd_brg" class="form-control" type="text" name="kd_brg" >
                  </div>
                  <div class="form-group">
                    <label>Nama Barang</label>
                    <input id="nama_brg" class="form-control"  type="text" name="nama_brg">
                  </div>
                  <div class="form-group">
                    <label>Satuan</label>
                    <input id="satuan" class="form-control" type="text" name="satuan">
                  </div>
                  <div class="form-group">
                    <label>Kategori</label>
                    <input id="kategori" class="form-control"type="text" name="kategori">
                  </div>
                  <div class="form-group">
                    <label>Jumlah</label>
                    <input id="jumlah" class="form-control" type="number" name="jumlah">
                  </div>
                  <div class="form-group">
                    <label>Harga</label>
                    <input id="hrg" class="form-control" type="text" name="hrg">
                  </div>
                  <div class="form-group">
                    <label>Diskon</label>
                    <input id="diskon" class="form-control" type="text" name="diskon">
                  </div>

                </form><br>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Simpan</button>
                <button class="btn btn-primary" id="panggil-m">Batal</button>
              </div>
<?php
  break;
  }
?>

<script>
$(document).ready(function(){
  $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
  });
    $("#example1").DataTable();

    // Tambah Input Barang Kredit
     $('#form_kk').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/pembelian_k/input_data.php',
            data: $('#form_kk').serialize(),
            success: function (data) {
              
              var oTable = $('#barang12').dataTable(); 
              oTable.fnDraw(false);
               $('#form_kk').trigger("reset");
               total();
            
          }
          });

        });
    
    $( "#nama_barang" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       $.ajax({
        url: "modul/pembelian_k/cari.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#kd_brg').val(ui.item.kd_produk);
       $('#nama_barang').val(ui.item.label);
       $('#id_satuan').val(ui.item.id_satuan);
       $('#id_kategori').val(ui.item.id_kategori);
       $('#hrg').val(ui.item.harga_beli);
       $('#harga_jual').val(ui.item.harga_jual);
       return false;
      }
     });
    // Datatable barang Kredit
    $('#barang12').dataTable( {
      "bProcessing": true,
      "bServerSide": true,
      "sAjaxSource": "modul/pembelian_k/data_barangk.php",
      "aoColumnDefs": [{ "bVisible": false, "aTargets": [0] }],
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
          return '<button id="hapus_brgk" data-id="'+data+'" class="btn btn-danger btn-xs"><i class="fa fa-trash"></i> Remove</button>';
          }
        }
      ]
    } );
    // Edit Barang Kredit
     $('body').on('click','#edit_brg', function () {
          $("#modal_pembelian_k").modal("show");

          var kode_b = $(this).closest('tr').find('td').html();

          $("#kd_brg").val(kode_b);
          

          
        });
     // Reset table input barang
     $("#reset_brg").click(function(){
        $.ajax({
          url: 'modul/pembelian_k/reset_brgk.php',
          success:function(){
            alert("Tabel Berhasil Direset");
            var oTable = $('#barang12').dataTable(); 
            oTable.fnDraw(false);
          }
        });
     });
     // Hapus Barang
     $('body').on("click","#hapus_brgk",function(){

          var id_k = $(this).data("id");
          $.ajax({
              type:'POST',
              url: 'modul/pembelian_k/hapus_k.php',
              data:{
                id_k:id_k
              },
              success:function(data){
                if(data=="YES"){
                  alert("Berhasil dihapus");
                  var oTable = $('#barang12').dataTable(); 
                  oTable.fnDraw(false);
                  total();
                }else{
                  alert("Data gagal terhapus");
                }
              }
          });
     });
    // function total
   function total(){
      $.ajax({
        url : "modul/pembelian_k/total.php",
        success: function(data){
          var obj = JSON.parse(data);
          var k = "<b>"+obj.rupiah+"</b>";
          $("#total").html(k);
          $("#tot").val(obj.total);
        }
      })
    }

    // total
    window.onload=total();
});


</script>