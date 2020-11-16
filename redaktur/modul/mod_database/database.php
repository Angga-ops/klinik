<?php
	session_start();
	if (empty($_SESSION['username']) AND empty($_SESSION['passuser'])) {
	  echo "<link href='style.css' rel='stylesheet' type='text/css'>
	 <center>Untuk mengakses modul, Anda harus login <br>";
	  echo "<a href=../../index.php><b>LOGIN</b></a></center>";
	} else {

		include "../../../config/koneksi.php";
		include "../mod_log/aksi_log.php";
		$module=$_GET['module'];

		function backup_tables($tables = '*') {
			global $con;
			if ($tables == '*') {
				$tables = array();
				$result = mysqli_query($con, 'SHOW TABLES');
				while ($row = mysqli_fetch_row($result)) {
					$tables[] = $row[0];
				}
			}
			else {
				$tables = is_array($tables) ? $tables : explode(',', $tables);
			}

			//melalui siklus
			foreach($tables as $table)
			{
				$result = mysqli_query($con, 'SELECT * FROM '.$table);
				$num_fields = mysqli_num_fields($result);
				
				$return.= 'DROP TABLE IF EXISTS '.$table.';';
				$row2 = mysqli_fetch_row(mysqli_query($con, 'SHOW CREATE TABLE '.$table));
				$return.= "\n".$row2[1].";\n";
				
				for ($i = 0; $i < $num_fields; $i++) 
				{
					while($row = mysqli_fetch_row($result))
					{
						$return.= 'INSERT INTO '.$table.' VALUES(';
						for($j=0; $j<$num_fields; $j++) 
						{
							$row[$j] = addslashes($row[$j]);
							$row[$j] = ereg_replace("/\n/","\\n",$row[$j]);
							if (isset($row[$j])) { $return.= '"'.$row[$j].'"' ; } else { $return.= '""'; }
							if ($j<($num_fields-1)) { $return.= ','; }
						}
						$return.= ");\n";
					}
				}
				//$return.="\n\n\n";
			}

			catat($con, $_SESSION['namauser'], "Berhasil Backup database");
			$file = "Backup-klinik-DB(".date('d-m-y').").sql";
			header("Content-type: text/plain");
			header("Content-Disposition: attachment; filename=$file");
			header("Pragma: no-cache");
			header("Expires: 0");
			print "--Backup SQL DUMP Database\n--Script By CGS ()\n--Copyright (c) 2016\n--File ini di backup pada tanggal ".date('d-m-Y H:i:s')."\n\n";
			print $return;
			exit(0);

		}

		function restore($filename){

			global $con;
			///////////////////////////////////////////////////////////
		
			// Temporary variable, used to store current query
			$templine = '';
			$letak="file/temp.sql";
			move_uploaded_file($filename,$letak);
			$lines = file($letak);
			$berhasil=0; $gagal=0;
			// Loop through each line
			foreach ($lines as $line)
			{
				// Skip it if it's a comment
				if (substr($line, 0, 2) == '--' || $line == '')
					continue;
			 
				// Add this line to the current segment
				$templine .= $line;
				// If it has a semicolon at the end, it's the end of the query
				if (substr(trim($line), -1, 1) == ';')
				{
					// Perform the query
					if(mysqli_query($con, $templine)){
						$berhasil++;
					}else{
						$gagal++;
					}
					// Reset temp variable to empty
					$templine = '';
					
				}
			}

	        if(file_exists($letak)){
	            unlink($letak);
	        }
	        catat($con, $_SESSION['namauser'], "Restore Database");
			echo "<script type=\"text/javascript\">alert('Hasil Restore Berhasil: $berhasil Gagal $gagal');
				location='../../media.php?module=database';
			</script>";
		} 

		if($_GET["do"]=="backup"){
		    backup_tables();
		}
		if($_GET["do"]=="restore"){
		    $file=$_FILES['restore']['tmp_name'];

		   restore($file);
		}
	?>
	<div id='main-content'>
		<div class='container_12'>
			<div class='grid_12'>
			</div>

			<div class='grid_12'>
				<div class='block-border'>
					<div class='block-header'>
						<h1>Backup Database</h1>
						<span></span> 
					</div>
					<div class='block-content'>

						<p class=inline-small-label>
							<button class="button" style="width: 30%; height: 25px; font-size: 100%" onclick="window.location='modul/mod_database/database.php?do=backup'">Backup Database</button>
	   					</p>
	   					<br>
	   					<form method="post" enctype="multipart/form-data" action="modul/mod_database/database.php?do=restore">
	   						<p class=inline-small-label>
	   							File Backup Database (*.sql)
	   							<br>
						    	<input name="restore" type="file" style="font-weight:bold; width: 77%; height: 50px; font-size: 24px; margin: 5px 0;">
						    </p>
						    <p>
						    	<input class="button" type='submit' value="Restore" onClick="return pastikan('Backup database')" data-loading-text="Loading..." style="width: 20%; height: 25px; font-size: 100%; float: right; margin: -40px 0">
						    </p>
						</form>
					  
						



						</div> 
					</div>
				</div>
			<div class='clear height-fix'></div> 
		</div>
	</div>
	<?php
}
?>