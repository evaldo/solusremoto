<?php

		session_start();
		
		include '../../database.php';
		$pdo = database::connect();
				
		
		$sql ="select count(1) as nualta
			from integracao.vw_bmh_online 
			where  to_date(dt_admss, 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(dt_admss, 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy')
	   and tipo_bmh_online = 'Alta'";			
		
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);
			//header(Config::$webLogin);
			exit;
		}
		
		$row = pg_fetch_row($ret);
		$nualta = $row[0];
		
		$sql ="select count(2) as nuadmss
			from integracao.vw_bmh_online 
			where  to_date(dt_admss, 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(dt_admss, 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy')";	   			
		$ret = pg_query($pdo, $sql);
		
		if(!$ret) {
			echo pg_last_error($pdo);
			//header(Config::$webLogin);
			exit;
		}
		
		$row = pg_fetch_row($ret);
		$nuadmss = $row[0];
		
		$sql ="select * from (
		       select 
			   nm_pcnt
			 , dt_admss
			 , dt_nasc_pcnt
			 , nm_cnvo
			 , nm_mdco
			 , nm_psco
			 , nm_trpa
			 , ds_cid
			 , fl_fmnte
			 , fl_rtgrd
			 , fl_acmpte
			 , ds_crtr_intnc
			 , ds_dieta
			 , ds_const
			 , ds_ocorr
			 , destino_alta 
			 , tipo_bmh_online
			 , to_char(dt_alta, 'dd/mm/yyyy hh24:mi')  as dt_alta
		from integracao.vw_bmh_online 
			where  to_date(dt_admss, 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(dt_admss, 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy')
			   and tipo_bmh_online = 'Admissão'
		union
		select  nm_pcnt
			 , dt_admss
			 , dt_nasc_pcnt
			 , nm_cnvo
			 , nm_mdco
			 , nm_psco
			 , nm_trpa
			 , ds_cid
			 , fl_fmnte
			 , fl_rtgrd
			 , fl_acmpte
			 , ds_crtr_intnc
			 , ds_dieta
			 , ds_const
			 , ds_ocorr
			 , destino_alta 
			 , tipo_bmh_online
			 , to_char(dt_alta, 'dd/mm/yyyy hh24:mi')  as dt_alta
		from integracao.vw_bmh_online 
			where  to_date(dt_admss, 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(dt_admss, 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy')
	   and tipo_bmh_online = 'Alta'
	   ) as bmh_online order by tipo_bmh_online, dt_admss;";			
		
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
		// Logo
		$image_file = K_PATH_IMAGES.'logo_vilaverde.png';
		$this->Image($image_file, 15, 5, 25, '', 'PNG', '', 'T', false, 300, '', false, false, 0, false, false, false);
		// Set font
		$this->SetFont('helvetica', 'B', 20);
		// Title
		$this->Cell(0, 0, 'Relatório de Gestão de Leitos', 0, false, 'C', 0, '', 0, false, 'M', 'M');
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
$pdf->SetAuthor('Nicola Asuni');
$pdf->SetTitle('Gestão de Leitos');
$pdf->SetSubject('TCPDF Tutorial');
$pdf->SetKeywords('TCPDF, PDF, example, test, guide');

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
$pdf->SetFont('times', 'B', 8);

$pdf->AddPage('L', 'A4');

date_default_timezone_set('America/Sao_Paulo');

	$row = pg_fetch_row($ret);

	$html = ' 				
		<h4>Data/Hora da Emissão		: '. date("d/m/Y H:i:s").'<h4>
		<h4>Período de Emissão - Início	:'.$_SESSION['dataInicio'].' a Fim:'.$_SESSION['dataFim'].'</h4>
		<h4>Quantidade de Admissões	: '.$nuadmss.'<h4>
		<h4>Quantidade de Altas		: '. $nualta.'<h4>
		<hr>
		<h4>Tipo de BMHOnline		: '.$row[16].'<h4>		
		<hr>
        <table>					
			<tr>
				<th>Paciente</th>				
				<th>Admissão</th>
				<th>Data de Nasc.</th>
				<th>Convênio</th>
				<th>Médico</th>
				<th>Psicólogo</th>
				<th>Terapeuta</th>
				<th>Grupo de CID</th>
				<th>Fumante</th>				
				<th>Retagd.</th>
				<th>Acomp.</th>
				<th>Cart. Inter.</th>
				<th>Dieta</th>
				<th>Consist.</th>
				<th>Ocorrências</th>						
															
			</tr>
			<hr>';
			
	$html .= ' 
			<tr >
				<td>'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td>'.$row[2].'</td>				
				<td>'.$row[3].'</td>
				<td>'.$row[4].'</td>
				<td>'.$row[5].'</td>
				<td>'.$row[6].'</td>
				<td>'.$row[7].'</td>
				<td>'.$row[8].'</td>
				<td>'.$row[9].'</td>
				<td>'.$row[10].'</td>					
				<td>'.$row[11].'</td>
				<td>'.$row[12].'</td>
				<td>'.$row[13].'</td>
				<td>'.$row[14].'</td>
				<td>'.$row[15].'</td>											
				<td>'.$row[17].'</td>							
			</tr>
			<hr>';
	$cabecalho='';	
	while($row = pg_fetch_row($ret)) {
		if($row[16] == 'Alta' and $cabecalho == ''){
			
			$cabecalho='alta';	
			
			$html .= ' 
			<br>
			<h4>Tipo de BMHOnline: '.$row[16].'<h4>			
			<hr>
			<table>					
				<tr>
					<th>Paciente</th>				
					<th>Admissão</th>
					<th>Data de Nasc.</th>
					<th>Convênio</th>
					<th>Médico</th>
					<th>Psicólogo</th>
					<th>Terapeuta</th>
					<th>Grupo de CID</th>
					<th>Fumante</th>				
					<th>Retagd.</th>
					<th>Acomp.</th>
					<th>Cart. Inter.</th>
					<th>Dieta</th>
					<th>Consist.</th>
					<th>Ocorrências</th>						
					<th>Destino de Alta</th>						
					<th>Alta</th>						
				</tr>
				<hr>';
			
		}
		$html .= ' 
			<tr >
				<td>'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td>'.$row[2].'</td>				
				<td>'.$row[3].'</td>
				<td>'.$row[4].'</td>
				<td>'.$row[5].'</td>
				<td>'.$row[6].'</td>
				<td>'.$row[7].'</td>
				<td>'.$row[8].'</td>
				<td>'.$row[9].'</td>
				<td>'.$row[10].'</td>					
				<td>'.$row[11].'</td>
				<td>'.$row[12].'</td>
				<td>'.$row[13].'</td>
				<td>'.$row[14].'</td>
				<td>'.$row[15].'</td>											
				<td>'.$row[17].'</td>											
			</tr>
			<hr>';
			//echo $row[0];
	}
		$html .= '</table>';

// output the HTML content
$pdf->writeHTML($html, true, 0, true, 0);

// reset pointer to the last page
$pdf->lastPage();

// ---------------------------------------------------------

//Close and output PDF document
$pdf->Output('gestao_leitos_2.pdf', 'I');

//============================================================+
// END OF FILE
//============================================================+
