
<?php 

$c = mysqli_query($con, "SELECT id,id_pasien,nama_pasien FROM pasien WHERE id_kk = '$_SESSION[klinik]'");
$d = '[';
while($cu = mysqli_fetch_assoc($c)){
    $dt .= '{"nama":"'.$cu['nama_pasien'].' '.$cu['id_pasien'].'","id":"'.$cu['id'].'"},';
}
$dt = substr($dt,0,strlen($dt) - 1);
$d .= $dt.']';

file_put_contents("../redaktur/modul/bonus/cust.json",$d);

$cx = mysqli_query($con, "SELECT kd_produk,nama_produk FROM produk_master WHERE id_kategori != 0");
$dx = '[';
while($cux = mysqli_fetch_assoc($cx)){
    $dtx .= '{"nama":"'.$cux['nama_produk'].'","id":"'.$cux['kd_produk'].'"},';
}
$dtx = substr($dtx,0,strlen($dtx) - 1);
$dx .= $dtx.']';

file_put_contents("../redaktur/modul/bonus/prod.json",$dx);

?>

<section class="content">

    

    <div class="row">

    <div class="col-md-12">

         <div class="callout callout-success">

         <button type="button" class="btn btn-info xbtn" data-toggle="modal" data-target="#modal-default">
               Tambah Bonus
              </button>

         </div>





        </div>

    </div>



     <div class="row">

    <div class="col-md-12">

 <div class="box box-success">

            <div class="box-header">

              <h3 class="box-title">Data Bonus</h3>

            </div>

            <!-- /.box-header -->

            <div class="box-body">

                

              <table id="example1" class="table table-bordered table-striped">

                  <thead>

            <tr>

                 <th>Aksi</th>
                 <th>Pasien</th>
                 <th>Produk</th>
                 <th>Harga</th>
                 <th>Satuan</th>
                 <th>Kategori</th>

                 <th>Jumlah</th>

                 <th>Kehadiran</th>
                 <th>Ket</th>
               
               

            </tr>

        </thead>

      <tbody>

<?php $bn = mysqli_query($con, "SELECT * FROM bonus WHERE username = '$_SESSION[namauser]'");
while($bnx = mysqli_fetch_assoc($bn)){

$h = mysqli_fetch_assoc(mysqli_query($con, "SELECT aksi FROM log WHERE username = '$bnx[username]' AND aksi LIKE '%bonus%' AND tanggal >= '$bnx[tgl]'"));

$j = mysqli_fetch_assoc(mysqli_query($con, "SELECT a.nama_produk,a.harga_jual,b.kategori,c.satuan FROM produk_master a JOIN kategori b ON a.id_kategori = b.id_kategori JOIN data_satuan c ON a.id_satuan = c.id_s WHERE a.kd_produk = '$bnx[produk]'"));

$k = mysqli_fetch_assoc(mysqli_query($con, "SELECT id_pasien,nama_pasien FROM pasien WHERE id = $bnx[pasien]"));

echo "<tr>";

echo "<td>

<span class='btn btn-sm btn-success' id='$bnx[id]' data-toggle='modal' data-target='#modal-default' onclick='edits(this.id)'>Edit</span>

<a href='modul/bonus/aksi.php?act=del&id=$bnx[id]' onclick='return confirm(\"apakah yakin akanmenghapus?\")'><span class='btn btn-sm btn-danger'>Hapus</span></a>

</td>";
echo "<td>$k[nama_pasien] $k[id_pasien]</td>";
echo "<td>$j[nama_produk]</td>";
echo "<td>Rp ".number_format($j['harga_jual'],0,",",".")."</td>";
echo "<td>$j[satuan]</td>";
echo "<td>$j[kategori]</td>";
echo "<td>$bnx[jml]</td>";
echo "<td>$h[aksi]</td>";
echo "<td>$bnx[ket]</td>";
echo "</tr>";

}
?>
    
    </tbody>

                </table>


<style>
.tbl {border-collapse: collapse; width: 100%}
.tbl td {padding: 1%}
</style>

     </div></div></div></div>

     <div class="modal fade" id="modal-default">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Bonus</h4>
                <span id="msg"></span>
              </div>
              <div class="modal-body">
<form id="users" method="POST">
    <table class="tbl">

    <tr>
    <td>Nama Pasien</td>
    <td><input type="text" id="acs" class="form-control" placeholder=""/>
    <input type="hidden" id="cus" name="cus" /><small>ketik nama pasien untuk menambah</small>
    </td>
    </tr>

    <tr>
    <td>Nama Produk</td>
    <td><input type="text" id="prod" class="form-control" placeholder=""/>
    <input type="hidden" id="prd" name="prd"/><small>ketik nama produk untuk menambah. hanya produk yang kategori dan satuan tidak kosong muncul di sini</small></td>
    </tr>

    <tr>
    <td>Jumlah</td>
    <td><input type="text" id="jml" name="jml" class="form-control" /></td>
    </tr>

    <tr>
    <td>Keterangan</td>
    <td><input type="text" id="ket" name="ket" class="form-control" /></td>
    </tr>

    <input type="hidden" id="tgl" name="tgl" value="<?php echo date("Y-m-d H:i:s"); ?>" />
    <input type="hidden" id="klinik" name="klinik" value="<?php echo $_SESSION['klinik']; ?>" />
    <input type="hidden" id="id_bns"  name="id_bns"/>
    <input type="hidden" id="username" name="username" value="<?php echo $_SESSION['namauser']; ?>"  />
    </table>



              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Tutup</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->


</section>

<link rel="stylesheet" href="<?php echo $url2; ?>bower_components/typeahead.css">
<script src="<?php echo $url2; ?>bower_components/typeahead.bundle.min.js"></script>


<!-- DataTables -->

  <link rel="stylesheet" href="<?php echo $url2; ?>bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css">

<!-- DataTables -->

<script src="<?php echo $url2; ?>bower_components/datatables.net/js/jquery.dataTables.min.js"></script>

<script src="<?php echo $url2; ?>bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js"></script>

<script>

function edits(id){
    $("#id_bns").val(id);
    $("#users").attr("action","<?php echo $url2."modul/bonus/aksi.php?act=edit"; ?>");
    var k = $.ajax({

        url: "modul/bonus/ajax.php",
        data: { "id" : id },
        dataType: "JSON",
        success: function(data){
            $("#acs").val(data.acs);
            $("#cus").val(data.cus);
            $("#prod").val(data.prod);
            $("#prd").val(data.prd);
            $("#jml").val(data.jml);
            $("#ket").val(data.ket);
            $("#tgl").val(data.tgl);
            $("#klinik").val(data.klinik);
            $("#username").val(data.username);
            $("#msg").html("");
        }

    });

    if(k.readyState == '1'){
        $("#msg").html("<small>memuat data...</small>");
    }
}


$(document).ready(function(){
    $("#example1").dataTable();

$(".xbtn").click(function(){
    $("#users").attr("action","<?php echo $url2."modul/bonus/aksi.php?act=add"; ?>");
    $("#users")[0].reset();
});

 //typeahead
        
 var namaCus = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/bonus/cust.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


$('#acs').typeahead({
    hint: true,
  highlight: true,
minLength: 3
}, {
  name: 'nama-cus',
  display: 'nama',
  source: namaCus
} );
        


        $('#acs').bind('typeahead:select', function(ev, suggestion) {   
                $("#cus").val(suggestion.id); 
               });


                      
 var namaProd = new Bloodhound({
  datumTokenizer: Bloodhound.tokenizers.obj.whitespace('nama'),
  queryTokenizer: Bloodhound.tokenizers.whitespace,
  prefetch: {
    url: '../redaktur/modul/bonus/prod.json?v=<?php echo rand(100,900); ?>'
  },
  cache: false
  
});


$('#prod').typeahead({
    hint: true,
  highlight: true,
minLength: 3
}, {
  name: 'nama-prod',
  display: 'nama',
  source: namaProd
} );
        


        $('#prod').bind('typeahead:select', function(ev, suggestion) {   
                $("#prd").val(suggestion.id); 
               });

//typeahead

});
</script>