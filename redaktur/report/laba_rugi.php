<script type="text/javascript">
window.print();
</script>
<?php  
require_once("../fpdf17/fpdf.php");
include("../../config/koneksi.php");
include("../../config/fungsi_rupiah.php");
include("../../config/fungsi_indotgl.php");

class FPDF_AutoWrapTable extends FPDF {
  	private $data = array();
  	private $options = array(
  		'filename' => '',
  		'destinationfile' => '',
  		'paper_size'=>'A4',
  		'orientation'=>'P'
  	);
  	
  	function __construct($data = array(), $options = array()) {
    	parent::__construct();
    	$this->data = $data;
    	$this->options = $options;
	}
	
	public function rptDetailData () {
		//
		$border = 0;
		$this->AddPage();
		$this->SetAutoPageBreak(true,60);
		$this->AliasNbPages();
		$left = 25;
	
		$id			= $_GET['id'];
		$sel_pem	= mysql_fetch_array(mysql_query("Select * From pembayaran Where id_pembayaran='$id'"));
		$id_tag		= $sel_pem['id_tagihan'];	

		$sel_tag	= mysql_fetch_array(mysql_query("Select * From tagihan Where id_tagihan='$id_tag'"));
		$id_atr		= $sel_tag['id_antrian'];	

		$sel_per	= mysql_fetch_array(mysql_query("Select * From pemeriksaan_pasien Where id_antrian='$id_atr'"));
		$id_per		= $sel_per['id_periksa'];	

		$sel_res	= mysql_fetch_array(mysql_query("Select * From obat_keluar Where id_periksa='$id_per' Group by id_periksa"));
		$id_res		= $sel_res['id_resep'];	

		$sel_br		= mysql_fetch_array(mysql_query("Select * From pembayaran_resep Where id_resep='$id_res'"));

		$sel_atr	= mysql_fetch_array(mysql_query("Select * From perawatan_pasien Where id_antrian='$id_atr'"));
		$id_pol		= $sel_atr['id_poli'];	
		$id_pas		= $sel_atr['id_pasien'];	
		$sel_pas	= mysql_fetch_array(mysql_query("Select * From pasien Where id_pasien='$id_pas'"));
		$sel_pol	= mysql_fetch_array(mysql_query("Select * From tujuan Where id_poli='$id_pol'"));
				
		/*header KOP Surat 1*/
		$this->Image("../img2/pol.png",40,15,80); // logo		
		$this->Image("../img2/lambang.png",480,20,70); // logo		
		$this->SetFont("", "B", 12);
		$this->MultiCell(0, 12, 'PEMERINTAH KABUPATEN INDRAMAYU', 0, 'C', 0);
		$this->Ln(5);
		$this->SetFont("", "B", 17);
		$this->MultiCell(0, 12, 'DINAS CIPTA KARYA', 0, 'C', 0);
		$this->Ln(5);
		$this->SetFont("", "B", 10);
		$this->MultiCell(0, 12, 'Jl. Wiralodra No. 35 Telp. (0234) 273076 - 272015', 0, 'C', 0);
		$this->Ln(5);
		$this->SetFont("", "B", 10);
		$this->MultiCell(0, 12, 'INDRAMAYU', 0, 'C', 0);
		$this->Cell(0, 5, " ", "B");
		$this->Ln(2);
		$this->Cell(0, 5, " ", "B");
		$this->Ln(15);
		$this->SetFont("", "B", 10);
		$this->SetX($left); $this->Cell(0, 10, 'BUKTI PEMBAYARAN TAGIHAN RUMAH SAKIT', 0, 1,'C');
		$this->Ln(3);
		$this->SetFont("", "B", 10);
		$this->SetX($left); $this->Cell(0, 10, $id_pas , 0, 1,'C');
		$this->Ln(15);
		/*KOP Surat 2*/
		$this->SetFont('Arial','','9');
		$this->Cell(30,1,'',0,'L',1); 
			$this->Cell(80,1,'No. Faktur',0,'L',1);
			$this->Cell(10,1,':',0,'L',1); 
			$this->Cell(400,1,$id,0,'L',1); 
		$this->Ln(12);
			$this->Cell(30,1,'',0,'L',1); 
			$this->Cell(80,1,'Id. Antrian',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
		$this->SetFont('Arial','','9');
			$this->Cell(400,1,$id_atr,0,'L',1);
		$this->Ln(12);
			$this->Cell(30,1,'',0,'L',1); 
			$this->Cell(80,1,'Nama Pasien',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
		$this->SetFont('Arial','','9');
			$this->Cell(400,1,$sel_pas['nama_pasien'],0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(30,1,'',0,'L',1); 
			$this->Cell(80,1,'Tgl. Masuk',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,tgl_indo($sel_atr['tgl_datang']),0,'L',1);
		$this->Ln(12);
			$this->Cell(30,1,'',0,'L',1); 
			$this->Cell(80,1,'Antrian',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,$sel_pol['nama_poli'],0,'L',1);
		$this->Ln(20);
		$this->SetFont('Arial','','8');
			$this->Cell(520,1,'Berdasarkan kajian dengan berpedoman kepada :',0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(80,1,'Jenis Pembayaran',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,tgl_indo($sel_atr['tgl_datang']),0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(80,1,'Mitra Pembayaran',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,tgl_indo($sel_atr['tgl_datang']),0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(80,1,'Keterangan',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,tgl_indo($sel_atr['tgl_datang']),0,'L',1);

		$this->Ln(25);
		/*Tabel*/		
		$h 		= 20;
		$left 	= 40;
		$top 	= 80;	
		/*Header Konstruksi Bangunan*/
		$this->SetFillColor(500);	
		$left = $this->GetX();
		$this->SetFont("", "B", 10);	
		$this->Cell(30,$h,'No',1,0,'C',true);
			$this->Cell(150, $h, 'Uraian', 1, 0, 'C',true);
			$this->Cell(100, $h, 'Biaya Awal', 1, 0, 'C',true);
			$this->Cell(120, $h, 'Diskon', 1, 0, 'C',true);
			$this->Cell(130, $h, 'Total', 1, 0, 'C',true);
		$this->Ln(20);
		/*Uaraian Konstruksi Bangunan*/
		$this->SetWidths(array(30,150,100,120,130));
		$this->SetAligns(array('C','L','L','C','R'));
		$this->SetFont('Arial','',10);
			$this->Row(array('1','Poli','e','e',rupiah2($sel_tag['biaya_poli'])));			
			$this->Row(array('2','Dokter','x','x',rupiah2($sel_tag['biaya_dokter'])));			
			$this->Row(array('3','Pemeriksaan','a','a',rupiah2($sel_tag['biaya_tindakan'])));			
			$this->Row(array('4','Uji Lab','b','b',rupiah2($sel_tag['biaya_lab'])));			
			$this->Row(array('5','Rontgen','c','c',rupiah2($sel_tag['biaya_rontgen'])));			
			$this->Row(array('6','Ruangan','d','d',rupiah2($sel_tag['biaya_kamar'])));			
		$this->SetWidths(array(280,120,130));
		$this->SetAligns(array('L','C','R'));
		$this->SetFont('Arial','B',10);
			$this->Row(array('Biaya Sementara',$sel_pem['diskon_pem'].'%',rupiah2($sel_tag['total'])));			
		$this->SetWidths(array(30,150,100,120,130));
		$this->SetAligns(array('C','L','L','C','R'));
		$this->SetFont('Arial','',10);
			$this->Row(array('7','Obat','e','e',rupiah2($sel_br['total_harga'])));			
		$this->SetWidths(array(400,130));
		$this->SetAligns(array('L','R'));
		$this->SetFont('Arial','B',10);
			$this->Row(array('Biaya Akhir',rupiah2($sel_pem['tagihan_akhir'])));			
			$this->Row(array('Nominal Bayar',rupiah2($sel_pem['nominal'])));			
			$this->Row(array('Nominal Kembalian',rupiah2($sel_pem['kembalian'])));			

		$this->Ln(30);
		/*Penanggalan*/
				$tgl  	= date('d');
				$bln  	= date('m');
				$thn  	= date('Y');
				switch ($bln){
					case 1: { $bln = 'Januari';
						}break;
					case 2: { $bln = 'Februari';
						}break;
					case 3: { $bln = 'Maret';
						}break;
					case 4: { $bln = 'April';
						}break;
					case 5: { $bln = 'Mei';
						}break;
					case 6: { $bln = 'Juni';
						}break;
					case 7: { $bln = 'Juli';
						}break;
					case 8: { $bln = 'Agustus';
						}break;
					case 9: { $bln = 'September';
						}break;
					case 10: { $bln = 'Oktober';
						}break;
					case 11: { $bln = 'November';
						}break;
					case 12: { $bln = 'Desember';
						}break;
					default: { $bln = 'Tidak Ada!';
						}break;
				}
				$sekarang = "Indramayu, ".$tgl." ".$bln." ".$thn;
		/*Footer Surat*/
		$this->SetFont("", "", 8);
		$this->SetX($left); $this->Cell(480, 10, $sekarang, 0, 1,'R');
		$this->Ln(20);
		$this->SetX($left); $this->Cell(455, 10, 'Mengetahui :', 0, 1,'R');
		$this->SetX($left); $this->Cell(500, 10, 'Kepala Seksi Pemanfaatan Bangunan', 0, 1,'R');
		$this->Ln(60);
		$this->SetFont("", "B", 8);
		$this->SetX($left); $this->Cell(470, 10, 'FAJAR SHODIEQIE', 0, 1,'R');
		$this->SetFont("", "", 8);
		$this->SetX($left); $this->Cell(485, 10, 'NIP. 19720621 200604 1 013', 0, 1,'R');
	}
	public function printPDF () {
				
		if ($this->options['paper_size'] == "A4") {
			$a = 8.3 * 72; //1 inch = 72 pt
			$b = 13.0 * 72;
			$this->FPDF($this->options['orientation'], "pt", array($a,$b));
		} else {
			$this->FPDF($this->options['orientation'], "pt", $this->options['paper_size']);
		}
		
	    $this->SetAutoPageBreak(false);
	    $this->AliasNbPages();
	    $this->SetFont("helvetica", "B", 10);
	    //$this->AddPage();
	
	    $this->rptDetailData();
			    
	    $this->Output($this->options['filename'],$this->options['destinationfile']);
  	}
  	
  	
  	
  	private $widths;
	private $aligns;

	function SetWidths($w)
	{
		//Set the array of column widths
		$this->widths=$w;
	}

	function SetAligns($a)
	{
		//Set the array of column alignments
		$this->aligns=$a;
	}

	function Row($data)
	{
		//Calculate the height of the row
		$nb	=0;
		for($i=0;$i<count($data);$i++)
			$nb	=max($nb,$this->NbLines($this->widths[$i],$data[$i]));
		$h	=15*$nb;
		//Issue a page break first if needed
		$this->CheckPageBreak($h);
		//Draw the cells of the row
		for($i=0;$i<count($data);$i++)
		{
			$w=$this->widths[$i];
			$a=isset($this->aligns[$i]) ? $this->aligns[$i] : 'L';
			//Save the current position
			$x=$this->GetX();
			$y=$this->GetY();
			//Draw the border
			$this->Rect($x,$y,$w,$h);
			//Print the text
			$this->MultiCell($w,15,$data[$i],0,$a);
			//Put the position to the right of the cell
			$this->SetXY($x+$w,$y);
		}
		//Go to the next line
		$this->Ln($h);
	}

	function CheckPageBreak($h)
	{
		//If the height h would cause an overflow, add a new page immediately
		if($this->GetY()+$h>$this->PageBreakTrigger)
			$this->AddPage($this->CurOrientation);
	}

	function NbLines($w,$txt)
	{
		//Computes the number of lines a MultiCell of width w will take
		$cw=&$this->CurrentFont['cw'];
		if($w==0)
			$w=$this->w-$this->rMargin-$this->x;
		$wmax=($w-2*$this->cMargin)*1000/$this->FontSize;
		$s=str_replace("\r",'',$txt);
		$nb=strlen($s);
		if($nb>0 and $s[$nb-1]=="\n")
			$nb--;
		$sep=-1;
		$i=0;
		$j=0;
		$l=0;
		$nl=1;
		while($i<$nb)
		{
			$c=$s[$i];
			if($c=="\n")
			{
				$i++;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
				continue;
			}
			if($c==' ')
				$sep=$i;
			$l+=$cw[$c];
			if($l>$wmax)
			{
				if($sep==-1)
				{
					if($i==$j)
						$i++;
				}
				else
					$i=$sep+1;
				$sep=-1;
				$j=$i;
				$l=0;
				$nl++;
			}
			else
				$i++;
		}
		return $nl;
	}
} //end of class

//contoh penggunaan

//koneksi ke database

//mengambil data dari tabel
$data = array();
//mengisi judul dan header tabel


//pilihan
$options = array(
	'filename' => 'Data_Kecamatan.pdf', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
