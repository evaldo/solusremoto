<?php
//delete_cores.php
	session_start();
	
	include '../database.php';
    $pdo = database::connect();
	
	$sqlpddotrtmto = "SELECT id_pddo_trtmto, nm_pcnt from tratamento.tb_pddo_trtmto 
	where id_pddo_trtmto = (SELECT max(id_pddo_trtmto) from tratamento.tb_pddo_trtmto where cd_pcnt = '".$_POST['cd_pcnt']."') and id_hstr_pnel_solic_trtmto is not null ";	
									
	$retpddotrtmto = pg_query($pdo, $sqlpddotrtmto);	
	
	if(!$retpddotrtmto) {
		echo pg_last_error($pdo);
		exit;
	}
	
	$rowpddotrtmto = pg_fetch_row($retpddotrtmto);
	
?>
	<!DOCTYPE html>
	<html lang="pt-br">
	<head>
	 <meta charset="utf-8">
	 <link href="../css/bootstrap.min.css" rel="stylesheet">
	 <link href="../css/style.css" rel="stylesheet">
	</head>
	<body>	
		<div class="container">
		  <div class="modal-dialog">
				<div class="modal-content">
					<div class="container">						
						<h4 class="modal-title">Impressao do Pedido de Tratamento</h4>
					</div>										
					<div class="modal-body">
						<div class="table-responsive">  
							<table class="table table-bordered">
								 <tr>  
									<td width="50%"><label>Id do Pedido:</label></td>  
									<td width="500%"><?php $_SESSION['id_pddo_trtmto'] = $rowpddotrtmto[0]; echo $rowpddotrtmto[0]; ?></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Nome do paciente:</label></td>  
									<td width="500%"><?php echo $rowpddotrtmto[1]; ?></td>  
								 </tr>								 								 
							</table>
						</div>
					</div>
					<div class="modal-footer">					
						<form class="form-inline" action="#" method="post" >
							<input type="submit" class="btn btn-danger" name="imprimirpdf" value="Imprimir PDF" onclick="window.open('../tcpdf/relatorio/impressao_pedidotratamento.php');">&nbsp;&nbsp;&nbsp;&nbsp;
							<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">
						</form>
					</div>
				</div>
			</div>
		</div>		
		<script src="../js/jquery.min.js"></script>
		<script src="../js/bootstrap.min.js"></script>
	</body>
	</html>
		
<?php 
    
	
?>
