<?php
	if(isset($_POST["impressao"]))
	{
		session_start();		
		
		include '../database.php';		
		
		global $pdo;	
		
		$pdo = database::connect();	
		$sql = '';
		
				
		$sql ="SELECT ds_leito, 			
			dt_admss,
			nm_pcnt,
			ds_sexo,
			to_char(dt_nasc_pcnt, 'DD/MM/YYYY') dt_nasc_pcnt,
			nm_cnvo,		
			ds_cid,
			case when fl_fmnte = 'T' then 'Fumante' else 'Não Fumante' end,
			ds_dieta,
			ds_const,
			TO_CHAR(dt_prvs_alta, 'DD/MM/YYYY'),
			nm_mdco,
			nm_psco,
			nm_trpa,
			ds_ocorr,
			ds_crtr_intnc,
			fl_status_leito FROM integracao.tb_ctrl_leito";
				
		if ($pdo==null){
			header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}

		$arquivo = "relatorio_gestaoleitos.xls";		
		$fp = fopen($arquivo, "w");

		$html = '';
		$html .= '<!DOCTYPE html>';
		$html .= '<html lang="pt-br">';
		$html .= '<head>';
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$html .= '</head>';	
		$html .= '<body>';	
		$html .= '<table>';	
		$html .= '<tr>';
		$html .= '<td>Leito</td>';
		$html .= '<td>Data de Admissão</td>';
		$html .= '<td>Paciente</td>';
		$html .= '<td>Sexo</td>';
		$html .= '<td>Data de Nascimento</td>';
		$html .= '<td>Convênio</td>';
		$html .= '<td>CID</td>';
		$html .= '<td>Fumante?</td>';
		$html .= '<td>Dieta</td>';
		$html .= '<td>Consistência</td>';
		$html .= '<td>Previsão de Alta</td>';
		$html .= '<td>Médico</td>';
		$html .= '<td>Psicólogo</td>';
		$html .= '<td>Terapeuta</td>';
		$html .= '<td>Ocorrência</td>';
		$html .= '<td>Caráter de Internação</td>';
		$html .= '</tr>';
		
		while($row = pg_fetch_row($ret)) {				
			$html .= '<tr>';
			$html .= '<td>'.$row[0].'</td>';
			$html .= '<td>'.$row[1].'</td>';
			$html .= '<td>'.$row[2].'</td>';
			$html .= '<td>'.$row[3].'</td>';
			$html .= '<td>'.$row[4].'</td>';
			$html .= '<td>'.$row[5].'</td>';
			$html .= '<td>'.$row[6].'</td>';
			$html .= '<td>'.$row[7].'</td>';
			$html .= '<td>'.$row[8].'</td>';
			$html .= '<td>'.$row[9].'</td>';
			$html .= '<td>'.$row[10].'</td>';
			$html .= '<td>'.$row[11].'</td>';
			$html .= '<td>'.$row[12].'</td>';
			$html .= '<td>'.$row[13].'</td>';
			$html .= '<td>'.$row[14].'</td>';
			$html .= '<td>'.$row[15].'</td>';
			$html .= '</tr>';
		}	
		
		$html .= '</table>';
		$html .= '</body>';	
		$html .= '</html>';
		
		fwrite($fp, $html);
		fclose($fp);
		?>
		<!DOCTYPE html>
		<html lang="pt-br">
		<head>
			<meta charset="utf-8">
			<link href="../css/bootstrap.min.css" rel="stylesheet">
			<link href="../css/style.css" rel="stylesheet">		
		</head>
		<body style="margin-right: 0; margin-left: 0; position: relative;">	
			<div class="container" style="width: 800%;  margin-right: 0; margin-left: 0; position: relative;">
			  <div class="modal-dialog">
					<div class="modal-content" style="width:800px; position: relative;">
						<div class="container">	
							<br>
							<br>
							<a href="<?php echo $arquivo;?>">Download do Relatório</a>							
							
							<div class="modal-footer">									
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">						
							</div>
						</div>
					</div>		
			  </div>
			</div>					
		</body>
		</html>
		<?php
		exit;			
	}
	
?>

