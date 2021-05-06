<?php

		session_start();
		
		include '../../database.php';
		$pdo = database::connect();
						
		$sql ="SELECT plnj_leito.id_plnj_pcnt_leito
		 , plnj_leito.nm_pcnt_cndat
		 , plnj_leito.dt_nasc
		 , cnvo.cd_cnvo
		 , plnj_leito.nm_cnto
		 , plnj_leito.dt_prvs_admss
		 , plnj_leito.ds_leito
		 , grvd_risco.nm_grvd_risco_pcnt
		 , orig_dmnd.ds_orig_dmnd_plnj_leito		 
		 , case when plnj_leito.fl_pcnt_adtdo = 0 then 'Não' else 'Sim' end fl_pcnt_adtdo
		FROM integracao.tb_orig_dmnd_plnj_leito orig_dmnd		   
		   , integracao.tb_plnj_pcnt_leito plnj_leito
		   , integracao.tb_grvd_risco_pcnt grvd_risco
		   , integracao.tb_cnvo cnvo
	WHERE plnj_leito.id_grvd_risco_pcnt = grvd_risco.id_grvd_risco_pcnt
	  and plnj_leito.id_orig_dmnd_plnj_leito = orig_dmnd.id_orig_dmnd_plnj_leito
	  and plnj_leito.id_cnvo = cnvo.id_cnvo		
	  and plnj_leito.dt_prvs_admss >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
	  and plnj_leito.dt_prvs_admss <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy') 	
	 order by 5 desc"; 
			
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);
			//header(Config::$webLogin);
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
$pdf->SetTitle('Relatório do Planejamento da Demanda de Leitos');
$pdf->SetSubject('Relatório em PDF');
$pdf->SetKeywords('BMH Online');

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

	//admissoes

	$row = pg_fetch_row($ret);

	$html = ' 				
			<!DOCTYPE html>
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
			<h4>Relatório do Planejamento da Demanda de Leitos<h4>
			<h5>Período de Emissão - Início	:'.$_SESSION['dataInicio'].' a Fim:'.$_SESSION['dataFim'].' Por Data de Previsão da Admissão</h5>			
        <table>					
			<tr>
				<th style="text-align:center">Id.</th>
				<th>Candidato a vaga</th>
				<th style="text-align:center">Data de Nasc</th>
				<th>Convênio</th>
				<th>Contato</th>							
				<th style="text-align:center">Dt. Prev. de Admissão</th>
				<th style="text-align:center">Leito Alocado</th>
				<th>Origem da Demanda</th>
				<th>Gravidade do Risco</th>							
				<th style="text-align:center">Paciente Admitido?</th>				
				
			</tr>
			<hr>';
			
	$html .= ' 
			<tr >
				<td style="text-align:center">'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td style="text-align:center">'.$row[2].'</td>				
				<td>'.$row[3].'</td>
				<td>'.$row[4].'</td>
				<td style="text-align:center">'.$row[5].'</td>
				<td style="text-align:center">'.$row[6].'</td>
				<td>'.substr($row[7], 0, 20).'</td>	
				<td>'.$row[8].'</td>
				<td style="text-align:center">'.$row[9].'</td>
			</tr>
			<hr>';
	
	$cabecalho='';	
	$contalinha = 0;
	$cor=1;
	$color='';
	while($row = pg_fetch_row($ret)) {
	
		$html .= ' 
			<tr >
				<td style="text-align:center">'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td style="text-align:center">'.$row[2].'</td>				
				<td>'.$row[3].'</td>
				<td>'.$row[4].'</td>
				<td style="text-align:center">'.$row[5].'</td>
				<td style="text-align:center">'.$row[6].'</td>
				<td>'.substr($row[7], 0, 20).'</td>	
				<td>'.$row[8].'</td>
				<td style="text-align:center">'.$row[9].'</td>
			</tr>
			<hr>';
	
	}
	$html .= '</table>';

$pdf->writeHTML($html, true, false, true, false, '');

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('gestao_leitos_2.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
