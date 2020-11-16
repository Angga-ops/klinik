<?php
include "koneksi.php";
?>
<h1>Double No RM Pasien</h1>
	<table width="300px" class="table1" border="1">
		<thead>
	    	<tr>
	          <th>No</th>
              <th>id pasien</th>
              <th>Juml Duplikat</th>
             
	        </tr>
	    </thead>
	    <tbody>
		<?php 
	
				$q1 = mysqli_query($con, "SELECT id_pasien, COUNT(*) duplikat FROM pasien GROUP BY id_pasien HAVING duplikat > 1"); 
              	$no =1;
              	while($br = mysqli_fetch_array($q1)) { ?>
		            <tr>
		              <td><?php echo $no++; ?></td>
		            
		            
		              <td><?php echo $br['id_pasien']; ?></td>
		              <td align="center"><?php echo $br['duplikat']; ?></td>
		             
		            </tr>
               
		
                <?php
                $no++; } ?>
            
			  
	    </tbody>
    </table>