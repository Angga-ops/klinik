<?php
	$thn		= date('Y');
	$bln		= date('m');
	$bulan		= date('m');
	switch ($bulan){
		case 1: { $bulan = 'Januari';
			}break;
		case 2: { $bulan = 'Februari';
			}break;
		case 3: { $bulan = 'Maret';
			}break;
		case 4: { $bulan = 'April';
			}break;
		case 5: { $bulan = 'Mei';
			}break;
		case 6: { $bulan = 'Juni';
			}break;
		case 7: { $bulan = 'Juli';
			}break;
		case 8: { $bulan = 'Agustus';
			}break;
		case 9: { $bulan = 'September';
			}break;
		case 10: { $bulan = 'Oktober';
			}break;
		case 11: { $bulan = 'November';
			}break;
		case 12: { $bulan = 'Desember';
			}break;
		default: { $bulan = 'Tidak Ada!';
			}break;
	}	
?>
<div id="main-content">
    <div class="container_12">
        <div class="grid_12">
			<div class='block-border'>
	            <div class="block-header">
                    <h1>KAS RUMAH SAKIT</h1>
				</div>
    <div class='block-content'>
    <br />
	<div style="margin-left:1%; margin-right:1%;">
    <h2>Periode : <?php echo $bulan.'-'.$thn; ?></h2>
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
		<tr>
        	<td colspan="8"><div align="center" id="pem2">Pemasukan</div></td>
        </tr>        
        <tr>
			<td width="12%"><div align="center" id="donker">Tanggal</div></td>
			<td width="14%"><div align="center" id="donker">Nominal</div></td>
        <?php
			$tot_pem	= mysqli_fetch_array(mysqli_query($con, "Select sum(jumlah_pmop) as total From pemasukan_op Where year(tgl_pmop)='$thn' And month(tgl_pmop)='$bln'"));
			$pemasukan	= mysqli_query($con, "Select tgl_pmop, sum(jumlah_pmop) as total From pemasukan_op Where year(tgl_pmop)='$thn' And month(tgl_pmop)='$bln' Group by tgl_pmop");
			while($pem	= mysqli_fetch_array($pemasukan)){
		?>
        <tr id="tdb">
			<td><?php echo $pem['tgl_pmop']; ?></td>
			<td id="tdku"><div align="right"><?php echo rupiah($pem['total']); ?></div></td>
		</tr>
        <?php
        	}
		?>
		<tr>
        	<td colspan="8"><div align="center" id="hitam">Total : <?php echo rupiah($tot_pem['total']); ?></div></td>
        </tr>        
    </table>
    <br>
	<table width="100%" style="border:solid; border-width:1px; border-color:#23333E;">
		<tr>
        	<td colspan="8"><div align="center" id="pem2">Pengeluaran</div></td>
        </tr>        
        <tr>
			<td width="12%"><div align="center" id="donker">Tanggal</div></td>
			<td width="14%"><div align="center" id="donker">Nominal</div></td>
        <?php
			$tot_png		= mysqli_fetch_array(mysqli_query($con, "Select sum(jumlah_pop) as total From pengeluaran_op Where year(tgl_pop)='$thn' And month(tgl_pop)='$bln'"));
			$pengeluaran	= mysqli_query($con, "Select tgl_pop, sum(jumlah_pop) as total From pengeluaran_op Where year(tgl_pop)='$thn' And month(tgl_pop)='$bln' Group by tgl_pop");
			while($png		= mysqli_fetch_array($pengeluaran)){
		?>
        <tr id="tdb">
			<td><?php echo $png['tgl_pop']; ?></td>
			<td id="tdku"><div align="right"><?php echo rupiah($png['total']); ?></div></td>
		</tr>
        <?php
        	}
		?>
		<tr>
        	<td colspan="8"><div align="center" id="hitam">Total : <?php echo rupiah($tot_png['total']); ?></div></td>
        </tr>        
    </table>
	</div>    
<br />    
    <div class="block-actions">
        <ul class="actions-right">
            <li>
            <a class="button red" id="reset-validate-form" href="?module=pemasukan">Kembali</a>
            </li> 
        </ul>
	</div>
				</div>
			</div>
        </div>
    </div>
</div>