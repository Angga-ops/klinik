<?php
session_start();
 if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])){
  echo "<link href='style.css' rel='stylesheet' type='text/css'>
 <center>Untuk mengakses modul, Anda harus login <br>";
  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
}
else{
//$aksi="modul/mod_agenda/aksi_agenda.php";

$tujuh_hari        = mktime(0,0,0,date("n"),date("j")+1,date("Y"));
$kembali        = date("Y-m-d H:i:s", $tujuh_hari);
function setkodehari($ymd){
	$h = array("Sunday" => 1,"Monday" => 2,"Tuesday" => 3,"Wednesday" => 4,"Thursday" => 5,"Friday" => 6,"Saturday" => 7);
	foreach($h as $k => $v){
		$dt = date("l",$ymd);
		if($dt == $k){
			return $v;
			break;
		}
	}
}


$filter = ($_POST["status"] == "day")? "AND JWDOKTER.KODEHARI = ".$_POST["opsi"] : "AND JWDOKTER.KODEHARI = ".setkodehari($tujuh_hari);

$filter2 = ($_POST["status"] == "poli")? "AND JWDOKTER.KODEBAGIAN = ".$_POST["opsi"] : "" ;

$filter3 = ($_POST["status"] == "dokter")? "AND JWDOKTER.KODEDOKTER = '".$_POST["opsi"]."'" : "" ;
switch($_GET[act]){
  // Tampil Agenda
  default:

	

        echo"<div class='row'>
			<div class='col-sm-12'>
			<ol class='breadcrumb bc-3'>
				<li>
				<a href='?module=home'><i class='entypo-home'></i>Halaman Utama</a>
				</li>
				<li class='active'>
			
							<strong>Jadwal Dokter</strong>
				</li>
			</ol>";

echo '<div class="well"><form action="" method="post">
   <fieldset>
   <legend>CARI BERDASARKAN</legend>
  <table>
  <tr>
  <td> <input type="radio" name="opts" value="day"  class="selector" ></td><td>HARI KERJA</td><td width=8px>  </td><td> <input type="radio" name="opts" class="selector" value="poli" >
  </td>
  <td>PER POLIKLINIK</td><td width=8px> </td>
  <td>  <input type="radio" name="opts"  class="selector" value="dokter"></td>
  <td>PER DOKTER</td><td width=8px>  </td> 
  <td  id="changer"><select class="form-control">
  </select></td></tr></table>
  <input type="hidden" name="status" id="status" />
   
   
   </fieldset>
</form></div>';

			echo "
				<div class='panel panel-primary'>
			<div class='panel-heading'>
						<div class='panel-title'>Jadwal Dokter</div>
						<div class='panel-options'>
							
							<a href='?module=agenda' ><i class='entypo-arrows-ccw'></i></a>
						</div>
					</div>";
          echo"<table class='table table-bordered table-responsive' id='mytable'>
          <thead><tr align='center'><th>No</th><th>Nama POLI</th><th>DOKTER</th>
		  <th>Waktu</th>
		  <th>Hari</th></tr></thead><tbody>";



    if ($_SESSION[leveluser]=='admin'){
      //$tampil=mysql_query("SELECT * FROM agenda ORDER BY id_agenda DESC");
    }
    else{
      $sql = " SELECT * FROM dr_praktek a JOIN user b ON a.id_dr = b.id_user JOIN poliklinik c ON a.id_poli = c.id_poli";
        switch($_POST["status"]){
            case "day": $sql .= " WHERE a.hari = '$_POST[opsi]'"; break;
            case "poli": $sql .= " WHERE a.id_poli = '$_POST[opsi]'"; break;
            case "dokter": $sql .= " WHERE a.id_dr = '$_POST[opsi]'"; break;
}
	}
	

    $tampil=mysql_query($sql);

    $no = 1;
    while ($r=mysql_fetch_array($tampil)){ 
		switch($r[hari]){
			case "0": $hari = "Minggu"; break;
			case  "1": $hari = "Senin"; break;
			case  "2": $hari = "Selasa"; break;
			case  "3": $hari = "Rabu"; break;
			case  "4": $hari = "Kamis"; break;
			case  "5": $hari = "Jumat"; break;
			case  "6": $hari = "Sabtu"; break;

			 
		}
      echo "<tr><td>$no</td>
                <td width=40%>$r[poli]</td>
                <td>$r[nama_lengkap]</td>
				<td>$r[jam]</td>
				<td>$hari </td>
				
				</tr>";
      $no++;
    }
    echo "</tbody></table></div></div></div>";?>
    
    <script>
        $(document).ready(function(){
            
            $(".selector").click(function(){
                
                
                
                var html = "";
                switch($(this).val()){
                    case "day": 
                        html = "<select class='form-control' onchange='submit()' name='opsi'><option value=''>--pilih--</option>";
                        html += "<option value='1'>Senin</option>";
                        html += "<option value='2'>Selasa</option>";
                        html += "<option value='3'>Rabu</option>";
                        html += "<option value='4'>Kamis</option>";
                        html += "<option value='5'>Jumat</option>";
                        html += "<option value='6'>Sabtu</option>";
                        html += "<option value='0'>Minggu</option>";
                        html += "</select>";
                        $("#status").val("day");
                        break;
                    case "dokter": 
                         html = "<select class='form-control' onchange='submit()' name='opsi'><option value=''>--pilih--</option>";
                        <?php 
                        
                        $po = mysql_query("SELECT * FROM user WHERE id_ju = 'JU-02'");
                        while($li = mysql_fetch_assoc($po)){
                            ?> 
                            html += "<option value='<?php echo $li[id_user]; ?>'><?php echo $li[nama_lengkap]; ?></option>";
                            <?php
                        }
                        
                        ?>
                        html += "</select>";
                        $("#status").val("dokter");
                        break;
                    case "poli": 
                        html = "<select class='form-control' onchange='submit()' name='opsi'><option value=''>--pilih--</option>";
                        <?php 
                        
                        $po = mysql_query("SELECT * FROM poliklinik ");
                        while($li = mysql_fetch_assoc($po)){
                            ?> 
                            html += "<option value='<?php echo $li[id_poli]; ?>'><?php echo $li[poli]; ?></option>";
                            <?php
                        }
                        
                        ?>
                        html += "</select>";
                        $("#status").val("poli");
                        break;
                }
                
                
                $("#changer").html(html);
            });
            
            
        });
    </script>
    
    <?php
    break;

}
}
?>
