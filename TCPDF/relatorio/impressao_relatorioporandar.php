<?php

		session_start();
		
		include '../../database.php';
		$pdo = database::connect();
		
		$sql ="select  
			replace(ds_leito, 'LEITO', '') as ds_leito,			
			to_char(to_date(substring(dt_admss, 1, 16),'yyyy/mm/dd hh24:mi:ss'), 'dd/mm/yyyy') as dt_admss,
			nm_pcnt,			
			dt_nasc_pcnt,
			nm_cnvo,
			nm_mdco,
			nm_psco,
			nm_trpa,
			ds_cid,
			case when fl_fmnte = 'T' then 'Sim' else 'Não' end  ,
			to_char(dt_prvs_alta, 'dd/mm/yyyy hh24:mi:ss') as dt_prvs_alta,			
			case when fl_rtgrd = 'T' then 'Sim' else 'Não' end  ,
			case when fl_acmpte = 'T' then 'Sim' else 'Não' end ,						
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
$pdf->SetFont('times', 'B', 9);

$pdf->AddPage('L', 'A4');

date_default_timezone_set('America/Sao_Paulo');

	$html = ' 				
		<h4>Data/Hora da Emissão: '. date("d/m/Y H:i:s").'<h4>
        <table>					
			<tr>
				<th>Leito</th>				
				<th>Admissão</th>
				<th>Paciente</th>				
				<th>Data de Nasc.</th>
				<th>Convênio</th>
				<th>Médico</th>
				<th>Psicólogo</th>
				<th>Terapeuta</th>
				<th>Grupo de CID</th>
				<th>Fumante</th>
				<th>Prvs. de Alta</th>					
				<th>Retagd.</th>
				<th>Acomp.</th>
				<th>Ocorrências</th>						
			</tr>
			<hr>';
	while($row = pg_fetch_row($ret)) {
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
