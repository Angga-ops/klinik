      $( ".datepicker" ).datepicker({
        dateFormat:'yy-mm-dd'
      });
      
      var nou = $("#nou").val();

    // Auto complete pencarian perawatan
    $( "#nama_t" ).autocomplete({
      source: function( request, response ) {
       // Fetch data
       var id = $(".id_pasien").val();
       $.ajax({
        url: "modul/mod_kasir/source.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,id:id,nofak:"<?php echo $_GET[nofak]; ?>"
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#nama_t').val(ui.item.label); // display the selected text
       $('#harga').val(ui.item.harga); // save selected id to input
      $('#jasa').val(ui.item.status);
       if (ui.item.edit=="Yes") {
          $("#harga").attr({
                "readonly" : false     
             });
       }
       return false;
      }
     });
    // Auto Complete pencarian produk
    $( "#nama_p" ).autocomplete({
      source: function( request, response ) {
        var id = $(".id_pasien").val();
       // Fetch data
       $.ajax({
        url: "modul/mod_kasir/source_produk.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,id:id,nofak:"<?php echo $_GET[nofak]; ?>"
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#nama_p').val(ui.item.label); // display the selected text
       $('#harga_p').val(ui.item.harga); // save selected id to input
       $('#kode_p').val(ui.item.kode);
       $('#harga_b').val(ui.item.harga_b);
    //   $('#diskon_p').val(ui.item.diskon);
       $("#jumlah_p").attr({
                "max" : ui.item.limit     
             });
       return false;
      }
     });
     // Auto Complete pencarian produk apotek
    $( "#nama_p_apotek" ).autocomplete({
      source: function( request, response ) {
        var id = "<?php echo $_GET["id_antrian"]; ?>";
       // Fetch data
       $.ajax({
        url: "modul/mod_kasir_apotek/source_produk.php",
        type: 'post',
        dataType: "json",
        data: {
         search: request.term,id:id
        },
        success: function( data ) {
         response( data );
        }
       });
      },
      select: function (event, ui) {
       // Set selection
       $('#nama_p_apotek').val(ui.item.label); // display the selected text
       $('#harga_p').val(ui.item.harga); // save selected id to input
       $('#kode_p').val(ui.item.kode);
       $('#harga_b').val(ui.item.harga_b);
    //   $('#diskon_p').val(ui.item.diskon);
       $("#jumlah_p").attr({
                "max" : ui.item.limit     
             });
       return false;
      }
     });
    // Tambah Pasien Baru
    $("#form_pp").on('submit',function(e){
      e.preventDefault();
      $.ajax({
        type :"post",
        url: 'modul/mod_kasir/tambah_pasien.php',
        data : $('#form_pp').serialize(),
        success:function(data){
          if (data=="sudah") {
            alert("Data Reka Medis Sudah Ada!!");
          }else{
            alert("Berhasil Menambah Data Pasien");
            window.location.href = "media.php?module=kasir";
          } 
          
        }
      });
    });
     // Tambah Pasien ke antrian
     $('#form_k').on('submit', function (e) {

          e.preventDefault();

          $.ajax({  
            type: 'post',
            url: 'modul/mod_kasir/tambah_k.php',
            data: $('#form_k').serialize(),
            success: function (data) {
              if (data=="Yes") {
                alert("Berhasil menambahkan pasien ke dalam antrian");
                window.location.href = "media.php?module=home";
              }else if(data=="Ok"){
                alert("Berhasil menambahkan pasien ke dalam antrian pembelian produk");
                window.location.href = "media.php?module=home";
              }else if(data=="No"){
                alert("Tidak ada perawatan atau Produk yang dipilih!\nSilahkan pilih produk atau perawatan terlebih dahulu!!");
              }else if(data=="D"){
                alert("Silahkan Pilih Dokter Terlebih Dahulu!!");
              }else if(data=="nama"){
                alert("Silahkan Masukan Nama Pasien Terlebih Dahulu!!");
              }else if(data=="pasien"){
                alert("Nama Pasien Belum Terdaftar! Silahkan Daftarkan Pasien Terlebih Dahulu");
              }
            }
          });

        });
     
     
     // Cari berdasarkan tanggal pada tabel history transaksi resepsionis
     $('#cari_h').click(function(){
          var tgl = $("#tanggal_h").val();
          var pl = "1";
          window.location.href = "media.php?module=history_transaksi&pl="+pl+"&tgl="+tgl+"";

     });
     // Cari berdasarkan tanggal pada tabel history perawtan dokter
     $('#cari_hp').click(function(){
          var tgl = $("#tanggal_hp").val();
          window.location.href = "media.php?module=history_p&tgl="+tgl+"";

     });
     // form bayar di history transaksi
     $('#form_bayar').on('submit', function (e) {

          e.preventDefault();

          $.ajax({
            type: 'post',
            url: 'modul/history_transaksi/bayar.php',
            data: $('#form_bayar').serialize(),
            success: function (data) {
              if (data=="Kurang") {
                alert("Uang yang dimasukkan kurang");
              }else{
                  //alert("Pembayaran Lunas");
                 window.open("modul/mod_kasir/print_kasir.php?nofak=<?php echo $_GET[nofak]; ?>");
                 window.location.href = "media.php?module=history_transaksi";
              }
              
            }
          });

        });
// Datatable
$(".datatable").dataTable({
  ordering:  false
});
$(".datatable2").dataTable({
  ordering:  false
});

// Collapse

$('#form_k').on('show.bs.collapse', function () {
  /*
  var awal = $('#awal').val();
  $('#form_pp').collapse('hide');
  if (awal=="konsultasi") {
    $("#pl").removeClass("active");
    $("#pb").addClass("active");
  }else{
    $("#pb").removeClass("active");
    $("#pl").addClass("active");
  }
  */
});

// Collapse treatment atau produk
$("#tataup").change(function(){
  var select = $(this).val();
  if(select=="produk"){
    $('#form_p').collapse('hide');
    $('#form_produk').collapse('show');
  }else{
    $('#form_produk').collapse('hide');
    $('#form_p').collapse('show');
  }
});

$("#konsultasi").click(function(){
  $('#awal').val("konsultasi");
  $("#pl").removeClass("active");
  $("#pk").removeClass("active");
  
  $("#pj").removeClass("active");
  $("#pb").addClass("active");
  if($("#cek_tampil").val() == "Sudah"){
    $('#pilih_dok').collapse('show');
    $('#tap').collapse('hide');
    $('#labs').collapse('hide');
    
    $('#mondok').collapse('hide');
  }
 

});
$("#bpt").click(function(){
  $('#awal').val("bpt");
  if($("#cek_tampil").val() == "Sudah"){
  $('#pilih_dok').collapse('hide');
  $('#tap').collapse('show');
  $('#labs').collapse('hide');
  
  $('#mondok').collapse('hide');
  }
  $("#pb").removeClass("active");
  $("#pk").removeClass("active");
  
  $("#pj").removeClass("active");
  $("#pl").addClass("active");
});
$("#lab").click(function(){
  $('#awal').val("lab");
  if($("#cek_tampil").val() == "Sudah"){
  $('#pilih_dok').collapse('hide');
  $('#tap').collapse('hide');
  
  $('#mondok').collapse('hide');
  $('#labs').collapse('show');
  }
  $("#pb").removeClass("active");
  $("#pl").removeClass("active");
  
  $("#pj").removeClass("active");
  $("#pk").addClass("active");

});
$("#inap").click(function(){
  $('#awal').val("inap");
  if($("#cek_tampil").val() == "Sudah"){
  $('#pilih_dok').collapse('hide');
  $('#tap').collapse('hide');
  $('#labs').collapse('hide');
  $('#mondok').collapse('show');
  }
  $("#pb").removeClass("active");
  $("#pl").removeClass("active");
  $("#pk").removeClass("active");
  $("#pj").addClass("active");

});

$( "#tgl_ks").datepicker({
  dateFormat: "yy-mm-dd",
  defaultDate: "-30y",
  changeYear: true,
  changeMonth: true

});

function show(){
  $(' #form_tam').collapse('show');
  $("#pb").addClass("active");
  
}
    
window.onload=show();