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
		//Biaya	Pemeriksaan
		
		/*header KOP Surat 1*/
		$this->Image("../img2/pol.png",40,15,80); // logo		
		$this->Image("../img2/lambang.png",480,20,70); // logo		
		$this->SetFont("", "B", 12);
		$this->MultiCell(0, 12, 'PEMERINTAH KABUPATEN INDRAMAYU', 0, 'C', 0);
		$this->Ln(5);
		$this->SetFont("", "B", 17);
		$this->MultiCell(0, 12, 'DINAS KESEHATAN', 0, 'C', 0);
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
		$this->SetX($left); $this->Cell(0, 10,'RS MUARA HATI', 0, 1,'C');
		$this->Ln(15);
		/*KOP Surat 2*/
		$this->SetFont('Arial','','9');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'No. Faktur',0,'L',1);
			$this->Cell(10,1,':',0,'L',1); 
			$this->Cell(400,1,$id,0,'L',1); 
		$this->Ln(12);
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Id. Antrian',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
		$this->SetFont('Arial','','9');
			$this->Cell(400,1,$id_atr,0,'L',1);
		$this->Ln(12);
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Nama Pasien',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
		$this->SetFont('Arial','','9');
			$this->Cell(400,1,$sel_pas['nama_pasien'],0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Tgl. Masuk',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,tgl_indo($sel_atr['tgl_datang']),0,'L',1);
		$this->Ln(12);
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Antrian',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,$sel_pol['nama_poli'],0,'L',1);
		$this->Ln(20);
		$this->SetFont('Arial','','8');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(520,1,'Berdasarkan kajian dengan berpedoman kepada :',0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Jenis Pembayaran',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,$sel_jpm['nama_jenispem'],0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Mitra Pembayaran',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,$sel_mit['nama_mitra'],0,'L',1);
		$this->Ln(12);
		$this->SetFont('Arial','','9');
			$this->Cell(40,1,'',0,'L',1);
			$this->Cell(100,1,'Keterangan',0,'L',1);
			$this->Cell(10,1,':',0,'L',1);
			$this->Cell(400,1,$sel_pem['keterangan'],0,'L',1);

		$this->Ln(25);
		/*Tabel*/		
		$h 		= 20;
		$left 	= 40;
		$top 	= 80;	
		/*Header Penjumlahan Tagihan*/
		$this->SetFillColor(500);	
		$left = $this->GetX();
		$this->SetFont("", "B", 10);	
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Cell(30,$h,'No',1,0,'C',true);
			$this->Cell(150, $h, 'Uraian', 1, 0, 'C',true);
			$this->Cell(260, $h, 'Total', 1, 0, 'C',true);
		$this->Ln(20);
		/*Uaraian Konstruksi Bangunan*/
		$this->SetWidths(array(30,150,260));
		$this->SetAligns(array('C','L','L','C','R'));
		$this->SetFont('Arial','',10);
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('1','Poli',rupiah2($sel_tag['biaya_poli'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('2','Dokter',rupiah2($sel_tag['biaya_dokter'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('3','Pemeriksaan',rupiah2($sel_tag['biaya_tindakan'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('4','Uji Lab',rupiah2($sel_tag['biaya_lab'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('5','Rontgen',rupiah2($sel_tag['biaya_rontgen'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('6','Ruangan',rupiah2($sel_tag['biaya_kamar'])));			
		$this->SetWidths(array(180,260));
		$this->SetAligns(array('C','C','R'));
		$this->SetFont('Arial','B',10);
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('Biaya Sementara',rupiah2($sel_tag['total'])));			
		$this->Ln(20);

		$this->SetFillColor(500);	
		$left = $this->GetX();
		$this->SetFont("", "B", 10);	
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Cell(30,$h,'No',1,0,'C',true);
			$this->Cell(150, $h, 'Uraian', 1, 0, 'C',true);
			$this->Cell(130, $h, 'Diskon/Ket.', 1, 0, 'C',true);
			$this->Cell(130, $h, 'Total', 1, 0, 'C',true);
		$this->Ln(20);
		$this->SetWidths(array(180,130,130));
		$this->SetAligns(array('L','C','R'));
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('Biaya Sementara',$sel_pem['diskon_pem'].'%',rupiah2($sel_tag['total'])));			
		$this->SetWidths(array(30,150,130,130));
		$this->SetAligns(array('C','L','C','R'));
		$this->SetFont('Arial','',10);
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('1','Obat',$sel_pmr['keterangan'],rupiah2($sel_pmr['total_harga'])));			
		$this->SetWidths(array(310,130));
		$this->SetAligns(array('L','R'));
		$this->SetFont('Arial','B',10);
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('Biaya Akhir',rupiah2($sel_pem['tagihan_akhir'] + $sel_br['total_harga'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
			$this->Row(array('Nominal Bayar',rupiah2($sel_pem['nominal'])));			
			$this->Cell(40,$h,'',0,0,'C',true);
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
		$this->SetX($left); $this->Cell(465, 10, 'Kasir RS Muara Hati', 0, 1,'R');
		$this->Ln(60);
		$this->SetFont("", "B", 8);
		$this->SetX($left); $this->Cell(460, 10, 'HAMBA ALLAH', 0, 1,'R');
		$this->SetFont("", "", 8);
		$this->SetX($left); $this->Cell(465, 10, 'NIP. 010419962017', 0, 1,'R');
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
	'filename' => 'Bukti_Pembayaran.pdf', //nama file penyimpanan, kosongkan jika output ke browser
	'destinationfile' => 'I', //I=inline browser (default), F=local file, D=download
	'paper_size'=>'A4',	//paper size: F4, A3, A4, A5, Letter, Legal
	'orientation'=>'P' //orientation: P=portrait, L=landscape
);

$tabel = new FPDF_AutoWrapTable($data, $options);
$tabel->printPDF();
?>
