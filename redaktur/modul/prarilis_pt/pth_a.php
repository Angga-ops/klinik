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
			<h4>History Pasca Treatment Pasien Prarilis (klik nama pasien untuk melihat detailnya)</h4>
			<div class="table-responsive">
				<table class="table-striped table table-bordered datatable">
					<thead>
						<tr>
                        <th>Tanggal</th>
							<th>Pasien</th>
                            <th>Id Pasien</th>
							<th>Subjek</th>
							<th>Objek</th>
							<th>Assestment</th>
							<th>Dokter</th>
							<th>Foto</th>
						</tr>
					</thead>
					<tbody>
					<?php $k = mysql_query("SELECT * FROM pasca_treatment GROUP BY id_pasien ORDER BY tanggal DESC");
					while($ki = mysql_fetch_assoc($k)){

$pas = mysql_fetch_assoc(mysql_query("SELECT nama_pasien FROM pasien WHERE id_pasien = '$ki[id_pasien]'"));
$dr = mysql_fetch_assoc(mysql_query("SELECT nama_lengkap FROM user WHERE id_user = '$ki[id_dr]'"));

															

						echo "<tr>";
						echo "<td>".strftime("%d %B %Y",strtotime($ki[tanggal]))."</td>";
                        echo "<td><a href='media.php?module=pth&pasien=$ki[id_pasien]'>$pas[nama_pasien]</a></td>";
                        echo "<td>$ki[id_pasien]</td>";
						echo "<td>$ki[subjek]</td>";
						echo "<td>$ki[objek]</td>";
						echo "<td>$ki[assestment]</td>";
						echo "<td>$dr[nama_lengkap]</td>";
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