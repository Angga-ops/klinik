<?php 

include "../../../config/koneksi.php";

?>

<label>Dokter</label>
<?php 

 //cari range expired
 $skrg = date("d");
 if($skrg <= 24){
 $now = date("Y-m-24");
 $last = date("Y-m",strtotime("-1 month"))."-25";
 } else {
	$last = date("Y-m-25");
	$now = date("Y-m",strtotime("+1 month"))."-24";
 }
 

$jam_1 = date("H",strtotime("-4 hour")).":00:00";
$jam_2 = date("H",strtotime("+4 hour")).":00:00";
$c = mysqli_query($con, "SELECT * FROM dr_pengganti WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam > '$jam_1' AND jam < '$jam_2'");
$k = mysqli_query($con, "SELECT * FROM dr_praktek WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam > '$jam_1' AND jam < '$jam_2' AND expired >= '$last' AND expired <= '$now'");

$cd = mysqli_num_rows($c);
$kd = mysqli_num_rows($k);

/*

kl $kd > 0
-> kl $cd > 0 tampilkan sekalian

kl $kd == 0
-> tampilkan $cd

*/

if($kd > 0){

	if($cd > 0){

		?> 
		
		<select class="form-control" name="dokter" style="width: 93%;">
											<option value="belum">Silahkan pilih dokter ..</option>
		
		<?php

		while($kdd = mysqli_fetch_assoc($k)){

			$dr = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = $kdd[id_dr]"));

			echo "<option value='$kdd[id_dr]'>$dr[nama_lengkap]</option>";	
			
		}

		while($cdd = mysqli_fetch_assoc($c)){

			$dr = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = $cdd[id_dr]"));

			echo "<option value='$cdd[id_dr]'>$dr[nama_lengkap] (pengganti)</option>";	

		}

		?> 
		</select>
		<?php

	} else {

		?> 
		
		<select class="form-control" name="dokter" style="width: 93%;" >
											<option value="belum">Silahkan pilih dokter ..</option>
		
		<?php

		while($kdd = mysqli_fetch_assoc($k)){

			$dr = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = $kdd[id_dr]"));

			echo "<option value='$kdd[id_dr]'>$dr[nama_lengkap]</option>";	
			
		}

		?> 
		</select>
		<?php

	}

} else if($cd > 0){

	?> 
		
		<select class="form-control" name="dokter" style="width: 93%;">
											<option value="belum">Silahkan pilih dokter ..</option>
		
		<?php

		while($cdd = mysqli_fetch_assoc($c)){

			$dr = mysqli_fetch_assoc(mysqli_query($con, "SELECT nama_lengkap FROM user WHERE id_user = $cdd[id_dr]"));

			echo "<option value='$cdd[id_dr]'>$dr[nama_lengkap]  (pengganti)</option>";	

		}

		?> 
		</select>
		<?php

} else {
?> 

<select class="form-control" name="dokter" style="width: 93%;" disabled>
											<option value="belum">Silahkan pilih dokter ..</option>
</select>

<?php } ?>