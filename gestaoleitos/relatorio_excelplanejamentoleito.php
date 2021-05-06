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
				
		if ($pdo==null){
			header(Config::$webLogin);
		}			

		$arquivo = "relatorio_planejamentodemanda.xls";		
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
		$html .= '<td>Id</td>';
		$html .= '<td>Candidato a vaga</td>';
		$html .= '<td>Data de Nasc</td>';		
		$html .= '<td>Convênio</td>';
		$html .= '<td>Contato</td>';
		$html .= '<td>Dt. Prev. de Admissão</td>';
		$html .= '<td>Leito Alocado</td>';
		$html .= '<td>Origem da Demanda</td>';			
		$html .= '<td>Gravidade do Risco</td>';
		$html .= '<td>Paciente Admitido?</td>';								
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
						<h4 class="modal-title">Relatório do Planejamento da Demanda de Leitos</h4>
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