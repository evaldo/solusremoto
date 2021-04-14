<?php
//delete_cores.php
	session_start();
	$_SESSION['id_grvd_risco_pcnt']=$_POST['id_grvd_risco_pcnt'];
		
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
						<h4 class="modal-title">Exclusão das Gravidades do Risco</h4>
					</div>										
					<div class="modal-body">
						<div class="table-responsive">  
							<table class="table table-bordered">
								 <tr>  
									<td width="50%"><label>Id da Gravidade do Risco:</label></td>  
									<td width="500%"><?php echo $_POST['id_grvd_risco_pcnt']; ?></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Descrição da Gravidade do Risco:</label></td>  
									<td width="500%"><?php echo $_POST['nm_grvd_risco_pcnt']; ?></td>  
								 </tr>								 
								 <tr>  
									<td width="50%"><label>Cor da Gravidade do Risco:</label></td>  
									<td width="500%"><?php echo $_POST['cd_cor_grvd_risco']; ?></td>  
								 </tr>
							</table>
						</div>
					</div>
					<div class="modal-footer">					
						<form class="form-inline" action="#" method="post" >
							<input type="submit" class="btn btn-danger" name="deleta" value="Apagar">&nbsp;&nbsp;&nbsp;&nbsp;
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
