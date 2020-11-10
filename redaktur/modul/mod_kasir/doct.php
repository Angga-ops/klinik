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
$c = mysql_query("SELECT * FROM dr_pengganti WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam > '$jam_1' AND jam < '$jam_2'");
$k = mysql_query("SELECT * FROM dr_praktek WHERE id_poli = $_GET[poli] AND hari = $_GET[hari] AND jam > '$jam_1' AND jam < '$jam_2' AND expired >= '$last' AND expired <= '$now'");

$cd = mysql_num_rows($c);
$kd = mysql_num_rows($k);

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

		while($kdd = mysql_fetch_assoc($k)){

			$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $kdd[id_dr]"));

			echo "<option value='$kdd[id_dr]'>$dr[nama_lengkap]</option>";	
			
		}

		while($cdd = mysql_fetch_assoc($c)){

			$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $cdd[id_dr]"));

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

		while($kdd = mysql_fetch_assoc($k)){

			$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $kdd[id_dr]"));

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

		while($cdd = mysql_fetch_assoc($c)){

			$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = $cdd[id_dr]"));

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