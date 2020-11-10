     <script>
     function nl(id){
         $("#fakturonline2").val($("#" + id).data("faktur"));
         $("#pasienonline2").val($("#" + id).data("pasien"));
         $("#dokteronline").val($("#" + id).data("dr"));
         $("#temp").val($("#" + id).data("jamin"));

      var jamin = $("#" + id).data("jamin");
      $("#dt").html("");
        $("#tarif").html("<option value=''>--pilih--</option>");
       $.ajax({
        url: "modul/mod_home/ajax_nl.php?jamin=" + jamin,
        success: function(data){
            $("#tarif").append(data);
            $("#wait").html("");
        }
        });
     }


     function likethis(id){
         var r = Math.ceil(Math.random() * 1000);
         var h = $("#" + id + " :selected").text();
         var i = $("#" + id).val();
         //var k = $("#nl").data("jamin");
         var k = $("#temp").val();
         //var k = $("#" + id).data("jamin");
         var j = "<div class='col-md-12' style='margin-bottom: 1%; padding-left: 10px' id='" + r + "'><div class='col-md-2' style='cursor: pointer' onclick='removethis(" + r + ")'><span class='fa-stack'><i class='fa fa-close fa-stack-1x text-danger'></i><i class='fa fa-circle-o fa-stack-2x text-danger'></i></span></div><div class='col-md-6' style='padding-top: 1%'>" + h + "</div><input type='hidden' name='tarif[]' value='" + i + "'/><input type='hidden' name='jamin[]' value='" + k + "'/></div>";
         $("#dt").append(j);
         $("#" + id).val("");
     }

     function removethis(id){
        $("#" + id).remove();
     }
     </script>
     
      <div class="modal fade" id="modal-default-notice">
          <div class="modal-dialog">
            <div class="modal-content">
              <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title">Buat Notice Lab</h4>
              </div><form action="modul/mod_home/noticelab.php" method="POST">
              <div class="modal-body">
                <table class="table">
                <input type="hidden" name="notice" id="inap" />
                <tr>
                <td>No Faktur</td><td><input type="text" class="form-control" name="nofak" id="fakturonline2" readonly/></td>
                <input type="hidden" id="temp">
                </tr>
                <tr>
                <td>Pasien</td><td><input type="text" class="form-control" name="id" id="pasienonline2" readonly/></td>
                </tr>
                <tr>
                <td>Dokter</td><td><input type="text" class="form-control" name="dr" id="dokteronline" readonly/></td>
                </tr>
                <tr>
                <td>Jenis Pemeriksaan Lab</td><td>
                <div id="wait"><i class="fa fa-spinner fa-1x fa-pulse fa-fw"></i> memuat data...</div>
                <select class="form-control" id="tarif" onchange="likethis(this.id)">
                </select>
                </td>
                </tr>
                </table>
                <div id="dt" class="row input-group">
                </div>
              </div>
              <div class="modal-footer">
                <button type="button" class="btn btn-default pull-left" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary">Simpan</button>
                </form>
              </div>
            </div>
            <!-- /.modal-content -->
          </div>
          <!-- /.modal-dialog -->
        </div>
        <!-- /.modal -->