<?php 

include "../../../config/koneksi.php";

?>

<label>Dokter</label>
<?php 
$jam = date("H").":00:00";
$c = mysqli_query($con,"SELECT * FROM dr_pengganti WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam >= '$jam'");
$k = mysqli_query($con,"SELECT * FROM dr_praktek WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam >= '$jam'");

if(mysqli_num_rows($c) > 0){

	$disabled = (mysqli_num_rows($c) == 0)? "disabled" : "";
?>
										<select class="form-control" name="dokter" style="width: 93%;" <?php echo $disabled; ?>>
											<option value="belum">Silahkan pilih dokter ..</option>
										

<?php

while($ko = mysqli_fetch_assoc($c)){
   
    $dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

  
}

?>

</select>

<?php

} else {

	$disabled = (mysqli_num_rows($k) == 0)? "disabled" : "";
?>
										<select class="form-control" name="dokter" style="width: 93%;" <?php echo $disabled; ?>>
											<option value="belum">Silahkan pilih dokter ..</option>
										

<?php

while($ko = mysqli_fetch_assoc($k)){
   
    $dr = mysqli_fetch_assoc(mysqli_query($con,"SELECT nama_lengkap FROM user WHERE id_user = $ko[id_dr]"));

echo "<option value='$ko[id_dr]'>$dr[nama_lengkap]</option>";

  
}

?>

</select> <?php

}



?>