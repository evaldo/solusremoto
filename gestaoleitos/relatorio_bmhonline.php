 <?php  
	
	session_start();
	
	include '../database.php';
	$pdo = database::connect();			
	
	if(isset($_POST['dataInicio'])){		
		
		$_SESSION['dataInicio']=$_POST['dataInicio'];			
		$_SESSION['dataFim']=$_POST['dataFim'];
	
	}
	//2020-06-23
	$dia = substr($_SESSION['dataInicio'], 8, 2);
	$mes = substr($_SESSION['dataInicio'], 5, 2);
	$ano = substr($_SESSION['dataInicio'], 0, 4);
	
	$_SESSION['dataInicio'] = trim($dia).'/'.trim($mes).'/'.$ano;
	
	$dia = substr($_SESSION['dataFim'], 8, 2);
	$mes = substr($_SESSION['dataFim'], 5, 2);
	$ano = substr($_SESSION['dataFim'], 0, 4);
	
	$_SESSION['dataFim'] = trim($dia).'/'.trim($mes).'/'.$ano;
	
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
						<h4 class="modal-title">Relatório do BMHOnline - Por Período</h4>
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
							   
								 <!--style="display:none"-->
																 
								</table>								
							</div>
							<div class="modal-footer">	
								<input type="submit" class="btn btn-primary" name="altera" value="Imprimir" onclick="window.open('../tcpdf/relatorio/impressao_relatoriobmh_online.php');">		
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