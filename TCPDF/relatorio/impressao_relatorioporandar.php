<?php

		session_start();
		
		include '../../database.php';
		$pdo = database::connect();
		
		$sql ="select  
			replace(ds_leito, 'LEITO', '') as ds_leito,			
			to_char(dt_admss,'dd/mm/yyyy hh24:mi') as dt_admss,
			nm_pcnt,			
			to_char(dt_nasc_pcnt,'dd/mm/yyyy') as dt_nasc_pcnt,
			nm_cnvo,
			nm_mdco,
			nm_psco,
			nm_trpa,
			ds_cid,
			case when fl_fmnte = 'T' then 
				'Sim' 
			  else 
				case when fl_fmnte = 'F' then
					'Não' 
				else	
					''
			end end as fl_fmnte,
			to_char(dt_prvs_alta, 'dd/mm/yyyy hh24:mi:ss') as dt_prvs_alta,			
			case when fl_rtgrd = 'T' then 
				'Sim' 
			  else 
				case when fl_rtgrd = 'F' then
					'Não' 
				else	
					''
			  end end as fl_rtgrd  ,
			case when fl_acmpte = 'T' then 
				'Sim' 
			  else 
				case when fl_acmpte = 'F' then
					'Não' 
				else	
					''
			  end end as fl_acmpte ,
			ds_crtr_intnc,
			ds_dieta,
			ds_const,			
			ds_ocorr			
			FROM integracao.tb_ctrl_leito ";
				
		if ($_SESSION['numeroandar'] == '0' || $_SESSION['numeroandar'] == 'Q') {
			$sql.="where ds_andar in ('0', 'Q')
			ORDER BY 1, 3 ";			
		} else {
			$sql.="where ds_andar = '". $_SESSION['numeroandar'] ."'
			ORDER BY 1, 3 ";			
		}			
		
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);
			header(Config::$webLogin);
			exit;
		}
	
	
	require_once('tcpdf_include.php');
	class MYPDF extends TCPDF {

	//Page header
	public function Header() {
				
		$this->SetFont('helvetica', 'B', 20);
		
	}
	// Page footer
	public function Footer() {
		// Position at 15 mm from bottom
		$this->SetY(-15);
		// Set font
		$this->SetFont('helvetica', 'B', 8);
		// Page number
		$this->Cell(0, 10, 'Página '.$this->getAliasNumPage().'/'.$this->getAliasNbPages(), 0, false, 'C', 0, '', 0, false, 'T', 'M');
	}
}

// create new PDF document
$pdf = new MYPDF(PDF_PAGE_ORIENTATION, PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

// set document information
$pdf->SetCreator(PDF_CREATOR);
$pdf->SetAuthor('Hospital Vila Verde Saúde Mental');
$pdf->SetTitle('Relatorio Por Andar');
$pdf->SetSubject('Relatório em PDF');
$pdf->SetKeywords('Por Andar');

// set default header data
$pdf->SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE, PDF_HEADER_STRING);

// set header and footer fonts
$pdf->setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
$pdf->setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

// set default monospaced font
$pdf->SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

// set margins
$pdf->SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
$pdf->SetHeaderMargin(PDF_MARGIN_HEADER);
$pdf->SetFooterMargin(PDF_MARGIN_FOOTER);

// set auto page breaks
$pdf->SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

// set image scale factor
$pdf->setImageScale(PDF_IMAGE_SCALE_RATIO);

// set some language-dependent strings (optional)
if (@file_exists(dirname(__FILE__).'/lang/por.php')) {
	require_once(dirname(__FILE__).'/lang/por.php');
	$pdf->setLanguageArray($l);
}

// ---------------------------------------------------------

$pdf->SetDisplayMode('fullpage', 'SinglePage', 'UseNone');

// set font
$pdf->SetFont('helvetica', 'N', 9);

$pdf->AddPage('L', 'A4');

date_default_timezone_set('America/Sao_Paulo');

	$html = ' 	<!DOCTYPE html>
				<html>
				<head>
				<style>		
				table {			
					width: 100%;
				}
				
				th {
					text-align: left;													
				}
				
				td {
					word-wrap: break-word;
					font-weight: normal;
				}

		</style>
		</head>
		<body>
		<img src="images/logo_vilaverde.png" border="0" height="80" width="80" ALIGN="left" HSPACE="50" VSPACE="50"/>
		<h4>Relatorio Por  andar. Andar = '.$_SESSION['numeroandar'].'<h4>			
		<h5>Data/Hora da Emissão: '. date("d/m/Y H:i:s").'<h5>
		<hr>
        <table style="border-collapse: collapse">					
			<tr>
				<th>LEITO</th>				
				<th>ADMISSÃO</th>
				<th>PACIENTE</th>				
				<th>DATA NASC.</th>
				<th>CONVÊNIO</th>
				<th>MÉDICO</th>
				<th>PSICÓL.</th>
				<th>TERAP.</th>
				<th>CID</th>
				<th>FUMANTE</th>
				<th colspan="2">DIETA</th>													
				<th>RET.</th>
				<th >ACOM.</th>
				<th>CAR INT.</th>				
				<th>OCORR.</th>								
			</tr>
			<tr style="background-color: #ffffff;"> <td colspan="16" height="5">&nbsp;</td> </tr>';
		$contalinha = 0;
		$color = "background-color: #f2f2f2;";
		while($row = pg_fetch_row($ret)) {
			if ($color == ""){
				$color = "background-color: #f2f2f2;";					
			} else {
				$color = "background-color: #ffffff;";
				$color="";
			}
		
			$html .= ' 
			<tr style="'.$color.'">
				<td style="font-weight: bold;">'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td style="font-weight: bold;">'.substr($row[2], 0, 30).'</td>				
				<td>'.$row[3].'</td>
				<td style="font-weight: bold;">'.substr($row[4], 0, 30).'</td>
				<td>'.$row[5].'</td>
				<td>'.$row[6].'</td>
				<td>'.$row[7].'</td>
				<td>'.$row[8].'</td>';
				if ($row[9]=="Sim"){
					$html.='<td style="text-align: center;"><img src="images/checkbox.png" border="0" height="10" width="10" /></td>';
				} else {
					$html.='<td style="text-align: center;"><img src="images/nocheckbox.png" border="0" height="10" width="10" /></td>';
				}																		
				$html.='<td>'.$row[14].'</td>
				<td>'.$row[15].'</td>';				
				if ($row[11]=="Sim"){
					$html.='<td style="text-align: center;"><img src="images/checkbox.png" border="0" height="10" width="10" /></td>';
				} else {
					$html.='<td style="text-align: center;"><img src="images/nocheckbox.png" border="0" height="10" width="10" /></td>';
				}
				if ($row[12]=="Sim"){
					$html.='<td style="text-align: center;"><img src="images/checkbox.png" border="0" height="10" width="10" /></td>';
				} else {
					$html.='<td style="text-align: center;"><img src="images/nocheckbox.png" border="0" height="10" width="10" /></td>';
				}
				$html.='<td>'.substr($row[13], 0, 5).'</td>
				<td>'.$row[16].'</td>
				</tr>
				<tr style="background-color: #ffffff;"> <td colspan="16" height="5">&nbsp;</td> </tr>';									
				
				$contalinha = $contalinha + 1;			
		}
		$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('gestao_leitos_2.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
