<div id="main-content">
    <div class="container_12">
        <div class="grid_12">
			<div class='block-border'>
	            <div class="block-header">
                    <h1>CEK LABA RUGI</h1>
				</div>
    <div class='block-content'>
    <br />
	<div style="margin-left:1%; margin-right:1%;">
<form method="post" enctype="multipart/form-data" target="_blank" action="report/rpt_keuangan.php">
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
        <tr>
          <td height="35" colspan="5"><div style="background:#23333E; text-align:center; height:20px; font-family:'Verdana'; font-size:15px; color:#FFFFFF;">Cek Laba Rugi</div></td>
        </tr>
        <?php
			$idpr		= $_GET['id'];
			$sel_pr		= mysql_fetch_array(mysql_query("Select id_antrian, rontgen, hasil, diskon_ron, keterangan, tgl_rontgen From uji_rontgen, pemeriksaan_rontgen Where uji_rontgen.id_rontgen=pemeriksaan_rontgen.id_rontgen And id_prontgen='$idpr'"));
			$ida		= $sel_pr['id_antrian'];
		?>
    	<tr>
    	  <td>&nbsp;</td>
        	<td height="35"><div align="center">Tanggal Awal</div></td>
        	<td><div align="center"></div></td>
        	<td><div align="center">Tanggal Akhir</div></td>
        	<td>&nbsp;</td>
        </tr>
    	<tr>
    	  <td>&nbsp;</td>
       		<td height="35"><div align="center">
       		  <input type="text" name="tgl_awal" size="25" style="text-align:center;" id="tgl1" required/>
     		  </div></td>
        	<td><div align="center">=</div></td>
        	<td><div align="center">
        	  <input type="text" name="tgl_akhir" size="25" style="text-align:center;" id="tgl2" required="required"/>
      	  </div></td>
        	<td>&nbsp;</td>
        </tr>
        <?php
			$sel_pas	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$ida'"));
			$pas		= $sel_pas["id_pasien"];
			$sel_pas	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$pas'"));
			$rwyt_pas	= $sel_pas["riwayat_penyakit"];
			$rwyt_obt	= $sel_pas["alergi_obat"];
			$nm_pas		= $sel_pas["nama_pasien"];
			?>
    </table>
	</div>    
<br />    
    <div class="block-actions">
        <ul class="actions-left">
            <li>
             <input type="submit" name="upload" class="button" value="Lihat" />
            </li> 
        </ul>
	</div>
</form>
				</div>
			</div>
        </div>
    </div>
</div>
   <script src="js/libs/jquery-1.10.2.min.js"></script>
   <script src="js/libs/jquery-ui-1.9.2.custom.min.js"></script>
   <script src="js/jquery.ui.core.js"></script>
   <script src="js/jquery.ui.datepicker.js"></script>
   <script src="js/ui.datepicker-id.js"></script>
   <script type="text/javascript">
   $(document).ready(function() {
     //Tanggal Awal
	 $("#tgl1").datepicker({
       altFormat : "yy MM dd",
       changeMonth : true,
       changeYear : true
     });
     $("#tgl1").change(function() {
       $("#tgl1").datepicker( "option", "dateFormat", "yy-mm-dd" );
     });
	 //Tanggal Akhir
     $("#tgl2").datepicker({
       altFormat : "yy MM dd",
       changeMonth : true,
       changeYear : true
     });
     $("#tgl2").change(function() {
       $("#tgl2").datepicker( "option", "dateFormat", "yy-mm-dd" );
     });
   });
   </script>