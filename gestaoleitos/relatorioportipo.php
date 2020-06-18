 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();			
	
	if(isset($_POST['tpimpressao'])){		
		 
		$_SESSION['stpimpressao']=$_POST['tpimpressao'];
		$_SESSION['varsl_tp_psco']=$_POST['varsl_tp_psco'];
		$_SESSION['varsl_tp_mdco']=$_POST['varsl_tp_mdco'];
		$_SESSION['varsl_tp_trpa']=$_POST['varsl_tp_trpa'];
		$_SESSION['varsl_tp_andar']=$_POST['varsl_tp_andar'];		
		
		
		if ($_SESSION['stpimpressao'] == "andar"){
			$vartpimpressao = "Andar";
			$varfiltro=$_SESSION['varsl_tp_andar'];
		}
		
		if ($_SESSION['stpimpressao'] == "medico"){
			$vartpimpressao = "Médico";
			$varfiltro=$_SESSION['varsl_tp_mdco'];
		}
		
		if ($_SESSION['stpimpressao'] == "psicologo"){
			$vartpimpressao = "Psicólogo";
			$varfiltro=$_SESSION['varsl_tp_psco'];
		}
		
		if ($_SESSION['stpimpressao'] == "terapeuta"){
			$vartpimpressao = "Terapeuta";
			$varfiltro=$_SESSION['varsl_tp_trpa'];
		}
		
		if ($_SESSION['stpimpressao'] == 'mapa'){
			$vartpimpressao = "Mapa";
			$varfiltro="Mapa";
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
						<h4 class="modal-title">Emissão de Relatório de Leitos Por <?php echo $vartpimpressao; ?></h4>
					</div>						
					<form class="form-inline" method="post" >
						<div class="modal-body">
							<div class="table-responsive">  							
								<table class="table table-bordered">									
								   <tr>  
										<td style="width:150px"><label><?php echo $vartpimpressao; ?>:</label></td>  										
										<td style="width:150px"><label><?php echo $varfiltro; ?></label></td>  		
										</td>  
									</tr>
								</table>								
							</div>
							<div class="modal-footer">									
								<!-- onclick="window.open('../tcpdf/relatorio/impressao_relatorioporandar.php'); -->								
								<input type="submit" class="btn btn-primary" id="tp_impressao" value="Imprimir" onclick="window.open('../tcpdf/relatorio/impressao_relatorioportipo.php');">
								<input type="submit" class="btn btn-primary" onclick="history.go()" value="Voltar">	
								<!--style="display:none"-->
								<input type="text" id="id_tp_impressao" name="id_tp_impressao" style="display:none">
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