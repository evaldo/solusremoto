<?php
	
	session_start();
	
    include '../database.php';	
	
	$pdo = database::connect();

	$sql = "SELECT tp_atlz_pnel, dt_inicial_cnlta_pnel, dt_final_cnlta_pnel, nu_minuto_lmte_1, nu_minuto_lmte_2, nu_minuto_lmte_3, cd_cor_minuto_limite_1, cd_cor_minuto_limite_2, cd_cor_minuto_limite_3, nu_minuto_lmte_utma_cnlta
	FROM integracao.tb_param_pnel_farmc ";

	if ($pdo==null){
			header(Config::$webLogin);
	}	
	$ret = pg_query($pdo, $sql);
	if(!$ret) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$row = pg_fetch_row($ret);	
	
	$tp_atlz_pnel = $row[0];	
	$dt_inicial_cnlta_pnel = $row[1];
	$dt_final_cnlta_pnel = $row[2];
	$nu_minuto_lmte_1 = $row[3];	
	$nu_minuto_lmte_2 = $row[4];	
	$nu_minuto_lmte_3 = $row[5];	
	$cd_cor_minuto_limite_1 = $row[6];	
	$cd_cor_minuto_limite_2 = $row[7];	
	$cd_cor_minuto_limite_3 = $row[8];
	$nu_minuto_lmte_utma_cnlta = $row[9];
	
	if(isset($_POST['altera'])){					
		
		if ($pdo==null){
			header(Config::$webLogin);
		}
		
		try
		{	
		
			$sql = "UPDATE integracao.tb_param_pnel_farmc
					SET tp_atlz_pnel = ".$_POST['tp_atlz_pnel']."
					  , dt_inicial_cnlta_pnel = '".$_POST['dt_inicial_cnlta_pnel']."'
					  , dt_final_cnlta_pnel = '".$_POST['dt_final_cnlta_pnel']."'
					  , nu_minuto_lmte_1 = ".$_POST['nu_minuto_lmte_1']."
					  , nu_minuto_lmte_2 = ".$_POST['nu_minuto_lmte_2']."
					  , nu_minuto_lmte_3 = ".$_POST['nu_minuto_lmte_3']."
					  , cd_cor_minuto_limite_1 = '".$_POST['cd_cor_minuto_limite_1']."'
					  , cd_cor_minuto_limite_2 = '".$_POST['cd_cor_minuto_limite_2']."'
					  , cd_cor_minuto_limite_3 = '".$_POST['cd_cor_minuto_limite_3']."'
					  , nu_minuto_lmte_utma_cnlta = ".$_POST['nu_minuto_lmte_utma_cnlta']." ";	
			
			$result = pg_query($pdo, $sql);

			if($result){
				echo "";
			}  
			
			$secondsWait = 0;
			header("Refresh:$secondsWait");
		
		
		} catch(PDOException $e)
		{
			die($e->getMessage());
		}
	}
	
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
						<h4 class="modal-title">Alteração dos Parâmetros do Painel da Farmácia</h4>
					</div>								
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">			
									 <tr>  
										<td style="width:150px"><label>Tempo em segundos para atualização:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="tp_atlz_pnel" value="<?php echo $tp_atlz_pnel; ?>"></td> 
									 </tr>
									  <tr>  
										<td style="width:150px"><label>Data Início da Consulta:</label></td>  
										<td style="width:400px"><input type="date" class="form-control" name="dt_inicial_cnlta_pnel" value="<?php echo $dt_inicial_cnlta_pnel; ?>"></td> 							
									  </tr>									  
									  <tr>  
										<td style="width:150px"><label>Data Fim da Consulta:</label></td>  
										<td style="width:400px"><input type="date" class="form-control" name="dt_final_cnlta_pnel" value="<?php echo $dt_final_cnlta_pnel; ?>"></td> 							
									  </tr>											  
									  <tr>  
										<td style="width:150px"><label>Minutos do Limite 1:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nu_minuto_lmte_1" value="<?php echo $nu_minuto_lmte_1; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Cor para o Limite 1:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_cor_minuto_limite_1" value="<?php echo $cd_cor_minuto_limite_1; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Minutos do Limite 2:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nu_minuto_lmte_2" value="<?php echo $nu_minuto_lmte_2; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Cor para o Limite 2:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_cor_minuto_limite_2" value="<?php echo $cd_cor_minuto_limite_2; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Minutos do Limite 3:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nu_minuto_lmte_3" value="<?php echo $nu_minuto_lmte_3; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Cor para o Limite 3:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="cd_cor_minuto_limite_3" value="<?php echo $cd_cor_minuto_limite_3; ?>"></td> 							
									  </tr>
									  <tr>  
										<td style="width:150px"><label>Minutos Limite da última consulta:</label></td>  
										<td style="width:400px"><input type="text" class="form-control" name="nu_minuto_lmte_utma_cnlta" value="<?php echo $nu_minuto_lmte_utma_cnlta; ?>"></td> 							
									  </tr>
								</table>																
							</div>								
							<div class="modal-footer">	
								<input type="submit" class="btn btn-danger" name="altera" value="Alterar">													
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
