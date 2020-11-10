<style>
.hidden {display: none}
.flt tbody tr td {border: none !important}
</style>
<section class="content-header"> 
<h1>
  Rekap Broadcast Message
</h1>
<ol class="breadcrumb">
  <li><a href="?module=home"><i class="fa fa-dashboard"></i> Home</a></li>
  <li class="active">Rekap Broadcast Message</li>
</ol>
</section>

<section class="content">

<div class="row">
<div class="col-md-12">
<div class="box box-primary">
<div class="box-header">
<strong>Silakan pilih jenis data broadcast lalu klik tombol "Ekspor Excel" </strong></div>
</div>
</div>
</div>

<div class="row">
<div class="col-md-12">
<div class="box box-primary"><div class="box-body">
<table class="table flt" style="border: none">
<tr>
<td style="width: 25%">Broadcast Message</td>
<td>
<select class="form-control" id="flt">
<option value="">--pilih filter--</option>
<option value="1">Jml Perawatan</option>
<option value="2">Pekerjaan</option>
<option value="3">Nominal</option>
<option value="4">Kelas</option>
</select>
</td>
</table>
<button class="btn btn-warning" id="kiss" disabled="disabled">Ekspor Excel</button>
</div></div>
</div>
</div>

</section>
 <script>
 	$(document).ready(function(){
        $("#flt").change(function(){
            $("#kiss").attr("disabled",false);
        });
        $("#kiss").click(function(){
            window.open("modul/broadcast_new/xls.php?flt=" + $("#flt").val(),"_BLANK");
        });
     });

 </script>