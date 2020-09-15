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
			FROM integracao.tb_ctrl_leito			
			where ds_andar = '". $_SESSION['numeroandar'] ."'
			ORDER BY 1, 3 ";			
		
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
$pdf->SetFont('times', 'N', 9);

$pdf->AddPage('L', 'A4');

date_default_timezone_set('America/Sao_Paulo');

	$html = ' 				
		<h5>Data/Hora da Emissão: '. date("d/m/Y H:i:s").'<h5>
        <table style="border-collapse: collapse">					
			<tr>
				<th>Leito</th>				
				<th>Admissão</th>
				<th width = "15%">Paciente</th>				
				<th>Data de Nasc.</th>
				<th>Convênio</th>
				<th>Médico</th>
				<th>Psicólogo</th>
				<th>Terapeuta</th>
				<th>CID</th>
				<th>Fumante</th>
				<th>Dieta</th>
				<th>Consist.</th>										
				<th width = "5%">Retagd.</th>
				<th width = "5%">Acomp.</th>
				<th width = "5%">Carat. Inter</th>
			</tr>
			<hr>';
	$contalinha = 0;
	
	$cor=1;
	$color='';
	
	while($row = pg_fetch_row($ret)) {
		
		/*if ($cor==1){
			$color="background-color: #dddddd";
			$cor=2;
		} else {
			$color="background-color: white";
			$cor=1;
		}*/
		
		$html .= ' 
			<tr >
				<td>'.$row[0].'</td>				
				<td>'.$row[1].'</td>
				<td width = "15%">'.substr($row[2], 0, 25).'</td>				
				<td>'.$row[3].'</td>
				<td>'.substr($row[4], 0, 10).'</td>
				<td>'.$row[5].'</td>
				<td>'.$row[6].'</td>
				<td>'.$row[7].'</td>
				<td>'.$row[8].'</td>
				<td>'.$row[9].'</td>															
				<td>'.$row[14].'</td>
				<td>'.$row[15].'</td>											
				<td width = "5%">'.$row[11].'</td>
				<td width = "5%">'.$row[12].'</td>
				<td width = "5%">'.substr($row[13], 0, 5).'</td>
			</tr>';
			if ($row[16]!=null){
				$html .= '<tr class="spacer"><td></td></tr>';
				$html .= '<tr style="'.$color.'"><td colspan="14">OCORRÊNCIAS:  '.$row[16].'</td></tr><br><br>';
			}
			/*$contalinha = $contalinha + 1;
			
			if ($contalinha == 12){
				$contalinha = 0;
				$html .= ' <div style="page-break-after: always"></div>';			
				
				$html .= ' 				
				<h5>Data/Hora da Emissão: '. date("d/m/Y H:i:s"). '<h5>
				<table style="border-collapse: collapse">					
					<tr>
						<th>Leito</th>				
						<th>Admissão</th>
						<th width = "15%">Paciente</th>				
						<th>Data de Nasc.</th>
						<th>Convênio</th>
						<th>Médico</th>
						<th>Psicólogo</th>
						<th>Terapeuta</th>
						<th>CID</th>
						<th>Fumante</th>
						<th>Dieta</th>
						<th>Consist.</th>										
						<th width = "3%">Retagd.</th>
						<th width = "3%">Acomp.</th>																		
					</tr>
					<hr>';				
				
			}*/
			$html .= ' <hr>';	
			$html .= '<tr class="spacer"><td></td></tr>';			
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
