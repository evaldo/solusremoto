<?php
//delete_cores.php
	session_start();
	$_SESSION['id_grupo_usua_transac_acesso']=$_POST['id_grupo_usua_transac_acesso'];
		
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
						<h4 class="modal-title">Exclusão de Grupos de Transação</h4>
					</div>										
					<div class="modal-body">
						<div class="table-responsive">  
							<table class="table table-bordered">
								 <tr>  
									<td width="50%"><label>Id do Grp Acesso Transac:</label></td>  
									<td width="500%"><?php echo $_POST['id_grupo_usua_transac_acesso']; ?></td>  
								 </tr>
								  <tr>  
									<td width="50%"><label>Transação:</label></td>  
									<td width="500%"><?php echo $_POST['nm_acesso_transac_integracao']; ?></td>  
								 </tr>								 
								 <tr>  
									<td width="50%"><label>Grupo de Acesso:</label></td>  
									<td width="500%"><?php echo $_POST['nm_grupo_acesso']; ?></td>  
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
