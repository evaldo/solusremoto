 <?php  
	
	session_start();
	
	if(isset($_POST['dataInicio'])){		
		
		$_SESSION['dataInicio']=$_POST['dataInicio'];			
		$_SESSION['dataFim']=$_POST['dataFim'];
	
	}
	if ($_SESSION['dataInicio']<>''){
		//2020-06-23
		$dia = substr($_SESSION['dataInicio'], 8, 2);
		$mes = substr($_SESSION['dataInicio'], 5, 2);
		$ano = substr($_SESSION['dataInicio'], 0, 4);
		
		$_SESSION['dataInicio'] = trim($dia).'/'.trim($mes).'/'.$ano;
		
		$dia = substr($_SESSION['dataFim'], 8, 2);
		$mes = substr($_SESSION['dataFim'], 5, 2);
		$ano = substr($_SESSION['dataFim'], 0, 4);
		
		$_SESSION['dataFim'] = trim($dia).'/'.trim($mes).'/'.$ano;
	}
	
	include '../database.php';
	$pdo = database::connect();			
		
				
		$sql ="select 
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
			 , 'Admissao'
			 , to_char(dt_alta, 'dd/mm/yyyy hh24:mi')  as dt_alta
		from integracao.vw_bmh_online 
			where  to_date(dt_admss, 'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(dt_admss, 'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy') 	
			   and tipo_bmh_online = 'Admissão'			   
		order by nm_pcnt";
				
		if ($pdo==null){
			header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}

		$arquivo = "relatorio_bmhonline.xls";		
		$fp = fopen($arquivo, "w");
		
		//Admissões
		
		$html = '';
		$html .= '<!DOCTYPE html>';
		$html .= '<html lang="pt-br">';
		$html .= '<head>';
		$html .= '<meta http-equiv="Content-Type" content="text/html; charset=utf-8">';
		$html .= '</head>';	
		$html .= '<body>';	
		$html .= '<table>';	
		$html .= '<tr>';
		$html .= '<td>Tipo de BMHOnline</td>';
		$html .= '<td>Paciente</td>';
		$html .= '<td>Data de Admissão</td>';		
		$html .= '<td>Data de Nascimento</td>';
		$html .= '<td>Convênio</td>';
		$html .= '<td>Médico</td>';
		$html .= '<td>Psicólogo</td>';
		$html .= '<td>Terapeuta</td>';			
		$html .= '<td>CID</td>';
		$html .= '<td>Fumante?</td>';
		$html .= '<td>Retagurada?</td>';
		$html .= '<td>Acompanhante?</td>';
		$html .= '<td>Carater de Inter.</td>';
		$html .= '<td>Dieta</td>';
		$html .= '<td>Consistência</td>';
		$html .= '<td>Ocorrência</td>';		
		$html .= '<td>Destino de alta</td>';		
		$html .= '<td>Data da alta</td>';		
		$html .= '</tr>';
		
		while($row = pg_fetch_row($ret)) {				
			$html .= '<tr>';
			$html .= '<td>'.$row[16].'</td>';
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
			$html .= '<td> </td>';
			$html .= '<td> </td>';					
			$html .= '</tr>';
		}	
		
		//Altas
		
		$sql ="select 
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
			 , 'Alta'
			 , to_char(dt_alta, 'dd/mm/yyyy hh24:mi')  as dt_alta
		from integracao.vw_bmh_online 
			where  to_date(to_char(dt_alta,'dd/mm/yyyy'),'dd/mm/yyyy') >= to_date('".$_SESSION['dataInicio']."','dd/mm/yyyy')
			   and to_date(to_char(dt_alta,'dd/mm/yyyy'),'dd/mm/yyyy') <= to_date('".$_SESSION['dataFim']."','dd/mm/yyyy')
	   and tipo_bmh_online = 'Alta' order by nm_pcnt";
				
		if ($pdo==null){
			header(Config::$webLogin);
		}	
		$ret = pg_query($pdo, $sql);
		if(!$ret) {
			echo pg_last_error($pdo);
			exit;
		}

		while($row = pg_fetch_row($ret)) {				
			$html .= '<tr>';
			$html .= '<td>'.$row[16].'</td>';
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
			$html .= '<td>'.$row[17].'</td>';					
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
	<body style="margin-right: 0; margin-left: 0">	
		<div class="container" style="width: 100%;  margin-right: 0; margin-left: 0; position: relative;">
		  <div class="modal-dialog">
				<div class="modal-content" style="width:800px">
					<div class="container">						
						<h4 class="modal-title">Relatório no Formato de Excel do BMHOnline - Por Período</h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">
								<tr>  
									<td width="50%"><label>Data Incial:</label></td>  
									<td width="150%"><label><?php echo $_SESSION['dataInicio']; ?></label></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Data Final:</label></td>  
									<td width="150%"><label><?php echo $_SESSION['dataFim']; ?></label></td>  
								 </tr>	
								 <br>									
								 <!--style="display:none"-->
								 
								</table>																
							</div>
							
							<div class="modal-footer">										
								<a href="<?php echo $arquivo;?>">Download do Relatório</a>
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">
							</div>
						</div>
					</form>	
				</div>				
			</div>
		</div>						
		<script src="../js/jquery.min.js"></script>	 
		<script src="../js/bootstrap.min.js"></script>	 		
</body>
</html>	

<?php 
    
	
?>