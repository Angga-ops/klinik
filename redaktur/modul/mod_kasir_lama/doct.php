<?php 

include "../../../config/koneksi.php";

?>

<label>Dokter</label>
<?php 
$jam = date("H").":00:00";
$c = mysql_query("SELECT * FROM dr_pengganti WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam >= '$jam'");
$k = mysql_query("SELECT * FROM dr_praktek WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam >= '$jam'");

if(mysql_num_rows($c) > 0){

	$disabled = (mysql_num_rows($c) == 0)? "disabled" : "";
?>
										<select class="form-control" name="dokter" style="width: 93%;" <?php echo $disabled; ?>>
											<option value="belum">Silahkan pilih dokter ..</option>
										

<?php

while($ko = mysql_fetch_assoc($c)){
   
    $dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

  
}

?>

</select>

<?php

} else {

	$disabled = (mysql_num_rows($k) == 0)? "disabled" : "";
?>
										<select class="form-control" name="dokter" style="width: 93%;" <?php echo $disabled; ?>>
											<option value="belum">Silahkan pilih dokter ..</option>
										

<?php

while($ko = mysql_fetch_assoc($k)){
   
    $dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

  
}

?>

</select> <?php

}



?>