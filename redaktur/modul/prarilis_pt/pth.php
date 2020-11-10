<?php 

setlocale(LC_TIME,"IND");
setlocale(LC_TIME,"id_ID");

?>
<section class="content">
	<div class="box box-success">
		<div class="box-header">
			<h3 class="box-title">Pasca Treatment Prarilis</h3>
		</div>
		<div class="box-body">
			<h4>History Pasca Treatment Pasien Prarilis</h4>
			<div class="table-responsive">
				<table class="table-striped table table-bordered datatable">
					<thead>
						<tr>
							<th>Tanggal</th>
							<th>Pasien</th>
							<th>Subjek</th>
							<th>Objek</th>
							<th>Assestment</th>
							<th>Dokter</th>
							<th>Produk</th>
							<th>Treatment</th>
							<th>Foto</th>
						</tr>
					</thead>
					<tbody>
					<?php $k = mysql_query("SELECT * FROM pasca_treatment WHERE id_pasien = '$_GET[pasien]' ORDER BY tanggal DESC");
					while($ki = mysql_fetch_assoc($k)){

$pas = mysql_fetch_assoc(mysql_query("SELECT nama_pasien FROM pasien WHERE id_pasien = '$ki[id_pasien]'"));
$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = '$ki[id_dr]'"));

						 $q1 = mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$ki[no_faktur]' AND jenis='Produk'"); 
								$cekp = mysql_num_rows($q1);
								if ($cekp>0) {
									$prod = "| ";
									while ($p=mysql_fetch_array($q1)) {
										$prod .= $p['nama'];
										$prod .= " | ";
									}
								}else{
									$prod = "Tidak Ada Produk ";
								}
								 $q2 = mysql_query("SELECT *FROM history_kasir WHERE no_faktur='$ki[no_faktur]' AND jenis='Treatment'"); 
								$cekt = mysql_num_rows($q2);
								if ($cekt>0) {
									$treat = "| ";
									while ($t=mysql_fetch_array($q2)) {
										$treat .= $t['nama'];
										$treat .= " | ";
									}
								}else{
									$treat = "Tidak Ada Treatment";
								}
									

						echo "<tr>";
						echo "<td>".strftime("%d %B %Y",strtotime($ki[tanggal]))."</td>";
						echo "<td>$pas[nama_pasien]</td>";
						echo "<td>$ki[subjek]</td>";
						echo "<td>$ki[objek]</td>";
						echo "<td>$ki[assestment]</td>";
						echo "<td>$dr[nama_lengkap]</td>";
						echo "<td>$prod</td>";
						echo "<td>$treat</td>";
						echo "<td>";
						if ($ki['foto1']!=null) {
							?><img width="200" src="../file_user/foto_pasien/<?php echo $ki['foto1']; ?>"><?php
						}else if($ki['foto2']!=null){
							?><img width="200" src="../file_user/foto_pasien/<?php echo $ki['foto2']; ?>"><?php
						}else if ($ki['foto3']!=null){
							?><img width="200" src="../file_user/foto_pasien/<?php echo $ki['foto3']; ?>"><?php
						}else if($ki['foto4']!=null){
							?><img width="200" src="../file_user/foto_pasien/<?php echo $ki['foto4']; ?>"><?php
						}
						echo "</td>";
						echo "</tr>";
					}

					?>
											</tbody>
				</table>
				</div>
				</div>
				</div>
				</section>